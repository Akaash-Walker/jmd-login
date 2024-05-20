import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'd-rgba': 'rgba(63, 65, 69, 1.00)',
                'm-rgba': 'rgba(166, 166, 166, 1.00)',
                'j-rgba': 'rgba(160, 28, 35, 1.00)',
            },
        },
    },

    plugins: [forms],
};
