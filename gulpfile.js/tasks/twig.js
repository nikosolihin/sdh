var config       = require('../config')
if(!config.tasks.twig) return

var browserSync  = require('browser-sync')
var gulp         = require('gulp')
var path         = require('path')

var paths = {
  src: path.join(config.root.src, config.tasks.twig.src, '/**/*.twig'),
  dest: path.join(config.root.dest, config.tasks.twig.dest)
}

var twigTask = function() {
  return gulp.src(paths.src)
    .pipe(gulp.dest(paths.dest))
    .on('end', browserSync.reload)
}

gulp.task('twig', twigTask)
module.exports = twigTask
