const path = require('path');
const HtmlWebpackPlugin = require('html-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const MediaQueryPlugin = require('./lib/media-query-plugin');
const WebpackAssetsManifest = require('webpack-assets-manifest');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const HtmlWebpackSkipAssetsPlugin =
  require('html-webpack-skip-assets-plugin').HtmlWebpackSkipAssetsPlugin;
const TerserPlugin = require('terser-webpack-plugin');
const RemoveEmptyScriptsPlugin = require('webpack-remove-empty-scripts');
const CriticalCssPlugin = require('./lib/critical-css-webpack-plugin');
const FontPreloadPlugin = require('webpack-font-preload-plugin');
const CopyPlugin = require('copy-webpack-plugin');

const {
  queryData,
  entryData,
  wwwDir,
  projectname,
  sassLoader,
  sassCriticalLoader,
  imageLoader,
  fontLoader,
  jsLoader,
  cssLoader,
  aliasData,
} = require('./webpack.common');

require('dotenv').config();

module.exports = (env, argv) => {
  if (env != undefined && env.deploy) {
    process.env = {
      wwwDir: wwwDir,
      projectname: projectname,
    };

    var templatePath = process.env.wwwDir;
  } else {
    var templatePath = process.env.wwwDir + '/' + process.env.projectname;
  }

  var config = {
    entry: entryData,
    plugins: [
      new HtmlWebpackPlugin({
        inject: false,
        filename: templatePath + '/wp-content/themes/' + process.env.projectname + '/header.php',
        template: './template/header.php',
        excludeAssets: [/.*./],
        realfavicons: true,
        minify: false,
      }),
      new HtmlWebpackSkipAssetsPlugin(),

      new CopyPlugin({
        patterns: [
          {
            from: path.resolve(__dirname, './template'),
            to: templatePath + '/wp-content/themes/' + process.env.projectname,
            globOptions: {
              ignore: [path.resolve(__dirname, './template/header.php')],
            },
          },
          {
            from: path.resolve(__dirname, './vendor'),
            to: templatePath + '/wp-content/themes/' + process.env.projectname + '/vendor',
          },
        ],
      }),

      new MediaQueryPlugin({
        include: true,
        queries: queryData,
        outputFileName: ({ path, queryname }) => {
          const pathParts = path
            .replace(__dirname + '/src/entry/', '')
            .replace(/\//g, '.')
            .replace('.scss', '');

          return `${pathParts}-${queryname}`;
        },
      }),
      new WebpackAssetsManifest({
        entrypoints: true,
        publicPath: '/wp-content/themes/' + process.env.projectname + '/',
      }),
      new RemoveEmptyScriptsPlugin(),

      new FontPreloadPlugin({
        index: 'header.php',
        extensions: ['woff2'],
        replaceCallback: ({ indexSource, linksAsString }) => {
          return indexSource.replace('{{{fontPreload}}}', linksAsString);
        },
      }),
    ],
    output: {
      path: templatePath + '/wp-content/themes/' + process.env.projectname + '/',
      publicPath: '/wp-content/themes/' + process.env.projectname + '/',
      clean: true,
    },
    module: {
      rules: [sassLoader, cssLoader, jsLoader, imageLoader, fontLoader, sassCriticalLoader],
    },
    optimization: {
      runtimeChunk: 'single',
      splitChunks: {
        chunks: 'all',
        maxInitialRequests: Infinity,
        minSize: 0,
        cacheGroups: {
          vendor: {
            test: /[\\/]node_modules[\\/]/,
            name(module) {
              // get the name. E.g. node_modules/packageName/not/this/part.js
              // or node_modules/packageName
              const packageName = module.context.match(/[\\/]node_modules[\\/](.*?)([\\/]|$)/)[1];

              // npm package names are URL-safe, but some servers don't like @ symbols
              return `vendor.${packageName.replace('@', '')}`;
            },
          },
        },
      },
    },
    resolve: {
      alias: aliasData,
    },
  };

  let name = '[name]';

  if (argv.mode === 'development') {
    config.devtool = 'source-map';

    if (env != undefined && env.deploy) {
      name = '[name].[contenthash]';
    }

    config.plugins.push(
      new BrowserSyncPlugin({
        proxy: process.env.projectname + '.local',
        notify: true,
        files: ['**/*.{php,html,twig}', '**/*.{jpg,png,gif,svg}'],
        reloadDelay: 500,
      }),
      new MiniCssExtractPlugin({
        filename: 'css/' + name + '.css',
      })
    );
  }

  if (argv.mode === 'production') {
    name = '[contenthash]';

    config.optimization.minimize = true;
    config.optimization.minimizer = [
      new TerserPlugin({
        terserOptions: {
          compress: {
            drop_console: true,
          },
        },
      }),
    ];

    config.plugins.push(
      new MiniCssExtractPlugin({
        filename: 'css/' + name + '.css',
      }),
      new CriticalCssPlugin({
        base: templatePath + '/wp-content/themes/' + process.env.projectname + '/',
        src: './template/header.php',
        target: { css: 'css/critical.css', uncritical: 'css/app-uncritical.css' },
      })
    );
  }

  config.output.filename = 'js/' + name + '.js';
  config.output.chunkFilename = 'js/' + name + '.js';

  return config;
};
