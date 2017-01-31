var config       = require('../config')
if(!config.tasks.languages) return

var browserSync  = require('browser-sync')
var gulp         = require('gulp')
var path         = require('path')

var paths = {
  src: path.join(config.root.src, config.tasks.languages.src, '/**/*.*'),
  dest: path.join(config.root.dest, config.tasks.languages.dest)
}

var languagesTask = function() {
  return gulp.src(paths.src)
    .pipe(gulp.dest(paths.dest))
    .pipe(browserSync.stream())
}

gulp.task('languages', languagesTask)
module.exports = languagesTask
