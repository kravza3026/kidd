<template>
    <button
        v-show="visible"
        @click="scrollToTop"
        class="fixed bottom-28 lg:bottom-6 right-6 z-50 p-3 rounded-full bg-dark-olive text-white hover:bg-olive transition"
    >
        <svg
            class="w-5 h-5"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"></path>
        </svg>
    </button>
</template>

<script>
import { ref, onMounted, onUnmounted } from 'vue';

export default {
    name: "ScrollToTop",
    setup() {
        const visible = ref(false);
        const threshold = 600;

        const handleScroll = () => {
            visible.value = window.scrollY > threshold;
        };

        const scrollToTop = () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        };

        onMounted(() => {
            window.addEventListener('scroll', handleScroll);
        });

        onUnmounted(() => {
            window.removeEventListener('scroll', handleScroll);
        });

        return {
            visible,
            scrollToTop,
        };
    },
};
</script>


<style scoped>
/* Можна кастомізувати розміри, позицію, кольори */
</style>
