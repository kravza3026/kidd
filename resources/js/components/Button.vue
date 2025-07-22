<template>
    <div
        :class="mergedClasses"
        @click="$emit('click')"
    >
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
        }
    },

    computed: {
        mergedClasses() {
            const commonClasses =
                'cursor-pointer shadow-md hover:shadow-sm duration-500 transition-all ease-in-out flex gap-5 items-center justify-center py-3 md:py-4 my-5 rounded-[12px]';

            const conditionalClasses = this.buttonPrimary
                ? 'shadow-light-border border-b-4 border-1 bg-light-orange hover:bg-light-border border-light-border'
                : 'shadow-olive border-b-4 hover:bg-dark-olive border-dark-olive bg-olive px-10 text-white';

            return [commonClasses, conditionalClasses, this.customClass].join(' ');
        }
    }


};
</script>
