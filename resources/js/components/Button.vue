<template>
    <div
        :class="mergedClasses"
        @click="$emit('click')"
    >
        <slot />
        <svg
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
            default: '',
        },
    },
    computed: {
        mergedClasses() {
            return [
                'button cursor-pointer border-b-4 hover:bg-dark-olive duration-500 transition-all ease-in-out border-dark-olive flex gap-5 items-center bg-olive justify-center w-fit py-3 md:py-5 px-10 my-5 rounded-2xl text-white',
                this.customClass
            ].join(' ');
        },
    },
};
</script>
