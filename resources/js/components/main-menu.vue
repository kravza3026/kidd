<script setup lang="ts">
import { isMegaOpen, toggleMegaMenu } from '@/stores/megaMenu'
import { useI18n } from 'vue-i18n'
import { computed } from 'vue'

interface NavRoutes {
    about: string
    help: string
    contacts: string
}

const props = withDefaults(defineProps<{ navRoutes?: NavRoutes }>(), {
    navRoutes: () => ({ about: '/about', help: '/help', contacts: '/contacts' }),
})

const { t } = useI18n()

const currentPath = window.location.pathname
const isActive = (segment: string) => currentPath.includes(segment)
const linkClass = (active: boolean) =>
    ['h-full flex items-center border-b-2', active ? 'text-olive border-olive' : 'border-transparent'].join(' ')
</script>

<template>
    <ul class="nav-items h-full grid grid-cols-4 items-center gap-y-5 gap-x-2 relative">
        <li class="relative h-full flex items-center px-2 border-b-2" :class="isMegaOpen ? 'border-olive' : 'border-transparent'">
            <button @click="toggleMegaMenu" class="inline-flex items-center w-full justify-center cursor-pointer">
                {{ t('header.menu.catalog') }}
                <svg class="-mr-1 size-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd"/>
                </svg>
            </button>
        </li>

        <li :class="linkClass(isActive('about'))">
            <a class="mx-auto" :href="props.navRoutes.about">{{ t('header.menu.about') }}</a>
        </li>
        <li :class="linkClass(isActive('help'))">
            <a class="mx-auto" :href="props.navRoutes.help">{{ t('header.menu.help') }}</a>
        </li>
        <li :class="linkClass(isActive('contacts'))">
            <a class="mx-auto" :href="props.navRoutes.contacts">{{ t('header.menu.contacts') }}</a>
        </li>
    </ul>
</template>
