var path = require('path');
// const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = [
    {
        mode: 'production',
        entry: './public/resources/admin/assets/js/common/listing.js',
        output: {
            filename: "listing.js",
            path: path.resolve(__dirname, 'public/js')
        }
    }
]

// module.exports = {
//     mode: 'production',
//     entry: [
//       './resources/assets/desktop/sass/pages/block-list.sass'
//     ],
//     module: {
//       rules: [
//         {
//           test: /\.(sa|sc)ss$/,
//           use: [
//             MiniCssExtractPlugin.loader,
//             'css-loader',
//             'sass-loader'
//           ]
//         },
//       ]
//     },
//     output: {
//       path: path.resolve(__dirname, "resources/assets") // this is the default value
//     },
//     plugins: [
//       new MiniCssExtractPlugin({
//             filename: "haha.css"
//       })
//     ]
//   };
