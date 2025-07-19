// resources/js/app.js
import { createApp } from 'vue';
import Alpine from 'alpinejs';

import.meta.glob('../images/**/*');

import Search from './components/Search.vue';
import CartDropdown from './components/CartDropdown.vue';
import UserDropdown from './components/UserDropdown.vue';
import Button from './components/Button.vue';
import SimpleButton from './components/SimpleButton.vue';
window.Alpine = Alpine;


// Масив компонентів
const components = {
    Search,
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
