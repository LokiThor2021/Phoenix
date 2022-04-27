module.exports = {
  important: true,
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  darkMode: 'class', /* Light mode will be added in the near future */
  theme: {
    extend: {
      colors: {
        black: '#010101',
        'desi-gold':'#B69255',
        'discord': '#5865F2'
      }
    }
  },
  plugins: [],
}