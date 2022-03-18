const BrowserSyncPlugin = require('browser-sync-webpack-plugin')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const { WebpackManifestPlugin } = require('webpack-manifest-plugin')
const jsonfile = require('jsonfile')
const path = require('path')
const mix = require('laravel-mix')
const mixManifest = 'public/mix-manifest.json'

mix.webpackConfig({
   entry: {
      main: ['regenerator-runtime/runtime.js', './resources/js/main.js', './resources/scss/main.scss']
   },
   output: {
      filename: '[name]~[contenthash].js',
      path: path.resolve(__dirname, 'public/dist'),
      clean: true
   },
   plugins: [
      new BrowserSyncPlugin({
         proxy: 'localhost:8000',
         port: 3000,
         host: 'localhost',
         files: ['./**/*.php']
      }),
      new MiniCssExtractPlugin({
         filename: '[name]~[contenthash].css'
      }),
      new WebpackManifestPlugin({ fileName: 'webpack-manifest.json' })
   ],
   module: {
      rules: [
         {
            test: /\.(m|c)?js$/,
            exclude: /(node_modules)/,
            use: 'swc-loader'
         },
         {
            test: /\.(c|sc|sa)ss$/i,
            use: [
               MiniCssExtractPlugin.loader,
               {
                  loader: 'css-loader',
                  options: {
                     importLoaders: 1
                  }
               },
               'postcss-loader',
               'sass-loader'
            ]
         }
      ]
   },
   optimization: {
      moduleIds: 'deterministic',
      runtimeChunk: 'single',
      splitChunks: {
         cacheGroups: {
            vendor: {
               test: /[\\/]node_modules[\\/]/,
               name: 'vendors',
               chunks: 'all'
            }
         }
      }
   }
}).then(() => {
   jsonfile.readFile(mixManifest, (err, obj) => {
      const hashRegex = /\~(.+)\.(.+)$/g
      const newManifest = {}
      for (const [key, value] of Object.entries(obj)) {
         newManifest[key.replace(hashRegex, '.$2')] = value
      }
      jsonfile.writeFile(mixManifest, newManifest, { spaces: 3 }, err => {
         if (err) console.error(err)
      })
   })
})

mix.options({
   hmrOptions: {
      host: 'localhost',
      port: 3000
   }
})

// mix.version()
