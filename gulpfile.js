
// $ npm install gulp gulp-util gulp-sass vinyl-ftp gulp-autoprefixer gulp-minify-css gulp-uglify gulp-notify gulp-rename gulp-concat del --save-dev

// Load plugins
var gulp          = require( 'gulp' ),
    gutil         = require( 'gulp-util' ),
    sass          = require( 'gulp-sass' ),
    ftp           = require( 'vinyl-ftp' ),
    autoprefixer  = require( 'gulp-autoprefixer' ),
    cleanCSS      = require( 'gulp-clean-css' ),
    uglify        = require( 'gulp-uglify' ),
    notify        = require( 'gulp-notify' ),
    rename        = require( 'gulp-rename' ),
    concat        = require( 'gulp-concat' ),
    del           = require( 'del' );
    secrets       = require( './secrets.json' );

var supportedBrowsers = [
    'last 2 versions',
    'ie >= 11',
    'android 4.4'
];

// Styles
gulp.task('styles', function() {
  return gulp.src(['bower_components/swiper/dist/css/swiper.min.css',
                   'src/styles/style.scss'])
    .pipe(sass({ style: 'expanded', }))
    .pipe(autoprefixer(supportedBrowsers))
    .pipe(concat('style.css'))
    .pipe(gulp.dest('dist/styles/'))
    .pipe(rename({ suffix: '.min' }))
    .pipe(cleanCSS({compatibility: supportedBrowsers, keepSpecialComments: 0}))
    .pipe(gulp.dest('dist/styles/'))
    .pipe(notify({ message: 'Styles task complete' }));
});

// Scripts
gulp.task('scripts', function() {
  return gulp.src(['bower_components/jquery/dist/jquery.js',
                   'bower_components/jquery-migrate/index.js',
                   'bower_components/photoswipe/dist/photoswipe.min.js',
                   'bower_components/photoswipe/dist/photoswipe-ui-default.min.js',
                   'bower_components/swiper/dist/js/swiper.min.js',
                   'bower_components/lazysizes/lazysizes.min.js',
                   'src/scripts/legacy/*.js',
                   'src/scripts/*.js' ],
                   {base: './'})
    .pipe(concat('script.js'))
    .pipe(gulp.dest('dist/scripts/'))
    .pipe(rename({ suffix: '.min' }))
    .pipe(uglify())
    .pipe(gulp.dest('dist/scripts/'))
    .pipe(notify({ message: 'Scripts task complete' }));
});

// Clean
gulp.task('clean', function() {
    del(['dist/styles', 'dist/scripts'])
});

// Default
gulp.task('default', ['clean'], function() {
    gulp.start('styles', 'scripts');
});

// Deploy
gulp.task('deploy', function () {

  var conn = ftp.create({
    host:     secrets.servers.development.serverhost,
    user:     secrets.servers.development.username,
    password: secrets.servers.development.password,
    parallel: 1,
    log:      gutil.log
  });

  var globs = [
    '**/*',
    '*',
    '!images/**',
    '!js/**',
    '!src/**',
    '!bower_components/**',
    '!node_modules/**'
  ];

  // using base = '.' will transfer everything to /public_html correctly
  // turn off buffering in gulp.src for best performance

  return gulp.src( globs, { base: '.', buffer: false } )
    .pipe(conn.dest( secrets.servers.development.remotepath ))
    // .pipe(notify({ message: 'Deploy to dev complete' }));
});

// Push
gulp.task('push', function () {

  var conn = ftp.create({
    host:     secrets.servers.development.serverhost,
    user:     secrets.servers.development.username,
    password: secrets.servers.development.password,
    parallel: 10,
    log:      gutil.log
  });

  var globs = [
    '**/*',
    '*',
    '!images/**',
    '!js/**',
    '!src/**',
    '!bower_components/**',
    '!node_modules/**'
  ];

  // using base = '.' will transfer everything to /public_html correctly
  // turn off buffering in gulp.src for best performance

  return gulp.src( globs, { base: '.', buffer: false } )
    .pipe(conn.newer( secrets.servers.development.remotepath )) // only upload newer files
    .pipe(notify({ message: 'Push to dev complete' }));
});

// Watch
gulp.task('watch', function() {

  // Watch .scss files
  var watcherStyles = gulp.watch('src/styles/**/*.scss', ['styles']);
    watcherStyles.on('change', function(event) {
    console.log('File ' + event.path + ' was ' + event.type + ', running tasks...');
  });

  // Watch .js files
  var watcherScripts = gulp.watch('src/scripts/**/*.js', ['scripts']);
    watcherStyles.on('change', function(event) {
    console.log('File ' + event.path + ' was ' + event.type + ', running tasks...');
  });

  // Push files when given an argument e.g. gulp watch --push
  if (gutil.env.push) {
    gulp.watch(['*', '**/*'], ['push']);
  }
});
