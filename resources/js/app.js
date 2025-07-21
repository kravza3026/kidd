// resources/js/app.js
import { createApp } from 'vue';
import Alpine from 'alpinejs';

import.meta.glob('../images/**/*');
import { default as IMask } from "imask";

import Search from './components/Search.vue';
import mobileMenu from './components/mobileMenu.vue';
import CartDropdown from './components/CartDropdown.vue';
import UserDropdown from './components/UserDropdown.vue';
import Button from './components/Button.vue';
import SimpleButton from './components/SimpleButton.vue';

window.Alpine = Alpine;
window.IMask = IMask;

// Масив компонентів
const components = {
    Search,mobileMenu,
    CartDropdown,UserDropdown,
    Button,SimpleButton,
};

// Шукаємо всі елементи з data-vue-компонентом
document.querySelectorAll('[data-vue-component]').forEach((el) => {
    const name = el.dataset.vueComponent;
    const props = el.dataset.vueProps ? JSON.parse(el.dataset.vueProps) : {};

    if (components[name]) {
        createApp(components[name], props).mount(el);
    }
});


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
            mask: "+{373}(00)000000",
            lazy: false, // make placeholder always visible
            placeholderChar: "_", // defaults to '_'
        });
    }
});
