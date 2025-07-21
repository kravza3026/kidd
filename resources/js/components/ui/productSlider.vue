<template>
    <swiper :pagination="true" :modules="modules" class="mySwiper">
        <swiper-slide class="w-full max-w-[520px] grow shrink aspect-1" v-for="(slide, index) in slides" :key="index">
            <img  :src="getImageUrl(slide)"  alt="">
        </swiper-slide>
        <swiper-slide v-for="(slide, index) in slides" :key="index">
            <img  :src="getImageUrl(slide)"  alt="">
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
import { Pagination } from 'swiper/modules';

export default {
    name:'ProductSlider',
    components: {
        Swiper,
        SwiperSlide,
    },
    props:{
        slides: {
            type: Array,
            default: () => [],
        },
    },
    methods: {
        getImageUrl(imagePath) {
            return `/assets/images/${imagePath}`;
        }
    },
    mounted() {
        console.log(this.slides)
    },
    setup() {
        return {
            modules: [Pagination],
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
