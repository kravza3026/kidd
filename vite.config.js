import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import tailwindcss from '@tailwindcss/vite';
import path from 'path';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue(),
        tailwindcss({
            config: {
                plugins: [
                    require("@tailwindcss/forms"),
                    require("@tailwindcss/typography"),
                    require("@tailwindcss/aspect-ratio"),
                ],
            }
        }),
    ],
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources/js'),
            '@img': path.resolve(__dirname, 'resources/images'), // опціонально для зображень
            'ziggy-js': path.resolve('vendor/tightenco/ziggy'), // Router helper
        },
    },
});
