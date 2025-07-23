
import Cookies from 'js-cookie'
import { ref } from 'vue'

const COOKIE_KEY = 'favorites'

export function useFavorites() {
    const favorites = ref(getFavoritesFromCookie())

    function getFavoritesFromCookie() {
        const cookie = Cookies.get(COOKIE_KEY)
        return cookie ? JSON.parse(cookie) : []
    }

    function saveToCookie() {
        Cookies.set(COOKIE_KEY, JSON.stringify(favorites.value), { expires: 30 })
    }

    function toggleFavorite(productId) {
        const index = favorites.value.indexOf(productId)
        if (index === -1) {
            favorites.value.push(productId)
        } else {
            favorites.value.splice(index, 1)
        }
        saveToCookie()
    }

    function isFavorite(productId) {
        return favorites.value.includes(productId)
    }

    return {
        favorites,
        toggleFavorite,
        isFavorite,
    }
}
