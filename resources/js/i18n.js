import { createI18n } from 'vue-i18n'

import en from '../lang/en/base.js'
import ru from '../lang/ru/base.js'


const messages = {
    en,
    ru,
    // ro,
}

const i18n = createI18n({
    legacy: false, // для Vue 3 Composition API
    locale: document.documentElement.lang || 'en', // мова за замовчуванням
    fallbackLocale: 'en',
    messages,
})

export default i18n
