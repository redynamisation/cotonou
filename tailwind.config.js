import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            colors: {
                buloc: {
                    orange: '#E8905D',
                    'orange-dark': '#D97D4D',
                    'orange-light': '#F5A97A',
                    green: '#2D6A4F',
                    'green-light': '#40916C',
                },
                brand: {
                    yellow: '#F8D34D',
                    orange: '#E8905D',
                },
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
