var gulp = require('gulp'),
    sass = require('gulp-sass'),
    uglify = require('gulp-uglify'),
    uglifycss = require('gulp-uglifycss'),
    sourcemaps = require('gulp-sourcemaps'),
    concat = require('gulp-concat'),
    notify = require('gulp-notify'),
    run_sequence = require('run-sequence'),
    argv = require('yargs').argv,
    del = require('del'),
    gulpif = require('gulp-if'),
    env = require('node-env-file'),
    Color = require("color"),
    rename = require("gulp-rename"),
    yaml = require('gulp-yaml'),
    chalk = require('chalk'),
    fs = require('fs');

//
//  Configuration
//
env('./.env');

// Base config paths
var config = {
    node: 'node_modules',
    bower: 'bower_components',
    assets: 'resources/assets',
    yaml: 'resources/config/dist',
    public: 'public',
};

//
//  Helper Functions
//
function isEnvironment(str) {
    str = str instanceof Array ? str : [str];

    for (var i in str) {
        if (str[i] === process.env.APP_ENV) { return true; }
    }

    return false;
}

function isNotEnvironment(str) {
    str = str instanceof Array ? str : [str];

    for (var i in str) {
        if (str[i] === process.env.APP_ENV) { return false; }
    }

    return true;
}

//
//  Images
//
gulp.task('img', function(){
    return gulp.src([
        config.assets + '/img/**/*.{png,jpg,jpeg,ico,svg,bmp}',
        config.bower + '/jquery-ui/themes/base/images/*',
    ]).pipe(gulp.dest(config.public + '/img'));
});

//
//  Sass
//
gulp.task('sass', function(){
    var src = [
        config.assets + '/sass/*.scss'
    ];

    if (argv.style) {
        src = config.assets + '/sass/style.scss';
    }

    return gulp.src(src, {base: config.assets + '/sass'})
        .pipe(sourcemaps.init())
        .pipe(sass({
            includePaths: [
                config.bower,
                config.assets + '/js/vendor',
            ]
        }).on('error', sass.logError))
        .pipe(sourcemaps.write('./'))
        .pipe(gulpif(isEnvironment(['production', 'staging']), uglifycss()))
        .pipe(gulp.dest(config.public + '/css'))
        .pipe(gulpif(isEnvironment('local'), notify({
            title: 'SASS',
            message: 'Compiled <%= file.relative %>'
        })));
});

//
//  Js Aggregated Vendors
//
gulp.task('js_vendor', function(){
    var queue = [
        config.node + '/jquery/dist/jquery.min.js'
    ];

    return gulp.src(queue)
        .pipe(sourcemaps.init())
        .pipe(gulpif(isEnvironment(['production', 'staging']), uglify({
            compress: {
                drop_console: true
            }
        })))
        .pipe(concat('app_vendor.js'))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(config.public + '/js'))
        .pipe(gulpif(isEnvironment('local'), notify({
            title: 'JS',
            message: 'Compiled <%= file.relative %>'
        })));
});

//
//  Js
//
gulp.task('js', function(){
    return gulp.src([
            config.assets + '/js/single/google-map.js',
            config.assets + '/js/*.js',
        ])
        .pipe(sourcemaps.init())
        .pipe(gulpif(isEnvironment(['production', 'staging']), uglify({
            compress: {
                drop_console: true
            }
        })))
        .pipe(concat('app.js'))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(config.public + '/js'))
        .pipe(gulpif(isEnvironment('local'), notify({
            title: 'JS',
            message: 'Compiled <%= file.relative %>'
        })));
});

//
//  Default
//
gulp.task('default', function(callback) {
    process.stdout.write('\n');

    var envNote = ' > ENVIRONMENT: ' + process.env.APP_ENV + '\n';

    if (isEnvironment(['production', 'staging'])) {
        envNote = chalk.bold.red(envNote);
    }else {
        envNote = chalk.bold.cyan(envNote);
    }

    process.stdout.write(envNote);
    process.stdout.write('\n');
    
    run_sequence(
        // ['img'],
        ['js_vendor'],
        ['sass', 'js'],
        'clean',
        callback
    );
});

//
//  Watch Sass
//
gulp.task('watch_sass', function(callback){
    run_sequence('sass', 'clean', callback);
});

//
//  Watch Js
//
gulp.task('watch_js', function(callback){
    run_sequence('js', 'clean', callback);
});

//
//  Watch
//
gulp.task('watch', function(){
    gulp.watch(config.assets + '/sass/**/*.scss', ['watch_sass']);
    gulp.watch(config.assets + '/js/**/*.js', ['watch_js']);
});

//
//  Clean
//
gulp.task('clean', function(){
    return del([
        config.public + '/build/css/*.css', 
        config.public + '/build/js/*.js'
    ]);
});