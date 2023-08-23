import defaultTheme from 'tailwindcss/defaultTheme';
import daisyui from "daisyui";
import colors from "tailwindcss/colors";

/** @type {import('tailwindcss').Config} */
export default {
    preset: [
        require("./vendor/power-components/livewire-powergrid/tailwind.config.js"),
        require('./vendor/wireui/wireui/tailwind.config.js')
    ],
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './app/Http/Livewire/**/*Table.php',
        './vendor/power-components/livewire-powergrid/resources/views/**/*.php',
        './vendor/power-components/livewire-powergrid/src/Themes/Tailwind.php',
        './resources/views/**/*.blade.php',
        './vendor/wireui/wireui/resources/**/*.blade.php',
        './vendor/wireui/wireui/ts/**/*.ts',
        './vendor/wireui/wireui/src/View/**/*.php'
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors : {
                "primary": colors.indigo,
                "pg-primary": colors.gray,
            }
        },
    },

    plugins: [
        require("@tailwindcss/forms")({
            strategy: 'class', // only generate classes
        }),
        daisyui,
    ],
};
