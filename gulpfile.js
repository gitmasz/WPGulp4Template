import gulp from 'gulp'
import dartSass from 'sass'
import gulpSass from 'gulp-sass'
import sourcemaps from 'gulp-sourcemaps'
import css from 'gulp-clean-css'
import autoprefixer from 'gulp-autoprefixer'
import babel from 'gulp-babel'
import uglify from 'gulp-uglify'
import imagemin from 'gulp-imagemin'
import webp from 'gulp-webp'
import cache from 'gulp-cache'
import concat from 'gulp-concat'
import rename from 'gulp-rename'
import plumber from 'gulp-plumber'
import notifier from 'gulp-notifier'
import browserSync from 'browser-sync'
import zip from 'gulp-zip'
const sass = gulpSass(dartSass)
const { dest } = gulp

const dateObj = new Date()
const year = dateObj.getUTCFullYear()
const month = dateObj.getUTCMonth() + 1
const day = dateObj.getUTCDate()
const zipVersion = '-' + year + '_' + month + '_' + day

const filesPath = {
  sass: ['./src/sass/main.scss'],
  no_map_sass: ['./src/sass/wp-login.scss', './src/sass/preloader.scss'],
  js: ['./src/js/**/*.js'],
  no_map_js: ['./src/js/wp-login.js'],
  img: ['./src/img/**/*.+(gif|svg)'],
  webp: ['./src/img/**/*.+(png|jpg)']
}

export function sassTask (done) {
  gulp
    .src(filesPath.sass)
    .pipe(plumber({ errorHandler: notifier.error }))
    .pipe(sourcemaps.init())
    .pipe(sass())
    .pipe(autoprefixer())
    .pipe(css({ compatibility: 'ie8' }))
    .pipe(sourcemaps.write('.'))
    .pipe(
      rename(function (path) {
        if (!path.extname.endsWith('.map')) {
          path.basename += '.min'
        }
      })
    )
    .pipe(dest('./css'))
  gulp
    .src(filesPath.no_map_sass)
    .pipe(plumber({ errorHandler: notifier.error }))
    .pipe(sass())
    .pipe(autoprefixer())
    .pipe(css({ compatibility: 'ie8' }))
    .pipe(
      rename(function (path) {
        path.basename += '.min'
      })
    )
    .pipe(dest('./css'))
  done()
}

export function jsTask (done) {
  gulp
    .src(filesPath.js)
    .pipe(plumber({ errorHandler: notifier.error }))
    .pipe(sourcemaps.init())
    .pipe(babel({
      presets: ['@babel/env']
    }))
    .pipe(concat('main.js'))
    .pipe(uglify())
    .pipe(sourcemaps.write('.'))
    .pipe(
      rename(function (path) {
        if (!path.extname.endsWith('.map')) {
          path.basename += '.min'
        }
      })
    )
    .pipe(dest('./js'))
  gulp
    .src(filesPath.no_map_js)
    .pipe(plumber({ errorHandler: notifier.error }))
    .pipe(babel({
      presets: ['@babel/env']
    }))
    .pipe(uglify())
    .pipe(
      rename(function (path) {
        path.basename += '.min'
      })
    )
    .pipe(dest('./js'))
  done()
}

export function imgTask (done) {
  gulp
    .src(filesPath.img)
    .pipe(cache(imagemin()))
    .pipe(dest('./img'))
  gulp
    .src(filesPath.webp)
    .pipe(cache(webp()))
    .pipe(dest('./img'))
  done()
}

export function clearCache (done) {
  return cache.clearAll(done)
}

export function watch () {
  browserSync.init({
    proxy: 'http://localhost/WordPress/',
    browser: 'firefox'
  })
  gulp.watch(filesPath.sass, { usePolling: true }, gulp.series(sassTask)).on('change', browserSync.reload)
  gulp.watch(filesPath.no_map_sass, { usePolling: true }, gulp.series(sassTask)).on('change', browserSync.reload)
  gulp.watch(filesPath.js, { usePolling: true }, gulp.series(jsTask)).on('change', browserSync.reload)
  gulp.watch(filesPath.no_map_js, { usePolling: true }, gulp.series(jsTask)).on('change', browserSync.reload)
  gulp.watch(filesPath.img, { usePolling: true }, gulp.series(imgTask)).on('change', browserSync.reload)
  gulp.watch(filesPath.webp, { usePolling: true }, gulp.series(imgTask)).on('change', browserSync.reload)
}

export function zipTask (done) {
  gulp.src([
    './**/*',
    '!./.vscode/**/*',
    '!./.vscode',
    '!./node_modules/**/*',
    '!./node_modules',
    '!./src/**/*',
    '!./src',
    '!./.eslintrc.json',
    '!./.gitignore',
    '!./composer.json',
    '!./gulpfile.js',
    '!./LICENSE',
    '!./package-lock.json',
    '!./package.json',
    '!./README.md',
    '!./*.zip'
  ])
    .pipe(zip('ftp-package' + zipVersion + '.zip'))
    .pipe(dest('./'))
  done()
}
