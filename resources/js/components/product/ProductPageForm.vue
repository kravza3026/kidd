
<script setup>
import { ref, computed, watch, onMounted, onUnmounted } from 'vue'
import { useI18n } from 'vue-i18n'
import iconAddFavorite from '@img/icons/fav_icon_active.svg'
import iconFavorited from '@img/icons/inFavorite.svg'
import cartWhite from '@img/icons/cart_white.svg'
import SizeGuide from "@/components/ui/sizeGuide.vue";
import Button from "@/components/ui/Button.vue";
import { useFavorites } from '@/useFavorites.js'
import {useAlert} from "@/useAlert.js";
import { emitter } from '@/eventBus.js'
const { toggleFavorite, isFavorite } = useFavorites()
const { showAlert } = useAlert()

const props = defineProps({
    product: {
        type: Object,
        required: true
    }
})

const { t, locale } = useI18n()
console.log(props.product)
// --- Selection states
const selectedColorId = ref(props.product.variants?.[0]?.color?.id || null)
const selectedSizeId = ref(null)

// --- Unique colors (no duplicates)
const uniqueColors = computed(() => {
    const seen = new Set()
    return props.product.variants
        .map(v => v.color)
        .filter(color => {
            if (seen.has(color.id)) return false
            seen.add(color.id)
            return true
        })
})

const sizes = computed(() => {
    const allSizes = props.product.variants.map(v => v.size)
    const unique = []
    allSizes.forEach(s => {
        if (!unique.find(u => u.id === s.id)) unique.push(s)
    })

    return unique.sort((a, b) => {
        if (a.sort_order === b.sort_order) {
            return a.id - b.id
        }
        return a.sort_order - b.sort_order
    })
})

// --- List of available sizes for selected color
const availableSizes = computed(() => {
    return props.product.variants
        .filter(v => v.color.id === selectedColorId.value)
        .map(v => v.size)
        .filter((size, index, self) => self.findIndex(s => s.id === size.id) === index) // unique
})

// --- Auto-select first available size after changing color
watch(selectedColorId, (newColorId) => {
    const sizes = props.product.variants
        .filter(v => v.color.id === newColorId)
        .map(v => v.size.id)

    selectedSizeId.value = sizes.length ? sizes[0] : null
}, { immediate: true })

// --- Currently selected variant
const selectedVariant = computed(() => {
    return props.product.variants.find(v =>
        v.color.id === selectedColorId.value &&
        v.size.id === selectedSizeId.value
    )
})

// --- Selected variant ID (to send to server during purchase)
const selectedVariantId = computed(() => selectedVariant.value?.id || null)

const addToCart = async (event) => {
    console.log(selectedVariantId.value)
    if (!selectedVariantId.value) return
    console.log(locale.value)
    await window.axios.post('cart', {
        variant_id: selectedVariantId.value,
        quantity: 1
    }).then((response) => {
        if (response.data?.alert){
            showAlert(response.data?.alert);
        }
        emitter.emit('cart-updated');

        console.log('Product added to cart successfully');
    }).catch(error => {
        console.error('Error adding product to cart:', error);
    });
}

// --- Selected color name (optional, but convenient)
const selectedColorName = computed(() => {
    return props.product.variants.find(v => v.color.id === selectedColorId.value)?.color.name || ''
})

// --- Prices
const priceFinal = computed(() => {
    if (selectedVariant.value) {
        return Math.round(selectedVariant.value.price_final / 100)
    }
    return 0
})

const priceOnline = computed(() => {
    if (selectedVariant.value) {
        return Math.round((selectedVariant.value.price_online ?? 0) / 100)
    }
    return 0
})

// --- Discount
const discountPercent = computed(() => {
    if (selectedVariant.value && selectedVariant.value.price_online) {
        return Math.round(100 - (priceFinal.value / priceOnline.value) * 100)
    }
    return 0
})

const hasDiscount = computed(() => {
    console.log(props.product)
    return selectedVariant.value?.discount_display
})

let clickedRecently = false

const handleFavoriteClick = (id, name) => {
    if (clickedRecently) return
    clickedRecently = true
    setTimeout(() => clickedRecently = false, 300)
    toggleFavorite(id, name)

}

</script>

<template>

    <div class="max-w-full flex-col relative justify-start items-start flex page-fade"  >
        <div class="pb-8  flex-col max-w-full justify-start items-start gap-3 flex">
            <div class="justify-start  items-start gap-4 inline-flex">
                <div class="opacity-80 text-center max-w-full text-charcoal text-[24px] md:text-3xl font-bold leading-[62.40px] text-nowrap">
                    {{ product.name[locale] }}
                </div>

                <div v-if="product.is_new" class="justify-center relative items-center gap-2 flex">
                    <div
                        class="absolute left-2/3 uppercase font-bold -translate-x-2/5 top-0 mt-0 w-max bg-olive text-white text-sm px-3 py-1 rounded-full transition-opacity duration-300">
                        {{ $t('product.new') }}
                        <div
                            class="absolute -bottom-0.5 left-1/3 rotate-90 w-0 h-0 border-l-8 -z-1 border-r-8 border-b-8 border-l-transparent border-r-transparent border-b-olive"></div>
                    </div>

                </div>
            </div>
            <div class="overflow-hidden opacity-60 text-charcoal text-sm font-normal leading-normal">
                {{ product.description[locale] }}
            </div>
        </div>

        <!-- Ціна -->
        <div class="pb-8 justify-start items-end gap-2 inline-flex">
            <div class="opacity-80 text-charcoal text-5xl font-medium leading-[48px]">
                {{ priceFinal }} {{ t('product.mdl') }}
            </div>
            <div v-if="hasDiscount" class="justify-start relative items-center gap-2 flex">
                <div
                    class="absolute left-2/3 uppercase font-bold -translate-x-2/5 w-fit text-nowrap -top-full bg-danger text-white text-sm px-2 py-0 rounded-full ">
                    -{{ selectedVariant.discount_display }}%
                    <div
                        class="absolute -bottom-0.5 left-1/3 -z-1 rotate-90 w-0 h-0 border-l-8 border-r-8 border-b-8 border-l-transparent border-r-transparent border-b-danger"></div>
                </div>
                <div class="opacity-30 text-right text-charcoal text-sm font-normal line-through leading-[25.20px]">
                    {{ priceOnline }} {{ t('product.mdl') }}
                </div>
            </div>
        </div>

        <!-- Колір -->
        <div class="w-full py-8 border-t border-[#eeeeee] flex-col justify-start items-start gap-8 flex">
            <div class="w-full flex-col justify-start items-start gap-4 flex">
                <h3 class="text-sm font-medium text-gray-900">
                    {{ t('product.choose-color') }} - <span>{{ selectedColorName[locale] }}</span>
                </h3>
                <fieldset aria-label="Choose a color">
                    <div class="flex items-center gap-x-3 space-x-3">
                        <label
                            v-for="color in uniqueColors"
                            :key="color.id"
                            :aria-label="color.name"
                            class="relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0 ring-gray-400"
                        >
                            <input
                                v-model="selectedColorId"
                                :value="color.id"
                                class="peer sr-only"
                                name="color-choice"
                                type="radio"
                            />
                            <span
                                class="h-8 w-8 rounded-full border relative p-1 border-black/10 border-opacity-10 bg-transparent peer-checked:ring">
                                <span
                                    :style="{ backgroundColor: color.hex }"
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
                    <div class="text-charcoal text-base font-normal inline-flex">
                        {{ t('product.desc.size') }}
                    </div>
                    <sizeGuide></sizeGuide>

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
                                :disabled="!availableSizes.some(s => s.id === size.id)"
                                :value="size.id"
                                class="peer sr-only"
                                name="size-choice"
                                type="radio"
                            />
                            <span
                                :class="{ 'opacity-40 cursor-not-allowed': !availableSizes.some(s => s.id === size.id) }"
                                class="px-2 md:px-5 py-[5px] md:py-[13px] bg-white rounded-[100px] border min-w-16 md:min-w-32 text-center border-[#eeeeee] peer-checked:border-olive"
                            >
                                <span class="text-charcoal text-sm font-bold leading-[14px]">
                                  {{ size.name[locale] }}
                                </span>
                            </span>
                        </label>

                    </div>
                </fieldset>
                <div class="w-full py-6 border-t border-b  border-[#eeeeee] flex-col justify-center items-start gap-10 flex">
                <div class="w-full md:flex flex-row justify-between items-center gap-4">

                    <Button
                        @click="handleFavoriteClick(product.id, product.name[locale],)"
                        buttonPrimary customClass="text-olive font-bold text-[15px] text-center w-[93vw] md:w-5/12"  >
                        <img class="size-4" :src="isFavorite(product.id) ? iconFavorited : iconAddFavorite" alt="">
                        {{ isFavorite(product.id) ? t('product.remove-from-favorites') : t('product.add-to-favorite') }}
                    </Button>

                    <Button
                        @click="addToCart"
                        customClass="text-white text-[16px]  font-bold w-[93vw] md:w-7/12">
                        <img :src="cartWhite" alt="">
                        {{ t('product.add-to-cart') }}
                    </Button>
                    <div id="sticky-trigger" class="h-[1px] absolute  -bottom-[110px]"></div>
                </div>
            </div>

            </div>
        </div>


    </div>

</template>
