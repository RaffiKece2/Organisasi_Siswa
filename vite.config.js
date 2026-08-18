import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/login.js',
                'resources/js/search.js',
                'resources/js/profile.js',
                'resources/js/notifikasi.js',
                'resources/js/dashboard.js',
                'resources/js/deleteProfile.js',
                'resources/js/deleteSiswa.js',
                'resources/js/jurusan.js',
                'resources/js/jurusanSiswa.js',
            
            ],
            refresh: true,
        }),
    ],
});