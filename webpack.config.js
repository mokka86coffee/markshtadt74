let path = require('path');
const ExtractTextPlugin = require("extract-text-webpack-plugin");
const autoprefixer = require('autoprefixer');
const csswring = require("csswring");

let conf = {
     entry: ['babel-polyfill','./src/index.js'],
     output: {
          path: path.resolve(__dirname, './dist'),
          filename: 'js.js',
          publicPath: ''
     },
     devServer: {
     	overlay: true,
        contentBase: path.join(__dirname, 'dist')
     },
     module: {
     	rules: [
     	   {
     	   	  test: /\.(js|jsx)$/,
     	   	  exclude: '/node_modules/',
	          loader: "babel-loader",   // определяем загрузчик
	                options:{
	                    presets:["@babel/preset-env",{
                            'plugins': ['@babel/plugin-proposal-class-properties']}]    // используемые плагины
	                }
           },
            {
              test: /\.(png|jpg|gif)$/,
              exclude: '/node_modules/',
              use: [
                {
                  loader: 'file-loader',
                  options: {
                    name: '[name].[ext]',
                    context: '',
                      outputPath: 'img/'
                  }
                }
              ]
             },
             {
                 test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/,
                 exclude: '/node_modules/',
                 use: [{
                     loader: 'file-loader',
                     options: {
                         name: '[name].[ext]',
                         outputPath: 'fonts/'
                     }
                 }]
             },
           {
              test: /\.scss$/,
              exclude: '/node_modules/',

              use: ExtractTextPlugin.extract({
                 fallback: "style-loader",
                 use: [
                    {
                        loader: 'css-loader',
                        options: {
                            sourceMap: true
                        }
                    },
                    {
                        loader: 'postcss-loader',
                        options: {
                            plugins: [
                                autoprefixer(),
                                csswring({removeAllComments: true,preserveHacks: true})
                            ],
                            sourceMap: true
                        }
                    },
                    {
                        loader: 'sass-loader',
                        options: {
                            sourceMap: true
                        }
                    }
                  ]
              })
           }
     	]
      },
  	  plugins: [
  	    new ExtractTextPlugin("styles.css")
  	  ]
};

module.exports = (env, options) => {
	let production = options.mode === "production";
    conf.devtool = production
                    ? 'source-map'
                    : 'eval-sourcemap'; 
	return conf;
}