// vite.config.js (hoặc vite.config.ts)
import { defineConfig } from 'vite'
import tailwindcss from '@tailwindcss/vite'
// ⚠ Nếu bạn dùng React:
import react from '@vitejs/plugin-react'
// ⚠ Nếu bạn dùng Vue:
// import vue from '@vitejs/plugin-vue'

export default defineConfig({
  plugins: [
    react(),            // hoặc vue(), nếu bạn dùng Vue
    tailwindcss()
  ],
  build: {
    outDir: 'dist',     // ✅ Render/Vercel sẽ tìm thư mục này
    emptyOutDir: true
  },
  server: {
    host: true,
    port: 5173
  },
  base: '/'            // ✅ quan trọng nếu deploy trên domain riêng
})
