import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import tailwindcss from '@tailwindcss/vite';
import path from 'path';

export default defineConfig({
    define: {
        global: {},
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/css/admin.css', 'resources/js/app.js', 'resources/js/admin.js'],
            refresh: true,
        }),
        vue(),
        tailwindcss(),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js', // <--- важливо
            '@': path.resolve(__dirname, 'resources/js'),
            '@img': path.resolve(__dirname, 'resources/images'), // опціонально для зображень
            'ziggy-js': path.resolve('vendor/tightenco/ziggy'), // Router helper
        },
    },

    // auto‑import for Vite HMR
    safelist: ['wash-icon', 'wash-icon-sm', 'wash-icon-lg', 'wash-icon-muted', 'care-icon-wrapper'],

    rules: [
        ['.wash-icon', { width: '24px', height: '24px', color: 'currentColor' }],
        ['.wash-icon-sm', { width: '18px', height: '18px' }],
        ['.wash-icon-lg', { width: '32px', height: '32px' }],
        ['.wash-icon-muted', { opacity: '0.6' }],
        [
            '.care-icon-wrapper',
            {
                display: 'inline-flex',
                alignItems: 'center',
                justifyContent: 'center',
                width: '24px',
                height: '24px',
                color: 'currentColor',
            },
        ],
    ],
});
