# desirees theme for WooCommerce

Modern e-commerce solution based on WordPress.

## Installation

#### Primary method
1. In your admin panel, go to ```Appearance > Themes``` and click the ```Add New``` button.
* Click ```Upload and Choose File```, then select the theme's .zip file. Click ```Install Now```.
* Click ```Activate``` to use your new theme right away.
* Find plugin WooCommerce from WordPress plugin repository and install it, to use e-commerce functionality.

#### Alternative method
1. Install [GitHub Updater](https://github.com/afragen/github-updater)
* Follow instructions [GitHub Updater ReadMe](https://github.com/afragen/github-updater/blob/develop/README.md)

### Development environment

#### Setup development tools
1. Install NPM:
  * ```npm install```
* Install NPM dependencies:
  * ```npm install gulp gulp-util gulp-sass vinyl-ftp gulp-autoprefixer gulp-minify-css gulp-uglify gulp-notify gulp-rename gulp-concat del --save-dev```
* Install Bower:
  * ```bower install```
  * ```bower install photoswipe```
* Run Gulp tasks:
  * ```gulp```
* Watch for modified source files:
  * ```gulp watch```

#### Specifications
* [BEM. Block, Element, Modifier](https://en.bem.info/)
* [CSScomb config Yandex](https://github.com/csscomb/csscomb.js/blob/master/config/yandex.json)
* [.gitattributes Templates](https://github.com/Danimoth/gitattributes)
* [.gitignore Templates](https://www.gitignore.io/)

#### Tools
* [gulp.js - the streaming build system](http://gulpjs.com/)
* [SCSS-lint](https://github.com/brigade/scss-lint)

## Credits
* Based on Underscores [http://underscores.me/](http://underscores.me/), (C) 2012-2015 Automattic, Inc., [GPLv2 or later](https://www.gnu.org/licenses/gpl-2.0.html)
* normalize.css [http://necolas.github.io/normalize.css/](http://necolas.github.io/normalize.css/), (C) 2012-2015 Nicolas Gallagher and Jonathan Neal, [MIT](http://opensource.org/licenses/MIT)
* Bourbon [http://bourbon.io/](http://bourbon.io/), (C) 2011–2015 thoughtbot, inc. Bourbon is free software, and may be redistributed under the terms specified in the [license](http://github.com/thoughtbot/bourbon/blob/master/LICENSE.md).
