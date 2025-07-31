
import Cookies from 'js-cookie'
import { ref } from 'vue'
import { useI18n } from 'vue-i18n'
import { useAlert } from './useAlert'
const COOKIE_KEY = 'favorites'

export function useFavorites() {
    const { t, locale } = useI18n();
    const favorites = ref(getFavoritesFromCookie())
    const { showAlert } = useAlert()

    function getFavoritesFromCookie() {
        const cookie = Cookies.get(COOKIE_KEY)
        return cookie ? JSON.parse(cookie) : []
    }

    function saveToCookie() {
        Cookies.set(COOKIE_KEY, JSON.stringify(favorites.value), { expires: 30 })
    }

    const toggleFavorite = (id, name) => {

        const index = favorites.value.indexOf(id)
        if (index === -1) {
            favorites.value.push(id)
            showAlert({
                title: name,
                type: 'favorite',
                message: t('alerts.savedToFavorites'),
                icon: 'favorite',
                button: {
                    label: t('user-dropdown.favorites'),
                    href: `/${locale.value}/favorites`,
                }
            });

        } else {
            favorites.value.splice(index, 1)
            showAlert({
                title: name,
                type: 'favorite',
                message: t('alerts.removedFromFavorites'),
                icon: 'favorite',
                button: {
                    label: t('user-dropdown.favorites'),
                    href: `/${locale.value}/favorites`,
                }
            });
        }
        saveToCookie()
    }

    function isFavorite(id) {
        return favorites.value.includes(id)
    }

    return {
        favorites,
        toggleFavorite,
        isFavorite,
    }
}
