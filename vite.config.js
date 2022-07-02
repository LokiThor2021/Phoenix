import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import babel from '@rollup/plugin-babel';
import copy from 'rollup-plugin-copy';

export default defineConfig({
    resolve: {
        alias: [
            {
                // this is required for the SCSS modules
                find: /^~(.*)$/,
                replacement: '$1',
            },
        ],
    },
    plugins: [
        laravel([
            'resources/sass/app.scss',

            /*
             * Sourced asset dependencies via node_modules and JS bootstrapping
             */
            'resources/js/app.js',
            'resources/js/unit3d/chat.js',
            'resources/js/unit3d/imgbb.js',
            'resources/js/vendor/alpine.js',
            'resources/js/vendor/virtual-select.js',

            /*
             * Themes
             *
             * Note: Default wysibb theme is compiled into public/css/app.css from resources/sass/app.scss
             */
            'resources/sass/themes/galactic.scss',
            'resources/sass/themes/dark-blue.scss',
            'resources/sass/themes/dark-green.scss',
            'resources/sass/themes/dark-pink.scss',
            'resources/sass/themes/dark-purple.scss',
            'resources/sass/themes/dark-red.scss',
            'resources/sass/themes/dark-teal.scss',
            'resources/sass/themes/dark-yellow.scss',
            'resources/sass/themes/cosmic-void.scss',

            /*
             * Login and TwoStep Auth styles
             *
             * We compile each of these separately since they should only be loaded with the certain views
             */
            'resources/sass/main/login.scss',
            'resources/sass/main/twostep.scss',

            /* Babel File  */
            'resources/js/unit3d.js',
        ]),
        babel({ babelHelpers: 'bundled' }),
        copy({
            targets: [{ src: 'resources/sass/vendor/webfonts/**/*', dest: 'public/fonts/' }],
        }),
    ],
});
