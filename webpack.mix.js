import mix from 'laravel-mix';
//run npx mix watch to compile the assets

mix.js('resources/js/mapbox.js', 'public/js').setPublicPath('public/js');