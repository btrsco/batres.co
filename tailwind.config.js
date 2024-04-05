import containerQueries from '@tailwindcss/container-queries';
import forms from '@tailwindcss/forms';
import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
module.exports = {
    darkMode: 'media',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/scripts/**/*.{js,jsx,ts}',
        './resources/views/**/*.{blade.php,js,jsx,ts,vue}',
    ],
    theme:   {
        extend: {
            containers: {
                '2xs': '16rem',
            },
            dropShadow:    {
                lg: '0px 6px 8px -4px rgba(0, 0, 0, 0.05), 0px 16px 20px -3px rgba(0, 0, 0, 0.05)',
                xl: '0px 8px 10px -6px rgba(0, 0, 0, 0.05), 0px 20px 25px -5px rgba(0, 0, 0, 0.05)',
            },
            fontFamily:    {
                sans:            [ '"Neuething Sans"', ...defaultTheme.fontFamily.sans ],
                'sans-expanded': [ '"Neuething Sans Expanded"', ...defaultTheme.fontFamily.sans ],
                'display':       [ 'Huben', ...defaultTheme.fontFamily.sans ],
                mono:            [ '"Space Mono"', 'monospace' ],
            },
            letterSpacing: {
                condensed: '-0.04em',
            },
            aspectRatio:   {
                'shot': '4 / 3',
            },
        },
    },
    plugins: [
        forms,
        containerQueries,
    ],
};
