<template>
    <div
        :class="customClass"
        class="flex flex-col gap-3 mt-3">
        <label v-if="label" :for="id" class="text-[14px] font-bold">
            {{ label }}
        </label>
        <input
            :type="type"
            :name="name"
            :id="id"
            :placeholder="placeholder"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            class="border-light-border border-1 focus:outline-hidden bg-white p-3 rounded-xl"
            v-bind="attrs"

        />
    </div>
</template>

<script setup>
import { useAttrs } from 'vue';

defineProps({
    label: String,
    type: {
        type: String,
        default: 'text',
    },
    name: String,
    id: String,
    placeholder: String,
    modelValue: [String, Number],
    customClass: {
        type: String,
        default: '',
    },
});

defineEmits(['update:modelValue']);

const attrs = useAttrs();
</script>
