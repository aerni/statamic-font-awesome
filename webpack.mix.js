const mix = require('laravel-mix');

mix.setPublicPath('resources/dist')
    .js('resources/js/cp.js', 'js')
    .vue();

if (mix.inProduction()) {
    mix.version();
}
