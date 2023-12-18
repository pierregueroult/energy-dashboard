/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.{html,php}", "./src/**/*.js"],
  theme: {
    extend: {
      colors: {
        background: "hsl(var(--background))",
        border: "hsl(var(--border))",
        text: "hsl(var(--text))",
        primary: "hsl(var(--primary))",
      },
      transitionProperty: {
        width: "width",
        opacity: "opacity",
      },
      minWidth: {
        56: "14rem",
        30: "7.5rem",
      },
      width: {
        30: "7.5rem",
      },
    },
  },
  plugins: [],
  darkMode: "class",
};
