<template>
    <div class="w-full">
        <div class="flex items-center justify-between gap-4 w-full">
            <h4 @click="expanded = !expanded" class="question-title">
                {{ title }}
            </h4>
            <button class="btn" @click="expanded = !expanded">
                <svg
                    v-show="expanded"
                    class="w-6 h-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M20 12H4"
                    ></path>
                </svg>
                <svg
                    v-show="!expanded"
                    class="w-6 h-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"
                    ></path>
                </svg>
            </button>
        </div>
        <div :style="contentStyle" class="content duration-500 transition-all ease-in-out">
            <p :style="infoStyle" class="info">{{ info }}</p>
        </div>
    </div>
</template>

<script>
import { ref, computed } from "vue";

export default {
    name: "Accordion",
    props: {
        title: String,
        info: String,
    },
    mounted() {
        console.log('title:', props.title);
        console.log('info:', props.info);
        },
    setup() {
        const expanded = ref(false);
        const contentStyle = computed(() => {
            return { "max-height": expanded.value ? "100px" : 0 };
        });

        const infoStyle = computed(() => {
            return { opacity: expanded.value ? 1 : 0 };
        });

        return { expanded, contentStyle, infoStyle };
    },
};
</script>



