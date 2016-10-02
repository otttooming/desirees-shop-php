<?php
/**
 * Desirees widgets.
 */

function desirees_widgets_init() {

	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'desirees'),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'desirees' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

  // Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'desirees'),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', 'desirees' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Single product sidebar.
	register_sidebar( array(
		'name' => __( 'Single product sidebar', 'desirees' ),
		'id' => 'product-single-widget-area',
		'description' => __( 'Single product sidebar widget area', 'desirees' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Products sidebar.
	register_sidebar( array(
		'name' => __( 'Product Page sidebar', 'desirees' ),
		'id' => 'product-widget-area',
		'description' => __( 'Product Page sidebar', 'desirees' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Under products
	register_sidebar( array(
		'name' => __( 'Under Products', 'desirees' ),
		'id' => 'under-product-widget-area',
		'description' => __( 'Under Products widget area', 'desirees' ),
		'before_widget' => '<div class="page-widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	// Area 4, located in the footer.
	register_sidebar( array(
		'name' => __( 'Footer Primary Widget Area', 'desirees' ),
		'id' => 'first-footer-widget-area',
		'before_widget' => '',
		'after_widget' => '',
		'description' => __( 'The First Footer Widget Area', 'desirees' ),
        'before_title' => '<span class="footer_title">',
        'after_title' => '</span>'
	) );

	// Area 5, located in the footer.
	register_sidebar( array(
		'name' => __( 'Footer Secondary Widget Area', 'desirees' ),
		'id' => 'second-footer-widget-area',
		'before_widget' => '',
		'after_widget' => '',
		'description' => __( 'The Second Footer Widget Area', 'desirees' ),
        'before_title' => '<span class="footer_title">',
        'after_title' => '</span>'
	) );

	// Area 11, located in the footer.
	register_sidebar( array(
		'name' => __( 'Footer Payments Area', 'desirees' ),
		'id' => 'payments-area',
		'before_widget' => '',
		'after_widget' => '',
		'description' => __( 'Payments Area', 'desirees' ),
        'before_title' => '<h5>',
        'after_title' => '</h5>'
	) );

	// Area 12, located in the footer.
	register_sidebar( array(
		'name' => __( 'Footer Copyrights', 'desirees' ),
		'id' => 'copyrights-area',
		'before_widget' => '',
		'after_widget' => '',
		'description' => __( 'Copyrights', 'desirees' ),
        'before_title' => '<h5>',
        'after_title' => '</h5>'
	) );

  // Empty category.
  register_sidebar( array(
    'name' => __( 'Empty category', 'desirees' ),
    'id' => 'empty-category-area',
    'before_widget' => '',
    'after_widget' => '',
    'description' => __( 'Empty category area', 'desirees' ),
        'before_title' => '<h5>',
        'after_title' => '</h5>'
  ) );

  // Product page banner.
  register_sidebar( array(
    'name' => __( 'Product page banner', 'desirees' ),
    'id' => 'product_bage_banner',
    'before_widget' => '',
    'after_widget' => '',
    'description' => __( 'Product page banner', 'desirees' ),
        'before_title' => '<h5>',
        'after_title' => '</h5>'
  ) );
}

add_action( 'widgets_init', 'desirees_widgets_init' );
