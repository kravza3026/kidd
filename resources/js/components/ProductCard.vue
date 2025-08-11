<script>
import { useFavorites } from '@/useFavorites'
import { useI18n } from 'vue-i18n'

export default {
    name: 'ProductCard',
    props: {
        product: {
            type: Object,
            required: true,
        },
    },
    setup() {
        const { locale, t, n } = useI18n()

        const { toggleFavorite, isFavorite } = useFavorites()

        return { toggleFavorite, isFavorite, locale }
    },
    methods: {
        getImageUrl(imagePath) {
            return `/assets/images/${imagePath}`;
        }
    },

    computed: {

        minAge() {
            return Math.min(...this.product.variants.map(v => v.size.min_age || 0));
        },
        maxAge() {
            return Math.max(...this.product.variants.map(v => v.size.max_age || 0));
        },
        finalPrice() {
            return (this.product.variants[0]?.price_final ?? 0) / 100;
        },
        originalPrice() {
            return (this.product.variants[0]?.price_online ?? 0) / 100;
        },
        sizeIcon() {
            return '/assets/images/icons/size.svg';
        },
        favIcon() {
            return '/assets/images/icons/add_fav.svg';
        },
        inFavIcon() {
            return '/assets/images/icons/inFavorite.svg';
        },

    }

}
</script>
<template>
<div  class="cursor-pointer relative z-0 group p-1 hover:z-10">
    <div
        class="bg-white md:bg-card-bg overflow-hidden hover:overflow-visible group-hover:bg-white border border-light-border md:border-transparent group-hover:border-black/10 transition-all ease-in-out rounded-xl py-4 px-2 relative"
    >
        <div class="relative flex justify-between">
            <div
                class="absolute left-1 md:left-3 md:top-2 flex items-center gap-2"
            >
                <div v-if="product.has_discount"
                    class="bg-danger text-white text-xs font-semibold rounded-full px-3 py-0.5 md:py-1"
                >
                    -{{ product.variants[0]?.discount_display }}%
                </div>
                <div v-if="product.is_new"
                    class="bg-olive text-white uppercase text-xs font-semibold rounded-full px-3 py-0.5 md:py-1"
                >
                    {{ $t ? $t('product.new') : 'New' }}
                </div>
            </div>

            <div class="absolute right-1 md:right-2 md:top-1 hidden xl:flex items-center gap-1 bg-opacity-90 rounded-full text-xs">
                <div class="flex items-center gap-2">
                    <div
                        class="group/gender relative flex items-center justify-center shadow-md size-6 rounded-full"
                        :class="product.gender.bg_color"
                    >
                        <div class="genderImg size-4 flex justify-center items-center" v-html="product.gender.svg"></div>
                        <div
                            class="absolute left-2/3 -translate-x-2/5 top-full mt-2 w-max bg-black text-white text-sm px-4 py-1.5 rounded-full opacity-0 group-hover/gender:opacity-100 transition-opacity duration-300 z-10"
                        >
                            {{ product.gender.name[locale] }}
                            <div
                                class="absolute -top-1 left-1/3 rotate-90 w-0 h-0 border-l-8 border-r-8 border-b-8 border-l-transparent border-r-transparent border-b-black"
                            ></div>
                        </div>
                    </div>
                    <div
                        class="pl-2.5 pr-3 py-1 bg-white rounded-3xl border border-black/10 flex items-center gap-1"
                    >
                        <div class="size-4">
                            <img class="size-4" :src="sizeIcon" alt="size icon" />
                        </div>
                        <div class="text-black text-xs font-bold leading-3">
                            {{ minAge }}-{{ maxAge }}M
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full h-full flex justify-center items-center pt-4 md:pt-10 transition-all duration-700 ease-in-out">
                <a :href="product.url">
                <img
                    :src="getImageUrl(product.main_image)"
                    :alt="product.name[locale]"
                    class="w-full object-center object-contain aspect-square max-h-[264px]"
                />
                </a>
            </div>
        </div>

        <div class="flex justify-center items-center gap-1.5 mb-1 md:mb-1.5">
            <template v-for="(variant, index) in product.variants" :key="variant.id">
                <div v-if="index === 0"
                    class="border cursor-pointer p-0 w-4 h-4 rounded-full flex justify-center items-center border-gray-300 bg-white">
                    <span class="w-2.5 h-2.5 rounded-full border border-light-border" :style="{ backgroundColor: variant.color.hex }"></span>
                </div>
                <div v-else class="border border-light-border cursor-pointer w-2.5 h-2.5 rounded-full" :style="{ backgroundColor: variant.color.hex }"></div>
            </template>
        </div>

        <div @click="toggleFavorite(product.id, product.name[locale])"
            class="absolute add_favorite bg-card-bg size-8 xl:size-10 p-2 xl:p-2.5 border border-black/10 rounded-full right-3 md:right-4 bottom-3 md:bottom-4 xl:bottom-[-20%] group-hover:bottom-4 xl:opacity-0 group-hover:opacity-100 duration-500 transition-all ease-in-out"
        >
            <img :src="isFavorite(product.id) ? inFavIcon : favIcon" class="size-4 xl:size-5 flex justify-center items-center" width="20" height="20" alt="Add/Remove to/from favorite icon" />
            <div
                class="absolute tooltip left-2/3 -translate-x-2/5 ml-[5px] mt-2 top-full px-4 py-2 w-max bg-black text-white text-sm rounded-full opacity-0 transition-opacity duration-300 z-[130]"
            >
               {{ isFavorite(product.id) ? 'Remove from Favorites' : 'Save to Favorites' }}
                <div
                    class="absolute -top-1 left-1/3 rotate-90 w-0 h-0 border-l-8 border-r-8 border-b-8 border-l-transparent border-r-transparent border-b-black"
                ></div>
            </div>
        </div>
    </div>

    <div class="space-y-1 text-start px-0 xl:px-4 mt-4">
        <div
            class="flex xl:hidden items-center gap-2 bg-opacity-90 rounded-full py-1 text-[10px]"
        >
            <div
                class="flex items-center justify-center shadow-md size-6 rounded-full"
                :class="product.gender.bg_color"
            >
                <div class="w-4 flex justify-center items-center" v-html="product.gender.svg"></div>
            </div>
            <div
                class="text-[12px]  bg-white font-bold h-6 text-nowrap rounded-full flex items-center justify-center py-1 px-2 gap-x-1 border border-black/10"
            >
                <img :src="sizeIcon" alt="size" />
                {{ minAge }}-{{ maxAge }}M
            </div>
        </div>
        <a class="space-y-1" :href="product.url">
            <p class="text-sm text-charcoal sm:text-base">
                {{ product.name[locale] }}</p>
            <p class="font-bold text-charcoal text-base">
                {{ $n(finalPrice, 'currency') }}
<!--                {{ finalPrice }} {{ $t ? $t('product.mdl') : 'MDL' }}-->
                <span
                    v-if="product.has_discount"
                    class="text-sm font-light line-through opacity-30"
                >
                    {{ $n(originalPrice, 'currency') }}
                </span>
            </p>
        </a>
    </div>
</div>
</template>
