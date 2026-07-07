<script>
import { computed, getCurrentInstance, onMounted, onUnmounted, ref, watch } from 'vue';
import clickOutside from '@/clickOutside.js';
import { useCartStore } from '@/stores/cart';
import iconTrash from '@img/common/trash.svg';
import iconTrashMobile from '@img/icons/trash_b.png';
import iconCheck from '@img/icons/checked_white.svg';
import iconDelete from '@img/icons/close.svg';
import basket_empty from '@img/basket_empty.svg';
import { useI18n } from 'vue-i18n';
import BaseCheckbox from '@/components/ui/BaseCheckbox.vue';
import selectIcon from '@img/icons/select-arrows_o.svg';
import Button from '@/components/ui/Button.vue';

export default {
    name: 'Cart',
    components: { Button, BaseCheckbox },

    directives: {
        clickOutside,
    },
    data() {
        return {
            iconTrash,
            iconCheck,
            iconDelete,
            iconTrashMobile,
            basket_empty,
            cartItems: [],
        };
    },
    setup() {
        const { locale, t, n } = useI18n();
        const cartStore = useCartStore();
        const isMobile = ref(false);
        const { proxy } = getCurrentInstance();

        const checkIsMobile = () => {
            isMobile.value = window.innerWidth <= 768; // наприклад, 768px як межа
        };

        onMounted(() => {
            checkIsMobile();
            window.addEventListener('resize', checkIsMobile);
        });

        onUnmounted(() => {
            window.removeEventListener('resize', checkIsMobile);
        });
        const getColorById = (item, id) => {
            return item.product.variants.map((v) => v.color).find((c) => c.id === id);
        };
        // Отримати назву розміру за id
        const getSizeNameById = (item, id) => {
            const size = item.product.variants.map((v) => v.size).find((s) => s.id === id);
            return size ? size.name[locale.value] : '';
        };
        // Коли обирають розмір
        const selectSize = (item, sizeId) => {
            item.selectedSizeId = sizeId;
            item.sizeDropdownOpen = false;
            updateAvailableColors(item);
            updateSelectedPrice(item);
            // Changing the variant re-creates the cart line (new hash) — resync to pick it up.
            updateItem(item, { resync: true });
        };
        // Коли обирають колір
        const selectColor = (item, colorId) => {
            item.selectedColorId = colorId;
            item.colorDropdownOpen = false;
            updateSelectedPrice(item);
            updateItem(item, { resync: true });
        };
        // Отримати список унікальних розмірів (для dropdown)
        const getUniqueSizes = (item) => {
            const seen = new Set();
            return item.product.variants
                .map((v) => v.size)
                .filter((s) => {
                    if (seen.has(s.id)) return false;
                    seen.add(s.id);
                    return true;
                });
        };
        // Отримати кольори, доступні лише для обраного розміру
        const getAvailableColors = (item) => {
            if (!item.selectedSizeId) return [];

            const seen = new Set();
            return item.product.variants
                .filter((v) => v.size.id === item.selectedSizeId)
                .map((v) => v.color)
                .filter((c) => {
                    if (seen.has(c.id)) return false;
                    seen.add(c.id);
                    return true;
                });
        };
        // Після вибору розміру, оновлюємо список доступних кольорів
        const updateAvailableColors = (item) => {
            const colors = getAvailableColors(item);
            item.selectedColorId = colors.length ? colors[0].id : null;
        };
        const getAllColorsWithAvailability = (item) => {
            const allColors = [];
            const seen = new Set();
            const currentSizeId = item.selectedSizeId;
            item.product.variants.forEach((variant) => {
                const { color, size } = variant;
                if (!seen.has(color.id)) {
                    seen.add(color.id);

                    const isAvailableForCurrentSize = item.product.variants.some(
                        (v) => v.color.id === color.id && v.size.id === currentSizeId,
                    );

                    allColors.push({
                        ...color,
                        available: isAvailableForCurrentSize,
                    });
                }
            });

            return allColors;
        };
        const min = 1;
        const max = 30;
        const increment = (item) => {
            if (item.quantity < max) {
                item.quantity++;
                updateItem(item);
            }
        };

        const decrement = (item) => {
            if (item.quantity > min) {
                item.quantity--;
                updateItem(item);
            }
        };
        const updateSelectedPrice = (item) => {
            const variant = item.product.variants.find(
                (v) => v.size.id === item.selectedSizeId && v.color.id === item.selectedColorId,
            );
            item.selectedPriceOnline = variant?.price_online ?? 0;
            item.selectedPriceFinal = variant?.price_final ?? 0;
            item.selectedDiscount = variant?.discount_amount ?? 0;
        };

        const cartTotalOnline = computed(() => {
            return proxy.cartItems.reduce((total, item) => {
                return total + item.selectedPriceOnline * item.quantity;
            }, 0);
        });

        const cartTotal = computed(() => {
            return proxy.cartItems.reduce((total, item) => {
                return total + item.selectedPriceFinal * item.quantity;
            }, 0);
        });

        const totalDiscount = computed(() => {
            return proxy.cartItems.reduce((acc, item) => {
                const discount = item.selectedDiscount || 0;
                return acc + discount * item.quantity;
            }, 0);
        });
        const updateItem = async (item, { resync = false } = {}) => {
            const variant = item.product.variants.find(
                (v) => v.size.id === item.selectedSizeId && v.color.id === item.selectedColorId,
            );
            if (!variant) return;
            try {
                await cartStore.updateItem(item.hash, variant.id, item.quantity);
                // After a variant change the line's hash changes server-side; re-map the local
                // rows so later edits target the current hash and the new size/colour show.
                if (resync) await proxy.getCartItems();
            } catch (err) {
                console.error('Server error:', err);
            }
        };
        const toggleConfirm = (item) => {
            item.showConfirm = !item.showConfirm;
        };
        const removeItem = async (item) => {
            try {
                await cartStore.removeItem(item.hash);
                proxy.cartItems = proxy.cartItems.filter((i) => i.hash !== item.hash);
            } catch (err) {
                console.error('Server error:', err);
            }
        };

        return {
            t,
            n,
            locale,
            cartStore,
            selectIcon,
            isMobile,
            // основні методи
            getUniqueSizes,
            getAvailableColors,
            updateSelectedPrice,
            updateAvailableColors,
            selectSize,
            selectColor,
            getSizeNameById,
            getColorById,
            getAllColorsWithAvailability,
            increment,
            decrement,
            cartTotal,
            totalDiscount,
            cartTotalOnline,
            toggleConfirm,
            removeItem,
        };
    },
    methods: {
        async getCartItems() {
            try {
                await this.cartStore.fetchCart();
                this.cartItems = this.cartStore.items.map((item) => {
                    const selectedVariant = item.product.variants.find(
                        (v) => v.size.id === item.size.id && v.color.id === item.color.id,
                    );
                    return {
                        ...item,
                        quantity: item.quantity || 1,
                        selected: false,
                        selectedSizeId: item.size.id,
                        selectedColorId: item.color.id,
                        selectedPriceOnline: selectedVariant?.price_online ?? 0,
                        selectedPriceFinal: selectedVariant?.price_final ?? 0,
                        selectedDiscount: selectedVariant?.discount_amount ?? 0,
                        sizeDropdownOpen: false,
                        colorDropdownOpen: false,
                        showConfirm: false,
                    };
                });
            } catch (error) {
                console.error('Server error:', error); // TODO Remove in production
            }
        },
    },
    mounted() {
        this.getCartItems();
    },
};
</script>

<template>
    <div class="w-full justify-between gap-x-16 lg:flex">
        <div class="w-full basis-full">
            <div class="text-charcoal/80 relative mb-4 inline-block text-5xl leading-[62px] font-bold tracking-[-2%]">
                <h1>{{ $t('cart.title') }}</h1>
                <p
                    class="bg-olive absolute top-0 -right-10 flex h-6 w-7 items-center justify-center rounded-full px-3 py-2 text-sm font-extrabold text-white"
                >
                    <span class="p-2">{{ cartItems.length }}</span>
                    <span
                        class="border-b-olive absolute -bottom-[2px] left-1/12 -z-1 h-0 w-4 rotate-95 border-r-8 border-b-8 border-l-8 border-r-transparent border-l-transparent"
                    ></span>
                </p>
            </div>
            <div
                v-if="cartItems.length > 0"
                class="border-light-border mb-7 rounded-lg border py-1 shadow-sm md:px-5 lg:border-none lg:px-0 lg:shadow-none"
            >
                <div v-for="(cartItem, index) in cartItems" :key="cartItem.hash" class="relative w-full">
                    <div v-if="isMobile">
                        <div class="my-2 grid grid-cols-12 items-center justify-between gap-x-3 px-3 py-2">
                            <div
                                class="bg-light-orange col-span-3 flex h-fit max-w-[100px] justify-center rounded-2xl px-1 py-2"
                            >
                                <img :src="cartItem.img" alt="{{cartItem.name}}" class="max-w-[80px]" />
                            </div>
                            <div class="col-span-9">
                                <div class="flex h-full flex-col justify-between">
                                    <div>
                                        <a :href="cartItem.product.url" class="text-[20px] font-medium">{{
                                            cartItem.product.name[locale]
                                        }}</a>
                                        <div class="mt-1 flex items-center gap-x-2">
                                            <div
                                                class="border-r-light-border flex items-center gap-x-2 border-r-2 pr-2"
                                            >
                                                <div
                                                    :style="{
                                                        backgroundColor:
                                                            getColorById(cartItem, cartItem.selectedColorId)?.hex ||
                                                            cartItem.hex,
                                                    }"
                                                    class="border-light-border size-5 rounded-full border"
                                                ></div>
                                                <p class="text-sm opacity-40">{{ cartItem.color.name }}</p>
                                            </div>
                                            <p class="text-sm opacity-40">{{ cartItem.size.name }}</p>
                                        </div>
                                    </div>
                                    <div class="flex w-full items-center justify-between">
                                        <div class="flex w-full items-center justify-between gap-x-2 py-2">
                                            <p>
                                                {{ cartItem.quantity }} x
                                                <span>{{ $n(cartItem.selectedPriceFinal / 100, 'currency') }}</span>
                                                <span class="px-1 text-sm line-through opacity-40">{{
                                                    $n(cartItem.selectedPriceOnline / 100, 'currency')
                                                }}</span>
                                            </p>
                                            <p class="text-olive text-[16px] font-bold">
                                                {{
                                                    $n(
                                                        (cartItem.selectedPriceFinal / 100) * cartItem.quantity,
                                                        'currency',
                                                    )
                                                }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                v-click-outside="() => (cartItem.showConfirm = false)"
                                class="absolute top-1 right-2 col-span-2 flex h-fit items-center justify-center"
                                @click="toggleConfirm(cartItem)"
                            >
                                <div class="text-olive border-light-border cursor-pointer rounded-full border p-2">
                                    <img :src="iconTrashMobile" alt="" />
                                </div>

                                <transition appear name="fade-slide">
                                    <div
                                        v-if="cartItem.showConfirm"
                                        class="absolute -bottom-14 -left-1 grid w-full flex-col items-center justify-between gap-x-2 gap-y-2"
                                    >
                                        <div
                                            class="bg-olive flex h-5 w-10 items-center justify-center rounded-lg px-0 py-1 shadow-sm transition-all duration-300 ease-in-out"
                                            @click="toggleConfirm(cartItem)"
                                        >
                                            <img :src="iconDelete" alt="icon remove" class="size-3" />
                                        </div>
                                        <div
                                            class="bg-danger flex h-5 w-10 justify-center rounded-lg px-0 py-1 text-center shadow-sm transition-all duration-300 ease-in-out"
                                            @click="removeItem(cartItem)"
                                        >
                                            <img :src="iconCheck" alt="" class="size-3" />
                                        </div>
                                    </div>
                                </transition>
                            </div>
                        </div>
                        <hr v-if="index < cartItems.length - 1" class="border-light-border" />
                    </div>

                    <div v-else>
                        <div class="my-2 grid grid-cols-12 items-center justify-between py-2">
                            <div class="col-span-10 flex items-center gap-x-6">
                                <div class="flex gap-x-6">
                                    <div class="bg-light-orange rounded-2xl p-2">
                                        <img
                                            :src="cartItem.img"
                                            alt="{{ cartItem.product.name[locale] }}"
                                            class="w-[84px]"
                                        />
                                    </div>
                                </div>
                                <div>
                                    <div>
                                        <a :href="cartItem.product.url" class="text-[20px] font-medium">{{
                                            cartItem.product.name[locale]
                                        }}</a>
                                        <div class="flex gap-x-2">
                                            <p class="pb-5 opacity-60">
                                                {{ $n(cartItem.selectedPriceFinal / 100, 'currency') }}
                                            </p>
                                            <p class="pb-5 line-through opacity-40">
                                                {{ $n(cartItem.selectedPriceOnline / 100, 'currency') }} lei
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex gap-x-2">
                                        <div class="relative min-w-42 rounded-lg shadow-sm">
                                            <div
                                                v-click-outside="() => (cartItem.sizeDropdownOpen = false)"
                                                class="border-light-border flex w-full items-center justify-between rounded-lg border px-3 py-1"
                                                @click="cartItem.sizeDropdownOpen = !cartItem.sizeDropdownOpen"
                                            >
                                                <p>
                                                    {{
                                                        getSizeNameById(cartItem, cartItem.selectedSizeId) ||
                                                        cartItem.size
                                                    }}
                                                </p>
                                                <img :src="selectIcon" alt="selectIcon" />
                                            </div>

                                            <ul
                                                v-if="cartItem.sizeDropdownOpen"
                                                class="border-light-border absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded border bg-white shadow-sm"
                                            >
                                                <li
                                                    v-for="size in getUniqueSizes(cartItem)"
                                                    :key="size.id"
                                                    class="cursor-pointer px-3 py-2 hover:bg-gray-100"
                                                    @click="selectSize(cartItem, size.id)"
                                                >
                                                    {{ size.name[locale] }}
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- Випадаючий список кольору -->
                                        <div class="relative min-w-42 rounded-lg shadow-sm">
                                            <div
                                                v-click-outside="() => (cartItem.colorDropdownOpen = false)"
                                                class="border-light-border flex w-full items-center justify-between rounded-lg border px-3 py-1"
                                                @click="cartItem.colorDropdownOpen = !cartItem.colorDropdownOpen"
                                            >
                                                <p class="flex items-center gap-x-2">
                                                    <span
                                                        v-if="cartItem.selectedColorId || cartItem.hex"
                                                        :style="{
                                                            backgroundColor:
                                                                getColorById(cartItem, cartItem.selectedColorId)?.hex ||
                                                                cartItem.hex,
                                                        }"
                                                        class="border-light-border block min-h-5 min-w-5 rounded-full border"
                                                    ></span>
                                                    {{
                                                        getColorById(cartItem, cartItem.selectedColorId)?.name[
                                                            locale
                                                        ] || getColorById(cartItem, cartItem.color_id)?.name[locale]
                                                    }}
                                                </p>
                                                <img :src="selectIcon" alt="selectIcon" />
                                            </div>

                                            <ul
                                                v-if="cartItem.colorDropdownOpen"
                                                class="border-light-border absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded border bg-white shadow-sm"
                                            >
                                                <li
                                                    v-for="color in getAllColorsWithAvailability(cartItem)"
                                                    :key="color.id"
                                                    :class="{
                                                        'cursor-pointer hover:bg-gray-100': color.available,
                                                        'cursor-not-allowed opacity-50': !color.available,
                                                    }"
                                                    class="flex cursor-pointer gap-x-2 px-3 py-2 hover:bg-gray-100"
                                                    @click="color.available && selectColor(cartItem, color.id)"
                                                >
                                                    <span
                                                        :style="{ backgroundColor: color.hex }"
                                                        class="border-light-border block h-5 w-5 rounded-full border"
                                                    ></span>
                                                    {{ color.name[locale] }}
                                                </li>
                                            </ul>
                                        </div>
                                        <div
                                            class="border-light-border flex min-w-24 items-center justify-between gap-x-2 rounded-lg border px-2 py-1 shadow-sm select-none"
                                        >
                                            <div class="cursor-pointer font-bold" @click="decrement(cartItem)">
                                                <p class="opacity-40">-</p>
                                            </div>
                                            <div>{{ cartItem.quantity }}</div>
                                            <div class="cursor-pointer font-bold" @click="increment(cartItem)">
                                                <p class="opacity-40">+</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-2 grid min-h-full content-between justify-end gap-6">
                                <div class="flex justify-end">
                                    <p class="text-olive font-bold">
                                        {{ $n((cartItem.selectedPriceFinal / 100) * cartItem.quantity, 'currency') }}
                                    </p>
                                </div>
                                <div
                                    v-click-outside="() => (cartItem.showConfirm = false)"
                                    class="text-olive bg-light-orange border-light-border shadow-sn shadow-olive relative flex h-fit w-fit cursor-pointer content-between justify-end gap-x-2 rounded-lg border px-4 py-2"
                                    @click="toggleConfirm(cartItem)"
                                >
                                    <img :src="iconTrash" alt="" />
                                    <p class="text-sm font-bold">
                                        {{ $t('cart.delete') }}
                                    </p>

                                    <transition appear name="fade-slide">
                                        <div
                                            v-if="cartItem.showConfirm"
                                            class="absolute right-0 -bottom-8 flex w-full items-center justify-between gap-x-2"
                                        >
                                            <div
                                                class="bg-olive flex h-5 w-full justify-center rounded-2xl py-1 text-center opacity-85 shadow-sm transition-all duration-300 ease-in-out hover:opacity-100"
                                                @click="toggleConfirm(cartItem)"
                                            >
                                                <img :src="iconDelete" alt="" />
                                            </div>
                                            <div
                                                class="bg-danger flex h-5 w-full justify-center rounded-2xl py-1 text-center opacity-85 shadow-sm transition-all duration-300 ease-in-out hover:opacity-100"
                                                @click="removeItem(cartItem)"
                                            >
                                                <img :src="iconCheck" alt="" />
                                            </div>
                                        </div>
                                    </transition>
                                </div>
                            </div>
                        </div>
                        <hr class="border-light-border my-4" />
                    </div>
                </div>
            </div>
            <div v-else class="grid justify-center p-4 text-center md:p-6">
                <img :src="basket_empty" alt="" class="mx-auto py-4" />
                <div class="py-4">
                    <p class="py-1 text-lg">
                        {{ $t('cart.empty') }}
                    </p>
                    <p class="py-1 text-sm font-normal opacity-60">
                        {{ $t('cart.empty_description') }}
                    </p>
                </div>
                <Button :href="route('products.index')" customClass="mx-auto mt-0 w-full" display-as="a" withArrow>
                    {{ $t('cart.btn_explore') }}
                </Button>
            </div>
        </div>
        <!--  Summary  -->
        <div
            v-if="cartItems.length > 0"
            class="sticky top-10 flex h-fit w-full flex-shrink-0 grow-5 basis-[340px] rounded-xl border border-[#eeeeee]/70 shadow-sm"
        >
            <div class="flex w-full grow-0 rounded-xl border border-[#eeeeee]/70 shadow-lg">
                <div class="static h-auto w-full p-6 text-nowrap">
                    <h4 class="flex w-full pb-6 text-2xl leading-6 font-bold tracking-[-2%] text-gray-800">
                        {{ $t('cart.summary.title') }}
                    </h4>

                    <div class="border-dark-snow flex w-full flex-col space-y-4 border-y py-6">
                        <div class="flex w-full justify-between">
                            <span class="text-charcoal/40 text-base font-normal tracking-[-2%]">
                                {{ $t('cart.summary.products') }}
                            </span>
                            <span class="text-charcoal text-base font-medium tracking-[-2%]">
                                {{ $n(cartTotalOnline / 100, 'currency') }}
                            </span>
                        </div>

                        <div class="flex w-full justify-between">
                            <span class="text-charcoal/40 text-base font-normal tracking-[-2%]">
                                {{ $t('cart.summary.discount') }}
                            </span>
                            <span class="text-charcoal text-base font-medium tracking-[-2%]">
                                {{ $n(totalDiscount / 100, 'currency') }}
                            </span>
                        </div>
                    </div>

                    <div class="flex w-full justify-between pt-6">
                        <span class="text-charcoal text-base font-medium tracking-[-2%]">
                            {{ $t('cart.summary.total') }}
                        </span>
                        <span class="text-charcoal text-base font-extrabold tracking-[-2%]">
                            {{ $n(cartTotal / 100, 'currency') }}
                        </span>
                    </div>

                    <div class="flex w-full pt-6">
                        <Button :display-as="`a`" :href="`cart/checkout`" class="w-full" withArrow>
                            {{ $t('cart.checkout_btn') }}
                        </Button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<!--<style scoped>-->
<!--.fade-slide-enter-active,-->
<!--.fade-slide-leave-active {-->
<!--    transition: opacity 0.2s ease, transform 0.2s ease;-->
<!--}-->

<!--.fade-slide-enter-from {-->
<!--    opacity: 0;-->
<!--    transform: translateY(8px);-->
<!--}-->

<!--.fade-slide-enter-to {-->
<!--    opacity: 1;-->
<!--    transform: translateY(0);-->
<!--}-->

<!--.fade-slide-leave-from {-->
<!--    opacity: 1;-->
<!--    transform: translateY(0);-->
<!--}-->

<!--.fade-slide-leave-to {-->
<!--    opacity: 0;-->
<!--    transform: translateY(8px);-->
<!--}-->

<!--</style>-->
