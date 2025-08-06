import "./bootstrap";

import { createApp } from 'vue';
import { ZiggyVue } from 'ziggy-js';
import { Ziggy } from './ziggy.js';

import Alpine from 'alpinejs';

import.meta.glob('../images/**/*');
import { default as IMask } from "imask";

import Search from './components/Search.vue';
import MobileMenu from './components/MobileMenu.vue';
import CartDropdown from './components/CartDropdown.vue';
import UserDropdown from './components/UserDropdown.vue';
import Addresses from './components/Addresses.vue';
import Button from './components/ui/Button.vue';
import ProductCard from './components/ProductCard.vue';
import Cart from './components/Cart.vue';
import ProductPageForm from './components/ProductPageForm.vue';
import ProductSlider from './components/ui/productSlider.vue';
import ProductsCardsSlider from './components/ProductsCardsSlider.vue';
import SubscribeForm from './components/ui/subscribeForm.vue';
import Accordion from './components/ui/accordion.vue';
import Tooltip from './components/ui/tooltip.vue';
import ScrollToTop from './components/ui/scrollToTop.vue';
import SizeGuide from './components/ui/sizeGuide.vue';
import HelpMain from './components/staticPages/help/helpMain.vue';
import Swal from 'sweetalert2';

window.Swal = Swal;
window.Alpine = Alpine;
window.IMask = IMask;

import i18n from './i18n';
import { useAlert } from "@/useAlert";

const { showAlert } = useAlert();
window.toast = showAlert;

// Масив компонентів
const components = {
    Accordion,
    Cart,Addresses,
    Search, mobileMenu: MobileMenu,
    CartDropdown,UserDropdown,
    Button,Tooltip,SubscribeForm,ScrollToTop,SizeGuide,
    ProductCard,ProductSlider,ProductPageForm, ProductsCardsSlider,
    HelpMain
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
        toggle() { this.open = !this.open },
        close() { this.open = false }
    });

});

Alpine.start();

window.addEventListener("load", function () {
    let phone_element = document.getElementById("phone");
    if (phone_element !== null) {
        IMask(phone_element, {
            mask: "+{373} (00) 000 000",
            lazy: false, // make placeholder always visible
            placeholderChar: "_", // defaults to '_'
        });
    }

});
