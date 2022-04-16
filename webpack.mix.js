const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .css('resources/css/owl-fix.css', 'public/css')
    .css('resources/css/mansory.css', 'public/css')
    .copy('resources/js/autocomplete.js', 'public/js')
    .copy('resources/js/search.js', 'public/js')
    .copy('node_modules/bootstrap/dist', 'public/dist/bootstrap')
    .copy('node_modules/owl.carousel/dist', 'public/dist/owl-carousel')
    .copy('node_modules/jquery/dist', 'public/dist/jquery')
    .copy('node_modules/@fancyapps/ui/dist', 'public/dist/fancybox')
    .copy('node_modules/masonry-layout/dist', 'public/dist/masonry')
    .sass('resources/sass/app.scss', 'public/css')
;

