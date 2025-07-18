// resources/js/app.js
import { createApp } from 'vue';
import Alpine from 'alpinejs';

// import HomePage from './pages/HomePage.vue';
import Search from './components/Search.vue';
import CartDropdown from './components/CartDropdown.vue';
import Button from './components/Button.vue';

window.Alpine = Alpine;


// Масив компонентів
const components = {
    Search,
    CartDropdown,
    Button
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
