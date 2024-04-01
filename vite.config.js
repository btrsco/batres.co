import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import path from 'path';
import { defineConfig } from 'vite';

export default defineConfig( {
  server:  {
    host: 'localhost',
  },
  resolve: {
    extensions: [ '.js', '.vue', '.ts', '.jsx', '.tsx', '.json', '.mjs', '.css', '.scss' ],
    alias:      {
      "@":        path.resolve(__dirname, "./resources"),
      'ZiggyVue': '/vendor/tightenco/ziggy/dist/index.esm.js',
    },
  },
  plugins: [
    laravel( {
      input:   [
        'resources/scripts/app.js',
        'resources/scss/app.scss',
      ],
      ssr:     'resources/scripts/ssr.js',
      refresh: true,
    } ),
    vue( {
      template: {
        transformAssetUrls: {
          base:            null,
          includeAbsolute: false,
        },
      },
    } ),
  ],
} );
