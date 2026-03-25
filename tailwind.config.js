/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'custom-purple': '#7877E6',
        'custom-white': '#FFFFFF',
        'custom-light-gray': '#F4F4F3',
        'custom-dark-gray': '#4F4F4F',
        'custom-black': '#212020',
      },
      fontFamily: {
        poppins: ['Poppins', 'sans-serif'],
      },
    },
  },
  plugins: [],
}
