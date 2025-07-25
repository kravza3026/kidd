import { createI18n } from 'vue-i18n'

import en from '../../lang/en/base.js'
import ro from '../../lang/ro/base.js'
import ru from '../../lang/ru/base.js'


const messages = {
    en,
    ro,
    ru,
}

const i18n = createI18n({
    legacy: false, // для Vue 3 Composition API
    locale: document.documentElement.lang || 'ro', // мова за замовчуванням
    fallbackLocale: 'ro',
    messages,
})

export default i18n
