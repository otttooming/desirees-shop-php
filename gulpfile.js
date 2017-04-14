// npm install -g npm-check-updates
// ncu
// ncu -u

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
    csscomb       = require( 'gulp-csscomb' );
    secrets       = require( './secrets.json' );

var supportedBrowsers = [
    'last 2 versions',
    'ie >= 11',
    'android 4.4'
];

// Styleguide
gulp.task('styleguide', function() {
  return gulp.src(['src/styles/**/*.scss', '!src/styles/_mixins.scss'], {base: './'})
  .pipe(csscomb())
  .pipe(gulp.dest('./'));
});

// Styles
gulp.task('styles', function() {
  return gulp.src(['node_modules/swiper/dist/css/swiper.min.css',
                   'src/styles/main.scss'])
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
  return gulp.src(['node_modules/photoswipe/dist/photoswipe.min.js',
                   'node_modules/photoswipe/dist/photoswipe-ui-default.min.js',
                   'node_modules/swiper/dist/js/swiper.min.js',
                   'node_modules/lazysizes/lazysizes.min.js',
                   'node_modules/js-cookie/src/js.cookie.js',
                   'node_modules/popper.js/dist/popper.es5.min.js',
                   'node_modules/tippy.js/dist/tippy.js',
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
    parallel: 10,
    log:      gutil.log
  });

  if (gutil.env.css) {

    var globs = [
      'dist/styles/*.min.css',
      '!images/**',
      '!js/**',
      '!src/**',
      '!node_modules/**'
    ];

  } else if (gutil.env.php) {

    var globs = [
      '**/*.php',
      '*.php',
      '!images/**',
      '!js/**',
      '!src/**',
      '!node_modules/**'
    ];

  } else {

    var globs = [
      '**/*',
      '*',
      '!*.js',
      '!*.json',
      '!*.md',
      '!images/**',
      '!js/**',
      '!src',
      '!src/**',
      '!node_modules',
      '!node_modules/**'
    ];

  }

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
    '!*.js',
    '!*.json',
    '!*.md',
    '!images/**',
    '!js/**',
    '!src',
    '!src/**',
    '!node_modules',
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
