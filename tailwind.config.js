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
        },
    },

    plugins: [
        forms,
        require('flowbite/plugin'),
        // require('tailwind-scrollbar-hide'),
        // function({ addComponents }) {
        //     addComponents({
        //       '.no-scrollbar': {
        //         '-ms-overflow-style': 'none',     
        //         'scrollbar-width': 'none',        
        //       },
        //       '.no-scrollbar::-webkit-scrollbar': {
        //         display: 'none'                   
        //       }
        //     })
        //   }
    ],
};


