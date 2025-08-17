<template>

        <input
            :type="type"
            :name="name"
            :id="id"
            :placeholder="placeholder"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            :aria-label="ariaLabel"
            :disabled="disabled"
            :required="required"
            v-bind="attrs"

            :class="[
        'border rounded-lg px-2 bg-white', customClass,
        error ? 'border-red-500' : 'border-light-border',
        disabled ? 'bg-gray-100 cursor-not-allowed' : ''
      ]"
        />

</template>

<script setup>
import { useAttrs } from 'vue'

defineProps({
    required: {
        type: Boolean,
        default: false,
    },
    ariaLabel: {
        type: String,
        required: true
    },
    type: {
        type: String,
        default: 'text'
    },
    name: String,
    id: String,
    placeholder: String,
    modelValue: [String, Number],
    customClass: {
        type: String,
        default: ''
    },
    error: {
        type: String,
        default: ''
    },
    disabled: {
        type: Boolean,
        default: false
    }
})

defineEmits(['update:modelValue'])

const attrs = useAttrs()
</script>
