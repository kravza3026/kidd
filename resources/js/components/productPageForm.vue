<template>

    <div class="flex-col justify-start items-start flex">
        <div class="pb-8 flex-col justify-start items-start gap-3 flex">
            <div class="justify-start items-start gap-4 inline-flex">
                <div class="opacity-80 text-center text-[#020202] text-3xl font-bold leading-[62.40px] text-nowrap">
                    {{ product.name[locale] }}
                </div>

                <div v-if="product.is_new" class="justify-center relative items-center gap-2 flex">
                    <div
                        class="absolute left-2/3 uppercase font-bold -translate-x-2/5 top-0 mt-0 w-max bg-olive text-white text-sm px-3 py-1 rounded-full transition-opacity duration-300">
                        {{ $t('product-show.new') }}
                        <div
                            class="absolute -bottom-0.5 left-1/3 rotate-90 w-0 h-0 border-l-8 -z-1 border-r-8 border-b-8 border-l-transparent border-r-transparent border-b-olive"></div>
                    </div>
                </div>
            </div>
            <div class="overflow-hidden opacity-60 text-[#020202] text-sm font-normal leading-normal">
                {{ product.description[locale] }}
            </div>
        </div>

        <!-- Ціна -->
        <div class="pb-8 justify-start items-end gap-2 inline-flex">
            <div class="opacity-80 text-[#020202] text-5xl font-medium leading-[48px]">
                {{ priceFinal }} lei
            </div>
            <div v-if="hasDiscount" class="justify-start relative items-center gap-2 flex">
                <div
                    class="absolute left-2/3 uppercase font-bold -translate-x-2/5 -top-full bg-danger text-white text-[14px] px-2 py-0 rounded-full z-10">
                    -20%
                    <div
                        class="absolute -bottom-0.5 left-1/3 -z-1 rotate-90 w-0 h-0 border-l-8 border-r-8 border-b-8 border-l-transparent border-r-transparent border-b-danger"></div>
                </div>
                <div class="opacity-30 text-right text-[#020202] text-sm font-normal line-through leading-[25.20px]">
                    {{ priceOnline }} lei
                </div>
            </div>
        </div>

        <!-- Колір -->
        <div class="w-full py-8 border-t border-[#eeeeee] flex-col justify-start items-start gap-8 flex">
            <div class="w-full flex-col justify-start items-start gap-4 flex">
                <h3 class="text-sm font-medium text-gray-900">
                    Choose color - <span>{{ selectedColorName[locale] }}</span>
                </h3>
                <fieldset aria-label="Choose a color">
                    <div class="flex items-center gap-x-3 space-x-3">
                        <label
                            v-for="variant in product.variants"
                            :key="variant.id"
                            :aria-label="variant.color.name"
                            class="relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0 ring-gray-400"
                        >
                            <input
                                v-model="selectedColorId"
                                :value="variant.color.id"
                                class="peer sr-only"
                                name="color-choice"
                                type="radio"
                            />
                            <span
                                class="h-8 w-8 rounded-full border relative p-1 border-black/10 border-opacity-10 bg-transparent peer-checked:ring">
                                <span
                                    :style="{ backgroundColor: variant.color.hex }"
                                    class="rounded-full absolute inset-0 border border-black/10"
                                ></span>
                            </span>
                        </label>
                    </div>
                </fieldset>
            </div>

            <!-- Розмір -->
            <div class="w-full flex-col justify-start items-start gap-4 flex">


                <div class="flex justify-between items-center w-full">
                    <div class="text-[#020202] text-base font-normal inline-flex">
                        {{ t('product-show.desc.size') }}
                    </div>
                    <a class="justify-start items-center gap-1 inline-flex" href="#">
                        <img :src="sizeIcon" alt="" class="w-3"/>
                        <span class="text-[#a8ba66] text-sm font-bold underline leading-[14px]">
                            {{ t('product-show.desc.size_guide') }}
                        </span>
                    </a>
                </div>
                <fieldset aria-label="Choose a size">
                    <div class="pb-1 justify-start items-center gap-4 flex flex-wrap">
                        <label
                            v-for="size in sizes"
                            :key="size.id"
                            :aria-label="size.name"
                            class="justify-center items-center flex"
                        >
                            <input
                                v-model="selectedSizeId"
                                :disabled="!availableSizes.includes(size.id)"
                                :value="size.id"
                                class="peer sr-only"
                                name="size-choice"
                                type="radio"
                            />
                            <span
                                :class="{ 'opacity-40 cursor-not-allowed': !availableSizes.includes(size.id) }"
                                class="px-5 py-[13px] bg-white rounded-[100px] border min-w-32 text-center border-[#eeeeee] peer-checked:border-olive"
                            >
                              <span class="text-[#020202] text-sm font-bold leading-[14px]">
                                {{ size.name[locale] }}
                              </span>
                            </span>

                        </label>
                    </div>
                </fieldset>
            </div>
        </div>

        <!-- Кнопки -->
        <div class="w-full py-6 border-t border-b border-[#eeeeee] flex-col justify-center items-start gap-10 flex">
            <div class="w-full flex flex-row justify-between items-center gap-4">
                <PrimaryButton class="text-olive font-bold text-[16px] text-center w-5/12">
                    <img :src="favIcon" alt="">
                    Save to Favorites
                </PrimaryButton>
                <SimpleButton class="text-white text-[16px] font-bold w-7/12">
                    <img :src="cartWhite" alt="">
                    Add to cart
                </SimpleButton>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, computed, watch } from 'vue'
import { useI18n } from 'vue-i18n'
import SimpleButton from "@/components/SimpleButton.vue";
import PrimaryButton from "@/components/PrimaryButton.vue";
import sizeIcon from '@img/icons/size.svg'
import favIcon from '@img/icons/fav_icon_active.svg'
import cartWhite from '@img/icons/cart_white.svg'
    const showDescription = ref(false)
    const showCareInstructions = ref(false)
    const props = defineProps({
        product: {
            type: Object,
            required: true
        }
    })
console.log(props.product)
    const { t, locale } = useI18n()

    const selectedColorId = ref(props.product.variants?.[0]?.color?.id || null)
    const selectedSizeId = ref(null)

    const sizes = computed(() => {
        const allSizes = props.product.variants.map(v => v.size)
        const unique = []
        allSizes.forEach(s => {
            if (!unique.find(u => u.id === s.id)) unique.push(s)
        })
        return unique
    })

    const availableSizes = computed(() => {
        return props.product.variants
            .filter(v => v.color.id === selectedColorId.value)
            .map(v => v.size.id)
    })

    watch(selectedColorId, (newColorId) => {
        const available = props.product.variants
            .filter(v => v.color.id === newColorId)
            .map(v => v.size.id)
        selectedSizeId.value = available.length ? available[0] : null
    }, { immediate: true })

    // Оновлений computed, що повертає варіант за кольором і розміром
    const selectedVariant = computed(() => {
        return props.product.variants.find(v =>
            v.color.id === selectedColorId.value && v.size.id === selectedSizeId.value
        )
    })

    const selectedColorName = computed(() => {
        return props.product.variants.find(v => v.color.id === selectedColorId.value)?.color.name || ''
    })

    const priceFinal = computed(() => {
        if (selectedVariant.value) {
            return Math.round(selectedVariant.value.price_final / 100)
        }
        return 0
    })

    const priceOnline = computed(() => {
        if (selectedVariant.value) {
            return Math.round(selectedVariant.value.price_online / 100)
        }
        return 0
    })

    const hasDiscount = computed(() => {
        // Якщо потрібна логіка перевірки знижки для вибраного варіанту, можна зробити так:
        return selectedVariant.value?.has_discount || props.product.has_discount
    })


</script>
