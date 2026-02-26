/** @type {import('tailwindcss').Config} */
export default {
    // Paksa agar menang lawan Bootstrap
    important: true,

    // Matikan reset agar tidak merusak Footer Bootstrap
    corePlugins: {
        preflight: false,
    },

    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                poppins: ["Poppins", "sans-serif"],
                qwigley: ["Qwigley", "cursive"],
            },
        },
    },
    plugins: [], // Kosongkan dulu bagian ini
};
