const mix = require('laravel-mix');
const PurgecssPlugin = require('purgecss-webpack-plugin')
const glob = require('glob')
const path = require('path')

mix.setPublicPath('assets');
mix.js('resources/js/app.js', 'assets/js')
   .sass('resources/sass/app.scss', 'assets/css')
   .options({
      processCssUrls: false
   })
   .webpackConfig({
      plugins: [
         ...process.env.NODE_ENV === 'production' ?
         [new PurgecssPlugin({
           paths: glob.sync(`${path.join(__dirname, 'application/views')}/**/**/*`,  { nodir: true }),
           safelist: {
              deep: ['/^dataTables/']
           }
         })] : []
       ]
    })