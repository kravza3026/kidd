import './bootstrap';

import { createApp } from 'vue';
import { createPinia } from 'pinia';
import { ZiggyVue } from 'ziggy-js';
import { Ziggy } from './ziggy.js';

import Alpine from 'alpinejs';
import Precognition from 'laravel-precognition-alpine';
import { default as IMask } from 'imask';

import Swal from 'sweetalert2';
import i18n from './i18n';
import { useAlert } from '@/useAlert';

import Search from './components/Search.vue';
import MobileMenu from './components/MobileMenu.vue';
import CartDropdown from './components/cart/CartDropdown.vue';
import UserDropdown from './components/account/UserDropdown.vue';
import Addresses from './components/account/addresses/Addresses.vue';
import Family from './components/account/family/Family.vue';
import Button from './components/ui/Button.vue';
import ProductCard from './components/product/ProductCard.vue';
import Cart from './components/cart/Cart.vue';
import ProductPageForm from './components/product/ProductPageForm.vue';
import ProductSlider from './components/ui/productSlider.vue';
import ProductsCardsSlider from './components/product/ProductsCardsSlider.vue';
import Accordion from './components/ui/accordion.vue';
import Tooltip from './components/ui/tooltip.vue';
import ScrollToTop from './components/ui/scrollToTop.vue';
import SizeGuide from './components/ui/sizeGuide.vue';
import HelpMain from './components/staticPages/help/helpMain.vue';
import MainMenu from "@/components/main-menu.vue";
import MegaMenu from "@/components/MegaMenu.vue";
import TopLine from "@/components/TopLine.vue";

import.meta.glob('../images/**/*');

// -------------------------------
// 🔥 GLOBALS
// -------------------------------
window.Swal = Swal;
window.Alpine = Alpine;
window.IMask = IMask;
Alpine.plugin(Precognition);

// toast
const { showAlert } = useAlert();
window.toast = showAlert;

// -------------------------------
// 🔥 ALPINE STORE (до .start())
// -------------------------------
Alpine.store('dropdown', {
    open: false,
    toggle() {
        this.open = !this.open;
    },
    close() {
        this.open = false;
    },
});

// -------------------------------
// 🔥 VUE APP — (Vue first, Alpine second)
// -------------------------------
const app = createApp({});

// всі компоненти
app.component('top-line', TopLine);
app.component('mobile-menu', MobileMenu);
app.component('main-menu', MainMenu);
app.component('mega-menu', MegaMenu);
app.component('search-component', Search);
app.component('cart-dropdown', CartDropdown);
app.component('user-dropdown', UserDropdown);
app.component('product-card', ProductCard);
app.component('product-slider', ProductSlider);
app.component('product-page-form', ProductPageForm);
app.component('products-cards-slider', ProductsCardsSlider);
app.component('accordion', Accordion);
app.component('tooltip', Tooltip);
app.component('scroll-to-top', ScrollToTop);
app.component('size-guide', SizeGuide);
app.component('help-main', HelpMain);
app.component('addresses', Addresses);
app.component('family', Family);
app.component('cart', Cart);
app.component('ui-button', Button);

// плаґіни Vue
app.use(createPinia());
app.use(i18n);
app.use(ZiggyVue, Ziggy);

// монтуємо Vue
app.mount('#app');

// -------------------------------
// 🔥 ALPINE STARTS AFTER VUE
// -------------------------------
Alpine.start();

// -------------------------------
// 🔥 INPUT MASKS + HELPERS
// -------------------------------
document.addEventListener('DOMContentLoaded', () => {

    // --- Phone mask ---
    document.querySelectorAll('#phone, #contact_phone').forEach(el => {
        IMask(el, {
            mask: '+{373} (00) 000 000',
            lazy: true,
            placeholderChar: '_',
        });
    });

    // --- Postal code mask ---
    document.querySelectorAll('#billing_postal_code, #shipping_postal_code, #postal_code')
        .forEach(el => {
            IMask(el, {
                mask: 'MD-0000',
                regex: '^(?:MD)*(\\d{4})$',
                lazy: false,
                placeholderChar: '_',
            });
        });

    // --- Copy to clipboard ---
    const copyBtn = document.getElementById('copyBtn');
    if (copyBtn) {
        copyBtn.addEventListener('click', () => {
            const text = document.getElementById('copy').innerText;
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(text).then(() => {
                    toast({ type: 'info', message: text, title: 'Code is copied to clipboard' });
                });
            } else {
                const area = document.createElement('textarea');
                area.value = text;
                area.style.position = 'fixed';
                document.body.appendChild(area);
                area.select();

                try {
                    document.execCommand('copy');
                    toast({ type: 'info', message: text, title: 'Code is copied to clipboard' });
                } catch(err) {
                    toast({ type: 'info', message: text, title: 'Could not copy' });
                }

                document.body.removeChild(area);
            }
        });
    }
});
