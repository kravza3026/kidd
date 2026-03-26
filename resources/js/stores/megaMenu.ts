// stores/megaMenu.ts
import { ref } from 'vue'

export const isMegaOpen = ref(false)
export const toggleMegaMenu = () => { isMegaOpen.value = !isMegaOpen.value }
export const closeMegaMenu = () => { isMegaOpen.value = false }
