var config       = require('../config')
if(!config.tasks.acf) return

var browserSync  = require('browser-sync')
var gulp         = require('gulp')
var path         = require('path')

var paths = {
  src: path.join(config.root.src, config.tasks.acf.src, '/*.*'),
  dest: path.join(config.root.dest, config.tasks.acf.dest)
}

var acfTask = function() {
  return gulp.src(paths.src)
    .pipe(gulp.dest(paths.dest))
    .pipe(browserSync.stream())
}

gulp.task('acf', acfTask)
module.exports = acfTask
