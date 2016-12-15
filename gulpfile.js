/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * Author: Julien Rondeau
 */

var gulp = require('gulp');

var sass = require('gulp-sass');
var autoprefixer = require('gulp-autoprefixer');
var sourcemaps = require('gulp-sourcemaps');
var plumber = require('gulp-plumber');
var notify = require('gulp-notify');
var browserSync = require('browser-sync');
var spritesmith = require('gulp.spritesmith');
var gulpIf = require('gulp-if');
var runSequence = require('run-sequence');
var jshint = require('gulp-jshint');
var jscs = require('gulp-jscs');
var scssLint = require('gulp-scss-lint');
var cleanCss = require('gulp-clean-css');
var imagemin = require('gulp-imagemin');

function customPlumber () {
  return plumber({
    errorHandler: notify.onError("Error: <%= error.message %>")
  });
}

gulp.task('default', function (callback) {
  runSequence(
    'sprites',
    'sass',
    ['browserSync', 'watch'],
    callback
  );
});

gulp.task('watch', ['browserSync', 'sass'], function () {
  gulp.watch('scss/**/*.scss', ['sass']);
  gulp.watch('js/**/*.js', browserSync.reload); // or add ['watch-js'] instead of browserSync.reload to watch lint:js
  gulp.watch('*.html', browserSync.reload);
});

gulp.task('sass', function() {
  return gulp.src('scss/**/*.scss')
    .pipe(customPlumber())
    .pipe(sourcemaps.init())
    .pipe(sass({
      outputStyle: 'expanded'
    }))
    .pipe(autoprefixer())
    .pipe(sourcemaps.write())
    .pipe(gulp.dest('./'))
    .pipe(browserSync.reload({
      stream: true
    }));
});

gulp.task('sass-prod', function() {
  return gulp.src('scss/**/*.scss')
    .pipe(customPlumber())
    .pipe(sass())
    .pipe(autoprefixer())
    .pipe(cleanCss())
    .pipe(gulp.dest('./'))
    .pipe(browserSync.reload({
      stream: true
    }));
});

gulp.task('browserSync', function() {
     browserSync({
    port: '8888',
    proxy: 'localhost:8888/_rj-wordpress',
//      server: {
//      baseDir: 'www/'
//    },
    notify: false,
    open: true
    
  });
});

gulp.task('sprites', function() {
  gulp.src('img/sprites/**/*')
    .pipe(spritesmith( {
      cssName: '_sprites.scss',
      imgName: 'sprites.png',
      imgPath: 'img/sprites.png',
//      retinaSrcFilter: 'img/sprites/*@2x.png',
//      retinaImgName: 'sprites@2x.png',
//      retinaImgPath: 'img/sprites@2x.png',
      padding: 10
    }))
    .pipe(gulpIf('*.png', gulp.dest('img/')))
    .pipe(gulpIf('*.scss', gulp.dest('scss/base/')));
});

gulp.task('images', function() {
  return gulp.src('app/images/**/*.+(png|jpg|jpeg|gif|svg)')
    .pipe(imagemin())
    .pipe(gulp.dest('dist/images'));
});