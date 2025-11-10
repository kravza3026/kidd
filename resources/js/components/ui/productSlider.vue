<template>
    <div v-if="ready" class="">
        <swiper
            :loop="true"
            :modules="modules"
            :pagination="true"
            :thumbs="{ swiper: thumbsSwiper }"
            class="mySwiper2 bg-light-orange rounded-2xl lg:!h-[550px] lg:w-full"
        >
            <swiper-slide
                v-for="(slide, index) in slides"
                :key="index"
                class="bg-light-orange max-h-[350px] items-center"
            >
                <img
                    :src="getImageUrl(slide)"
                    alt=""
                    class="mx-auto h-full !max-h-[300px] w-full"
                    height="300"
                    width="500"
                />
            </swiper-slide>
        </swiper>
        <swiper
            :autoplay="true"
            :breakpoints="{
                0: {
                    slidesPerView: 3,
                },
                768: {
                    slidesPerView: 4,
                },
                1440: {
                    slidesPerView: 6,
                },
            }"
            :freeMode="true"
            :loop="true"
            :modules="modules"
            :slides-per-view="6"
            :spaceBetween="20"
            :speed="1000"
            :watchSlidesProgress="true"
            class="mySwiper mt-5"
            @swiper="setThumbsSwiper"
        >
            <swiper-slide
                v-for="(slide, index) in slides"
                :key="index"
                class="aspect-1 h-[100px] max-w-[70px] shrink grow"
            >
                <img
                    :src="getImageUrl(slide)"
                    alt=""
                    class="mx-auto max-h-[50px] max-w-[70px]"
                    height="100"
                    loading="lazy"
                />
            </swiper-slide>
        </swiper>
    </div>
</template>
<script>
// Import Swiper Vue.js components
import { Swiper, SwiperSlide } from 'swiper/vue';
// import required modules
import { Autoplay, FreeMode, Navigation, Thumbs } from 'swiper/modules';
import { onMounted, ref } from 'vue';

// Import Swiper styles
import 'swiper/css';
import 'swiper/css/effect-fade';
import 'swiper/css/free-mode';
import 'swiper/css/navigation';
import 'swiper/css/thumbs';

export default {
    name: 'ProductSlider',
    components: {
        Swiper,
        SwiperSlide,
    },
    props: {
        slides: {
            type: Array,
            default: () => [],
        },
    },
    methods: {
        getImageUrl(imagePath) {
            return imagePath;
            // return `/assets/images/${imagePath}`;
        },
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
            thumbsSwiper,
            ready,
            setThumbsSwiper,
            modules: [FreeMode, Navigation, Thumbs, Autoplay],
        };
    },
};
</script>
<style>
.swiper-pagination-bullet-active {
    background-color: var(--color-charcoal) !important;
    transition: all 0.7s ease-in-out;
}

.swiper-wrapper {
    display: flex;
    align-items: center;
}
.swiper-slide img {
    display: block;
    width: auto !important;
    min-height: 100% !important;
    object-fit: cover !important;
}
.swiper-slide-thumb-active {
    border: 1px solid var(--color-olive) !important;
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
