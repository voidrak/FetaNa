import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      fontFamily: {
        Montserrat: ["Montserrat", "san-serif"],
        DMSans: ["DM Sans", "san-serif"],
      },
      colors: {
        "bg-tan": "#f6f2e9",
        "bg-dark-green": "#003d29",
        "bg-light-green": "#9ee76f",
        "blue-accent": "#338eee",
      },
    },
  },
  plugins: [],
};
