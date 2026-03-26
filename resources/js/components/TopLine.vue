<script setup lang="ts">
import { ref, onMounted, onUnmounted } from 'vue'
import flRo from '@img/icons/flags/fl_ro.svg'
import flRu from '@img/icons/flags/fl_ru.svg'
import flEn from '@img/icons/flags/fl_en.svg'
import checkedIcon from '@img/icons/olive/checked_ol.svg'

interface TopLink {
    label: string
    url: string
}

interface Locale {
    code: string
    native: string
    url: string
    isCurrent: boolean
}

const props = defineProps<{
    links: TopLink[]
    locales: Locale[]
    phone: string
}>()

const flagMap: Record<string, string> = { ro: flRo, ru: flRu, en: flEn }

const open = ref(false)
const currentLocale = props.locales.find(l => l.isCurrent)

function onClickOutside(e: MouseEvent) {
    const el = (e.target as HTMLElement).closest('.lang-switcher')
    if (!el) open.value = false
}
onMounted(() => document.addEventListener('click', onClickOutside))
onUnmounted(() => document.removeEventListener('click', onClickOutside))
</script>

<template>
    <div class="bg-light-orange relative z-[100002] hidden lg:block">
        <div class="container flex justify-between">
            <!-- Left links -->
            <div class="flex-1 flex items-center gap-5">
                <a v-for="link in props.links" :key="link.url" :href="link.url" class="text-[13px] font-medium">
                    {{ link.label }}
                </a>
            </div>

            <!-- Right: lang switcher + phone -->
            <div class="flex-1 flex justify-end gap-5 items-center">

                <!-- Language switcher -->
                <div class="lang-switcher relative inline-block text-left">
                    <button
                        @click="open = !open"
                        type="button"
                        class="inline-flex w-full items-center justify-center gap-x-1.5 rounded-md px-3 py-2 text-sm font-semibold text-gray-900 ring-gray-300 ring-inset hover:bg-gray-50"
                        aria-haspopup="true"
                        :aria-expanded="open"
                    >
                        <template v-if="currentLocale">
                            <img class="size-4" :src="flagMap[currentLocale.code]" alt="flag" />
                            {{ currentLocale.native }}
                        </template>
                        <svg class="-mr-1 size-5 text-black" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd"/>
                        </svg>
                    </button>

                    <transition
                        enter-active-class="transition duration-100 ease-out"
                        enter-from-class="opacity-0 scale-95"
                        enter-to-class="opacity-100 scale-100"
                        leave-active-class="transition duration-75 ease-in"
                        leave-from-class="opacity-100 scale-100"
                        leave-to-class="opacity-0 scale-95"
                    >
                        <div
                            v-if="open"
                            class="absolute right-0 z-20 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-hidden"
                            role="menu"
                        >
                            <div class="flex flex-col gap-y-1 p-1" role="none">
                                <a
                                    v-for="locale in props.locales"
                                    :key="locale.code"
                                    :href="locale.url"
                                    class="animated flex items-center justify-between gap-x-2 rounded-lg px-4 py-2 text-sm text-gray-700 hover:bg-light-charcoal"
                                    :class="{ 'bg-light-charcoal': locale.isCurrent }"
                                    role="menuitem"
                                >
                                    <div class="flex gap-x-2">
                                        <img width="24" height="24" :src="flagMap[locale.code]" alt="flag" />
                                        <span class="font-bold">{{ locale.native }}</span>
                                    </div>
                                    <img v-if="locale.isCurrent" :src="checkedIcon" alt="checked" />
                                </a>
                            </div>
                        </div>
                    </transition>
                </div>

                <a :href="`tel:${props.phone.replace(/\s/g, '')}`" class="text-[13px] font-medium">
                    {{ props.phone }}
                </a>
            </div>
        </div>
    </div>
</template>
