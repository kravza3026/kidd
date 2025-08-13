<script>
import { ref, onMounted, onUnmounted } from 'vue';
import cartIcon from '@img/cart.svg';
import cartIconOpen from '@img/icons/cartOpen.svg';
import basket_empty from '@img/basket_empty.svg';
import Button from '@/components/ui/Button.vue';
import { emitter } from '@/eventBus.js';

export default {
    name: 'CartDropdown',
    components: {
        Button,
    },
    setup() {
        const cartItems = ref([]);
        const cartGrandTotal = ref(0);
        const open = ref(false);
        const dropdown = ref(null);
        const locale = document.documentElement.lang || 'ro';
        const getCartItems = async () => {
            try {
                const response = await window.axios.get('cart');
                cartItems.value = response.data.items;
                cartGrandTotal.value = response.data.grand_total;
            } catch (error) {
                console.error('Server error:', error);
            }
        };
        getCartItems.fetched = false;

        const handleClickOutside = (event) => {
            if (dropdown.value && !dropdown.value.contains(event.target)) {
                open.value = false;
            }
        };

        // 🔄 Додаємо слухач
        onMounted(() => {
            getCartItems();
            document.addEventListener('click', handleClickOutside);
            emitter.on('cart-updated', getCartItems);
        });

        // ❌ Прибираємо слухач
        onUnmounted(() => {
            document.removeEventListener('click', handleClickOutside);
            emitter.off('cart-updated', getCartItems);
        });

        return {
            cartItems,
            cartGrandTotal,
            open,
            dropdown,
            cartIcon,
            cartIconOpen,
            basket_empty,
            toggle: () => (open.value = !open.value),
        };
    },
};

</script>

<template>
    <div class="cart relative cursor-pointer " ref="dropdown" @click="toggle">
       <div class="group relative">
           <img :src="cartIcon" width="24" height="24" alt="cart" class="opacity-65 md:opacity-100">
            <div v-if="cartItems.length > 0" class="absolute flex items-center justify-center -top-2 -right-2 bg-olive rounded-full p-1 w-[16px] h-[16px]">
                <span class="text-[10px] text-white">{{cartItems.length}}</span>
            </div>

           <div class="absolute left-2/3 -translate-x-2/5 top-full mt-2 w-max bg-black text-white text-sm px-3 py-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10">
               {{ $t('cart.tooltip') }}
               <div class="absolute -top-1 left-1/3 rotate-90 w-0 h-0 border-l-8 border-r-8 border-b-8 border-l-transparent border-r-transparent border-b-black"></div>
           </div>
       </div>

        <!-- full dropdown cart menu -->
        <transition name="slide-fade" @click.stop>
            <div
                v-if="open"
                class="fixed inset-0 h-[calc(100%-162px)] md:h-fit md:inset-auto left-0 md:-right-12 w-full p-4 md:p-0  md:absolute cursor-auto border-t md:border-light-border  top-[72px] md:top-full md:mt-4 md:w-105 bg-white md:shadow-xl md:rounded-xl z-50 "
            >
                <i class="w-[15px] h-[15px] hidden md:block absolute right-1/7 -top-2 rotate-45 border-l border-t border-light-border bg-white translate-x-2/5 "></i>

                <div v-if="cartItems.length > 0">
                    <div class="flex justify-between items-baseline p-4 md:p-6 md:border-b md:border-b-light-border">
                        <h3 class="text-2xl font-bold">{{ $t('cart.title') }}</h3>
                        <p class="font-medium text-sm opacity-40">{{ $t('cart.products_count', cartItems.length) }}</p>
                    </div>
                    <ul  class="p-4 md:px-6 space-y-3 border-b border-b-light-border max-h-[40vh] overflow-y-auto">
                        <li v-for="item in cartItems" :key="item.id" class="flex justify-between gap-4 mb-6">
                            <div class="flex text-start gap-x-2">
                                <div class="size-16 bg-cart-bg p-1 rounded-xl bg-[#F6F6F6]">
                                    <img class="size-14" :src="item.img" :alt="item.name">
                                </div>
                                <div class="grid grid-col gap-y-1">
                                    <p class="text-charcoal font-medium text-sm">{{ item.name }}</p>
                                    <div class="flex items-center">
                                        <div class="flex items-center-safe gap-x-2 border-r pr-2 border-r-light-border">
                                            <span class="size-3.5 shadow-xs inset-shadow-charcoal/12  border border-charcoal/10 rounded-full" :style="{ backgroundColor: item.color.hex }"></span>
                                            <p class="opacity-40 font-normal text-sm">{{item.color.name}}</p>
                                        </div>
                                        <p class="opacity-40 font-normal text-sm pl-2">{{item.size.name}}</p>
                                    </div>
                                    <p class="text-xs text-charcoal">x{{ item.quantity }}</p>
                                </div>
                            </div>
                            <div>
                                <p class="text-olive">{{ $n(item.price / 100, 'currency', 'ro') }}</p>
                            </div>
                        </li>
                    </ul>
                    <div class="flex justify-between p-4 md:px-6">
                        <h3 class="text-lg font-bold mb-2">{{ $t('cart.grand_total')}}</h3>
                        <p class=" text-lg">{{ $n(cartGrandTotal / 100, 'currency', 'ro') }}</p>
                    </div>
                    <div class="px-4 md:px-6 md:pb-6">
                        <Button display-as="a" :href="route('cart')" customClass="mx-auto mt-0 w-full" withArrow >
                            {{ $t('cart.btn_view_cart')}}
                        </Button>
                    </div>
                </div>

                <div v-else class="text-center p-4 md:p-6 grid justify-center ">
                    <img class="mx-auto py-4" :src="basket_empty" alt="">
                    <div class="py-4">
                        <p class="py-1 text-lg">
                            {{ $t('cart.empty') }}
                        </p>
                        <p class="py-1 opacity-60 text-sm font-normal">
                            {{ $t('cart.empty_description') }}
                        </p>
                    </div>
                    <Button display-as="a" :href="route('products.index')" customClass="mx-auto mt-0 w-full" withArrow>
                        {{ $t('cart.btn_explore')}}
                    </Button>
                </div>
            </div>
        </transition>
    </div>
</template>

<style scoped>
.slide-fade-enter-active,
.slide-fade-leave-active {
    transition: all 0.3s ease;
}
.slide-fade-enter-from {
    opacity: 0;
    transform: translateY(-10px);
}
.slide-fade-leave-to {
    opacity: 0;
    transform: translateY(-10px);
}
</style>
