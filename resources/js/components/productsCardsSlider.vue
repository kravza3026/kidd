<template>
    <swiper
        :pagination="false"
        :space-between="20"
        :autoplay="true"
        :speed="1000"
        :free-mode="true"
        :breakpoints="{
    0: {
      slidesPerView: 1.2,
    },
    640: {
      slidesPerView: 2.2,
    },
    768: {
      slidesPerView: 3,
    },
    1024: {
      slidesPerView: 4,
    }}"
        :modules="modules"

        class="mySwiper">
        <swiper-slide
            class="w-full max-full grow shrink aspect-1"
            v-for="(product, index) in products"
            :key="index"
        >
            <ProductCard :product="product" />
        </swiper-slide>

    </swiper>
</template>
<script>
// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from 'swiper/vue';

// Import Swiper styles
import 'swiper/css';

import 'swiper/css/pagination';

// import './style.css';

// import required modules
import { Pagination, Autoplay } from 'swiper/modules';
import ProductCard from "@/components/productCart.vue";

export default {
    name:'ProductCardsSlider',
    components: {
        ProductCard,
        Swiper,
        SwiperSlide,
    },
    props:{
        products: {
            type: Array,
            default: () => [],
        },
    },

    mounted() {
        console.log('slides:', this.slides);
    },
    setup() {
        return {
            modules: [Pagination, Autoplay],
        };
    },
};
</script>
<style>

.swiper-pagination-bullet-active{
    background-color: var(--color-charcoal)!important;
    transition: all 0.7s ease-in-out;
}

.swiper-slide img {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

</style>
