<script setup>
import { computed, onMounted, ref, watch } from 'vue';
import { useI18n } from 'vue-i18n';
import iconAddFavorite from '@img/icons/olive/fav_icon_active.svg';
import iconFavorited from '@img/icons/inFavorite.svg';
import cartWhite from '@img/icons/cart_white.svg';
import SizeGuide from '@/components/ui/sizeGuide.vue';
import Button from '@/components/ui/Button.vue';
import { useFavoritesStore } from '@/stores/favorites';
import { useCartStore } from '@/stores/cart';
import { useAlert } from '@/useAlert.js';

const { toggleFavorite, isFavorite } = useFavoritesStore();
const cartStore = useCartStore();
const { showAlert } = useAlert();

const props = defineProps({
    product: {
        type: Object,
        required: true,
    },
    sizeChartUrl: {
        type: String,
        default: '',
    },
});

const { t, locale } = useI18n();

// --- Selection states
const selectedColorId = ref(props.product.variants?.[0]?.color?.id || null);
const selectedSizeId = ref(null);

// --- Unique colors (no duplicates)
const uniqueColors = computed(() => {
    const seen = new Set();
    return props.product.variants
        .map((v) => v.color)
        .filter((color) => {
            if (seen.has(color.id)) return false;
            seen.add(color.id);
            return true;
        });
});

const sizes = computed(() => {
    const allSizes = props.product.variants.map((v) => v.size);
    const unique = [];
    allSizes.forEach((s) => {
        if (!unique.find((u) => u.id === s.id)) unique.push(s);
    });

    return unique.sort((a, b) => {
        if (a.sort_order === b.sort_order) {
            return a.id - b.id;
        }
        return a.sort_order - b.sort_order;
    });
});

// --- List of available sizes for selected color
const availableSizes = computed(() => {
    return props.product.variants
        .filter((v) => v.color.id === selectedColorId.value)
        .map((v) => v.size)
        .filter((size, index, self) => self.findIndex((s) => s.id === size.id) === index); // unique
});

// --- Auto-select first available size after changing color
watch(
    selectedColorId,
    (newColorId) => {
        const sizes = props.product.variants.filter((v) => v.color.id === newColorId).map((v) => v.size.id);

        selectedSizeId.value = sizes.length ? sizes[0] : null;
    },
    { immediate: true },
);

// --- Currently selected variant
const selectedVariant = computed(() => {
    return props.product.variants.find(
        (v) => v.color.id === selectedColorId.value && v.size.id === selectedSizeId.value,
    );
});

// --- Selected variant ID (to send to server during purchase)
const selectedVariantId = computed(() => selectedVariant.value?.id || null);

// update url
// TODO add slug color and size
watch([selectedColorId, selectedSizeId], ([newColor, newSize]) => {
    if (newColor && newSize) {
        const url = new URL(window.location.href);
        url.searchParams.set('color', newColor);
        url.searchParams.set('size', newSize);
        window.history.replaceState({}, '', url);
    }
});
onMounted(() => {
    const url = new URL(window.location.href);
    const colorFromUrl = url.searchParams.get('color');
    const sizeFromUrl = url.searchParams.get('size');

    if (colorFromUrl && sizeFromUrl) {
        const variant = props.product.variants.find(
            (v) => String(v.color.id) === colorFromUrl && String(v.size.id) === sizeFromUrl,
        );
        if (variant) {
            selectedColorId.value = variant.color.id;
            selectedSizeId.value = variant.size.id;
            return;
        }
    }

    // fallback: перший варіант
    const first = props.product.variants[0];
    if (first) {
        selectedColorId.value = first.color.id;
        selectedSizeId.value = first.size.id;
    }
});
const addToCart = async (event) => {
    if (!selectedVariantId.value) return;
    console.log(locale.value);
    await window.axios
        .post('cart', {
            variant_id: selectedVariantId.value,
            quantity: 1,
        })
        .then((response) => {
            if (response.data?.alert) {
                showAlert(response.data?.alert);
            }
            cartStore.fetchCart();

            console.log('Product added to cart successfully');
        })
        .catch((error) => {
            console.error('Error adding product to cart:', error);
        });
};

// --- Selected color name (optional, but convenient)
const selectedColorName = computed(() => {
    return props.product.variants.find((v) => v.color.id === selectedColorId.value)?.color.name || '';
});

// --- Prices
const priceFinal = computed(() => {
    if (selectedVariant.value) {
        return Math.round(selectedVariant.value.price_final / 100);
    }
    return 0;
});

const priceOnline = computed(() => {
    if (selectedVariant.value) {
        return Math.round((selectedVariant.value.price_online ?? 0) / 100);
    }
    return 0;
});

// --- Discount
const discountPercent = computed(() => {
    if (selectedVariant.value && selectedVariant.value.price_online) {
        return Math.round(100 - (priceFinal.value / priceOnline.value) * 100);
    }
    return 0;
});

const hasDiscount = computed(() => {
    console.log(props.product);
    return selectedVariant.value?.discount_display;
});

let clickedRecently = false;

const handleFavoriteClick = (id, name) => {
    if (clickedRecently) return;
    clickedRecently = true;
    setTimeout(() => (clickedRecently = false), 300);
    toggleFavorite(id, name);
};
</script>

<template>
    <div class="page-fade relative flex max-w-full flex-col items-start justify-start">
        <div class="flex max-w-full flex-col items-start justify-start gap-3 pb-8">
            <div class="relative inline-flex items-start justify-start gap-4">
                <div
                    class="text-charcoal max-w-full text-[24px] leading-[62.40px] font-bold opacity-80 md:text-center md:text-3xl"
                >
                    {{ product.name[locale] }}
                </div>

                <div v-if="product.is_new" class="flex items-center justify-center gap-2">
                    <div
                        class="bg-olive absolute top-0 -right-16 mt-0 w-max -translate-x-2/5 rounded-full px-3 py-1 text-sm font-bold text-white uppercase transition-opacity duration-300"
                    >
                        {{ $t('product.new') }}
                        <div
                            class="border-b-olive absolute -bottom-0.5 left-1/3 -z-1 h-0 w-0 rotate-90 border-r-8 border-b-8 border-l-8 border-r-transparent border-l-transparent"
                        ></div>
                    </div>
                </div>
            </div>
            <div class="text-charcoal overflow-hidden text-sm leading-normal font-normal opacity-60">
                {{ product.description[locale] }}
            </div>
        </div>

        <!-- Ціна -->
        <div class="inline-flex items-end justify-start gap-2 pb-8">
            <div class="text-charcoal text-5xl leading-[48px] font-medium opacity-80">
                {{ priceFinal }} {{ t('product.mdl') }}
            </div>
            <div v-if="hasDiscount" class="relative flex items-center justify-start gap-2">
                <div
                    class="bg-danger absolute -top-full left-2/3 w-fit -translate-x-2/5 rounded-full px-2 py-0 text-sm font-bold text-nowrap text-white uppercase"
                >
                    -{{ selectedVariant.discount_display }}%
                    <div
                        class="border-b-danger absolute -bottom-0.5 left-1/3 -z-1 h-0 w-0 rotate-90 border-r-8 border-b-8 border-l-8 border-r-transparent border-l-transparent"
                    ></div>
                </div>
                <div class="text-charcoal text-right text-sm leading-[25.20px] font-normal line-through opacity-30">
                    {{ priceOnline }} {{ t('product.mdl') }}
                </div>
            </div>
        </div>

        <!-- Колір -->
        <div class="flex w-full flex-col items-start justify-start gap-8 border-t border-[#eeeeee] py-8">
            <div class="flex w-full flex-col items-start justify-start gap-4">
                <h3 class="text-sm font-medium text-gray-900">
                    {{ t('product.choose-color') }} - <span>{{ selectedColorName[locale] }}</span>
                </h3>
                <fieldset aria-label="Choose a color">
                    <div class="flex items-center gap-x-3 space-x-3">
                        <label
                            v-for="color in uniqueColors"
                            :key="color.id"
                            :aria-label="color.name"
                            class="relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0 ring-gray-400"
                        >
                            <input
                                v-model="selectedColorId"
                                :value="color.id"
                                class="peer sr-only"
                                name="color-choice"
                                type="radio"
                            />
                            <span
                                class="border-opacity-10 relative h-8 w-8 rounded-full border border-black/10 bg-transparent p-1 peer-checked:ring"
                            >
                                <span
                                    :style="{ backgroundColor: color.hex }"
                                    class="absolute inset-0 rounded-full border border-black/10"
                                ></span>
                            </span>
                        </label>
                    </div>
                </fieldset>
            </div>

            <!-- Розмір -->
            <div class="flex w-full flex-col items-start justify-start gap-4">
                <div class="flex w-full items-center justify-between">
                    <div class="text-charcoal inline-flex text-base font-normal">
                        {{ t('product.desc.size') }}
                    </div>
                    <sizeGuide :size-chart-url="sizeChartUrl"></sizeGuide>
                </div>
                <fieldset aria-label="Choose a size">
                    <div class="flex flex-wrap items-center justify-start gap-3 pb-1 md:gap-4">
                        <label
                            v-for="size in sizes"
                            :key="size.id"
                            :aria-label="size.name"
                            class="flex items-center justify-center"
                        >
                            <input
                                v-model="selectedSizeId"
                                :disabled="!availableSizes.some((s) => s.id === size.id)"
                                :value="size.id"
                                class="peer sr-only"
                                name="size-choice"
                                type="radio"
                            />
                            <span
                                :class="{
                                    'cursor-not-allowed opacity-40': !availableSizes.some((s) => s.id === size.id),
                                }"
                                class="peer-checked:border-olive flex w-fit min-w-auto items-center justify-center gap-x-2.5 rounded-full border border-[#eeeeee] bg-white px-3 py-3 text-center md:min-w-24 md:px-5 md:py-3"
                            >
                                <template v-for="(member, index) in product.compatible_with" :key="member.id">
                                    <div
                                        v-if="member.compatible_size_id == size.id"
                                        :class="product.gender.bg_color"
                                        class="group/gender relative flex h-4 w-auto items-center justify-center gap-x-0 rounded-full"
                                    >
                                        <span
                                            :class="member.bg_color_name"
                                            class="flex size-6 items-center justify-center rounded-full text-xs font-bold text-white"
                                        >
                                            {{ member.letter }}
                                        </span>
                                        <div
                                            class="absolute top-full left-10/12 z-10 mt-2 w-max -translate-x-2/5 rounded-full bg-black px-4 py-1.5 text-sm text-white opacity-0 transition-opacity duration-300 group-hover/gender:opacity-100"
                                        >
                                            <p>{{ $t('product.compatible_with', { name: member.name }) }}</p>
                                            <div
                                                class="absolute -top-1 left-1/3 h-0 w-0 rotate-90 border-r-8 border-b-8 border-l-8 border-r-transparent border-b-black border-l-transparent"
                                            ></div>
                                        </div>
                                    </div>
                                </template>

                                <span class="text-charcoal text-sm leading-[14px] font-bold">
                                    {{ size.name[locale] }}
                                </span>
                            </span>
                        </label>
                    </div>
                </fieldset>
                <div
                    class="flex w-full flex-col items-start justify-center gap-10 border-t border-b border-[#eeeeee] py-6"
                >
                    <div class="w-full flex-row items-center justify-between gap-4 md:flex">
                        <Button
                            buttonPrimary
                            customClass="text-olive font-bold text-[15px] text-center w-[93vw] md:w-5/12"
                            @click="handleFavoriteClick(product.id, product.name[locale])"
                        >
                            <img
                                :src="isFavorite(product.id) ? iconFavorited : iconAddFavorite"
                                alt=""
                                class="size-4"
                            />
                            {{
                                isFavorite(product.id)
                                    ? t('product.remove-from-favorites')
                                    : t('product.add-to-favorite')
                            }}
                        </Button>

                        <Button customClass="text-white text-[16px]  font-bold w-[93vw] md:w-7/12" @click="addToCart">
                            <img :src="cartWhite" alt="" />
                            {{ t('product.add-to-cart') }}
                        </Button>
                        <div id="sticky-trigger" class="absolute -bottom-[110px] h-[1px]"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
