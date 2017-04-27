var gulp =require('gulp'),
    concat = require('gulp-concat'),
    uglify =require('gulp-uglify'),
    minifyCss = require('gulp-minify-css'),
    rename =require('gulp-rename'),
    //imagemin = require('gulp-imagemin'),
    sass = require('gulp-sass'),
    gulpCopy = require('gulp-copy');


//var sourceFiles =

//gulp.task('default',function(){
//    return gulp.src(['node_modules/font-awesome/fonts','resources/assets/fonts'])
//        .pipe(gulpCopy('public/assets/fonts'))
//})

//编译sass打包
gulp.task('blog-css',function(){
    return gulp.src(['resources/assets/sass/base.scss','resources/assets/sass/app.scss'])
        .pipe(concat('blog.scss'))
        .pipe(sass({outputStyle: 'compact'}).on('error', sass.logError))
        .pipe(minifyCss())
        .pipe(rename('blog.min.css'))
        .pipe(gulp.dest('public/assets/css'))
})
//js打包
gulp.task('blog-js',function(){
    return gulp.src(['node_modules/jquery/dist/jquery.js',
        'node_modules/bootstrap/dist/js/bootstrap.js',
        'node_modules/holderjs/holder.js',
        'resources/assets/js/app.js'])
        .pipe(concat('blog.js'))
        .pipe(uglify())
        .pipe(rename('blog.min.js'))
        .pipe(gulp.dest('public/assets/js'))
})