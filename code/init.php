<?php
define('PARENT_DIR', get_template_directory());
define('ETHEME_THEME_NAME', 'Desirees');
define('THEME_LOGO', '<span>DE</span>SIREES');
define('ETHEME_CODE_DIR', trailingslashit(PARENT_DIR).'code');

define('PARENT_URL', get_template_directory_uri());
define('ETHEME_CODE_URL', trailingslashit(PARENT_URL).'code');
define('ETHEME_CODE_IMAGES_URL', trailingslashit(ETHEME_CODE_URL).'css/images');
define('ETHEME_CODE_JS_URL', trailingslashit(ETHEME_CODE_URL).'js');
define('ETHEME_CODE_CSS_URL', trailingslashit(ETHEME_CODE_URL).'css');
define('CHILD_URL', get_stylesheet_directory_uri());

if(!defined('WP_LOAD_IMPORTERS') )
    define( 'WP_LOAD_IMPORTERS', true );

add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' );
add_action('after_setup_theme', 'etheme_theme_setup');
function etheme_theme_setup(){
	load_theme_textdomain( ETHEME_DOMAIN, get_template_directory() . '/languages' );

	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );
}


require_once( trailingslashit(ETHEME_CODE_DIR). 'options.php' );
require_once( trailingslashit(ETHEME_CODE_DIR). 'functions.php' );
require_once( trailingslashit(ETHEME_CODE_DIR). 'products.php' );
require_once( trailingslashit(ETHEME_CODE_DIR). 'shortcodes.php' );
require_once( trailingslashit(ETHEME_CODE_DIR). 'widgets.php' );
require_once( trailingslashit(ETHEME_CODE_DIR). 'woo.php' );
require_once( trailingslashit(ETHEME_CODE_DIR). 'sidebars.php' );

if ( is_admin() ) {
	require_once( trailingslashit(ETHEME_CODE_DIR) . 'admin_functions.php');
	require_once( trailingslashit(ETHEME_CODE_DIR) . 'admin.php');
  require_once( trailingslashit(ETHEME_CODE_DIR) . 'product.php' );
  require_once( trailingslashit(ETHEME_CODE_DIR) . 'meta-boxes.php' );
	require_once( trailingslashit(ETHEME_CODE_DIR) . 'theme-options.php');
}
