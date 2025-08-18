<template>
    <div v-if="ready" class="">
        <swiper
            :pagination="true"
            :loop="true"
            :modules="modules"
            :thumbs="{ swiper: thumbsSwiper }"
            class="mySwiper2 bg-light-orange rounded-2xl lg:w-full lg:!h-[550px]">
            <swiper-slide class=" bg-light-orange max-h-[350px]  items-center" v-for="(slide, index) in slides" :key="index">
                <img :src="getImageUrl(slide)" class="mx-auto w-full h-full !max-h-[300px]" width="500" height="300"  alt="">
            </swiper-slide>
        </swiper>
        <swiper
            @swiper="setThumbsSwiper"
            :spaceBetween="20"
            :slides-per-view="6"
            :freeMode="true"
            :autoplay="true"
            :speed="1000"
            :loop="true"
            :watchSlidesProgress="true"
            :modules="modules"
            :breakpoints="{
                0: {
                  slidesPerView: 3,
                },
                768: {
                  slidesPerView: 4,
                },
                1440: {
                  slidesPerView: 6,
                }
            }"
            class="mySwiper mt-5"
        >
            <swiper-slide class=" h-[100px] max-w-[70px]  grow shrink aspect-1" v-for="(slide, index) in slides" :key="index">
                <img  :src="getImageUrl(slide)" loading="lazy" height="100" class="max-h-[50px] max-w-[70px] mx-auto" alt="">
            </swiper-slide>
        </swiper>
    </div>
</template>
<script>

// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from 'swiper/vue';
import { FreeMode, Navigation, Thumbs,Autoplay,EffectFade } from 'swiper/modules';
import {onMounted, ref} from 'vue';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/effect-fade';
import 'swiper/css/free-mode';
import 'swiper/css/navigation';
import 'swiper/css/thumbs';

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

    setup() {
        const thumbsSwiper = ref(null);
        const ready = ref(false);
        onMounted(() => {
            ready.value = true;
        });

        const setThumbsSwiper = (swiper) => {
            thumbsSwiper.value = swiper;
        };

        return {
            thumbsSwiper,ready,
            setThumbsSwiper,
            modules: [FreeMode, Navigation,Thumbs,Autoplay],
        };
    },
};
</script>
<style>
.swiper-pagination-bullet-active {
    background-color: var(--color-charcoal)!important;
    transition: all 0.7s ease-in-out;
}

.swiper-wrapper {
    display: flex;
    align-items: center;
}
.swiper-slide img {
    display: block;
    width: auto!important;
    min-height: 100%!important;
    object-fit: cover!important;
}
.swiper-slide-thumb-active {
    border: 1px solid var(--color-olive)!important;
    border-radius: 12px;
}
.swiper {
    opacity: 0;
    animation: fade-in 1.5s ease-out forwards;
}

@keyframes fade-in {
    to {
        opacity: 1;
    }
}

</style>
