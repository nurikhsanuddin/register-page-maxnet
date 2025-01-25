/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
      fontFamily: {
        opens: ['Open Sans', 'sans-serif'],
      },
      colors: {
        'purple-maxnet' : '#4A007B',
        'orange-maxnet' : '#F33656',
        'gold-maxnet' : '#B28E00',
      }
    },
  },
  plugins: [
    require('flowbite/plugin')
  ],
}

