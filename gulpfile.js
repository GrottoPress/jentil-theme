'use strict'

const { src, dest, watch, series, parallel } = require('gulp')

const uglify = require('gulp-uglify')
const rename = require('gulp-rename')
const rtlcss = require('gulp-rtlcss')
const sass = require('gulp-sass')
const sourcemaps = require('gulp-sourcemaps')
const typescript = require('gulp-typescript')
const postcss = require('gulp-postcss')
const cssnano = require('cssnano')
const focus = require('postcss-focus')
const newer = require('gulp-newer')
const sh = require('shelljs')

const tsConfig = require('./tsconfig.json')

const paths = {
    styles: {
        src: ['./assets/styles/**/*.scss'],
        dest: './dist/styles'
    },
    scripts: {
        src: tsConfig.include,
        dest: tsConfig.compilerOptions.outDir
    },
    vendor: {
        dest: {
            dist: './dist/vendor',
            assets: './assets/vendor'
        }
    }
}

function _scripts(done)
{
    src(paths.scripts.src)
        .pipe(newer(paths.scripts.dest))
        .pipe(sourcemaps.init())
        .pipe(typescript(tsConfig.compilerOptions))
        .pipe(uglify())
        .pipe(rename({'suffix': '.min'}))
        .pipe(sourcemaps.write())
        .pipe(dest(paths.scripts.dest))

    done()
}

function _styles(done)
{
    src(paths.styles.src)
        .pipe(newer(paths.styles.dest))
        .pipe(sourcemaps.init())
        .pipe(sass().on('error', sass.logError))
        .pipe(postcss([focus(), cssnano()]))
        .pipe(rename({'suffix': '.min'}))
        .pipe(sourcemaps.write())
        .pipe(dest(paths.styles.dest))
        .pipe(rtlcss())
        .pipe(rename(path =>
            path.basename = path.basename.replace('.min', '-rtl.min')
        ))
        .pipe(dest(paths.styles.dest))

    done()
}

function _watch()
{
    watch(paths.scripts.src, {ignoreInitial: false}, _scripts)
    watch(paths.styles.src, {ignoreInitial: false}, _styles)
}

function _clean(done)
{
    sh.rm(
        '-rf',
        paths.styles.dest,
        paths.scripts.dest,
        paths.vendor.dest.dist,
        paths.vendor.dest.assets
    )

    done()
}

function _chmod(done)
{
    sh.chmod('-R', 'a+x', './bin', './vendor/bin', './node_modules/.bin')

    done()
}

exports.styles = _styles
exports.scripts = _scripts
exports.watch = _watch
exports.clean = _clean
exports.chmod = _chmod

exports.default = series(parallel(_styles, _scripts), _watch)
