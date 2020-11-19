module.exports = {
  purge: {
    content: [
      './public/assets/svgs/*.svg',
      './resources/views/**/*.html',
      './resources/views/*.html',   
    ],
    options: {
      safelist: [
        'think-toast', 
        'think-loser-toast', 
        'overflow-visible',
        'page-content',
        ' toggle-dot',
        'threed-animation',
        'swiper-button-disabled',
      ]
    }
  },
  theme: {
    container: {
      padding: '2rem',
      center: true,
      screens: {
        "none": "100%",
        sm: '540px',
        md: '720px',
        lg: '960px',
        xl: '1140px',
      }
    },
    fontFamily: {
      black: ['geo-black'],
      regular: ['geo-regular'],
      bold: ['geo-bold'],
      "regular-italic": ['geo-regular-italic'],
      medium: ['geo-medium']
    },
    extend: {
      margin: {
        
      },
      spacing: {
        "screen": "100vw",
        handle: "5rem",
        "handle-nm": "calc( 100vw - 5rem )",
        "vertical-handle-nm": "calc(100vh - 120px)",
        '1/2': '50%',
        '1/3': '33.333333%',
        '2/3': '66.666667%',
        '1/4': '25%',
        '2/4': '50%',
        '3/4': '75%',
        '1/5': '20%',
        '2/5': '40%',
        '3/5': '60%',
        '4/5': '80%',
        '1/6': '16.666667%',
        '2/6': '33.333333%',
        '3/6': '50%',
        '4/6': '66.666667%',
        '5/6': '83.333333%',
        '1/12': '8.333333%',
        '2/12': '16.666667%',
        '3/12': '25%',
        '4/12': '33.333333%',
        '5/12': '41.666667%',
        '6/12': '50%',
        '7/12': '58.333333%',
        '8/12': '66.666667%',
        '9/12': '75%',
        '10/12': '83.333333%',
        '11/12': '91.666667%',
        full: '100%',
        screen: '100vw',
      },
      fontFamily: {
        black: ['geo-black'],
        regular: ['geo-regular'],
        bold: ['geo-bold'],
        "regular-italic": ['geo-regular-italic'],
        medium: ['geo-medium']
      },
      fontSize: {
        "display-hero": "7rem",
        "2:5-xl": "1.25rem",
        "4:5xl": "2.5rem",
        "7xl": "5rem",
        "10xl": "6rem",
        "14xl": "7rem",
        "18xl": "8rem"
      },
      transitionProperty: {
        'background-color': 'background-color'
      },
      rotate: {
        '135': '135deg'
      },
      minHeight : {
        '0': '0',
       '1/4': '25%',
       '1/2': '50%',
       '3/4': '75%',
       '1000': '1000px',
      },
      maxHeight : {
        '0': '0',
       '1/4': '25%',
       '1/2': '50%',
       '3/4': '75%',
       '1000': '1000px',
       '600': '600px',
      },
      maxWidth : {
        "500": "500px"
      },
      zIndex: {
        '1': '1',
        '5': '5',
      },
      colors: {
        yellow: "#FFC734",
        darker: "#2C2F33",
        dark: "#42454A",
        light: "#F7F7F7",
        grey: "#AFB0B3",
        blue: "#0A064D",
        "light-blue": "#3369FF",
        "light-grey": "#DDDDDD",
      },
      flex: {
        "none": "0 0 0%",
        "33": "1 0 33%",
        "50": "1 0 50%",
        "66": "1 0 66%",
        "100": "1 0 100%"
      },
      // translate: {
      //   '1/4': '25%',
      // }
      inset: {
        '1/2': '50%'
      }
    },
  },
  corePlugins: {
    fontWeight: false,
  },
  variants: {
    scale: ['responsive', 'hover', 'focus', 'active', 'group-hover'],
    animation: ['responsive', 'hover', 'focus'],
  },
  plugins: [
    require('tailwindcss-debug-screens'),
  ],
}
