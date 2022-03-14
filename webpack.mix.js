const BrowserSyncPlugin = require('browser-sync-webpack-plugin')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const path = require('path')
const mix = require('laravel-mix')
const tailwindcss = require('tailwindcss')
const autoprefixer = require('autoprefixer')
const cssnano = require('cssnano')

const mode = process.env.NODE_ENV
const dev = mode === 'development'

mix.webpackConfig({
   entry: './resources/js/app.js',
   output: {
      filename: 'js/[name].bundle.js',
      path: path.resolve(__dirname, 'public')
   },
   plugins: [
      new BrowserSyncPlugin({
         proxy: 'localhost:8000',
         port: 3000,
         host: 'localhost',
         files: ['./**/*.php']
      }),
      new MiniCssExtractPlugin({
         filename: 'css/main.css'
      })
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
               {
                  loader: 'postcss-loader',
                  options: {
                     postcssOptions: {
                        config: path.resolve(__dirname, './postcss.config.js')
                     }
                  }
               },
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
})

mix.options({
   hmrOptions: {
      host: 'localhost',
      port: 3000
   }
})

mix.version()
