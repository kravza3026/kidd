<template>
    <div
        v-for="product in products"
        class="">

<!--        {{product}}-->

        <div class="flex justify-between items-center my-2">
            <div class="flex items-center gap-x-6">
                <div class="p-2 bg-light-orange rounded-2xl">
                    <img class="w-[84px]" :src='getImageUrl(product.options.product.main_image)' alt="{{product.options.product.name[locale]}}">
                </div>
                <div>
                    <div>
                        <p class="text-[20px] font-medium">{{product.options.product.name[locale]}}</p>
                        <p class="opacity-60">{{product.options.price_final / 100}} lei</p>
                    </div>
                    <div>sizes</div>
                </div>
            </div>
            <div class="flex justify-between flex-col min-h-full gap-6">
                <div class="flex justify-end">
                    <p class="text-olive">{{(product.options.price_final / 100) - product.discounted[0] / 100}} lei</p>
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
import { ref, computed, watch, onMounted, onUnmounted } from 'vue'
import iconTrash from '@img/common/trash.svg'
import { useI18n } from 'vue-i18n'
export default {
    name: 'Cart',
    props: {
        products: {
            type: Array,
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
        console.log(this.products) // ✅ ось так правильно
    },
    methods: {
        getImageUrl(imagePath) {
            return `/assets/images/${imagePath}`;
        }
    }
}
</script>
