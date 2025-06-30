// import defaultTheme from 'tailwindcss/defaultTheme';
// import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        // colors: {
        //     'blue': '#1fb6ff',
        //     'pink': '#ff49db',
        //     'orange': '#ff7849',
        //     'green': '#13ce66',
        //     'gray-dark': '#273444',
        //     'gray': '#8492a6',
        //     'gray-light': '#d3dce6',
        //   },
        extend: {
             // colors: {
        //     'blue': '#1fb6ff',
        //     'pink': '#ff49db',
        //     'orange': '#ff7849',
        //     'green': '#13ce66',
        //     'gray-dark': '#273444',
        //     'gray': '#8492a6',
        //     'gray-light': '#d3dce6',
        //   },
            // fontFamily: {
                // sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            // },
        },
    },

    plugins: [
        // forms
    ],
};
 module.exports = {
    content: [
      "./resources/**/*.blade.php",
       "./resources/**/*.js",
      "./resources/**/*.vue",
      './resources/views/**/*.blade.php',
      './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    //   "./node_modules/tw-elements/js/**/*.js"
    ],
    theme: {
        // colors: {
        //     'blue': '#1fb6ff',
        //     'pink': '#ff49db',
        //     'orange': '#ff7849',
        //     'green': '#13ce66',
        //     'gray-dark': '#273444',
        //     'gray': '#8492a6',
        //     'gray-light': '#d3dce6',
        //   },
      extend: {},
    },
    daisyui: {
        themes: ["light", "dark"], // false: only light + dark | true: all themes | array: specific themes like this ["light", "dark", "cupcake"]
        darkTheme: "light", // name of one of the included themes for dark mode
        base: true, // applies background color and foreground color for root element by default
        styled: true, // include daisyUI colors and design decisions for all components
        utils: true, // adds responsive and modifier utility classes
        prefix: "", // prefix for daisyUI classnames (components, modifiers and responsive class names. Not colors)
        logs: true, // Shows info about daisyUI version and used config in the console when building your CSS
        themeRoot: ":root", // The element that receives theme color CSS variables
    },
    // darkMode: "class",
    plugins: [
        // require("tw-elements/plugin.cjs"),
        // require('@tailwindcss/forms'),
        require('daisyui'),
    ]
  }
