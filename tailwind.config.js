const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/asantibanez/livewire-calendar/resources/views/**/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        debugScreens: {
            position: ['bottom', 'right'],
          },
          fontFamily: {
            black: ['geo-black'],
            regular: ['geo-regular'],
            bold: ['geo-bold'],
            italic: ['geo-regular-italic'],
            medium: ['geo-medium']
          },
          container: {
            padding: '2rem',

          },
        extend: {

            colors: {
                yellow: "#FFC734",
                darker: "#2C2F33",
                // dark: "#42454A",
                dark: "#373737",
                "header-dark" :"#292929",
                "mid-grey" : "#7c7c7c",

                light: "#F7F7F7",
                grey: "#AFB0B3",
                blue: "#0A064D",
                "light-blue": "#3369FF",
                "light-grey": "#DDDDDD",
              },

        },

    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography'), require('tailwindcss-debug-screens'),],
};
