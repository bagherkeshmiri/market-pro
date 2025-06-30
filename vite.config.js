import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig(({ command }) => {
    if (command === 'serve') {
        return {
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
                host: '0.0.0.0',
                port: 5173,
                strictPort: true,
                cors: true,
                hmr: {
                    host: '192.168.4.5',
                },
            },
            esbuild: {
                logOverride: {
                    'css-syntax-error': 'silent',
                },
            },
        };
    } else {
        return {
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
                    refresh: false,
                }),
            ],
            esbuild: {
                logOverride: {
                    'css-syntax-error': 'silent',
                },
            },
        };
    }
});
