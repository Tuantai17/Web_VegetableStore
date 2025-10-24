// vite.config.js
import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
  plugins: [
    laravel({
      // Khớp với @vite trong Blade
      input: ['resources/css/app.css', 'resources/js/app.js'],
      // Laravel sẽ tìm public/build/manifest.json
      buildDirectory: 'build',
      refresh: true,
    }),
    tailwindcss(),
  ],
})
