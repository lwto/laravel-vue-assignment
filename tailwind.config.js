/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    screens: {
      sm: '480px',
      md: '768px',
      lg: '976px',
      xl: '1440px'
    },
    colors: {
      logo: 'rgb(30 58 138)',
      blue: 'rgb(67 56 202)',
      white: '#fff',
      gray: 'rgb(107 114 128)',
      lightGray: 'rgb(209 213 219)',
      lightBlue: 'rgb(219 234 254)',
      black: '#333333',
      red: 'rgb(239 68 68)',
      green: 'rgb(68 212 68)',
    },
    extend: {},
  },
  plugins: [],
}

