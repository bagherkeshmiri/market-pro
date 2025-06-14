import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';
import {viteStaticCopy} from 'vite-plugin-static-copy';

export default defineConfig({
    publicDir: 'public',
    plugins: [
        laravel({
            input: [
                'resources/css/admin-panel.css',
                'resources/js/admin-panel.js',
                'resources/css/admin-auth.css',
                'resources/js/admin-auth.js',
                'resources/css/frest/pages/page-user-profile.css',
            ],
            refresh: true,
        }),
    ],
    server: {
        hmr: {
            host: 'localhost',
        },
    },
});
