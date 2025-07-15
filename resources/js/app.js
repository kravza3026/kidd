import { createApp } from 'vue';
import Alpine from 'alpinejs';
import HomePage from './pages/HomePage.vue';

window.Alpine = Alpine;

Alpine.start();
createApp(HomePage).mount('#content');
