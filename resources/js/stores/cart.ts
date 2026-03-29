import { defineStore } from 'pinia'
import { ref,reactive } from 'vue'

export const useCartStore = defineStore('cart', () => {
    const items = reactive<any[]>([])
    const grandTotal = ref(0)

    async function fetchCart() {
        try {
            const { data } = await window.axios.get('cart')
            items.value = data.items
            grandTotal.value = data.grand_total
        } catch (e) {
            console.error('Cart fetch error:', e)
            items.value = []
            grandTotal.value = 0
        }
    }

    async function updateItem(hash: string, variantId: number, quantity: number) {
        const { data } = await window.axios.put(`cart/${hash}`, { variant_id: variantId, quantity })
        if (data?.alert) window.toast(data.alert)
        await fetchCart()
    }

    async function removeItem(hash: string) {
        const { data } = await window.axios.delete(`cart/${hash}`)
        if (data?.alert) window.toast(data.alert)
        items.value = items.value.filter((i) => i.hash !== hash)
        await fetchCart()
    }

    return { items, grandTotal, fetchCart, updateItem, removeItem }
})
