/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        fontSize: {
            'xs': '0.75rem',
            'sm': '0.875rem',
            'base': '1rem',
            'lg': '1.125rem',
            'xl': '1.25rem',
            '2xl': '1.5rem',
            '3xl': '1.875rem',
            '4xl': '2.25rem',
            '5xl': '3rem',
            '6xl': '3.75rem',
            '7xl': '4.5rem',
            '8xl': '6rem',
            '9xl': '8rem',
            '10xl': '10rem',
        },
        colors: {
            transparent: 'transparent',
            current: 'currentColor',
            white: '#ffffff',
            black: '#000000',
            // Dark theme palette
            dark: {
                bg: '#000000',
                surface: '#0a0a0a',
                card: '#111111',
                border: '#1a1a1a',
                text: '#ffffff',
                muted: '#888888',
            },
            // Accent colors
            accent: {
                DEFAULT: '#f0fa00',
                hover: '#d4de00',
            },
            yellow: {
                400: '#f0fa00',
                500: '#d4de00',
            },
            // Utility colors
            gray: {
                100: '#f5f5f5',
                200: '#e5e5e5',
                300: '#d4d4d4',
                400: '#a3a3a3',
                500: '#737373',
                600: '#525252',
                700: '#404040',
                800: '#262626',
                900: '#171717',
            },
            red: {
                50: '#fef2f2',
                500: '#ef4444',
                700: '#b91c1c',
            },
        },
        fontFamily: {
            'display': ['Space Grotesk', 'sans-serif'],
            'body': ['Inter', 'sans-serif'],
            'mono': ['JetBrains Mono', 'monospace'],
        },
        extend: {
            spacing: {
                '18': '4.5rem',
                '88': '22rem',
                '128': '32rem',
            },
            zIndex: {
                '60': '60',
                '70': '70',
                '80': '80',
                '90': '90',
                '100': '100',
                'cursor': '9999',
                'preloader': '10000',
            },
            transitionDuration: {
                '400': '400ms',
                '600': '600ms',
                '800': '800ms',
                '1200': '1200ms',
            },
            transitionTimingFunction: {
                'out-expo': 'cubic-bezier(0.19, 1, 0.22, 1)',
                'out-quart': 'cubic-bezier(0.25, 1, 0.5, 1)',
                'in-out-quart': 'cubic-bezier(0.76, 0, 0.24, 1)',
            },
            animation: {
                'fade-in': 'fadeIn 0.8s ease-out forwards',
                'slide-up': 'slideUp 0.8s ease-out forwards',
                'scale-in': 'scaleIn 0.6s ease-out forwards',
                'marquee': 'marquee 25s linear infinite',
                'marquee-reverse': 'marquee-reverse 25s linear infinite',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                slideUp: {
                    '0%': { opacity: '0', transform: 'translateY(30px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                scaleIn: {
                    '0%': { opacity: '0', transform: 'scale(0.95)' },
                    '100%': { opacity: '1', transform: 'scale(1)' },
                },
                marquee: {
                    '0%': { transform: 'translateX(0%)' },
                    '100%': { transform: 'translateX(-50%)' },
                },
                'marquee-reverse': {
                    '0%': { transform: 'translateX(-50%)' },
                    '100%': { transform: 'translateX(0%)' },
                },
            },
        }
    },
    plugins: [],
}
