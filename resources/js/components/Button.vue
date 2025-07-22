<template>
    <div
        :class="mergedClasses"
        @click="$emit('click')"
    >
        <div v-if="stickyOnMobile && isSticky" class="h-[20px] md:hidden"></div>
        <slot />

            <svg
                v-if="withArrow"
                width="14"
                height="14"
                viewBox="0 0 14 14"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    d="M2.73335 1.66669H11.6667C12.0349 1.66669 12.3334 1.96516 12.3334 2.33335V11.2667M1.66669 12.3334L11.8 2.20002"
                    stroke="white"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                />
            </svg>

    </div>
</template>

<script>
export default {
    name: 'Button',

    props: {
        customClass: {
            type: String,
            default: 'w-fit',
        },
        withArrow: {
            type: Boolean,
            default: false,
        },
        buttonPrimary: {
            type: Boolean,
            default: false,
        },
        stickyOnMobile: {
            type: Boolean,
            default: false, // за замовчуванням не прилипати
        },
    },
    data() {
        return {
            isSticky: false,
            isMobile: window.innerWidth < 768,
        };
    },

    computed: {
        mergedClasses() {
            const base = 'cursor-pointer shadow-md hover:shadow-sm duration-500 transition-all ease-in-out flex gap-5 items-center justify-center py-3 md:py-4 my-5 rounded-[12px]';
            const variant = this.buttonPrimary
                ? 'shadow-light-border border-b-4 border-1 bg-light-orange hover:bg-light-border border-light-border'
                : 'shadow-olive border-b-4 hover:bg-dark-olive border-dark-olive bg-olive px-10 text-white';

            const sticky = (this.stickyOnMobile && this.isSticky)
                ? 'fixed bottom-[88px]    z-10 md:static'
                : 'md:static';

            return [base, variant, sticky, this.customClass].join(' ');
        }
    },
    mounted() {
        if (this.stickyOnMobile && window.innerWidth < 768) {
            window.addEventListener('scroll', this.handleScroll);
        }
    },
    beforeUnmount() {
        if (this.stickyOnMobile && window.innerWidth < 768) {
            window.removeEventListener('scroll', this.handleScroll);
        }
    },
    methods: {
        handleScroll() {
            const trigger = document.getElementById('sticky-trigger');
            if (!trigger) return;
            const triggerBottom = trigger.getBoundingClientRect().bottom;
            this.isSticky = triggerBottom < window.innerHeight;
        },
    },


};
</script>
