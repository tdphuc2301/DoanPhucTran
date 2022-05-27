const mix = require('laravel-mix');
let fs = require('fs');
const path = require("path");
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

 /**
 * @param directory
 * @returns {[]}
 */
function getFiles(directory) {
    var files = [];
    fs.readdirSync(directory).forEach(file => {
        const absolute = path.join(directory, file);
        if (fs.statSync(absolute).isDirectory()) {
            if (files.length > 0) {
                files = files.concat(getFiles(absolute));
            } else {
                files = getFiles(absolute);
            }
        } else {
            files.push(absolute);
        }
    });
    return files;
}

function compileFile(src, des){
    getFiles(src).forEach(filePath => {
        if (filePath.includes(".js")) {
            mix.js(filePath, des).version();
        }
        if (filePath.includes(".css") && !filePath.includes("_") && !filePath.includes(".map")) {
            mix.styles(filePath, filePath.replace(src, des + '/')).version();
        }
    });
}

let arrDir = [
    ['resources/js/admin' , 'public/js/admin']
];

arrDir.forEach(el => {
    compileFile(el[0],el[1]);
});

mix.disableNotifications();