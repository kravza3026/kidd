<template>
    <div class="flex flex-col gap-3 mt-5">
        <label
            v-if="label"
            :for="id"
            class="text-sm font-bold"
        >
            {{ label }}
        </label>

        <textarea
            class="border-light-border border-1 focus:outline-hidden min-h-[120px] bg-white p-3 rounded-xl"
            :id="id"
            :name="name"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            v-bind="attrs"
        />
    </div>
</template>

<script setup>
import { useAttrs } from 'vue'

defineProps({
    modelValue: String,
    label: String,
    id: String,
    name: String
})

defineEmits(['update:modelValue'])

const attrs = useAttrs()
</script>
