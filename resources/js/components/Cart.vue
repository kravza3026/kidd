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
                        <p class="opacity-60">{{cartItem.options.price_final / 100}} lei</p>
                    </div>
                    <div>sizes</div>
                </div>
            </div>
            <div class="flex justify-between flex-col min-h-full gap-6">
                <div class="flex justify-end">
                    <p class="text-olive">{{(cartItem.options.price_final / 100) - cartItem.discounted[0] / 100}} lei</p>
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
import iconTrash from '@img/common/trash.svg'
import { useI18n } from 'vue-i18n'
export default {
    name: 'Cart',
    props: {
        cartItems: {
            type: Object,
            required: true,
        },
    },
    data(){
        return {
            iconTrash
        }
    },
    setup(){
        const { t, locale } = useI18n()
        return {
            t,
            locale
        }
    },
    mounted() {
        console.log(this.cartItems) // ✅ ось так правильно
    },
    methods: {
        getImageUrl(imagePath) {
            return `/assets/images/${imagePath}`;
        }
    }
}
</script>
