import forms from '@tailwindcss/forms';
import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/scripts/**/*.{js,jsx,ts}',
    './resources/views/**/*.{blade.php,js,jsx,ts,vue}',
  ],
  theme:   {
    extend:    {
      fontFamily: {
        sans: ['Inter', ...defaultTheme.fontFamily.sans],
        mono: ['"Space Mono"', 'monospace'],
      },
    },
  },
  plugins: [
    forms,
  ],
};
