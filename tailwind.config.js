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
    flame: '#E8440A',

    amber: {
        DEFAULT: '#FF9A5C',
        600: '#D97706',
        500: '#F59E0B',
    },

    gold: '#F4C95D',

    brand: {
        950: '#2A1508',
        900: '#3D1A08',
        800: '#4A1F0D',
        700: '#6B2E14',
    },
},
        },
    },

    plugins: [forms],
};
