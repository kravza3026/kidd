
<template>
    <div class="flex-col justify-start items-start flex">
        <!-- Назва + бейдж NEW -->
        <div class="pb-8 flex-col justify-start items-start gap-3 flex">
            <div class="justify-start items-start gap-4 inline-flex">
                <div class="opacity-80 text-center text-[#020202] text-3xl font-bold leading-[62.40px] text-nowrap">
                    {{ product.name[locale] }}
                </div>

                <div class="justify-center relative items-center gap-2 flex" v-if="product.is_new">
                    <div class="absolute left-2/3 uppercase font-bold -translate-x-2/5 top-0 mt-0 w-max bg-olive text-white text-sm px-3 py-1 rounded-full transition-opacity duration-300">
                        {{ $t('product-show.new') }}
                        <div class="absolute -bottom-0.5 left-1/3 rotate-90 w-0 h-0 border-l-8 -z-1 border-r-8 border-b-8 border-l-transparent border-r-transparent border-b-olive"></div>
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
            <div class="justify-start relative items-center gap-2 flex" v-if="hasDiscount">
                <div class="absolute left-2/3 uppercase font-bold -translate-x-2/5 -top-full bg-danger text-white text-[14px] px-2 py-0 rounded-full z-10">
                    -20%
                    <div class="absolute -bottom-0.5 left-1/3 -z-1 rotate-90 w-0 h-0 border-l-8 border-r-8 border-b-8 border-l-transparent border-r-transparent border-b-danger"></div>
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
                                type="radio"
                                name="color-choice"
                                :value="variant.color.id"
                                v-model="selectedColorId"
                                class="peer sr-only"
                            />
                            <span class="h-8 w-8 rounded-full border relative p-1 border-black/10 border-opacity-10 bg-transparent peer-checked:ring">
                                <span
                                    class="rounded-full absolute inset-0 border border-black/10"
                                    :style="{ backgroundColor: variant.color.hex }"
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
                    <a href="#" class="justify-start items-center gap-1 inline-flex">
<!--                        <img class="w-3" src="/images/icons/size.png" alt="" />-->
                        <span class="text-[#a8ba66] text-sm font-bold underline leading-[14px]">
                            {{ t('product-show.desc.size_guide') }}
                        </span>
                    </a>
                </div>
                <div class="pb-1 justify-start items-center gap-2 inline-flex">
                    <div
                        v-for="size in sizes"
                        :key="size"
                        class="px-5 py-[13px] bg-white rounded-[100px] border border-[#eeeeee] justify-center items-center flex"
                    >
                        <div class="text-[#020202] text-sm font-bold leading-[14px]">
                            {{ size }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Кнопки -->
        <div class="w-full py-6 border-t border-b border-[#eeeeee] flex-col justify-center items-start gap-10 flex">
            <div class="w-full flex justify-center items-center gap-4">
<!--                <PrimaryButton class="bg-secondary hover:!bg-secondary-dark !border-transparent !text-olive hover:!text-olive focus:!text-olive sm:py-4">-->
<!--                    <HeartIcon class="size-5 mr-2" />-->
<!--                    {{ $t('product-show.add-to-favorite') }}-->
<!--                </PrimaryButton>-->
<!--                <PrimaryButton class="sm:py-4 w-full flex-grow">-->
<!--                    <CartIcon class="size-5 mr-2" />-->
<!--                    {{ $t('product-show.add-to-cart') }}-->
<!--                </PrimaryButton>-->
            </div>
        </div>
    </div>
</template>
<script setup>
import { useI18n } from 'vue-i18n'

const { t, locale } = useI18n()
</script>
<script>
// import PrimaryButton from '@/Components/PrimaryButton.vue'
// import HeartIcon from '@/Icons/HeartIcon.vue'
// import CartIcon from '@/Icons/CartIcon.vue'

export default {
    name: 'ProductPageForm',
    components: {
        // PrimaryButton,
        // HeartIcon,
        // CartIcon
    },
    props: {
        product: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            selectedColorId: this.product.variants?.[0]?.color?.id || null,
            sizes: ['Preemie', '0-3M', '3-6M', '6-9M', '9-12M']
        }
    },
    computed: {
        selectedColorName() {
            return this.product.variants.find(v => v.color.id === this.selectedColorId)?.color.name || '';
        },
        priceFinal() {
            return Math.round(this.product.variants?.[0]?.price_final / 100) || 0;
        },
        priceOnline() {
            return Math.round(this.product.variants?.[0]?.price_online / 100) || 0;
        },
        hasDiscount() {
            return this.priceOnline > this.priceFinal;
        }
    }
}
</script>
