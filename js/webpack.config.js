/**
 * External dependencies
 */
var ExtractTextPlugin = require("extract-text-webpack-plugin");

// Main CSS loader for everything but blocks..
var cssExtractEditorSCSS = new ExtractTextPlugin({
  filename: "./editor-style.css"
});

var cssExtractBlocksSCSS = new ExtractTextPlugin({
    filename: "./style.css"
});

// Configuration for the ExtractTextPlugin.
const extractConfig = {
	use: [
		{ loader: "raw-loader" },
	]
};

var scssConfig = {
    use: [
        {
            loader: 'css-loader'
        },
        {
            loader: 'sass-loader',
            options: {
                outputStyle: 'compressed'
            }
        }
    ]
};

var debug = process.env.NODE_ENV !== 'production';

var glob = require("glob");

var webpack = require( 'webpack' ),
	NODE_ENV = process.env.NODE_ENV || 'development';

const entryPointNames = [
	'blocks',
	'components',
	'date',
	'editor',
	'element',
	'i18n',
	'utils',
	'data',
];

const packageNames = [
	'hooks',
];

const externals = {
	react: 'React',
	'react-dom': 'ReactDOM',
	'react-dom/server': 'ReactDOMServer',
	tinymce: 'tinymce',
	moment: 'moment',
	jquery: 'jQuery',
};

[ ...entryPointNames, ...packageNames ].forEach( name => {
	externals[ `@wordpress/${ name }` ] = {
		this: [ 'wp', name ],
	};
} );


var webpackConfig = {
	entry: [ ...glob.sync("./src/*.js", {ignore: "node_modules"}) ],
	output: {
		path: __dirname,
		filename: 'pluginAPI.build.js',
	},
	externals,
	module: {
		loaders: [
			{
				test: /.js$/,
				loader: 'babel-loader',
				exclude: /node_modules/,
			},
			{
			  test: /editor-style\.scss$/,
			  use: cssExtractEditorSCSS.extract(scssConfig)
			},
			{
			  test: /block-style\.scss$/,
			  use: cssExtractBlocksSCSS.extract(scssConfig)
			},

		],
	},
	plugins: [
		new webpack.DefinePlugin( {
			'process.env.NODE_ENV': JSON.stringify( NODE_ENV )
		} ),
		cssExtractEditorSCSS,
		cssExtractBlocksSCSS
	]
};

if ( 'production' === NODE_ENV ) {
	webpackConfig.plugins.push( new webpack.optimize.UglifyJsPlugin() );
}

module.exports = webpackConfig;