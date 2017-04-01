<?php

/**
 * Enqueue scripts and styles.
 */
function desirees_assets() {

	wp_enqueue_style( 'desirees-style', get_stylesheet_directory_uri() . '/dist/styles/style.min.css', array(), '2', 'all' );

	wp_enqueue_script( 'desirees-script', get_template_directory_uri() . '/dist/scripts/script.min.js', array(), '2', true );

}
add_action( 'wp_enqueue_scripts', 'desirees_assets' );

/**
 * Enqueue webfonts, icon fonts from CDN
 */
function desirees_assets_cdn() {

	wp_enqueue_style( 'desirees_google_typefaces', 'https://fonts.googleapis.com/css?family=Playfair+Display|Oranienbaum', false );

}
add_action( 'wp_enqueue_scripts', 'desirees_assets_cdn' );
