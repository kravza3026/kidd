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
    name: 'PrimaryButton',
    props: {
        customClass: {
            type: String,
            default: '',
        },
    },
    computed: {
        mergedClasses() {
            return [
                'cursor-pointer shadow-md hover:shadow-sm shadow-light-border border-b-4 border-1 bg-light-orange hover:bg-light-border duration-500 transition-all ease-in-out border-light-border flex gap-5 items-center  justify-center py-3 md:py-3  my-5 rounded-2xl',
                this.customClass
            ].join(' ');
        },
    },
};
</script>
