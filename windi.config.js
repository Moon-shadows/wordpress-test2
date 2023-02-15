import { defineConfig } from 'windicss/helpers'

export default defineConfig({

  theme: {
    screens: {
        sm: '640px',
        md: '768px',
        lg: '1024px',
        xl: '1280px',
    },

    extend: {
      colors: {
          transparent: 'transparent',
          black: '#000',
          white: '#fff'
      },
      fontFamily: {
        sans: [
            //
        ],
        serif: [
            //
        ],
        mono: [
            //
        ]
      },
      fontSize: {
        xs: '',
        sm: '',
        base: '1rem', //Use this as base, rem or px is up to you
        md: '',
        lg: '',
        xl: '',
        '2xl': ''
      },
      lineHeight: {
          none: 1,
          tight: 1.25,
          normal: 1.5,
          loose: 2
      },
      fontWeights: {
          normal: 400,
          medium:500,
          bold: 700
      },
      padding: {},
      margins: {}
      }
    },
    variants: {},
    plugins: []
})
