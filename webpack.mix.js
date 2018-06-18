let mix = require('laravel-mix');

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')
   //.less('resources/assets/less/app.less', 'public/css')
   //.sass('resources/assets/sass/app.sass', 'public/css')
   ;
