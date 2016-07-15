<?php
/**
 * Desirees engine room
 *
 * @package desirees
 */


/**
* Dequeue assets
*/
require get_template_directory() . '/inc/func/dequeue.php';

/**
* Enqueue assets
*/
require get_template_directory() . '/inc/func/enqueue.php';

 
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
  /**
   * User selectable products per page
   */
  ?>
    <form class="woocommerce-ordering" action="" method="POST" name="results">
    <select name="woocommerce-sortby-columns" id="woocommerce-sortby-columns" class="woocommerce-sortby" onchange="this.form.submit()">
  <?php
    $shopCatalog_orderby = apply_filters('woocommerce_sortby_page', array(
      '24' 	=> __('24', 'woocommerce'),
      '64' 	=> __('64', 'woocommerce'),
      '128' => __('128', 'woocommerce'),
    ));
    
    $is_selected = isset($_SESSION['woocommerce-sortby']) ? $_SESSION['woocommerce-sortby'] : '';

    foreach ( $shopCatalog_orderby as $sort_id => $sort_name )
      echo '<option value="' . $sort_id . '" ' . selected( $is_selected, $sort_id, false ) . ' >' . $sort_name . '</option>';
  ?>
    </select>
    </form>

  <?php
    if (isset($_POST['woocommerce-sortby-columns']) && (isset($_COOKIE['wc_sortbyValue']) || isset($_POST['woocommerce-sortby-columns']))) {
      $currentProductsPerPage = $_POST['woocommerce-sortby-columns'];
    } else if (isset($_COOKIE['wc_sortbyValue'])) {
      $currentProductsPerPage = $_COOKIE['wc_sortbyValue'];
    } else {
      $currentProductsPerPage = '24';
    }
  ?>

  <?php
      if ($currentProductsPerPage != '') {
        echo '
        <script type="text/javascript">
            document.querySelector("select.woocommerce-sortby>option[value=\''. $currentProductsPerPage . '\']").setAttribute("selected", true);
        </script>
        ';
      }
      ?>
  <?php
}
add_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_page_ordering', 20 );

/**
 * Return selected sortby value from cookie to loop
 */
function woocommerce_sortby_value_save( $count ) {
	$main_site_url = home_url( '', 'relative' );
	$cookie_retention_time = ( 14 * 24 * 60 * 60 );

	if (isset($_COOKIE['wc_sortbyValue'])) {
		$count = $_COOKIE['wc_sortbyValue'];
	}
	if (isset($_POST['woocommerce-sortby-columns'])) {
		setcookie('wc_sortbyValue', $_POST['woocommerce-sortby-columns'], time() + $cookie_retention_time, '/', $main_site_url, false);
		$count = $_POST['woocommerce-sortby-columns'];
	}
	return $count;
}
add_filter( 'loop_shop_per_page', 'woocommerce_sortby_value_save' );



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

// Remove a top level admin menu.
// https://codex.wordpress.org/Function_Reference/remove_menu_page
function remove_menus(){

  // remove_menu_page( 'index.php' );                  //Dashboard
  // remove_menu_page( 'jetpack' );                    //Jetpack*
  remove_menu_page( 'edit.php' );                   //Posts
  // remove_menu_page( 'upload.php' );                 //Media
  // remove_menu_page( 'edit.php?post_type=page' );    //Pages
  remove_menu_page( 'edit-comments.php' );          //Comments
  // remove_menu_page( 'themes.php' );                 //Appearance
  // remove_menu_page( 'plugins.php' );                //Plugins
  // remove_menu_page( 'users.php' );                  //Users
  remove_menu_page( 'tools.php' );                  //Tools
  // remove_menu_page( 'options-general.php' );        //Settings

}
add_action( 'admin_menu', 'remove_menus' );
