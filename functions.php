<?php
global $etheme_theme_data;
$etheme_theme_data = wp_get_theme( 'idstore' );
define('ETHEME_DOMAIN', 'idstore');
define('ETHEME_OPTIONS', 'site_basic_options');
require_once( get_template_directory() . '/code/init.php' );




function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);
  $content = strip_tags($content, '<p>');

  return $content;
}


// User selects how many products to view per page
// via http://designloud.com/how-to-add-products-per-page-dropdown-to-woocommerce/
function woocommerce_catalog_page_ordering() {
?>
<form class="woocommerce-ordering" action="" method="POST" name="results">
<select name="woocommerce-sort-by-columns" id="woocommerce-sort-by-columns" class="sortby" onchange="this.form.submit()">
<?php

		//  This is where you can change the amounts per page that the user will use  feel free to change the numbers and text as you want, in my case we had 4 products per row so I chose to have multiples of four for the user to select.
			$shopCatalog_orderby = apply_filters('woocommerce_sortby_page', array(
				'24' 	=> __('24', 'woocommerce'),
				'64' 		=> __('64', 'woocommerce'),
				'128' 		=> __('128', 'woocommerce'),
			));

			foreach ( $shopCatalog_orderby as $sort_id => $sort_name )
				echo '<option value="' . $sort_id . '" ' . selected( $_SESSION['sortby'], $sort_id, false ) . ' >' . $sort_name . '</option>';
		?>
</select>

</form>
<?php   // Adrian's code
	if (isset($_POST['woocommerce-sort-by-columns']) && (($_COOKIE['shop_pageResults'] <> $_POST['woocommerce-sort-by-columns']))) {
	$currentProductsPerPage = $_POST['woocommerce-sort-by-columns'];
	} else {
	$currentProductsPerPage = $_COOKIE['shop_pageResults'];
	}
	?>
    <script type="text/javascript">
         jQuery('select.sortby>option[value="<?php echo $currentProductsPerPage; ?>"]').attr('selected', true);
    </script>
<?php
}

// now we set our cookie if we need to
function dl_sort_by_page($count) {
  if (isset($_COOKIE['shop_pageResults'])) { // if normal page load with cookie
     $count = $_COOKIE['shop_pageResults'];
  }
  if (isset($_POST['woocommerce-sort-by-columns'])) { //if form submitted
    setcookie('shop_pageResults', $_POST['woocommerce-sort-by-columns'], time()+1209600, '/', 'www.desirees.ee', false); //this will fail if any part of page has been output- hope this works!
    $count = $_POST['woocommerce-sort-by-columns'];
  }
  // else normal page load and no cookie
  return $count;
}

add_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_page_ordering', 20 );
add_filter('loop_shop_per_page','dl_sort_by_page');


// Remove Reviews tab

add_filter( 'woocommerce_product_tabs', 'sb_woo_remove_reviews_tab', 98);
function sb_woo_remove_reviews_tab($tabs) {

 unset($tabs['reviews']);

 return $tabs;
}



//Order of content elements

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 10 );


//Minium order amount

add_action( 'woocommerce_checkout_process', 'wc_minimum_order_amount' );
add_action( 'woocommerce_before_cart' , 'wc_minimum_order_amount' );

function wc_minimum_order_amount() {
	// Set this variable to specify a minimum order value
	$minimum = 15;

	if ( WC()->cart->total < $minimum ) {

		if( is_cart() ) {

			wc_print_notice(
				sprintf( 'Miinimum tellimuse suurus on %s , teie praegune ostu summa on %s.' ,
					woocommerce_price( $minimum ),
					woocommerce_price( WC()->cart->total )
				), 'error'
			);

		} else {

			wc_add_notice(
				sprintf( 'Miinimum tellimuse suurus on %s , teie praegune ostu summa on %s.' ,
					woocommerce_price( $minimum ),
					woocommerce_price( WC()->cart->total )
				), 'error'
			);

		}
	}

}


//WP hide update nag
add_action('admin_menu','wphidenag');
function wphidenag() {
remove_action( 'admin_notices', 'update_nag', 3 );
}
