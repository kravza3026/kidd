<script setup lang="ts">
import { isMegaOpen, closeMegaMenu } from '@/stores/megaMenu'
import { useI18n } from 'vue-i18n'
import dropdownBg from '@img/dropdown_bg.png'

interface Category {
    id: number | string
    name: string
    icon?: string
    url?: string
}

const props = defineProps<{ categories: Category[] }>()
const { t } = useI18n()
</script>

<template>
    <transition
        enter-active-class="transition duration-200 ease-out"
        enter-from-class="opacity-0 scale-95"
        enter-to-class="opacity-100 scale-100"
        leave-active-class="transition duration-150 ease-in"
        leave-from-class="opacity-100 scale-100"
        leave-to-class="opacity-0 scale-95"
    >
        <div
            v-if="isMegaOpen"
            id="megaMenu"
            class="absolute top-0 left-0 z-[1] h-[calc(100vh-161px)] w-screen overflow-auto ring-black/5 lg:top-[calc(100%+1px)] lg:h-fit"
            @click.self="closeMegaMenu"
        >
            <div class="relative h-full min-h-fit bg-white pb-5 shadow-lg lg:rounded-b-2xl">
                <div class="border-t-light-border relative container grid border-t py-5 lg:flex lg:gap-y-5 lg:px-[40px] lg:py-[60px]">

                    <h2 class="pb-2 text-[24px] font-bold opacity-80 lg:hidden">
                        {{ t('header.menu.catalog') }}
                    </h2>

                    <!-- Category grid -->
                    <div class="small-cards border-light-border grid-cols-3 rounded-2xl border lg:grid lg:w-[55%] lg:rounded-none lg:border-none">
                        <a
                            v-for="(cat, index) in props.categories"
                            :key="cat.id"
                            :href="cat.url || '#'"
                            class="small-cart-container group lg:bg-light-orange hover:bg-olive relative flex cursor-pointer items-center p-4 transition-all duration-500 ease-in-out lg:mr-[24px] lg:mb-[24px] lg:grid lg:h-[16vw] lg:max-h-[186px] lg:w-[16vw] lg:max-w-[212px] lg:justify-start lg:rounded-2xl lg:p-5"
                            :class="{
                                'border-b border-light-border': index !== props.categories.length - 1,
                                'rounded-t-2xl': index === 0,
                                'rounded-b-2xl': index === props.categories.length - 1,
                            }"
                        >
                            <div class="small-cart_img_container" v-html="cat.icon"></div>
                            <div class="small-cart-title grid items-end pl-3 lg:pl-0">
                                <p class="m-0 p-0 font-normal transition-all duration-500 ease-in-out group-hover:text-white lg:text-[20px]">
                                    {{ cat.name }}
                                </p>
                            </div>
                            <i class="small-cart-arrow absolute right-0 p-3 transition-all duration-500 ease-in-out group-hover:p-2 lg:top-0">
                                <svg class="text-gray-300/80 transition-all duration-500 ease-in-out group-hover:text-white" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g>
                                        <path d="M3.73334 2.66666H12.6667C13.0349 2.66666 13.3333 2.96513 13.3333 3.33332V12.2667M2.66667 13.3333L12.8 3.19999" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </g>
                                </svg>
                            </i>
                        </a>
                    </div>

                    <!-- Promo banner -->
                    <div
                        class="relative right-0 bottom-0 mx-auto flex h-[224px] w-11/12 flex-col justify-between rounded-2xl lg:absolute lg:h-full lg:w-[45%] lg:rounded-none lg:rounded-br-2xl"
                        :style="{ backgroundImage: `url(${dropdownBg})`, backgroundSize: 'cover', backgroundPosition: 'center' }"
                    >
                        <div class="bg-filter from-charcoal/40 to-charcoal/10 absolute inset-0 rounded-2xl bg-gradient-to-t lg:rounded-none lg:rounded-br-2xl"></div>
                        <div class="align-end absolute inset-0 bottom-8 grid h-full w-full content-end items-end justify-center">
                            <p class="text-center text-[30px] font-bold text-white lg:text-[40px]">
                                {{ t('offers.mega-menu.title') }}
                            </p>
                            <p class="text-center text-sm font-normal text-white">
                                {{ t('offers.mega-menu.desc') }}
                            </p>
                            <ui-button as="a" href="/products" class="mx-auto">
                                {{ t('general.buttons.shop_now') }}
                            </ui-button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Close button -->
            <div
                class="close relative mx-auto mt-10 hidden h-6 w-6 cursor-pointer rounded-full bg-white/20 p-5 text-center lg:block"
                @click="closeMegaMenu"
            >
                <div class="absolute inset-0 flex items-center justify-center">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.33337 14.6667L14.6667 1.33337M1.33337 1.33337L14.6667 14.6667" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
        </div>
    </transition>
</template>
