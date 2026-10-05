import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            colors: {
                gold: "#B8935A",
                "gold-deep": "#8B6914",
                "gold-pale": "#E8DCC4",
                ivory: "#FAF8F3",
            },
            fontFamily: {
                serif: ['"Playfair Display"', "serif"],
                sans: ["Inter", "sans-serif"],
                mono: ['"JetBrains Mono"', "monospace"],
            },
        },
    },

    plugins: [forms],
};
