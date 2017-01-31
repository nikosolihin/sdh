var config    = require('../../config')
var gulp      = require('gulp')
var path      = require('path')
var rev       = require('gulp-rev')
var revNapkin = require('gulp-rev-napkin')

// 4) Rev and compress CSS and JS files (this is done after assets, so that if a
//    referenced asset hash changes, the parent hash will change as well

// Don't rev Wordpress style.css and screenshot.png
var languages = '!' + path.join(config.root.dest,'languages/**')
var ignoreWP = '!' + path.join(config.root.dest,'style.css')
var dashboard = '!' + path.join(config.root.dest,'dashboard/**')
var ignoreScreenshot = '!' + path.join(config.root.dest,'screenshot.png')

gulp.task('rev-css', function(){
  return gulp.src([path.join(config.root.dest,'/**/*.css'), languages, ignoreWP, dashboard, ignoreScreenshot])
    .pipe(rev())
    .pipe(gulp.dest(config.root.dest))
    .pipe(revNapkin({verbose: false}))
    .pipe(rev.manifest(path.join(config.root.dest, 'rev-manifest.json'), {merge: true}))
    .pipe(gulp.dest(''))
})
