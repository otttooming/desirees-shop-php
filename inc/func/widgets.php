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

	// Empty cart.
  register_sidebar( array(
    'name' => __( 'Empty cart', 'desirees' ),
    'id' => 'empty-cart',
    'before_widget' => '',
    'after_widget' => '',
    'description' => __( 'Empty cart', 'desirees' ),
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

add_action( 'widgets_init', 'desirees_register_general_widgets' );
function desirees_register_general_widgets() {
  register_widget('Desirees_Subcategories_Widget');
}


function desirees_get_wc_categories_menu($title = 'Categories'){
    global $wp_query;
    ?>
        <div class="widget-container cat-list">
					<?php
								$instance_categories = get_terms( 'product_cat', 'hide_empty=0&parent=0');
								$cat = $wp_query->get_queried_object();
								$current_cat = '';
								if(!empty($cat->term_id)){ $current_cat = $cat->term_id; }

								foreach ($instance_categories as $categories) {
										$term_id = $categories->term_id;
										$term_name = $categories->name;
										$term_count = $categories->count;
										$term_desc = $categories->description;
										$thumbnail_id = get_woocommerce_term_meta( $term_id, 'thumbnail_id', true );
										?>
										<div class='cat-list__group <?php if($term_id == $current_cat) echo 'current-parent cat-list__group-open' ; ?>'>
											<?php
												$subcat_args = array(
													'taxonomy' => 'product_cat',
													'title_li' => '',
													'show_count' => 1,
													'hide_empty' => 0,
													'echo' => false,
													'show_option_none' => '',
													'child_of' => $term_id
												);
											?>

											<?php if(get_option('show_category_count') == 1) $subcat_args['show_count'] = 1; ?>
											<?php $subcategories = wp_list_categories( $subcat_args ); ?>

												<h2 class='cat-list__title'>
													<a href="<?php echo get_term_link( $categories, 'product_cat' ); ?>">
														<span class="cat-list__name"><?php echo $term_name; ?></span>
														<span class="cat-list__desc"><?php _e($term_desc); ?></span>
														<span class="cat-list__count"><?php echo $term_count; ?></span>
														<?php if (wp_get_attachment_url( $thumbnail_id )) : ?>
															<img class="cat-list__thumb" src="<?php echo wp_get_attachment_url( $thumbnail_id ); ?>" alt="" />
														<?php endif; ?>
													</a>
													<?php if ( $subcategories ) : ?>

													<div class="cat-list__subcat-control control__items">
															<svg class="<?php if($term_id == $current_cat) { echo 'control__up'; } else { echo 'control__down'; } ; ?>" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 501.5 501.5"><g><path fill="currentColor" d="M199.33 410.622l-55.77-55.508L247.425 250.75 143.56 146.384l55.77-55.507L358.44 250.75z"></path></g></svg>
													</div>

												<?php endif; ?>

												</h2>

												<?php if ( $subcategories ) : ?>
													<ul class='cat-list__subcat'>
														<?php echo $subcategories ?>
													</ul>
												<?php endif; ?>
										</div>
										<?php
								}
						?>
        </div>
    <?php
}

class Desirees_Subcategories_Widget extends WP_Widget {
    function Desirees_Subcategories_Widget() {
        $widget_ops = array( 'clasname' => 'desirees_subcats', 'description' => __('Display a list of subcategories on Category Page', 'desirees'));
        $control_ops = array('id_base' => 'desirees-subcategories');
        parent::__construct('desirees-subcategories', 'Desirees - '.__('Subcategories List', 'desirees'), $widget_ops, $control_ops);
    }
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
	}
	function form( $instance ) {
		$defaults = array( 'title' => 'Categories' );
		$instance = wp_parse_args( (array) $instance, $defaults );
	}
    function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		echo $before_widget;
        if(class_exists('Woocommerce')){
            desirees_get_wc_categories_menu($title);
        }
		echo $after_widget;
	}
}
