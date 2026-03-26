import { defineStore } from 'pinia'
import { ref } from 'vue'
import Cookies from 'js-cookie'
import i18n from '@/i18n'
import { useAlert } from '@/useAlert'

const COOKIE_KEY = 'favorites'

export const useFavoritesStore = defineStore('favorites', () => {
    const { showAlert } = useAlert()

    const ids = ref<number[]>(loadFromCookie())

    function loadFromCookie(): number[] {
        const cookie = Cookies.get(COOKIE_KEY)
        return cookie ? JSON.parse(cookie) : []
    }

    function saveToCookie() {
        Cookies.set(COOKIE_KEY, JSON.stringify(ids.value), {
            expires: 30,
            domain: '.' + window.location.hostname,
            secure: window.location.protocol === 'https:',
            sameSite: 'Lax',
        })
        window.axios.get('favorites')
    }

    function toggleFavorite(id: number, name: string) {
        const { t, locale } = i18n.global
        const index = ids.value.indexOf(id)

        if (index === -1) {
            ids.value.push(id)
            showAlert({
                title: name,
                type: 'favorite',
                message: t('alerts.favorites.addedToFavorites'),
                icon: 'favorite',
                button: {
                    label: t('user-dropdown.favorites'),
                    href: `/${locale.value}/favorites`,
                },
            })
        } else {
            ids.value.splice(index, 1)
            showAlert({
                title: name,
                type: 'favorite',
                message: t('alerts.favorites.removedFromFavorites'),
                icon: 'favorite',
                button: {
                    label: t('user-dropdown.favorites'),
                    href: `/${locale.value}/favorites`,
                },
            })
        }

        saveToCookie()
    }

    function isFavorite(id: number): boolean {
        return ids.value.includes(id)
    }

    return { ids, toggleFavorite, isFavorite }
})
