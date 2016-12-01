<?php

/**
 * Call a shortcode function by tag name.
 *
 * @since  1.4.6
 *
 * @param string $tag     The shortcode whose function to call.
 * @param array  $atts    The attributes to pass to the shortcode function. Optional.
 * @param array  $content The shortcode's content. Default is null (none).
 *
 * @return string|bool False on failure, the result of the shortcode on success.
 */
function desirees_do_shortcode( $tag, array $atts = array(), $content = null ) {
	global $shortcode_tags;
	if ( ! isset( $shortcode_tags[ $tag ] ) ) {
		return false;
	}
	return call_user_func( $shortcode_tags[ $tag ], $atts, $content, $tag );
}

if ( ! function_exists( 'desirees_best_selling_products' ) ) {
	/**
	 * Display Best Selling Products
	 * Hooked into the `homepage` action in the homepage template
	 *
	 * @since 2.0.0
	 * @param array $args the product section args.
	 * @return void
	 */
	 function desirees_best_selling_products_function($atts) {
	     global $woocommerce_loop, $woocommerce;

	     extract(shortcode_atts(array(
	         'per_page'  => '12',
	         'columns'   => '4',
	         'orderby' => 'date',
	         'order' => 'desc'
	     ), $atts));

	     $meta_query = $woocommerce->query->get_meta_query();

	     $args = array(
	         'post_type' => 'product',
	         'post_status' => 'publish',
	         'ignore_sticky_posts'   => 1,
	         'posts_per_page' => $per_page,
	         'orderby' => $orderby,
	         'order' => $order,
	         'meta_query' => $meta_query
	     );

	     ob_start();

	     $products = new WP_Query( $args );

	     $woocommerce_loop['columns'] = $columns;

	     if ( $products->have_posts() ) : ?>


         <?php while ( $products->have_posts() ) : $products->the_post(); ?>

             <?php woocommerce_get_template_part( 'content', 'product' ); ?>

         <?php endwhile; // end of the loop. ?>


	     <?php endif;

	     wp_reset_postdata();

	     return '<div class="products-listing">' . ob_get_clean() . '</div>';
	  }
	  add_shortcode('desirees_best_selling_products','desirees_best_selling_products_function');
}

/** Progress Bar */
function desirees_progress_shortcode($atts) {
	$a = shortcode_atts(array(
		'complete' => '',
		'title'    => ''
	),$atts);

	if($a['complete'] > 100) {
		$a['complete'] = 100;
	}elseif($a['complete'] < 0) {
		$a['complete'] = 0;
	}

	return '
		<div class="progress-bar">
		  <div class="progress-bar__inner" data-name="'.$a['title'].'" data-percent="'.$a['complete'].'%">
				<svg viewBox="-10 -10 220 220">
			    <g fill="none" stroke-width="3" transform="translate(100,100)">
			      <path d="M 0,-100 A 100,100 0 0,1 86.6,-50"/>
			      <path d="M 86.6,-50 A 100,100 0 0,1 86.6,50"/>
			      <path d="M 86.6,50 A 100,100 0 0,1 0,100"/>
			      <path d="M 0,100 A 100,100 0 0,1 -86.6,50"/>
			      <path d="M -86.6,50 A 100,100 0 0,1 -86.6,-50"/>
			      <path d="M -86.6,-50 A 100,100 0 0,1 0,-100"/>
			    </g>
			    </svg>
					<svg viewBox="-10 -10 220 220">
			    	<path d="M200,100 C200,44.771525 155.228475,0 100,0 C44.771525,0 0,44.771525 0,100 C0,155.228475 44.771525,200 100,200 C155.228475,200 200,155.228475 200,100 Z" stroke-dashoffset="'.$a['complete'] * 2 * M_PI .'"></path>
			    </svg>
				</div>
		</div>
	';
}

add_shortcode('progress','desirees_progress_shortcode');


/**	Blockquote */
function desirees_blockquote_shortcode($atts, $content = null) {
    $a = shortcode_atts( array(
        'align' => 'left'
    ), $atts);
    switch($a['align']) {
        case 'right':
            $align = 'fl-r';
        break;
        case 'center':
            $align = 'fl-none';
        break;
        default:
            $align = 'fl-l';
    }
    $content = wpautop(trim($content));
    return '<blockquote class="' . $align . '">' . $content . '</blockquote>';
}
add_shortcode('blockquote', 'desirees_blockquote_shortcode');

?>
