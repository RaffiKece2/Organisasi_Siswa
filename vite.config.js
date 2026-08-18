import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/login.js',
                'resource/js/search.js',
                'resource/js/profile.js',
                'resource/js/notifikasi.js',
                'resource/js/dashboard.js',
                'resource/js/deleteProfile.js',
                'resource/js/deleteSiswa.js',
                'resource/js/jurusan.js',
                'resource/js/jurusanSiswa.js',
            
            ],
            refresh: true,
        }),
    ],
});