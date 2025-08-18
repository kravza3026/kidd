<template>
    <input
        ref="input"
        :type="type"
        :name="name"
        :id="id"
        :placeholder="placeholder"
        :value="modelValue"
        @input="onInput"
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
import {ref, onMounted, watch} from 'vue'
import IMask from 'imask'
import { useAttrs } from 'vue'

const props = defineProps({
    required: { type: Boolean, default: false },
    ariaLabel: { type: String, required: true },
    type: { type: String, default: 'text' },
    name: String,
    id: String,
    placeholder: String,
    modelValue: [String, Number],
    customClass: { type: String, default: '' },
    error: { type: String, default: '' },
    disabled: { type: Boolean, default: false },
    maskOptions: { type: Object, default: null } // <- передаємо IMask конфіг
})

const emit = defineEmits(['update:modelValue'])
const attrs = useAttrs()
const input = ref(null)
let mask = null
const internalValue = ref(props.modelValue || '')

onMounted(() => {
    if (input.value && props.maskOptions) {
        mask = IMask(input.value, props.maskOptions)
        mask.on('accept', () => {
            internalValue.value = mask.value
            emit('update:modelValue', mask.value)
        })
        if (props.modelValue) mask.value = props.modelValue
    }
})

watch(() => props.modelValue, (val) => {
    if (mask && val !== mask.value) {
        mask.value = val
    } else {
        internalValue.value = val
    }
})


function onInput(e) {
    if (!mask) {
        emit('update:modelValue', e.target.value)
    }
}
</script>
