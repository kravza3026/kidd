
import Cookies from 'js-cookie'
import { ref } from 'vue'
import { useAlert } from './useAlert.js'
const COOKIE_KEY = 'favorites'

export function useFavorites() {

    const favorites = ref(getFavoritesFromCookie())
    const { showAlert } = useAlert(isFavorite)

    function getFavoritesFromCookie() {
        const cookie = Cookies.get(COOKIE_KEY)
        return cookie ? JSON.parse(cookie) : []
    }

    function saveToCookie() {
        Cookies.set(COOKIE_KEY, JSON.stringify(favorites.value), { expires: 30 })
    }

    function toggleFavorite(productId, productName) {

        const index = favorites.value.indexOf(productId)
        if (index === -1) {
            favorites.value.push(productId)
            showAlert({
                title: `Added to cart: ${productName}`,
                type: "info",
                message: "Product was added to your shopping cart",
                icon: "graphic-outline",
                button: {
                    label: "View Cart",
                    href: "/en/cart",
                },
                options: {
                    timer: 6000,
                }
            });

        } else {
            favorites.value.splice(index, 1)
            showAlert({
                title: `Added to cart: ${productName}`,
                type: "info",
                message: "Product was removed to your shopping cart",
                icon: "graphic-outline",
                button: {
                    label: "View Cart",
                    href: "/en/cart",
                },
                options: {
                    timer: 6000,
                }
            });
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
