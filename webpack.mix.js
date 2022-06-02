const mix = require('laravel-mix')

mix
  .sass('resources/scss/main.default.scss', 'public/assets/mix.default.bundle.css')
  .sourceMaps(false, 'source-map')
