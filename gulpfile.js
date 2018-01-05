var gulp = require('gulp'),
	sourcemaps = require('gulp-sourcemaps'),
	cleanCSS = require('gulp-clean-css'),
	concat = require('gulp-concat'),
	uglify = require('gulp-uglify'),
	projectError = require('gulp-util'),
	rename = require('gulp-rename'),
	watch = require('gulp-watch'),
	imagemin = require('gulp-imagemin'),
	cache = require('gulp-cache'),
	autoprefixer = require('gulp-autoprefixer'),
	sass = require('gulp-sass'),
	spritesmith = require('gulp.spritesmith');

gulp.task('sass', function () {
	gulp.src('app/sass/app.scss')
		.pipe(sourcemaps.init())
		.pipe(sass())
		.pipe(autoprefixer({
			browsers: ['last 2 versions']
		}))
		.pipe(cleanCSS())
		.pipe(rename('app.min.css'))
		.pipe(sourcemaps.write('./'))
		.pipe(gulp.dest('dist/css/'))
});

gulp.task('manage', function () {
	return gulp.src(['app/js/*.js'])
		.pipe(uglify({ output: { comments: false}}))///^!/ } })))
		.pipe(concat('app.js'))
		.pipe(rename('app.min.js'))
		.pipe(gulp.dest('dist/js'))
		.on('error', projectError.log)
});

gulp.task('fonts', function () {
	gulp.src('app/fonts/*.*')
		.pipe(gulp.dest('dist/fonts'))
});

gulp.task('images', function () {
	return gulp.src(['app/images/**/*.+(png|jpg|gif|svg|ico)', '!app/images/sprites/**/*'])
		.pipe(cache(imagemin([
			imagemin.gifsicle({ interlaced: true }),
			imagemin.jpegtran({ progressive: true, optimizationLevel: 6 }),
			imagemin.optipng({ optimizationLevel: 6 }),
			imagemin.svgo({ plugins: [{ removeViewBox: true }] })
		])))
		.pipe(gulp.dest('dist/images'))
});

gulp.task('sprite', function () {
	var spriteData = gulp.src('app/images/sprites/*.png').pipe(spritesmith({
		imgName: '../images/sprite.png',
		cssName: '_sprite.scss'
	}));
	spriteData.img.pipe(gulp.dest('dist/images'));
	spriteData.css.pipe(gulp.dest('app/sass/config/'));
});


gulp.task('watch', function () {
	gulp.watch(['app/sass/**/*.scss', 'app/css/*.css'], ['sass']);
	gulp.watch('app/js/*js', ['manage']);
	gulp.watch('app/fonts/*', ['fonts']);
	gulp.watch('app/images/**/*.*', ['images', 'sprite']);
});

gulp.task('default', ['sass', 'manage', 'fonts', 'images', 'sprite', 'watch']);
