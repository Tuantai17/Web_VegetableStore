import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    build: {
        outDir: 'dist',        // ✅ Vercel yêu cầu thư mục đầu ra là dist
        emptyOutDir: true,     // ✅ Xóa dist cũ trước khi build mới
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        host: true,             // Cho phép truy cập từ bên ngoài (nếu cần)
        port: 5173,             // Cổng mặc định cho Vite
    },
});
