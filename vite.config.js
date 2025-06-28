import {defineConfig} from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/admin-auth-app.css',
                'resources/css/admin-panel-app.css',
                'resources/css/site-app.css',
                'resources/js/admin-auth-app.js',
                'resources/js/admin-panel-app.js',
                'resources/js/site-app.js',
            ],
            refresh: true,
        }),
    ],
    server: {
        host: '127.0.0.1',
        port: 5173
    }
});
