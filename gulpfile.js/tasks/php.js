var config       = require('../config')
if(!config.tasks.php) return

var browserSync  = require('browser-sync')
var gulp         = require('gulp')
var path         = require('path')

var paths = {
  // The php folder contains dashboard stuff so wilcard it
  src: path.join(config.root.src, config.tasks.php.src, '/**/*.*'),
  dest: path.join(config.root.dest, config.tasks.php.dest)
}

var phpTask = function() {
  return gulp.src(paths.src)
    .pipe(gulp.dest(paths.dest))
    .pipe(browserSync.stream())
    // .on('end', browserSync.reload)
}

gulp.task('php', phpTask)
module.exports = phpTask
