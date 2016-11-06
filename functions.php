<?php
/**
 * Desirees engine room
 *
 * @package desirees
 */

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
   add_theme_support( 'woocommerce' );
}

/**
* Dequeue assets
*/
require get_template_directory() . '/inc/func/dequeue.php';

/**
* Enqueue assets
*/
require get_template_directory() . '/inc/func/enqueue.php';

/**
* Theme options
*/
require get_template_directory() . '/inc/func/options.php';

/**
* Widgets
*/
require get_template_directory() . '/inc/func/widgets.php';

/**
* Shortcodes
*/
require get_template_directory() . '/inc/func/shortcodes.php';

/**
* Breadcrumbs
*/
require get_template_directory() . '/inc/func/breadcrumbs.php';

/**
* Price
*/
require get_template_directory() . '/inc/func/price.php';

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


remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
add_action( 'desirees_after_product_loop_images_wrap', 'woocommerce_template_loop_price', 11 );


function wc_authenticate_alter(){
    //return wp_get_current_user();
    if( 'GET' ==  WC()->api->server->method ){
        return new WP_User( 1 );
    } else {
        throw new Exception( __( 'You dont have permission', 'woocommerce' ), 401 );
    }
}

add_filter( 'woocommerce_api_check_authentication', 'wc_authenticate_alter', 1 );

add_theme_support( 'custom-logo' );

function theme_prefix_setup() {

	add_theme_support( 'custom-logo', array(
		'height'      => 160,
		'width'       => 430,
		'flex-width' => true,
	) );

}
add_action( 'after_setup_theme', 'theme_prefix_setup' );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

add_action( 'desirees_after_product_details_wrap', 'woocommerce_template_single_meta', 11 );

/**
 * Generated by the WordPress Meta Box Generator at http://goo.gl/8nwllb
 */
class Rational_Meta_Box {
	private $screens = array(
		'page',
	);
	private $fields = array(
		array(
			'id' => 'logo',
			'label' => 'logo',
			'type' => 'media',
		),
		array(
			'id' => 'logo2',
			'label' => 'logo2',
			'type' => 'media',
		),
		array(
			'id' => 'text',
			'label' => 'text',
			'type' => 'text',
		),
		array(
			'id' => 'text2',
			'label' => 'text2',
			'type' => 'text',
		),
		array(
			'id' => 'textarea',
			'label' => 'textarea',
			'type' => 'textarea',
		),
	);

	/**
	 * Class construct method. Adds actions to their respective WordPress hooks.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'admin_footer', array( $this, 'admin_footer' ) );
		add_action( 'save_post', array( $this, 'save_post' ) );
	}

	/**
	 * Hooks into WordPress' add_meta_boxes function.
	 * Goes through screens (post types) and adds the meta box.
	 */
	public function add_meta_boxes() {


    global $post;
    if(!empty($post)) {
        $pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);

        if($pageTemplate == 'frontpage.php' ) {
          foreach ( $this->screens as $screen ) {
      			add_meta_box(
      				'landing-page',
      				__( 'Landing page', 'desirees' ),
      				array( $this, 'add_meta_box_callback' ),
      				$screen,
      				'advanced',
      				'default'
      			);
      		}
        }
    }
	}

	/**
	 * Generates the HTML for the meta box
	 *
	 * @param object $post WordPress post object
	 */
	public function add_meta_box_callback( $post ) {
		wp_nonce_field( 'landing_page_data', 'landing_page_nonce' );
		$this->generate_fields( $post );
	}

	/**
	 * Hooks into WordPress' admin_footer function.
	 * Adds scripts for media uploader.
	 */
	public function admin_footer() {
		?><script>
			// https://codestag.com/how-to-use-wordpress-3-5-media-uploader-in-theme-options/
			jQuery(document).ready(function($){
				if ( typeof wp.media !== 'undefined' ) {
					var _custom_media = true,
					_orig_send_attachment = wp.media.editor.send.attachment;
					$('.rational-metabox-media').click(function(e) {
						var send_attachment_bkp = wp.media.editor.send.attachment;
						var button = $(this);
						var id = button.attr('id').replace('_button', '');
						_custom_media = true;
							wp.media.editor.send.attachment = function(props, attachment){
							if ( _custom_media ) {
								$("#"+id).val(attachment.url);
							} else {
								return _orig_send_attachment.apply( this, [props, attachment] );
							};
						}
						wp.media.editor.open(button);
						return false;
					});
					$('.add_media').on('click', function(){
						_custom_media = false;
					});
				}
			});
		</script><?php
	}

	/**
	 * Generates the field's HTML for the meta box.
	 */
	public function generate_fields( $post ) {
		$output = '';
		foreach ( $this->fields as $field ) {
			$label = '<label for="' . $field['id'] . '">' . $field['label'] . '</label>';
			$db_value = get_post_meta( $post->ID, 'landing_page_' . $field['id'], true );
			switch ( $field['type'] ) {
				case 'media':
					$input = sprintf(
						'<input class="regular-text" id="%s" name="%s" type="text" value="%s"> <input class="button rational-metabox-media" id="%s_button" name="%s_button" type="button" value="Upload" />',
						$field['id'],
						$field['id'],
						$db_value,
						$field['id'],
						$field['id']
					);
					break;
				case 'textarea':
					$input = sprintf(
						'<textarea class="large-text" id="%s" name="%s" rows="5">%s</textarea>',
						$field['id'],
						$field['id'],
						$db_value
					);
					break;
				default:
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s">',
						$field['type'] !== 'color' ? 'class="regular-text"' : '',
						$field['id'],
						$field['id'],
						$field['type'],
						$db_value
					);
			}
			$output .= $this->row_format( $label, $input );
		}
		echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
	}

	/**
	 * Generates the HTML for table rows.
	 */
	public function row_format( $label, $input ) {
		return sprintf(
			'<tr><th scope="row">%s</th><td>%s</td></tr>',
			$label,
			$input
		);
	}
	/**
	 * Hooks into WordPress' save_post function
	 */
	public function save_post( $post_id ) {
		if ( ! isset( $_POST['landing_page_nonce'] ) )
			return $post_id;

		$nonce = $_POST['landing_page_nonce'];
		if ( !wp_verify_nonce( $nonce, 'landing_page_data' ) )
			return $post_id;

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;

		foreach ( $this->fields as $field ) {
			if ( isset( $_POST[ $field['id'] ] ) ) {
				switch ( $field['type'] ) {
					case 'email':
						$_POST[ $field['id'] ] = sanitize_email( $_POST[ $field['id'] ] );
						break;
					case 'text':
						$_POST[ $field['id'] ] = sanitize_text_field( $_POST[ $field['id'] ] );
						break;
				}
				update_post_meta( $post_id, 'landing_page_' . $field['id'], $_POST[ $field['id'] ] );
			} else if ( $field['type'] === 'checkbox' ) {
				update_post_meta( $post_id, 'landing_page_' . $field['id'], '0' );
			}
		}
	}
}
new Rational_Meta_Box;
