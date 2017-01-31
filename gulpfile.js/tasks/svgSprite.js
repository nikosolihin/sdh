var config      = require('../config')
if(!config.tasks.svgSprite) return

var browserSync = require('browser-sync')
var gulp        = require('gulp')
var imagemin    = require('gulp-imagemin')
var svgstore    = require('gulp-svgstore')
var inject      = require('gulp-inject')
var cheerio     = require('gulp-cheerio')
var path        = require('path')

var svgSpriteTask = function() {

  var settings = {
    src: path.join(config.root.src, config.tasks.svgSprite.src, '/*.svg'),
    injectDest: path.join(config.root.src, config.tasks.twig.src,  config.tasks.svgSprite.dest, config.tasks.svgSprite.injectTo),
    dest: path.join(config.root.src, config.tasks.twig.src, config.tasks.svgSprite.dest)
  }

  var svgs = gulp.src(settings.src)
    .pipe(imagemin())
    .pipe(cheerio({
      run: function ($) {
        $('[fill]').removeAttr('fill')
        $('style').remove()
      },
      parserOptions: { xmlMode: true }
    }))
    .pipe(svgstore({ inlineSvg: true }))

  function fileContents (filePath, file) {
    return file.contents.toString()
  }

  return gulp.src(settings.injectDest)
    .pipe(inject(svgs, { transform: fileContents }))
    .pipe(gulp.dest(settings.dest))
    .pipe(browserSync.stream())
}

gulp.task('svgSprite', svgSpriteTask)
module.exports = svgSpriteTask
