import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import { viteStaticCopy } from 'vite-plugin-static-copy';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/admin-panel.css',
                'resources/js/admin-panel.js',
                'resources/css/admin-auth.css',
                'resources/js/admin-auth.js',
            ],
            refresh: true,
        }),
        viteStaticCopy({
            targets: [
                {
                    src: 'resources/fonts',
                    dest: 'fonts',
                },
            ],
        }),
    ],
    server: {
        hmr: {
            host: 'localhost',
        },
    },
});
