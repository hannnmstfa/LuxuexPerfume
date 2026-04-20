import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './node_modules/flowbite/**/*.js'
    ],

    theme: {
        extend: {
            fontFamily: {
                inter: ['Inter', ...defaultTheme.fontFamily.sans],
                poppins: ['Poppins', ...defaultTheme.fontFamily.sans],
            },
            keyframes: {
                swipeUp: {
                    '0%': { transform: 'translateY(50px)', opacity: '0' },
                    '100%': { transform: 'translateY(0)', opacity: '1' },
                },
                swipeDown: {
                    '0%': { transform: 'translateY(-50px)', opacity: '0' },
                    '100%': { transform: 'translateY(0)', opacity: '1' },
                },
                shake: {
                    '0%, 100%': { transform: 'translateX(0)' },
                    '20%': { transform: 'translateX(-6px)' },
                    '40%': { transform: 'translateX(6px)' },
                    '60%': { transform: 'translateX(-6px)' },
                    '80%': { transform: 'translateX(6px)' },
                },
            },
            animation: {
                swipeUp: 'swipeUp 0.5s ease-out forwards',
                swipeDown: 'swipeDown 0.5s ease-out forwards',
                shake: 'shake 0.5s ease-in-out',
            },
            colors: {
                'gold': '#D4AF37',
            },
        },
    },

    plugins: [
        require('flowbite/plugin')({
            chart: true,
            datatables: true,
        }),
        forms,
    ],
};
