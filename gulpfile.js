const gulp = require('gulp');
const sass = require('gulp-sass');

gulp.task('sass', async function() {
    return gulp.src('scss/custom.scss')
    .pipe(sass())
    .pipe(gulp.dest('css'))
});

gulp.task('default', function() {
    gulp.watch('scss/*.scss', gulp.series('sass'))
});