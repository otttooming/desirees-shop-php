<?php
// **********************************************************************//
// ! Remove Default STYLES
// **********************************************************************//

add_filter( 'woocommerce_enqueue_styles', '__return_false' );

add_theme_support(ETHEME_DOMAIN);

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 18000)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time
    session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp

remove_action( 'woocommerce_product_tabs', 'woocommerce_product_description_tab', 10 );
remove_action( 'woocommerce_product_tabs', 'woocommerce_product_attributes_tab', 20 );
remove_action( 'woocommerce_product_tabs', 'woocommerce_product_reviews_tab', 30 );
remove_action( 'woocommerce_product_tab_panels', 'woocommerce_product_description_panel', 10 );
remove_action( 'woocommerce_product_tab_panels', 'woocommerce_product_attributes_panel', 20 );
remove_action( 'woocommerce_product_tab_panels', 'woocommerce_product_reviews_panel', 30 );

if(!etheme_get_option('related_products')) {
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
}

class Etheme_WooCommerce_Widget_Special extends WP_Widget {

	/** Variables to setup the widget. */
	var $woo_widget_cssclass;
	var $woo_widget_description;
	var $woo_widget_idbase;
	var $woo_widget_name;

	/** constructor */
	function Etheme_WooCommerce_Widget_Special() {

		/* Widget variable settings. */
		$this->woo_widget_cssclass 		= 'etheme_woocommerce_widget_special';
		$this->woo_widget_description 	= __( "Display Special Offers in sidebar", ETHEME_DOMAIN );
		$this->woo_widget_idbase 		= 'etheme_woocommerce_widget_special';
		$this->woo_widget_name 			= __( '8theme Special Offers', ETHEME_DOMAIN );

		/* Widget settings. */
		$widget_ops = array( 'classname' => $this->woo_widget_cssclass, 'description' => $this->woo_widget_description );

		/* Create the widget. */
		parent::__construct( 'etheme_special', $this->woo_widget_name, $widget_ops );
	}

	/** @see WP_Widget */
	function widget( $args = array(), $instance = array() ) {
		global $woocommerce,$wpdb;

		extract( $args );

		$title = apply_filters('widget_title', empty( $instance['title'] ) ? __('Special Offers', ETHEME_DOMAIN) : $instance['title'], $instance, $this->id_base );
		$hide_if_empty = empty( $instance['hide_if_empty'] )  ? 0 : 1;



        $key = '_etheme_special';

        $args = apply_filters('woocommerce_related_products_args', array(
        	'post_type'				=> 'product',
            'meta_key'              => $key,
            'meta_value'            => true,
        	'ignore_sticky_posts'	=> 1,
        	'no_found_rows' 		=> 1,
        	'posts_per_page' 		=> ($instance['number'])
        ) );

        ob_start();
        etheme_create_slider($args,$title, $image_width, $image_height,false,1,0);
        $output = ob_get_contents();
        ob_end_clean();

?>
    <div class="widget-container widget_special_offers">
        <?php echo $output ?>
    </div>

        <?php
	}

	/** @see WP_Widget->update */
	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( stripslashes( $new_instance['title'] ) );
        $instance['number'] = (int) $new_instance['number'];
		return $instance;
	}

	/** @see WP_Widget->form */
	function form( $instance ) {
        if ( !$number = (int) $instance['number'] )
                $number = 5;
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', ETHEME_DOMAIN) ?></label>
		<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php if (isset ( $instance['title'])) {echo esc_attr( $instance['title'] );} ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of products to show:', ETHEME_DOMAIN); ?></label>
        <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /><br />
        </p>
		<?php
	}

} // class WooCommerce_Widget_Cart
class Etheme_Widget_Price_Filter extends WP_Widget {

	/** Variables to setup the widget. */
	var $woo_widget_cssclass;
	var $woo_widget_description;
	var $woo_widget_idbase;
	var $woo_widget_name;

	/** constructor */
	function Etheme_Widget_Price_Filter() {

		/* Widget variable settings. */
		$this->woo_widget_cssclass = 'widget_price_filter';
		$this->woo_widget_description = __( 'Shows a price filter slider in a widget which lets you narrow down the list of shown products when viewing product categories.', ETHEME_DOMAIN );
		$this->woo_widget_idbase = 'etheme_woocommerce_price_filter';
		$this->woo_widget_name = __('8theme Price Filter', ETHEME_DOMAIN );

		/* Widget settings. */
		$widget_ops = array( 'classname' => $this->woo_widget_cssclass, 'description' => $this->woo_widget_description );

		/* Create the widget. */
		$this->WP_Widget('price_filter', $this->woo_widget_name, $widget_ops);
	}

	/** @see WP_Widget */
	function widget( $args, $instance ) {
		extract($args);

		global $_chosen_attributes, $wpdb, $woocommerce, $wp_query, $wp;

		if (!is_tax( 'product_cat' ) && !is_post_type_archive('product') && !is_tax( 'product_tag' )) return; // Not on product page - return

		if ( sizeof( $woocommerce->query->unfiltered_product_ids ) == 0 ) return; // None shown - return

		if ( get_option( 'woocommerce_enable_jquery_ui' ) != 'no' ) {

			wp_enqueue_script( 'wc-price-slider' );

			wp_localize_script( 'wc-price-slider', 'woocommerce_price_slider_params', array(
				'currency_symbol' 	=> get_woocommerce_currency_symbol(),
				'currency_pos'      => get_option( 'woocommerce_currency_pos' ),
				'min_price'			=> isset( $_GET['min_price'] ) ? $_GET['min_price'] : '',
				'max_price'			=> isset( $_GET['max_price'] ) ? $_GET['max_price'] : ''
			) );
		}

		$title = $instance['title'];
		$title = apply_filters('widget_title', $title, $instance, $this->id_base);

		// Remember current filters/search
		$fields = '';

		if (get_search_query()) $fields = '<input type="hidden" name="s" value="'.get_search_query().'" />';
		if (isset($_GET['post_type'])) $fields .= '<input type="hidden" name="post_type" value="'.esc_attr( $_GET['post_type'] ).'" />';
		if (isset($_GET['product_cat'])) $fields .= '<input type="hidden" name="product_cat" value="'.esc_attr( $_GET['product_cat'] ).'" />';
		if (isset($_GET['product_tag'])) $fields .= '<input type="hidden" name="product_tag" value="'.esc_attr( $_GET['product_tag'] ).'" />';

		if ($_chosen_attributes) foreach ($_chosen_attributes as $attribute => $data) :

			$fields .= '<input type="hidden" name="'.esc_attr( str_replace('pa_', 'filter_', $attribute) ).'" value="'.esc_attr( implode(',', $data['terms']) ).'" />';
			if ($data['query_type']=='or') $fields .= '<input type="hidden" name="'.esc_attr( str_replace('pa_', 'query_type_', $attribute) ).'" value="or" />';

		endforeach;

		$min = $max = 0;
		$post_min = $post_max = '';

		if ( sizeof( $woocommerce->query->layered_nav_product_ids ) == 0 ) :

			$max = ceil($wpdb->get_var("SELECT max(meta_value + 0)
			FROM $wpdb->posts
			LEFT JOIN $wpdb->postmeta ON $wpdb->posts.ID = $wpdb->postmeta.post_id
			WHERE meta_key = '_price'"));

		else :

			$max = ceil($wpdb->get_var("SELECT max(meta_value + 0)
			FROM $wpdb->posts
			LEFT JOIN $wpdb->postmeta ON $wpdb->posts.ID = $wpdb->postmeta.post_id
			WHERE meta_key = '_price' AND (
				$wpdb->posts.ID IN (".implode(',', $woocommerce->query->layered_nav_product_ids).")
				OR (
					$wpdb->posts.post_parent IN (".implode(',', $woocommerce->query->layered_nav_product_ids).")
					AND $wpdb->posts.post_parent != 0
				)
			)"));

		endif;

		if ( $min == $max ) return;

		if (isset($_SESSION['min_price'])) $post_min = $_SESSION['min_price'];
		if (isset($_SESSION['max_price'])) $post_max = $_SESSION['max_price'];

		echo $before_widget . $before_title . $title . $after_title;

		if ( get_option( 'permalink_structure' ) == '' )
			$form_action = remove_query_arg( array( 'page', 'paged' ), add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );
		else
			$form_action = preg_replace( '%\/page/[0-9]+%', '', home_url( $wp->request ) );

		echo '<form method="get" action="' . esc_url($form_action) . '">
			<div class="price_slider_wrapper">
				<div class="price_slider" style="display:none;"></div>
				<div class="price_slider_amount">
					<input type="text" id="min_price" name="min_price" value="'.esc_attr( $post_min ).'" data-min="'.esc_attr( $min ).'" placeholder="'.__('Min price', ETHEME_DOMAIN).'" />
					<input type="text" id="max_price" name="max_price" value="'.esc_attr( $post_max ).'" data-max="'.esc_attr( $max ).'" placeholder="'.__('Max price', ETHEME_DOMAIN).'" />
					<button type="submit" class="button"><span>'.__('Filter', ETHEME_DOMAIN).'</span></button>
					<div class="price_label" style="display:none;">
						'.__('Price:', ETHEME_DOMAIN).' <span class="from"></span> &mdash; <span class="to"></span>
					</div>
					'.$fields.'
					<div class="clear"></div>
				</div>
			</div>
		</form>';

		echo $after_widget;
	}

	/** @see WP_Widget->update */
	function update( $new_instance, $old_instance ) {
		if (!isset($new_instance['title']) || empty($new_instance['title'])) $new_instance['title'] = __('Filter by price', ETHEME_DOMAIN);
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		return $instance;
	}

	/** @see WP_Widget->form */
	function form( $instance ) {
		global $wpdb;
		?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', ETHEME_DOMAIN) ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php if (isset ( $instance['title'])) {echo esc_attr( $instance['title'] );} ?>" /></p>
		<?php
	}
} // class WooCommerce_Widget_Price_Filter
function etheme_wc_register_widgets() {

    if(class_exists('WooCommerce')) {
		//register_widget('Etheme_Widget_Price_Filter');
		register_widget('Etheme_WooCommerce_Widget_Special');
	}
}
add_action('widgets_init', 'etheme_wc_register_widgets');





add_filter( 'woocommerce_checkout_fields' , 'etheme_custom_checkout_fields' );

function etheme_custom_checkout_fields( $fields ) {

	$fields['billing']['billing_address_2']['label'] = __('Address 2', ETHEME_DOMAIN);
	$fields['shipping']['shipping_address_2']['label'] = __('Address 2', ETHEME_DOMAIN);

	return $fields;

}





function etheme_get_wc_categories_menu($title = 'Categories'){
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
            <script type="text/javascript">
                <?php if(!etheme_get_option('cats_accordion')): ?>
                    var nav_accordion = false;
                <?php else: ?>
                    var nav_accordion = true;
                <?php endif ;?>
            </script>
        </div>
    <?php
}

function etheme_wc_product_labels( $product_id = '' ) {
    echo etheme_wc_get_product_labels($product_id);
}
function etheme_wc_get_product_labels( $product_id = '' ) {
	global $post, $wpdb,$product;
    $count_labels = 0;
    $output = '';

    if ( etheme_get_option('sale_icon') ) :
        if ($product->is_on_sale()) {$count_labels++;
            $output .= '<span class="label-icon sale-label">'.__( 'Sale!', ETHEME_DOMAIN ).'</span>';
        }
    endif;

    if ( etheme_get_option('new_icon') ) : $count_labels++;
        if(etheme_product_is_new($product_id)) :
            $second_label = ($count_labels > 1) ? 'second_label' : '';
            $output .= '<span class="label-icon new-label '.$second_label.'">'.__( 'New!', ETHEME_DOMAIN ).'</span>';
        endif;
    endif;
    return $output;
}


remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end');
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper');
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );

/* Grid/List switcher */
add_action('woocommerce_before_shop_loop', 'etheme_grid_list_switcher',115);

function etheme_grid_list_switcher() {
	?>
	<?php $view_mode = etheme_get_option('view_mode'); ?>
	<?php if($view_mode == 'grid_list'): ?>
		<div class="view-switcher">
			<label><?php _e('View as', ETHEME_DOMAIN); ?></label>
			<div class="switchToGrid">grid</div>
			<div class="switchToList">list</div>
		</div>
	<?php elseif($view_mode == 'list_grid'): ?>
		<div class="view-switcher">
			<label><?php _e('View as', ETHEME_DOMAIN); ?></label>
			<div class="switchToList">list</div>
			<div class="switchToGrid">grid</div>
		</div>
	<?php endif ;?>


	<?php
}


/**
 * Display a single prodcut
 **/
function etheme_woocommerce_product($atts){
  	if (empty($atts)) return;

  	$args = array(
    	'post_type' => 'product',
    	'posts_per_page' => 1,
    	'no_found_rows' => 1,
    	'post_status' => 'publish',
    	'meta_query' => array(
			array(
				'key' => '_visibility',
				'value' => array('catalog', 'visible'),
				'compare' => 'IN'
			)
		)
  	);

  	if(isset($atts['sku'])){
    	$args['meta_query'][] = array(
      		'key' => '_sku',
      		'value' => $atts['sku'],
      		'compare' => '='
    	);
  	}

  	if(isset($atts['id'])){
    	$args['p'] = $atts['id'];
  	}

  	ob_start();

	$products = new WP_Query( $args );

	if ( $products->have_posts() ) : ?>


        <div id="products-grid" class="products_grid shortcode-products row rows-count4">
    		<?php while ( $products->have_posts() ) : $products->the_post(); ?>

    			<?php woocommerce_get_template_part( 'content', 'product' ); ?>

    		<?php endwhile; // end of the loop. ?>
		</div>
		<div class="clear"></div>
        <script type="text/javascript">imageTooltip(jQuery('.imageTooltip'))</script>

	<?php endif;

	wp_reset_query();

	return ob_get_clean();
}


/**
 * List multiple products shortcode
 **/
function etheme_woocommerce_products($atts){
	global $woocommerce_loop;

  	if (empty($atts)) return;

	extract(shortcode_atts(array(
		'columns' 	=> '4',
	  	'orderby'   => 'title',
	  	'order'     => 'asc'
		), $atts));

  	$args = array(
		'post_type'	=> 'product',
		'post_status' => 'publish',
		'ignore_sticky_posts'	=> 1,
		'orderby' => $orderby,
		'order' => $order,
		'posts_per_page' => -1,
		'meta_query' => array(
			array(
				'key' 		=> '_visibility',
				'value' 	=> array('catalog', 'visible'),
				'compare' 	=> 'IN'
			)
		)
	);

	if(isset($atts['skus'])){
		$skus = explode(',', $atts['skus']);
	  	$skus = array_map('trim', $skus);
    	$args['meta_query'][] = array(
      		'key' 		=> '_sku',
      		'value' 	=> $skus,
      		'compare' 	=> 'IN'
    	);
  	}

	if(isset($atts['ids'])){
		$ids = explode(',', $atts['ids']);
	  	$ids = array_map('trim', $ids);
    	$args['post__in'] = $ids;
	}

  	ob_start();

	$products = new WP_Query( $args );

	$woocommerce_loop['columns'] = $columns;

	if ( $products->have_posts() ) : ?>


        <div id="products-grid" class="products_grid shortcode-products row rows-count<?php echo $columns ?>">
    		<?php while ( $products->have_posts() ) : $products->the_post(); ?>

    			<?php woocommerce_get_template_part( 'content', 'product' ); ?>

    		<?php endwhile; // end of the loop. ?>
		</div>
		<div class="clear"></div>
        <script type="text/javascript">imageTooltip(jQuery('.imageTooltip'))</script>

	<?php endif;

	wp_reset_query();

	return ob_get_clean();
}


/**
 * Show a single product page
 **/
function etheme_woocommerce_product_page_shortcode( $atts ) {
  	if (empty($atts)) return;

    if (!$atts['id'] && !$atts['sku']) return;

	wp_enqueue_script( 'wc-single-product', home_url() . '/wp-content/plugins/woocommerce/assets/js/frontend/single-product.min.js', array( 'jquery' ), '1.6', true );
    wp_enqueue_script( 'wc-add-to-cart-variation', home_url() . '/wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart-variation.min.js', array( 'jquery' ), '1.6', true );

  	$args = array(
    	'posts_per_page' 	=> 1,
    	'post_type'	=> 'product',
    	'post_status' => 'publish',
    	'ignore_sticky_posts'	=> 1,
    	'no_found_rows' => 1
  	);

  	if(isset($atts['sku'])){
    	$args['meta_query'][] = array(
      		'key' => '_sku',
      		'value' => $atts['sku'],
      		'compare' => '='
    	);
  	}

  	if(isset($atts['id'])){
    	$args['p'] = $atts['id'];
  	}

  	$single_product = new WP_Query( $args );

  	ob_start();

	while ( $single_product->have_posts() ) : $single_product->the_post(); ?>

		<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>

	<?php endwhile; // end of the loop.

	wp_reset_query();

	return ob_get_clean();
}


/**
 * List products in a category shortcode
 **/
function etheme_woocommerce_product_category($atts){
	global $woocommerce_loop;

  	if (empty($atts)) return;

	extract(shortcode_atts(array(
		'limit' 		=> '12',
		'columns' 		=> '4',
	  	'orderby'   	=> 'title',
	  	'order'     	=> 'asc',
	  	'category'		=> ''
		), $atts));

	if ( ! $category ) return;

  	$args = array(
		'post_type'	=> 'product',
		'post_status' => 'publish',
		'ignore_sticky_posts'	=> 1,
		'orderby' => $orderby,
		'order' => $order,
		'posts_per_page' => $limit,
		'meta_query' => array(
			array(
				'key' => '_visibility',
				'value' => array('catalog', 'visible'),
				'compare' => 'IN'
			)
		),
		'tax_query' => array(
	    	array(
		    	'taxonomy' => 'product_cat',
				'terms' => array( esc_attr($category) ),
				'field' => 'slug',
				'operator' => 'IN'
			)
	    )
	);

  	ob_start();

	$products = new WP_Query( $args );

	$woocommerce_loop['columns'] = $columns;

	if ( $products->have_posts() ) : ?>

        <div id="products-grid" class="products_grid shortcode-products row rows-count<?php echo $columns ?>">
    		<?php while ( $products->have_posts() ) : $products->the_post(); ?>

    			<?php woocommerce_get_template_part( 'content', 'product' ); ?>

    		<?php endwhile; // end of the loop. ?>
		</div>
		<div class="clear"></div>
        <script type="text/javascript">imageTooltip(jQuery('.imageTooltip'))</script>

	<?php endif;

	wp_reset_query();

	return ob_get_clean();
}


/**
 * List all (or limited) product categories
 *
 */
function etheme_woocommerce_product_categories( $atts ) {
	global $woocommerce_loop;

	extract( shortcode_atts( array (
		'number'     => null,
		'orderby'    => 'name',
		'order'      => 'ASC',
		'columns' 	 => '4',
		'hide_empty' => 1,
		'parent'     => ''
		), $atts ) );

	if ( isset( $atts[ 'ids' ] ) ) {
		$ids = explode( ',', $atts[ 'ids' ] );
	  	$ids = array_map( 'trim', $ids );
	} else {
		$ids = array();
	}

	$hide_empty = ( $hide_empty == true || $hide_empty == 1 ) ? 1 : 0;

	// get terms and workaround WP bug with parents/pad counts
  	$args = array(
  		'orderby'    => $orderby,
  		'order'      => $order,
  		'hide_empty' => $hide_empty,
		'include'    => $ids,
		'pad_counts' => true,
		'child_of'   => $parent
	);

  	$product_categories = get_terms( 'product_cat', $args );

  	if ( $parent !== "" )
  		$product_categories = wp_list_filter( $product_categories, array( 'parent' => $parent ) );

  	if ( $number )
  		$product_categories = array_slice( $product_categories, 0, $number );

  	$woocommerce_loop['columns'] = $columns;

  	ob_start();

  	// Reset loop/columns globals when starting a new loop
	$woocommerce_loop['loop'] = $woocommerce_loop['column'] = '';

  	if ( $product_categories ) {

		foreach ( $product_categories as $category ) {

			woocommerce_get_template( 'content-product_cat.php', array(
				'category' => $category
			) );

		}

	}

	woocommerce_reset_loop();

	return '<div class="product-categories row-count'.$columns.'"">' . ob_get_clean() . '</div>';
}


/**
 * List all products on sale
 */
function etheme_woocommerce_sale_products( $atts ){
    global $woocommerce_loop, $woocommerce;

    extract( shortcode_atts( array(
        'limit'         => '12',
        'columns'       => '4',
        'orderby'       => 'title',
        'order'         => 'asc'
        ), $atts ) );

	// Get products on sale
	$product_ids_on_sale = woocommerce_get_product_ids_on_sale();

	$meta_query = array();
	$meta_query[] = $woocommerce->query->visibility_meta_query();
    $meta_query[] = $woocommerce->query->stock_status_meta_query();

	$args = array(
		'posts_per_page'=> $limit,
		'orderby' 		=> $orderby,
        'order' 		=> $order,
		'no_found_rows' => 1,
		'post_status' 	=> 'publish',
		'post_type' 	=> 'product',
		'meta_query' 	=> $meta_query,
		'post__in'		=> $product_ids_on_sale
	);

  	ob_start();

	$products = new WP_Query( $args );

	$woocommerce_loop['columns'] = $columns;

	if ( $products->have_posts() ) : ?>

        <div id="products-grid" class="products_grid shortcode-products row rows-count<?php echo $columns ?>">
    		<?php while ( $products->have_posts() ) : $products->the_post(); ?>

    			<?php woocommerce_get_template_part( 'content', 'product' ); ?>

    		<?php endwhile; // end of the loop. ?>
		</div>
		<div class="clear"></div>
        <script type="text/javascript">imageTooltip(jQuery('.imageTooltip'))</script>

	<?php endif;

	wp_reset_query();

	return ob_get_clean();
}


function etheme_woocommerce_best_selling_products( $atts ){
    global $woocommerce_loop;

    extract( shortcode_atts( array(
        'limit'         => '12',
        'columns'       => '4'
        ), $atts ) );

    $args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'ignore_sticky_posts'   => 1,
        'posts_per_page' => $limit,
        'meta_key' 		 => 'total_sales',
    	'orderby' 		 => 'meta_value',
        'meta_query' => array(
            array(
                'key' => '_visibility',
                'value' => array( 'catalog', 'visible' ),
                'compare' => 'IN'
            )
        )
    );

  	ob_start();

	$products = new WP_Query( $args );

	$woocommerce_loop['columns'] = $columns;

	if ( $products->have_posts() ) : ?>

        <div id="products-grid" class="products_grid shortcode-products row rows-count<?php echo $columns ?>">
    		<?php while ( $products->have_posts() ) : $products->the_post(); ?>

    			<?php woocommerce_get_template_part( 'content', 'product' ); ?>

    		<?php endwhile; // end of the loop. ?>
		</div>
		<div class="clear"></div>
        <script type="text/javascript">imageTooltip(jQuery('.imageTooltip'))</script>

	<?php endif;

	wp_reset_query();

	return ob_get_clean();
}




/**
 * Output featured products
 **/
function etheme_woocommerce_featured_products( $atts ) {

	global $woocommerce_loop;

	extract(shortcode_atts(array(
		'limit' 	=> '12',
		'columns' 	=> '4',
		'orderby' => 'date',
		'order' => 'desc'
	), $atts));

	$args = array(
		'post_type'	=> 'product',
		'post_status' => 'publish',
		'ignore_sticky_posts'	=> 1,
		'posts_per_page' => $limit,
		'orderby' => $orderby,
		'order' => $order,
		'meta_query' => array(
			array(
				'key' => '_visibility',
				'value' => array('catalog', 'visible'),
				'compare' => 'IN'
			),
			array(
				'key' => '_featured',
				'value' => 'yes'
			)
		)
	);

	ob_start();

	$products = new WP_Query( $args );

	$woocommerce_loop['columns'] = $columns;

	if ( $products->have_posts() ) : ?>

        <div id="products-grid" style="padding: 0;" class="products_grid shortcode-products row rows-count<?php echo $columns ?>">
    		<?php while ( $products->have_posts() ) : $products->the_post(); ?>

    			<?php woocommerce_get_template_part( 'content', 'product' ); ?>

    		<?php endwhile; // end of the loop. ?>
		</div>
		<div class="clear"></div>
        <script type="text/javascript">imageTooltip(jQuery('.imageTooltip'))</script>

	<?php endif;

	wp_reset_query();

	return ob_get_clean();
}


/**
 * Recent Products shortcode
 **/
function etheme_woocommerce_recent_products( $atts ) {

	global $woocommerce_loop;

	extract(shortcode_atts(array(
		'limit' 	=> '12',
		'columns' 	=> '4',
		'orderby' => 'date',
		'order' => 'desc'
	), $atts));

	$args = array(
		'post_type'	=> 'product',
		'post_status' => 'publish',
		'ignore_sticky_posts'	=> 1,
		'posts_per_page' => $limit,
		'orderby' => $orderby,
		'order' => $order,
		'meta_query' => array(
			array(
				'key' => '_visibility',
				'value' => array('catalog', 'visible'),
				'compare' => 'IN'
			)
		)
	);

	ob_start();

	$products = new WP_Query( $args );

	if ( $products->have_posts() ) : ?>

        <div id="products-grid" style="padding: 0;" class="products_grid shortcode-products row rows-count<?php echo $columns ?>">
    		<?php while ( $products->have_posts() ) : $products->the_post(); ?>

    			<?php woocommerce_get_template_part( 'content', 'product' ); ?>

    		<?php endwhile; // end of the loop. ?>
		</div>
		<div class="clear"></div>
        <script type="text/javascript">imageTooltip(jQuery('.imageTooltip'))</script>

	<?php endif;

	wp_reset_query();

	return ob_get_clean();
}


/**
 * Display a single prodcut price + cart button
 *
 * @access public
 * @param array $atts
 * @return string
 */
function etheme_product_add_to_cart( $atts ) {
  	if (empty($atts)) return;

  	global $wpdb, $woocommerce;

  	if (!isset($atts['style'])) $atts['style'] = '';

  	if ($atts['id']) :
  		$product_data = get_post( $atts['id'] );
	elseif ($atts['sku']) :
		$product_id = $wpdb->get_var($wpdb->prepare("SELECT post_id FROM $wpdb->postmeta WHERE meta_key='_sku' AND meta_value='%s' LIMIT 1", $atts['sku']));
		$product_data = get_post( $product_id );
	else :
		return;
	endif;

	if ($product_data->post_type=='product') {

		$product = $woocommerce->setup_product_data( $product_data );

		ob_start();
		?>
		<p class="product-add-to-cart" style="<?php echo $atts['style']; ?>">

			<?php echo $product->get_price_html(); ?>

			<?php woocommerce_template_loop_add_to_cart(); ?>

		</p><?php

		return ob_get_clean();

	} elseif ($product_data->post_type=='product_variation') {

		$product = new WC_Product( $product_data->post_parent );

		$GLOBALS['product'] = $product;

		$variation = new WC_Product_Variation( $product_data->ID );

		ob_start();
		?>
		<p class="product-add-to-cart product-variation" style="<?php echo $atts['style']; ?>">

			<?php echo $product->get_price_html(); ?>

			<?php

			$link 	= $product->add_to_cart_url();

			$label 	= apply_filters('add_to_cart_text', __('Add to cart', ETHEME_DOMAIN));

			$link = add_query_arg( 'variation_id', $variation->variation_id, $link );

			foreach ($variation->variation_data as $key => $data) {
				if ($data) $link = add_query_arg( $key, $data, $link );
			}

			printf('<a href="%s" rel="nofollow" data-product_id="%s" class="button add_to_cart_button product_type_%s">%s</a>', esc_url( $link ), $product->id, $product->product_type, $label);

			?>

		</p><?php

		return ob_get_clean();

	}
}



/**
 * Shortcode creation
 **/
add_shortcode('etheme_product', 'etheme_woocommerce_product');
add_shortcode('etheme_products', 'etheme_woocommerce_products');
add_shortcode('etheme_product_page', 'etheme_woocommerce_product_page_shortcode');
add_shortcode('etheme_product_category', 'etheme_woocommerce_product_category');
add_shortcode('etheme_product_categories', 'etheme_woocommerce_product_categories');
add_shortcode('etheme_bestsellers', 'etheme_woocommerce_best_selling_products');
add_shortcode('etheme_sale', 'etheme_woocommerce_sale_products');
add_shortcode('etheme_featured_products', 'etheme_woocommerce_featured_products');
add_shortcode('etheme_recent_products', 'etheme_woocommerce_recent_products');
add_shortcode('etheme_add_to_cart', 'etheme_product_add_to_cart');
