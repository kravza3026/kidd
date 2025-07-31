<template>
    <div
        v-for="cartItem in cartItems"
        :key="cartItem.id" class="">

<!--        {{product}}-->

        <div class="flex justify-between items-center my-2">
            <div class="flex items-center gap-x-6">
                <div class="p-2 bg-light-orange rounded-2xl">
                    <img class="w-[84px]" :src='getImageUrl(cartItem.options.model.product.main_image)' alt="{{cartItem.options.model.product.name[locale]}}">
                </div>
                <div>
                    <div>
                        <p class="text-[20px] font-medium">{{cartItem.options.model.product.name[locale]}}</p>
                        <p class="opacity-60">{{cartItem.price / 100}} lei</p>
                    </div>
                    <div>sizes</div>
                </div>
            </div>
            <div class="flex justify-between flex-col min-h-full gap-6">
                <div class="flex justify-end">
                    <p class="text-olive">{{(cartItem.options.model.product.price_final / 100) - cartItem.options.model.product.discounted[0] / 100}} lei</p>
                </div>
                <div class="flex justify-end items-center gap-2 text-olive bg-light-orange py-1 px-4 rounded-lg cursor-pointer">
                    <img :src="iconTrash" alt="">
                    <p class="text-[14px]">Delete</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// import { ref, computed, watch, onMounted, onUnmounted } from 'vue'
import iconTrash from '@img/common/trash.svg'
import { useI18n } from 'vue-i18n'
import {emitter} from "@/eventBus.js";
export default {
    name: 'Cart',

    data(){
        return {
            iconTrash,
            cartItems: [],
        }
    },
    setup(){
        const { t, locale } = useI18n()
        return {
            t,
            locale
        }
    },
    methods: {
        getImageUrl(imagePath) {
            return `/assets/images/${imagePath}`;
        },
        async getCartItems() {
            try {
                const response = await window.axios.get(`${this.locale}/cart/items`)
                this.cartItems = response.data.items;
                console.log(this.cartItems[0])
                console.log(response) // TODO Remove in production
            } catch (error) {
                console.error('Server error:', error) // TODO Remove in production
            }
        }
    },
    mounted() {
        this.getCartItems();
        // emitter.on('cart-updated', this.getCartItems);
    },

}
</script>
