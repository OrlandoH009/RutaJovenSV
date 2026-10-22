import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                display: ['Newsreader', 'Georgia', ...defaultTheme.fontFamily.serif],
            },
            // Paletas grises remapeadas a los tonos fríos de la referencia (Voiceflow):
            // así las ~60 vistas existentes heredan el nuevo look sin reescribir cada clase.
            colors: {
                gray: {
                    50: '#FDFDFD', 100: '#F2F7F7', 200: '#E3EBEC', 300: '#CDD8DA', 400: '#9AA7AB',
                    500: '#6E797B', 600: '#515A63', 700: '#38414A', 800: '#232A31', 900: '#1A1E23',
                },
                slate: {
                    50: '#FDFDFD', 100: '#F2F7F7', 200: '#E3EBEC', 300: '#CDD8DA', 400: '#9AA7AB',
                    500: '#6E797B', 600: '#4A535C', 700: '#333B44', 800: '#232A31', 900: '#1A1E23', 950: '#111418',
                },
            },
            borderRadius: {
                xl: '1rem',
                '2xl': '1.25rem',
                '3xl': '1.75rem',
            },
            boxShadow: {
                soft: '0 1px 2px rgb(26 30 35 / 0.04), 0 8px 24px -12px rgb(26 30 35 / 0.12)',
            },
        },
    },

    plugins: [forms],
};
