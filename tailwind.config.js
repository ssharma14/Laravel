/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        fontSize: {
            '4xl': ['2.25rem', {
                lineHeight: '1.25'
            }],
        },
        backgroundColor: {
            'yellow-400': '#f0fa00',
            'black': '#000',
            'neutral-100': '#f0f0f0'
        },
        borderColor:{
            'black': '#000',
        },
        extend: {
            backgroundColor: {
                'grey': '#E0E0E0',
            },
        }
    },
    plugins: [],
}
