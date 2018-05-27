var path = require('path');
var UglifyJsPlugin = require('uglifyjs-webpack-plugin')

module.exports = [{
   entry: './includes/js/pessoa.js',
   mode: 'production',
   output: {
      filename: 'pessoa.min.js',
      path: path.resolve(__dirname, './includes/dist')
   },
   plugins: [
      new UglifyJsPlugin({
         test: /\.js($|\?)/i
      })
   ]
}];