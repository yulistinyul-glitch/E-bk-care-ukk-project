/** @type {import('tailwindcss').Config} */
const plugin = require("tailwindcss/plugin");

export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {},
    },
    plugins: [
        plugin(function ({ addUtilities }) {
            addUtilities({
                /* Kelas untuk menyembunyikan scrollbar */
                ".scrollbar-hide": {
                    /* IE and Edge */
                    "-ms-overflow-style": "none",
                    /* Firefox */
                    "scrollbar-width": "none",
                    /* Safari and Chrome */
                    "&::-webkit-scrollbar": {
                        display: "none",
                    },
                },
            });
        }),
    ],
};
