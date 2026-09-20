import { defineConfig } from 'vite'
import react from '@vitejs/plugin-react'

export default defineConfig({
  plugins: [react()],
  server: {
    proxy: {
      '/api': {
        target: 'http://localhost',
        changeOrigin: true,
        rewrite: path => path.replace(
          /^\/api/,
          '/Laravel-itcc-project-tracker/itcc_project_tracker/public/api'
        ),
      },
    },
  },
})