import './bootstrap';

import { createApp } from 'vue';
import { ZiggyVue } from 'ziggy-js';
import { Ziggy } from './ziggy.js';

import Alpine from 'alpinejs';
import Precognition from 'laravel-precognition-alpine';
import { default as IMask } from 'imask';

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
import SubscribeForm from './components/ui/subscribeForm.vue';
import Accordion from './components/ui/accordion.vue';
import Tooltip from './components/ui/tooltip.vue';
import ScrollToTop from './components/ui/scrollToTop.vue';
import SizeGuide from './components/ui/sizeGuide.vue';
import HelpMain from './components/staticPages/help/helpMain.vue';
import Swal from 'sweetalert2';
import i18n from './i18n';
import { useAlert } from '@/useAlert';

import.meta.glob('../images/**/*');

window.Swal = Swal;
window.Alpine = Alpine;
window.IMask = IMask;

Alpine.plugin(Precognition);

const { showAlert } = useAlert();
window.toast = showAlert;

// Масив компонентів
const components = {
    Accordion,
    Cart,
    Addresses,
    Family,
    Search,
    mobileMenu: MobileMenu,
    CartDropdown,
    UserDropdown,
    Button,
    Tooltip,
    SubscribeForm,
    ScrollToTop,
    SizeGuide,
    ProductCard,
    ProductSlider,
    ProductPageForm,
    ProductsCardsSlider,
    HelpMain,
};

// Шукаємо всі елементи з data-vue-компонентом
document.querySelectorAll('[data-vue-component]').forEach((el) => {
    const name = el.dataset.vueComponent;

    let props = {};
    if (el.dataset.vueProps) {
        props = JSON.parse(el.dataset.vueProps);
    } else if (el.dataset.product) {
        props = { product: JSON.parse(el.dataset.product) };
    }

    if (el.dataset.locale) props.locale = el.dataset.locale;
    if (el.dataset.link) props.link = el.dataset.link;
    if (el.dataset.title) props.title = el.dataset.title;
    if (el.dataset.info) props.info = el.dataset.info;

    if (components[name]) {
        const app = createApp(components[name], props);
        app.use(i18n);
        app.use(ZiggyVue, Ziggy); // php artisan ziggy:generate

        app.mount(el);
    }
});

// Ініціалізація Alpine.js
document.addEventListener('alpine:init', () => {
    Alpine.store('dropdown', {
        open: false,
        toggle() {
            this.open = !this.open;
        },
        close() {
            this.open = false;
        },
    });
});

Alpine.start();

window.addEventListener('load', function () {
    document.querySelectorAll('#phone, #contact_phone').forEach((phone_input) => {
        if (phone_input !== null) {
            IMask(phone_input, {
                mask: '+{373} (00) 000 000',
                lazy: true, // make placeholder always visible
                placeholderChar: '_', // defaults to '_'
            });
        }
    });

    document
        .querySelectorAll('#billing_postal_code, #shipping_postal_code, #postal_code')
        .forEach((postal_code_input) => {
            if (postal_code_input !== null) {
                IMask(postal_code_input, {
                    mask: 'MD-0000',
                    regex: '^(?:MD)*(\\d{4})$',
                    lazy: false, // make placeholder always visible
                    placeholderChar: '_', // defaults to '_'
                });
            }
        });
    // TODO add translate in toast
    document.getElementById('copyBtn').addEventListener('click', function() {
        const text = document.getElementById('copy').innerText;

        // Основний спосіб (Clipboard API)
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(text).then(() => {
                toast({
                    type: 'info',
                    message:text,
                    title:'Code is copied to clipboard'
                })
            }).catch(err => {
                toast({
                    type: 'info',
                    message:text,
                    title:'Could not copy to clipboard'
                })
            });
        } else {
            let textarea = document.createElement("textarea");
            textarea.value = text;
            textarea.style.position = "fixed";  // не скролить сторінку
            document.body.appendChild(textarea);
            textarea.focus();
            textarea.select();
            try {
                document.execCommand('copy');
                toast({
                    type: 'info',
                    message:text,
                    title:'Code is copied to clipboard'
                })
            } catch (err) {
                toast({
                    type: 'info',
                    message:text,
                    title:'Could not copy to clipboard'
                })
            }
            document.body.removeChild(textarea);
        }
    });
});

