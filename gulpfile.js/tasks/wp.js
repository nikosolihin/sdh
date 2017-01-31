var config       = require('../config')
if(!config.tasks.wp) return

var gulp         = require('gulp')
var path         = require('path')

var paths = {
  src: path.join(config.root.src, '/'),
  dest: path.join(config.root.dest, '/')
}

var wpTask = function() {
  return gulp.src([paths.src+config.tasks.wp.files[0],paths.src+config.tasks.wp.files[1]])
    .pipe(gulp.dest(paths.dest))
}

gulp.task('wp', wpTask)
module.exports = wpTask
