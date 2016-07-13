<?php

/**
 * Enqueue scripts and styles.
 */
function desirees_assets() {

	wp_enqueue_style( 'desirees-style', get_stylesheet_directory_uri() . '/dist/styles/style.min.css', array(), '1', 'all' );

	wp_enqueue_script( 'desirees-script', get_template_directory_uri() . '/dist/scripts/script.min.js', array(), '1', true );
	
	// wp_enqueue_script( 'desirees-script-a', get_template_directory_uri() . '/js/script.js', array(), '1', true );


}
add_action( 'wp_enqueue_scripts', 'desirees_assets' );

/**
 * Enqueue webfonts, icon fonts from CDN
 */
function desirees_assets_cdn() {

	wp_enqueue_style( 'desirees_google_typefaces', 'https://fonts.googleapis.com/css?family=Oswald:400,300|Playfair+Display|Oranienbaum', false );

	// wp_enqueue_style( 'desirees_fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css', false );

}
add_action( 'wp_enqueue_scripts', 'desirees_assets_cdn' );
