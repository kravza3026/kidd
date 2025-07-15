// resources/js/app.js
import { createApp } from 'vue';
import Alpine from 'alpinejs';

import HomePage from './pages/HomePage.vue';
import Button from './components/Button.vue';

window.Alpine = Alpine;
Alpine.start();

// Масив компонентів
const components = {
    HomePage,
    ExampleComponent: Button,
};

// Шукаємо всі елементи з data-vue-компонентом
document.querySelectorAll('[data-vue-component]').forEach((el) => {
    const name = el.dataset.vueComponent;
    const props = el.dataset.vueProps ? JSON.parse(el.dataset.vueProps) : {};

    if (components[name]) {
        createApp(components[name], props).mount(el);
    }
});
