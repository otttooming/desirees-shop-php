<?php
global $etheme_theme_data;
$etheme_theme_data = wp_get_theme( get_stylesheet_directory() . '/style.css' );
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
				'40' 	=> __('40', 'woocommerce'),
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
    setcookie('shop_pageResults', $_POST['woocommerce-sort-by-columns'], time()+1209600, '/', 'www.spiceflow.net.ee', false); //this will fail if any part of page has been output- hope this works!
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


// Invoice number

add_filter( 'wpo_wcpdf_invoice_number', 'wpo_wcpdf_invoice_number', 10, 4 );

function wpo_wcpdf_invoice_number( $invoice_number, $order_number, $order_id, $order_date ) {
	$prefix = 'DES';
	$order_year = date_i18n( 'Y', strtotime( $order_date ) );
	$offset = 10000;
	$invoice_number = $prefix . $order_year . ($offset + $invoice_number);
	return $invoice_number;
}

// Woocom breadcrumbs

add_filter( 'woocommerce_breadcrumb_defaults', 'jk_woocommerce_breadcrumbs' );
function jk_woocommerce_breadcrumbs() {
    return array(
            'delimiter'   => '<span class="delimeter">/</span>',
            'wrap_before' => '<nav class="woocommerce-breadcrumb" itemprop="breadcrumb">',
            'wrap_after'  => '</nav>',
            'before'      => '<span class="current">',
            'after'       => '</span>',
            'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
        );
}

//Order of content elements

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 10 );


