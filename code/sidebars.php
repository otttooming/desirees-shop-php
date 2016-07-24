<?php
/* Functions for unlimited sidebars */

/**
*
*	Function for adding sidebar (AJAX action)
*/

function etheme_add_sidebar(){
	if (!wp_verify_nonce($_GET['_wpnonce_etheme_widgets'],'etheme-add-sidebar-widgets') ) die( 'Security check' );
	if($_GET['etheme_sidebar_name'] == '') die('Empty Name');
	$option_name = 'etheme_custom_sidebars';
	if(!get_option($option_name) || get_option($option_name) == '') delete_option($option_name);

	$new_sidebar = $_GET['etheme_sidebar_name'];


	if(get_option($option_name)) {
		$et_custom_sidebars = etheme_get_stored_sidebar();
		$et_custom_sidebars[] = trim($new_sidebar);
		$result = update_option($option_name, $et_custom_sidebars);
	}else{
		$et_custom_sidebars[] = $new_sidebar;
		$result2 = add_option($option_name, $et_custom_sidebars);
	}


	if($result) die('Updated');
	elseif($result2) die('added');
	else die('error');
}

/**
*
*	Function for deleting sidebar (AJAX action)
*/

function etheme_delete_sidebar(){
	$option_name = 'etheme_custom_sidebars';
	$del_sidebar = trim($_GET['etheme_sidebar_name']);

	if(get_option($option_name)) {
		$et_custom_sidebars = etheme_get_stored_sidebar();

		foreach($et_custom_sidebars as $key => $value){
			if($value == $del_sidebar)
				unset($et_custom_sidebars[$key]);
		}


		$result = update_option($option_name, $et_custom_sidebars);
	}

	if($result) die('Deleted');
	else die('error');
}

/**
*
*	Function for registering previously stored sidebars
*/
function etheme_register_stored_sidebar(){
	$et_custom_sidebars = etheme_get_stored_sidebar();
	if(is_array($et_custom_sidebars)) {
		foreach($et_custom_sidebars as $name){
			register_sidebar( array(
				'name' => ''.$name.'',
				'id' => $name,
				'class' => 'etheme_custom_sidebar',
				'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			) );
		}
	}

}

/**
*
*	Function gets stored sidebar array
*/
function etheme_get_stored_sidebar(){
	$option_name = 'etheme_custom_sidebars';
	return get_option($option_name);
}


/**
*
*	Add form after all widgets
*/
function etheme_sidebar_form(){
	?>

	<form action="<?php echo admin_url( 'widgets.php' ); ?>" method="post" id="etheme_add_sidebar_form">
		<h2>Custom Sidebar</h2>
		<?php wp_nonce_field( 'etheme-add-sidebar-widgets', '_wpnonce_etheme_widgets', false ); ?>
		<input type="text" name="etheme_sidebar_name" id="etheme_sidebar_name" />
		<button type="submit" class="button-primary" value="add-sidebar">Add Sidebar</button>
	</form>
	<script type="text/javascript">
		var sidebarForm = jQuery('#etheme_add_sidebar_form');
		var sidebarFormNew = sidebarForm.clone();
		sidebarForm.remove();
		jQuery('#widgets-right').append(sidebarFormNew);

		sidebarFormNew.submit(function(e){
			e.preventDefault();
			var data =  {
				'action':'etheme_add_sidebar',
				'_wpnonce_etheme_widgets': jQuery('#_wpnonce_etheme_widgets').val(),
				'etheme_sidebar_name': jQuery('#etheme_sidebar_name').val(),
			};
			//console.log(data);
			jQuery.ajax({
				url: ajaxurl,
				data: data,
				success: function(response){
					console.log(response);
					window.location.reload(true);

				},
				error: function(data) {
					console.log('error');

				}
			});
		});

	</script>
	<?php
}

add_action( 'sidebar_admin_page', 'etheme_sidebar_form', 30 );
add_action('wp_ajax_etheme_add_sidebar', 'etheme_add_sidebar');
add_action('wp_ajax_etheme_delete_sidebar', 'etheme_delete_sidebar');
add_action( 'widgets_init', 'etheme_register_stored_sidebar' );



/* Get page sidebar position */

function etheme_get_page_sidebar($blog = false) {

	$result = array(
		'position' => '',
		'responsive' => '',
		'sidebarname' => ''
	);


	$result['responsive'] = etheme_get_option('blog_sidebar_responsive');
	$result['position'] = etheme_get_option('blog_sidebar');
	$page_sidebar_state = etheme_get_custom_field('sidebar_state', $blog);
	$widgetarea = etheme_get_custom_field('widget_area', $blog);

	if($widgetarea != '') {
		$result['sidebarname'] = 'custom';
	}
	if($page_sidebar_state != '') {
		$result['position'] = $page_sidebar_state;
	}
	if($result['position'] == 'no_sidebar') $result['position'] = false;

	return $result;

}
