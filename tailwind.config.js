/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/protonemedia/laravel-splade/lib/**/*.vue",
        "./vendor/protonemedia/laravel-splade/resources/views/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./app/Tables/views/*.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        extend: {
            colors: {
                primary: {
                    '50': '#eef5ff',
                    '100': '#d9e7ff',
                    '200': '#bcd5ff',
                    '300': '#8ebbff',
                    '400': '#5995ff',
                    '500': '#467cff',
                    '600': '#1b4cf5',
                    '700': '#1438e1',
                    '800': '#172eb6',
                    '900': '#192d8f',
                },
                alternative: {
                    '50': '#fff9eb',
                    '100': '#feeec7',
                    '200': '#fedd89',
                    '300': '#fec54b',
                    '400': '#fdb22e',
                    '500': '#f78b09',
                    '600': '#db6504',
                    '700': '#b64407',
                    '800': '#93350d',
                    '900': '#792c0e',
                },
                danger: {
                    100: "#fddedb",
                    200: "#fbbeb7",
                    300: "#f99d92",
                    400: "#f77d6e",
                    500: "#f55c4a",
                    600: "#c44a3b",
                    700: "#93372c",
                    800: "#62251e",
                    900: "#31120f"
                  },
                success: {
                    100: "#daf1e3",
                    200: "#b5e3c7",
                    300: "#8fd5aa",
                    400: "#6ac78e",
                    500: "#45b972",
                    600: "#37945b",
                    700: "#296f44",
                    800: "#1c4a2e",
                    900: "#0e2517"
                },
            }

        },
    },

    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography")
    ],
};
