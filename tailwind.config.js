/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.svelte',
	'./app/Utils/VideoUtil.php',
  ],
  theme: {
    extend: {},
  },
  plugins: [require("daisyui")],
  daisyui: {
	themes: ['black']
  }
}

