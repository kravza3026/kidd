
import Cookies from 'js-cookie'
import { ref } from 'vue'
import { useI18n } from 'vue-i18n'
import { useAlert } from './useAlert.js'
const COOKIE_KEY = 'favorites'

export function useFavorites() {
    const { t, locale } = useI18n();
    const favorites = ref(getFavoritesFromCookie())
    const { showAlert } = useAlert(isFavorite)

    function getFavoritesFromCookie() {
        const cookie = Cookies.get(COOKIE_KEY)
        return cookie ? JSON.parse(cookie) : []
    }

    function saveToCookie() {
        Cookies.set(COOKIE_KEY, JSON.stringify(favorites.value), { expires: 30 })
    }

    const toggleFavorite = ({ type, id, name, title, message, icon, button = {} }) => {

        const index = favorites.value.indexOf(id)
        if (index === -1) {
            favorites.value.push(id)
            showAlert({
                title: title ?? `Added to cart: ${name}`,
                type: type ?? 'favorite',
                message: message ?? "saved to Favorites",
                icon: icon ?? "favorite",
                button: {
                    label: button.label ?? "Favorites",
                    href: button.href ?? `/${locale.value}/favorites`,
                },
                options: {
                    timer: 4000,
                }
            });

        } else {
            favorites.value.splice(index, 1)
            showAlert({
                title: `Removed from cart: ${name}`,
                type: "favorite",
                message: "saved to Favorites from favorites",
                icon: icon ?? "favorite",
                button: {
                    label: button.label ?? "Favorites",
                    href: button.href ?? `/${locale.value}/favorites`,
                },
                options: {
                    timer: 4000,
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
