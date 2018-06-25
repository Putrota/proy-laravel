let mix = require('laravel-mix');

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css')   
   .sass('resources/assets/sass/blog.scss', 'public/css')
   //.less('resources/assets/less/app.less', 'public/css')
   //.sass('resources/assets/sass/app.sass', 'public/css')
   ;

mix.js([
	'node_modules/bootstrap/dist/js/bootstrap.js',
	'node_modules/jquery/dist/jquery.js',
	'resources/assets/js/mis-scripts.js',
], 'public/js/all.js', './');

/*mix.styles([
	'public/css/app.css',
	'public/css/blog.css'
], 'public/css/app.css');*/

mix.browserSync({
	proxy: 'blog2.local'
});
