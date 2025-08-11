let mix = require('laravel-mix');
const fs = require('fs');
const path = require('path');
mix.disableNotifications();

const themeInfo = require('./theme.json');

// Thêm function để xóa thư mục và nội dung bên trong
function cleanDirectory(directory) {
    if (fs.existsSync(directory)) {
        fs.readdirSync(directory).forEach((file) => {
            const curPath = path.join(directory, file);
            if (fs.lstatSync(curPath).isDirectory()) {
                cleanDirectory(curPath);
                fs.rmdirSync(curPath);
            } else {
                fs.unlinkSync(curPath);
            }
        });
    }
}

// Function để copy với clean trước
function copyWithClean(src, dest) {
    cleanDirectory(dest);
    mix.copy(src, dest);
}

mix.options({
    processCssUrls: false
});

if (mix.inProduction()) {
    mix.version();
    const pathAssetCompile = "./assets/";
    mix.setPublicPath(pathAssetCompile);

    // Copy với clean trước
    copyWithClean('resources/fonts', pathAssetCompile + '/fonts');
    copyWithClean('resources/images', pathAssetCompile + '/images');
    copyWithClean('resources/js/plugins', pathAssetCompile + '/js/plugins');

    mix.sass('resources/sass/main.scss', '/css/main.css');
    mix.js('resources/js/app.js', '/app').vue({ version: 2 });
    mix.scripts(['resources/js/script.js'], pathAssetCompile + '/js/script.js');
    mix.scripts(['resources/js/dz.ajax.js'], pathAssetCompile + '/js/dz.ajax.js');
    mix.scripts(['resources/js/dz.carousel.min.js'], pathAssetCompile + '/js/dz.carousel.min.js');
    mix.scripts(['resources/js/jquery.lazy.min.js'], pathAssetCompile + '/js/jquery.lazy.min.js');
    mix.scripts(['resources/js/jquery.min.js'], pathAssetCompile + '/js/jquery.min.js');
    mix.scripts(['resources/js/rev.slider.js'], pathAssetCompile + '/js/rev.slider.js');
} else {
    const pathPublicTheme = 'public/themes/' + themeInfo.name.toLowerCase();
    mix.sourceMaps();

    // Copy với clean trước
    copyWithClean('resources/fonts', "../../" + pathPublicTheme + '/fonts');
    copyWithClean('resources/images', "../../" + pathPublicTheme + '/images');
    copyWithClean('resources/js/plugins', "../../" + pathPublicTheme + '/js/plugins');

    mix.setPublicPath('../../')
        .sass('resources/sass/main.scss', pathPublicTheme + '/css/main.css')
        .js('resources/js/app.js', pathPublicTheme + '/app').vue({ version: 2 });

    mix.scripts(['resources/js/script.js'], "../../" + pathPublicTheme + '/js/script.js');
    mix.scripts(['resources/js/dz.ajax.js'], "../../" + pathPublicTheme + '/js/dz.ajax.js');
    mix.scripts(['resources/js/dz.carousel.min.js'], "../../" + pathPublicTheme + '/js/dz.carousel.min.js');
    mix.scripts(['resources/js/jquery.lazy.min.js'], "../../" + pathPublicTheme + '/js/jquery.lazy.min.js');
    mix.scripts(['resources/js/jquery.min.js'], "../../" + pathPublicTheme + '/js/jquery.min.js');
    mix.scripts(['resources/js/rev.slider.js'], "../../" + pathPublicTheme + '/js/rev.slider.js');
}
