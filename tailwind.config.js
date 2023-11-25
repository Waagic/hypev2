/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./assets/**/*.js",
    "./templates/**/*.html.twig",
  ],
  theme: {
    colors: {
      'dark': '#082032',
      'medium': '#2C394B',
      'light' : '#334756',
      'orange' : '#FF4C29',
      'textColor': '#FAF0E6',
      'white' : '#FFF'
    },
    fontFamily: {
      title: ['Kilimanjaro', 'sans-serif'],
      titleAlt: ['Remboy', 'sans-serif'],
      body: ['CrimsonPro', 'sans-serif'],
    },
    extend: {},
  },
  plugins: [],
}

