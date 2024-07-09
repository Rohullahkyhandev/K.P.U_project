/** @type {import('tailwindcss').Config} */
export default {
    purge: ["./index.html", "./src/**/*.{vue,js,ts,jsx,tsx}"],
    theme: {
        extend: {},
    },
    plugins: [require("@tailwindcss/forms"), [require("tailwindcss-primeui")]],
};
