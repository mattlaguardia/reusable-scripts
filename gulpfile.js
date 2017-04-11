/**
 * Project Setup
 * Setting up variables for project name and directories
*/
// NOTE: Have not included .env file this wont work how it is currently set up
// Load Plugins
var gulp = require('gulp'),
    gutil = require('gulp-util'),
    browserSync = require('browser-sync'), // Asynchronous browser loading on .scss file changes
    sass = require('gulp-sass'),
    watch = require('gulp-watch'),
    notify = require('gulp-notify'),
    url = 'http://localhost/clients/jolley',
    ftp = require ('gulp-ftp'),
    source = './wp-content/themes/catroos/', // Your main project assets and naming 'source' instead of 'src' to avoid confusion with gulp.src
    plumber = require('gulp-plumber'), // Helps prevent stream crashing on errors
    themeDir = '/wp-content/themes/catroos/',
    liveDir = 'jolley.roostertest3.com'
		ftpUrl = process.env.ftpUrl,
		ftpUser = process.env.ftpUser,
		ftpPass = process.env.ftpPass,
		ftpPort = process.env.ftpPort;


/**
 * Browser Sync
 * The 'cherry on top!' Asynchronous browser syncing of assets across multiple devices!! Watches for changes to js, image and php files
 * Although, I think this is redundant, since we have a watch task that does this already.
*/
gulp.task('browser-sync', function() {
    var files = [
        '**/*.php',
        '**/*.{png,jpg,gif}',
        '**/*.{css,scss}',
        '**/*.js',
        '!node_modules/**/*.*' //skips the nodes_modules folder
    ];
    browserSync.init(files, {
        proxy: url
    });
});

// sass task
gulp.task('sass', function () {
  gulp.src([source+'sass/**/*.scss'])
    .pipe(plumber())
    .pipe(sass({
        noCache: true,
        errLogToConsole: true,
        style: "expanded",
        outputSTyle: 'nested',
        lineNumbers: true
    }))

    .pipe(ftp({
            host: ftpUrl,
						user: ftpUser,
            pass: ftpPass,
            port: ftpPort,
            remotePath: liveDir + themeDir
        }))
    .pipe(plumber.stop())
    .pipe(gulp.dest(source))
    .pipe(notify({
          message: "You just got Sassy!"
    }));;
});


gulp.task('watch', function() {
      // watch scss files
      gulp.watch(source+'sass/**/*.scss', function() {
        gulp.run('sass');
      });

    });


/**
 * Build task that moves essential theme files for production-ready sites
 *
 * First, we're moving PHP files to the build folder for redistribution. Also we're excluding the library, build and src directories. Why?
 * Excluding build prevents recursive copying and Inception levels of bullshit. We exclude library because there are certain non-php files
 * there that need to get moved as well. So I put the library directory into its own task. Excluding src because, well, we don't want to
 * distribute uniminified/unoptimized files. And, uh, grabbing screenshot.png cause I'm janky like that!
*/


gulp.task('default', ['sass', 'browser-sync', 'watch']);
