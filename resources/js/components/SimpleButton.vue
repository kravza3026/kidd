<template>
    <div
        :class="mergedClasses"
        @click="$emit('click')"
    >
        <slot />
    </div>
</template>

<script>
export default {
    name: 'SimpleButton',

    props: {
        customClass: {
            type: String,
            default: '',
        },
    },
    computed: {
        mergedClasses() {
            return [
                'button cursor-pointer border-b-4 hover:bg-dark-olive duration-500 transition-all ease-in-out border-dark-olive flex gap-5 items-center bg-olive justify-center py-3 md:py-3 px-10 my-5 rounded-2xl',
                this.customClass
            ].join(' ');
        },
    },
};
</script>
