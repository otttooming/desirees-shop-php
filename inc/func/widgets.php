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

add_action( 'widgets_init', 'desirees_register_general_widgets' );
function desirees_register_general_widgets() {
  register_widget('Desirees_Subcategories_Widget');
}


function desirees_get_wc_categories_menu($title = 'Categories'){
    global $wp_query;
    ?>
        <div class="block cats widget-container">
            <h2 class="block-head">
                <?php echo ($title != '') ? $title : 'Categories'; ?>
            </h2>
            <div class="block-content">
            	<?php
                    $instance_categories = get_terms( 'product_cat', 'hide_empty=0&parent=0');
                    $cat = $wp_query->get_queried_object();
                    $current_cat = '';
                    if(!empty($cat->term_id)){ $current_cat = $cat->term_id; }
                    foreach($instance_categories as $categories){
                        $term_id = $categories->term_id;
                        $term_name = $categories->name;
                        ?>
                        <div class='categories-group <?php if($term_id == $current_cat) echo 'current-parent opened' ; ?>' id='sidebar_categorisation_group_<?php echo $term_id; ?>'>
                            <h5 class='wpsc_category_title'><a href="<?php echo get_term_link( $categories, 'product_cat' ); ?>"><?php echo $term_name; ?></a><span class="btn-show"></span></h5>
                                <?php $subcat_args = array( 'taxonomy' => 'product_cat',
                                'title_li' => '', 'show_count' => 0, 'hide_empty' => 0, 'echo' => false,
                                'show_option_none' => '', 'child_of' => $term_id ); ?>
                                <?php if(get_option('show_category_count') == 1) $subcat_args['show_count'] = 1; ?>
                                <?php $subcategories = wp_list_categories( $subcat_args ); ?>
                                <?php if ( $subcategories ) { ?>
                                <ul class='wpsc_categories wpsc_top_level_categories'><?php echo $subcategories ?></ul>
                                <?php } ?>
                            <div class='clear_category_group'></div>
                        </div>
                        <?php
                    }
                ?>
            </div>
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
