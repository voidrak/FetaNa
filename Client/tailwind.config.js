/** @type {import('tailwindcss').Config} */
export default {
  content: ["./index.html", "./src/**/*.{vue,js,ts,jsx,tsx}"],
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
      screens: {
        mlg: "425px",
      },
    },
  },
  plugins: [],
};
