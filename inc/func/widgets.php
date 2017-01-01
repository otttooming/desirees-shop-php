<?php
/**
 * Desirees widgets.
 */

function desirees_widgets_init() {

	// Sidebar
	register_sidebar( array(
		'name' => __( 'Sidebar Widget Area', 'desirees'),
		'id' => 'sidebar-widget-area',
		'description' => __( 'The sidebar widget area', 'desirees' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	// Footer 1 widget area
	register_sidebar( array(
		'name' => __( 'Footer 1', 'desirees' ),
		'id' => 'footer-1',
		'before_widget' => '',
		'after_widget' => '',
		'description' => __( 'Footer 1', 'desirees' ),
        'before_title' => '<h2>',
        'after_title' => '</h2>'
	) );

	// Footer 2 widget area
	register_sidebar( array(
		'name' => __( 'Footer 2', 'desirees' ),
		'id' => 'footer-2',
		'before_widget' => '',
		'after_widget' => '',
		'description' => __( 'Footer 2', 'desirees' ),
        'before_title' => '<h2>',
        'after_title' => '</h2>'
	) );

	// Footer 3 widget area
	register_sidebar( array(
		'name' => __( 'Footer 3', 'desirees' ),
		'id' => 'footer-3',
		'before_widget' => '',
		'after_widget' => '',
		'description' => __( 'Footer 3', 'desirees' ),
				'before_title' => '<h2>',
				'after_title' => '</h2>'
	) );

	// Footer 4 widget area
	register_sidebar( array(
		'name' => __( 'Footer 4', 'desirees' ),
		'id' => 'footer-4',
		'before_widget' => '',
		'after_widget' => '',
		'description' => __( 'Footer 4', 'desirees' ),
				'before_title' => '<h2>',
				'after_title' => '</h2>'
	) );

	// Footer wide widget area
	register_sidebar( array(
		'name' => __( 'Footer wide', 'desirees' ),
		'id' => 'footer-wide',
		'before_widget' => '',
		'after_widget' => '',
		'description' => __( 'Footer wide', 'desirees' ),
				'before_title' => '<h2>',
				'after_title' => '</h2>'
	) );

	// Empty category.
	register_sidebar( array(
		'name' => __( 'Empty page', 'desirees' ),
		'id' => 'empty-page-widget-area',
		'before_widget' => '',
		'after_widget' => '',
		'description' => __( '404 page area', 'desirees' ),
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

  // Products top banner.
  register_sidebar( array(
    'name' => __( 'Products top banner', 'desirees' ),
    'id' => 'products-banner-top',
    'before_widget' => '',
    'after_widget' => '',
    'description' => __( 'Products top banner', 'desirees' ),
        'before_title' => '<h5>',
        'after_title' => '</h5>'
  ) );
};
add_action( 'widgets_init', 'desirees_widgets_init' );

function desirees_widgets_contacts_init() {

	// Contacts
	register_sidebar( array(
		'name' => __( 'Contacts', 'desirees' ),
		'id' => 'contacts',
		'before_widget' => '',
		'after_widget' => '',
		'description' => __( 'Contacts', 'desirees' ),
				'before_title' => '<h5>',
				'after_title' => '</h5>'
	) );
};
add_action( 'widgets_init', 'desirees_widgets_contacts_init' );

function desirees_widgets_frontpage_init() {

	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'FP shopnav 1', 'desirees'),
		'id' => 'fp-shopnav-1',
		'description' => __( 'The primary widget area', 'desirees' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'FP shopnav 2', 'desirees'),
		'id' => 'fp-shopnav-2',
		'description' => __( 'The primary widget area', 'desirees' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'FP slider top', 'desirees'),
		'id' => 'fp-slider-top',
		'description' => __( 'FP slider top', 'desirees' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'FP slogan 1', 'desirees'),
		'id' => 'fp-slogan-1',
		'description' => __( 'FP slogan 1', 'desirees' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'FP slogan 2', 'desirees'),
		'id' => 'fp-slogan-2',
		'description' => __( 'FP slogan 2', 'desirees' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'FP slogan 3', 'desirees'),
		'id' => 'fp-slogan-3',
		'description' => __( 'FP slogan 3', 'desirees' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'FP slogan 4', 'desirees'),
		'id' => 'fp-slogan-4',
		'description' => __( 'FP slogan 4', 'desirees' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );

	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
	  'name' => __( 'FP illustration 1', 'desirees'),
	  'id' => 'fp-illustration-1',
	  'description' => __( 'FP illustration 1', 'desirees' ),
	  'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
	  'after_widget' => '</div>',
	  'before_title' => '<h2 class="widget-title">',
	  'after_title' => '</h2>',
	) );

	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
	  'name' => __( 'FP illustration 2', 'desirees'),
	  'id' => 'fp-illustration-2',
	  'description' => __( 'FP illustration 2', 'desirees' ),
	  'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
	  'after_widget' => '</div>',
	  'before_title' => '<h2 class="widget-title">',
	  'after_title' => '</h2>',
	) );

	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
	  'name' => __( 'FP illustration 3', 'desirees'),
	  'id' => 'fp-illustration-3',
	  'description' => __( 'FP illustration 3', 'desirees' ),
	  'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
	  'after_widget' => '</div>',
	  'before_title' => '<h2 class="widget-title">',
	  'after_title' => '</h2>',
	) );

	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
	  'name' => __( 'FP illustration 4', 'desirees'),
	  'id' => 'fp-illustration-4',
	  'description' => __( 'FP illustration 4', 'desirees' ),
	  'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
	  'after_widget' => '</div>',
	  'before_title' => '<h2 class="widget-title">',
	  'after_title' => '</h2>',
	) );
};
add_action( 'widgets_init', 'desirees_widgets_frontpage_init' );


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
													'show_count' => 0,
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
													</a>
													<?php if ( $subcategories ) : ?>

														<div class="cat-list__subcat-control control__items">
																<svg class="<?php if($term_id == $current_cat) { echo 'control__up'; } else { echo 'control__down'; } ; ?>" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 501.5 501.5"><g><path fill="currentColor" d="M199.33 410.622l-55.77-55.508L247.425 250.75 143.56 146.384l55.77-55.507L358.44 250.75z"></path></g></svg>
														</div>

													<?php endif; ?>

												</h2>

												<?php $subcats = get_categories( array ('taxonomy' => 'product_cat', 'parent' => $categories->term_id )); ?>
												<ul class='cat-list__subcat'>
														<?php foreach ( $subcats as $subcat ) { ?>
																<li class="cat-list__title">
																		<a href="<?php echo get_term_link( $subcat, 'product_cat' ); ?>">

																				<span class="cat-list__name"><?php echo $subcat->name; ?></span>
																				<span class="cat-list__desc"><?php _e($subcat->description); ?></span>
																				<span class="cat-list__count"><?php echo $subcat->count; ?></span>
																		</a>
																</li>

																<?php $subcats_lvl2 = get_categories( array ('taxonomy' => 'product_cat', 'parent' => $subcat->term_id )); ?>

																<ul class='cat-list__subcat'>
																		<?php foreach ( $subcats_lvl2 as $subcat_lvl2 ) { ?>
																				<li class="cat-list__title">
																						<a href="<?php echo get_term_link( $subcat_lvl2, 'product_cat' ); ?>">

																								<span class="cat-list__name"><?php echo $subcat_lvl2->name; ?></span>
																								<span class="cat-list__desc"><?php _e($subcat_lvl2->description); ?></span>
																								<span class="cat-list__count"><?php echo $subcat_lvl2->count; ?></span>
																						</a>
																				</li>
																		<?php } ?>
																</ul>
														<?php } ?>
												</ul>

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
