const gulp = require('gulp');
const tar = require('gulp-tar');
const del = require('del');

const files = {
    dist: [
        'src/templates/*.xml',
        'build/templates.tar',
        'build/files.tar'
    ]
};

gulp.task('pack-files', ['clean'], () =>
    gulp.src('src/files/*')
        .pipe(tar('files.tar'))
        .pipe(gulp.dest('build'))
);

gulp.task('pack-templates', ['clean'], () =>
    gulp.src('src/templates/*')
        .pipe(tar('templates.tar'))
        .pipe(gulp.dest('build'))
);

gulp.task('dist', ['pack-files','pack-templates'], () =>
    gulp.src(files.dist)
        .pipe(tar('ch.nana.usermenu.ts3.tar'))
        .pipe(gulp.dest('dist'))
);

gulp.task('clean', () => {
  // You can use multiple globbing patterns as you would with `gulp.src`
  return del(['dist','build']);
});

gulp.task('default', ['dist']);