import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/sass/theme.scss',
                'resources/js/app.js',
                'resources/js/theme.js',
                'resources/js/reply.js',
            ],
            refresh: true,
        }),
    ],
});
