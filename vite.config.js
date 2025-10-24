import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
  build: {
    outDir: 'dist',        // ✅ Thư mục mà Vercel yêu cầu
    emptyOutDir: true
  },
  plugins: [
    laravel({
      input: ['resources/css/app.css', 'resources/js/app.js'],
      refresh: true
    }),
    tailwindcss()
  ],
  server: {
    host: true,
    port: 5173
  }
});
