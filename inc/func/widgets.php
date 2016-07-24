<?php
/**
 * Desirees widgets.
 */

function desirees_widgets_init() {

	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', ETHEME_DOMAIN),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', ETHEME_DOMAIN ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

  // Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', ETHEME_DOMAIN),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', ETHEME_DOMAIN ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Single product sidebar.
	register_sidebar( array(
		'name' => __( 'Single product sidebar', ETHEME_DOMAIN ),
		'id' => 'product-single-widget-area',
		'description' => __( 'Single product sidebar widget area', ETHEME_DOMAIN ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Products sidebar.
	register_sidebar( array(
		'name' => __( 'Product Page sidebar', ETHEME_DOMAIN ),
		'id' => 'product-widget-area',
		'description' => __( 'Product Page sidebar', ETHEME_DOMAIN ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Under products
	register_sidebar( array(
		'name' => __( 'Under Products', ETHEME_DOMAIN ),
		'id' => 'under-product-widget-area',
		'description' => __( 'Under Products widget area', ETHEME_DOMAIN ),
		'before_widget' => '<div class="page-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Area 4, located in the footer.
	register_sidebar( array(
		'name' => __( 'The First Footer Widget Area', ETHEME_DOMAIN ),
		'id' => 'first-footer-widget-area',
		'before_widget' => '',
		'after_widget' => '',
		'description' => __( 'The First Footer Widget Area', ETHEME_DOMAIN ),
        'before_title' => '<span class="footer_title">',
        'after_title' => '</span>'
	) );

	// Area 5, located in the footer.
	register_sidebar( array(
		'name' => __( 'The Second Footer Widget Area', ETHEME_DOMAIN ),
		'id' => 'second-footer-widget-area',
		'before_widget' => '',
		'after_widget' => '',
		'description' => __( 'The Second Footer Widget Area', ETHEME_DOMAIN ),
        'before_title' => '<span class="footer_title">',
        'after_title' => '</span>'
	) );

	// Area 6, located in the footer.
	register_sidebar( array(
		'name' => __( 'The Third Footer Widget Area', ETHEME_DOMAIN ),
		'id' => 'third-footer-widget-area',
		'before_widget' => '',
		'after_widget' => '',
		'description' => __( 'The Third Footer Widget Area', ETHEME_DOMAIN ),
        'before_title' => '<span class="footer_title">',
        'after_title' => '</span>'
	) );

	// Area 7, located in the footer.
	register_sidebar( array(
		'name' => __( 'The Fourth Footer Widget Area', ETHEME_DOMAIN ),
		'id' => 'fourth-footer-widget-area',
		'before_widget' => '',
		'after_widget' => '',
		'description' => __( 'The Fourth Footer Widget Area', ETHEME_DOMAIN ),
        'before_title' => '<span class="footer_title">',
        'after_title' => '</span>'
	) );

	// Area 7, located in the footer.
	register_sidebar( array(
		'name' => __( 'The Fifth Footer Widget Area', ETHEME_DOMAIN ),
		'id' => 'fifth-footer-widget-area',
		'before_widget' => '',
		'after_widget' => '',
		'description' => __( 'The Fifth Footer Widget Area', ETHEME_DOMAIN ),
        'before_title' => '<span class="footer_title">',
        'after_title' => '</span>'
	) );

	// Area 15, located in the footer.
	register_sidebar( array(
		'name' => __( 'The Sixth Footer Widget Area', ETHEME_DOMAIN ),
		'id' => 'sixth-footer-widget-area',
		'before_widget' => '',
		'after_widget' => '',
		'description' => __( 'The Sixth Footer Widget Area', ETHEME_DOMAIN ),
        'before_title' => '<span class="footer_title">',
        'after_title' => '</span>'
	) );

	// Area 16, located in the footer.
	register_sidebar( array(
		'name' => __( 'The Seventh Footer Widget Area', ETHEME_DOMAIN ),
		'id' => 'seventh-footer-widget-area',
		'before_widget' => '',
		'after_widget' => '',
		'description' => __( 'The Seventh Footer Widget Area', ETHEME_DOMAIN ),
        'before_title' => '<span class="footer_title">',
        'after_title' => '</span>'
	) );

	// Area 17, located in the footer.
	register_sidebar( array(
		'name' => __( 'The Eighth Footer Widget Area', ETHEME_DOMAIN ),
		'id' => 'eighth-footer-widget-area',
		'before_widget' => '',
		'after_widget' => '',
		'description' => __( 'The Eighth Footer Widget Area', ETHEME_DOMAIN ),
        'before_title' => '<span class="footer_title">',
        'after_title' => '</span>'
	) );

	// Area 10, located in the footer.
	register_sidebar( array(
		'name' => __( 'Payments Area', ETHEME_DOMAIN ),
		'id' => 'payments-area',
		'before_widget' => '',
		'after_widget' => '',
		'description' => __( 'Payments Area', ETHEME_DOMAIN ),
        'before_title' => '<h5>',
        'after_title' => '</h5>'
	) );

	// Area 11, located in the footer.
	register_sidebar( array(
		'name' => __( 'Payments Area', ETHEME_DOMAIN ),
		'id' => 'payments-area',
		'before_widget' => '',
		'after_widget' => '',
		'description' => __( 'Payments Area', ETHEME_DOMAIN ),
        'before_title' => '<h5>',
        'after_title' => '</h5>'
	) );

	// Area 12, located in the footer.
	register_sidebar( array(
		'name' => __( 'Copyrights', ETHEME_DOMAIN ),
		'id' => 'copyrights-area',
		'before_widget' => '',
		'after_widget' => '',
		'description' => __( 'Copyrights', ETHEME_DOMAIN ),
        'before_title' => '<h5>',
        'after_title' => '</h5>'
	) );
}

add_action( 'widgets_init', 'desirees_widgets_init' );
