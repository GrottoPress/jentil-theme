let mix = require('laravel-mix')
let path = require('path')
let rtlcss = require('rtlcss')

let bsConfig = require('./bs-config')

mix.setResourceRoot('../')
mix.setPublicPath(path.resolve('./'))

mix.disableNotifications()

mix.webpackConfig({
    watchOptions: { ignored: [
        path.posix.resolve(__dirname, './node_modules'),
        path.posix.resolve(__dirname, './dist'),
    ] }
})

mix.ts('assets/js/core.ts', 'dist/js').sourceMaps()
mix.ts('assets/js/customize-preview.ts', 'dist/js').sourceMaps()

mix.postCss('assets/css/core.css', 'dist/css').sourceMaps()
mix.postCss('assets/css/editor.css', 'dist/css').sourceMaps()

mix.postCss(
    'assets/css/core-rtl.css',
    'dist/css',
    [rtlcss()]
).sourceMaps()

mix.postCss(
    'assets/css/editor-rtl.css',
    'dist/css',
    [rtlcss()]
).sourceMaps()

mix.browserSync(bsConfig)

if (mix.inProduction()) {
    mix.version()
} else {
    Mix.manifest.refresh = _ => void 0
}
