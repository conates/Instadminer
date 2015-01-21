/*
* Dependencias
*/
var gulp 		= require('gulp'),
	jshint 		= require('gulp-jshint'),
	concat 		= require('gulp-concat'),
	uglify 		= require('gulp-uglify'),
	stylus 		= require('gulp-stylus'),
	imagemin 	= require('gulp-imagemin'),
	pngquant 	= require('imagemin-pngquant'),
	notify		= require('gulp-notify'),
	rename		= require('gulp-rename');



var path = {
    stylus: ['public/templates_dev/stylus/style.styl'],
    css_min: 'public/templates_dev/css/min/',
    css: 'public/templates_dev/css/'
};

/*
*	watch
*
*/

path.watch = {
    stylus: ['public/templates_dev/stylus/*.styl'],
    js: ['public/templates_dev/js/*.js']
};

gulp.task('watch', function () {

    gulp.watch(path.watch.js, ['js']);
    gulp.watch(path.watch.stylus, ['css']);
});



/*
* Configuración de las tareas
*/
gulp.task('default', ['images', 'css', 'js']);

gulp.task('images',function(){
    return gulp.src(['public/templates_dev/img/*.*'])
        .pipe(imagemin({
            progressive: true,
            svgoPlugins: [{removeViewBox: false}],
            use: [pngquant()]
        }))
        .pipe(gulp.dest('public/templates_dev/img/'))
});

gulp.task('css',['css-min'],function(){
    return gulp.src(path.stylus)
        .pipe(stylus({
            compress: false
        }))
        .pipe(gulp.dest(path.css))
        .pipe(notify('css compiled'));
});
gulp.task('css-min',function(){
    return gulp.src(path.stylus)
        .pipe(stylus({
            compress: true
        }))
        .pipe(rename('styles.min.css'))
        .pipe(gulp.dest(path.css_min))
        .pipe(notify('css_min compiled'));
});

gulp.task('js',function() {
	return gulp.src('public/templates_dev/js/script.js')
		.pipe(jshint())
		.pipe(jshint.reporter('default'))
		.pipe(concat('script.js'))
		.pipe(uglify())
		.pipe(rename('script.min.js'))
		.pipe(gulp.dest('public/templates_dev/js/min/'));
});