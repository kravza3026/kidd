import { createI18n } from 'vue-i18n'

import en from '../../lang/en/base.js'
import ro from '../../lang/ro/base.js'
import ru from '../../lang/ru/base.js'


const messages = {
    en,
    ro,
    ru,
}


// useGrouping: true, notation: 'standard', currencyDisplay: 'symbol', maximumFractionDigits: 0
const numberFormats = {
    'ro': {
        currency: {
            style: 'currency',
            currency: 'MDL',
            useGrouping: true,
            notation: 'standard', // notation: 'standart' | 'compact'
            currencyDisplay: 'code', // currencyDisplay: 'code' | 'symbol' | 'name'
            maximumFractionDigits: 0
        },
        decimal: {
            style: 'decimal', minimumFractionDigits: 2, maximumFractionDigits: 2
        },
        percent: {
            style: 'percent', useGrouping: false
        }
    }
    ,'ru': {
        currency: {
            style: 'currency',
            currency: 'MDL',
            useGrouping: true,
            notation: 'standard', // notation: 'standart' | 'compact'
            currencyDisplay: 'code', // currencyDisplay: 'code' | 'symbol' | 'name'
            maximumFractionDigits: 0
        },
        decimal: {
            style: 'decimal', minimumFractionDigits: 2, maximumFractionDigits: 2
        },
        percent: {
            style: 'percent', useGrouping: false
        }
    }
    ,'en': {
        currency: {
            style: 'currency',
            currency: 'MDL',
            useGrouping: true,
            notation: 'standard', // notation: 'standart' | 'compact'
            currencyDisplay: 'code', // currencyDisplay: 'code' | 'symbol' | 'name'
            maximumFractionDigits: 0
        },
        decimal: {
            style: 'decimal', minimumFractionDigits: 2, maximumFractionDigits: 2
        },
        percent: {
            style: 'percent', useGrouping: false
        }
    },

}

const datetimeFormats = {
    'ro': {
        short: {
            year: 'numeric', month: 'short', day: 'numeric'
        },
        long: {
            year: 'numeric', month: 'short', day: 'numeric',
            weekday: 'short', hour: 'numeric', minute: 'numeric'
        }
    },
}

const i18n = createI18n({
    legacy: false, // для Vue 3 Composition API
    locale: document.documentElement.lang || 'ro', // мова за замовчуванням
    fallbackLocale: 'ro',
    messages,
    numberFormats,
    datetimeFormats,
})

export default i18n
