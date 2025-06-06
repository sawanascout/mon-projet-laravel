import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    /*
    server: {
        host: true,  // Écoute sur toutes les interfaces réseau (0.0.0.0)
        port: 3000,   // Optionnel : définir un port fixe
        strictPort: true, // Ne pas changer de port si 3000 est pris
    },*/
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
