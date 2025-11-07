<script>
import { useFavorites } from '@/useFavorites.js';
import { useI18n } from 'vue-i18n';

export default {
    name: 'ProductCard',
    props: {
        product: {
            type: Object,
            required: true,
        },
    },
    setup() {
        const { locale, t, n } = useI18n();

        const { toggleFavorite, isFavorite } = useFavorites();

        return { toggleFavorite, isFavorite, locale };
    },
    methods: {
        getImageUrl(imagePath) {
            return `/assets/images/${imagePath}`;
        },
    },

    computed: {
        minAge() {
            return Math.min(...this.product.variants.map((v) => v.size.min_age || 0));
        },
        maxAge() {
            return Math.max(...this.product.variants.map((v) => v.size.max_age || 0));
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
    },
};
</script>
<template>
    <div class="group relative z-0 cursor-pointer p-1 hover:z-[2]">
        <div
            class="md:bg-card-bg border-light-border relative overflow-hidden rounded-xl border bg-white px-2 py-4 transition-all ease-in-out group-hover:border-black/10 group-hover:bg-white hover:overflow-visible focus:overflow-visible md:border-transparent"
        >
            <div class="relative flex justify-between">
                <div class="absolute left-1 flex items-center gap-2 md:top-2 md:left-3">
                    <div
                        v-if="product.has_discount"
                        class="bg-danger rounded-full px-3 py-0.5 text-xs font-semibold text-white md:py-1"
                    >
                        -{{ product.variants[0]?.discount_display }}%
                    </div>
                    <div
                        v-if="product.is_new"
                        class="bg-olive rounded-full px-3 py-0.5 text-xs font-semibold text-white uppercase md:py-1"
                    >
                        {{ $t ? $t('product.new') : 'New' }}
                    </div>
                </div>

                <div
                    class="bg-opacity-90 absolute right-1 hidden items-center gap-1 rounded-full text-xs md:top-1 md:right-2 xl:flex"
                >
                    <div class="flex items-center gap-2">
                        <div
                            :class="product.gender.bg_color"
                            class="group/gender relative flex size-6 items-center justify-center rounded-full shadow-md"
                        >
                            <div
                                class="genderImg flex size-4 items-center justify-center"
                                v-html="product.gender.svg"
                            ></div>
                            <div
                                class="absolute top-full left-2/3 z-10 mt-2 w-max -translate-x-2/5 rounded-full bg-black px-4 py-1.5 text-sm text-white opacity-0 transition-opacity duration-300 group-hover/gender:opacity-100"
                            >
                                {{ product.gender.name[locale] }}
                                <div
                                    class="absolute -top-1 left-1/3 h-0 w-0 rotate-90 border-r-8 border-b-8 border-l-8 border-r-transparent border-b-black border-l-transparent"
                                ></div>
                            </div>
                        </div>
                        <div
                            class="flex items-center gap-1 rounded-3xl border border-black/10 bg-white py-1 pr-3 pl-2.5"
                        >
                            <div class="size-4">
                                <img :src="sizeIcon" alt="size icon" class="size-4" />
                            </div>
                            <div class="text-xs leading-3 font-bold text-black">{{ minAge }}-{{ maxAge }}M</div>
                        </div>
                    </div>
                </div>

                <div
                    class="flex h-full w-full items-center justify-center pt-4 transition-all duration-700 ease-in-out md:pt-10"
                >
                    <a :href="product.url">
                        <img
                            :alt="product.name[locale]"
                            :src="getImageUrl(product.main_image)"
                            class="aspect-square max-h-[264px] w-full object-contain object-center"
                        />
                    </a>
                </div>
            </div>

            <div class="mb-1 flex items-center justify-center gap-1.5 md:mb-1.5">
                <template v-for="(variant, index) in product.variants" :key="variant.id">
                    <div
                        v-if="index === 0"
                        class="flex h-4 w-4 cursor-pointer items-center justify-center rounded-full border border-gray-300 bg-white p-0"
                    >
                        <span
                            :style="{ backgroundColor: variant.color.hex }"
                            class="border-light-border h-2.5 w-2.5 rounded-full border"
                        ></span>
                    </div>
                    <div
                        v-else
                        :style="{ backgroundColor: variant.color.hex }"
                        class="border-light-border h-2.5 w-2.5 cursor-pointer rounded-full border"
                    ></div>
                </template>
            </div>

            <div
                class="add_favorite bg-card-bg absolute right-3 bottom-3 size-8 rounded-full border border-black/10 p-2 transition-all duration-500 ease-in-out group-hover:bottom-4 group-hover:opacity-100 md:right-4 md:bottom-4 xl:bottom-[-20%] xl:size-10 xl:p-2.5 xl:opacity-0"
                @click="toggleFavorite(product.id, product.name[locale])"
            >
                <img
                    :src="isFavorite(product.id) ? inFavIcon : favIcon"
                    alt="Add/Remove to/from favorite icon"
                    class="flex size-4 items-center justify-center xl:size-5"
                    height="20"
                    width="20"
                />
                <div
                    class="tooltip absolute top-full left-2/3 z-[130] mt-2 ml-[5px] hidden w-max -translate-x-2/5 rounded-full bg-black px-4 py-2 text-sm text-white opacity-0 transition-opacity duration-300 lg:block"
                >
                    {{ isFavorite(product.id) ? 'Remove from Favorites' : 'Save to Favorites' }}
                    <div
                        class="absolute -top-1 left-1/3 h-0 w-0 rotate-90 border-r-8 border-b-8 border-l-8 border-r-transparent border-b-black border-l-transparent"
                    ></div>
                </div>
            </div>
        </div>

        <div class="mt-4 space-y-1 px-0 text-start xl:px-4">
            <div class="bg-opacity-90 flex items-center gap-2 rounded-full py-1 text-[10px] xl:hidden">
                <div
                    :class="product.gender.bg_color"
                    class="flex size-6 items-center justify-center rounded-full shadow-md"
                >
                    <div class="flex w-4 items-center justify-center" v-html="product.gender.svg"></div>
                </div>
                <div
                    class="flex h-6 items-center justify-center gap-x-1 rounded-full border border-black/10 bg-white px-2 py-1 text-[12px] font-bold text-nowrap"
                >
                    <img :src="sizeIcon" alt="size" />
                    {{ minAge }}-{{ maxAge }}M
                </div>
            </div>
            <a :href="product.url" class="space-y-1">
                <div class="flex items-center justify-between gap-1">
                    <p class="text-charcoal truncate text-sm sm:text-base">
                        {{ product.name[locale] }}
                    </p>
                    <template v-for="(member, index) in product.compatible_with" :key="member.id">
                        <div
                            :class="product.gender.bg_color"
                            class="group/gender relative flex size-6 items-center justify-center gap-x-0 rounded-full shadow-md"
                        >
                            <span
                                :class="member.bg_color_name"
                                class="flex size-6 items-center justify-center rounded-full text-xs font-bold text-white"
                            >
                                {{ member.letter }}
                            </span>
                            <div
                                class="absolute top-full left-10/12 z-10 mt-2 w-max -translate-x-2/5 rounded-full bg-black px-4 py-1.5 text-sm text-white opacity-0 transition-opacity duration-300 group-hover/gender:opacity-100"
                            >
                                <p>{{ $t('product.compatible_with', { name: member.name }) }}</p>
                                <div
                                    class="absolute -top-1 left-1/3 h-0 w-0 rotate-90 border-r-8 border-b-8 border-l-8 border-r-transparent border-b-black border-l-transparent"
                                ></div>
                            </div>
                        </div>
                    </template>
                </div>
                <p class="text-charcoal text-base font-bold">
                    {{ $n(finalPrice, 'currency') }}
                    <!--                {{ finalPrice }} {{ $t ? $t('product.mdl') : 'MDL' }}-->
                    <span v-if="product.has_discount" class="text-sm font-light line-through opacity-30">
                        {{ $n(originalPrice, 'currency') }}
                    </span>
                </p>
            </a>
        </div>
    </div>
</template>
