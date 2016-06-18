<?php

add_shortcode('etheme_bestsellers', 'etheme_bestsellers_shortcodes');
function etheme_bestsellers_shortcodes($atts, $content=null){
	if ( !class_exists('WP_eCommerce') ) return false;
	extract(shortcode_atts(array(
		'image_width' => 215,
		'image_height' => 215,
        'title' => __('Bestsellers', ETHEME_DOMAIN)
	), $atts));
	global $wpdb;

    $sql = "select prodid, count(prodid) as prodnum from " . $wpdb->prefix. "wpsc_cart_contents group by prodid order by prodnum desc";
    $ids = $wpdb->get_results($sql);
	foreach( $ids as $id )
	$post_in[] = $id->prodid;
    $args = array(
    	'post_type'				=> 'wpsc-product',
    	'ignore_sticky_posts'	=> 1,
    	'no_found_rows' 		=> 1,
    	'posts_per_page' 		=> 20,
        'post__in'              => $post_in
    );

    ob_start();
    etheme_create_slider($args,$title, $image_width, $image_height);
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

add_shortcode('etheme_featured', 'etheme_featured_shortcodes');
function etheme_featured_shortcodes($atts, $content=null){
	global $wpdb;
	if ( !class_exists('Woocommerce') ) return false;

	extract(shortcode_atts(array(
		'image_width' => 215,
		'image_height' => 215,
        'limit' => 50,
        'categories' => '',
        'title' => __('Featured Products', ETHEME_DOMAIN)
	), $atts));

    $key = '_featured';

    $post_type = 'wpsc-product';
    if(class_exists('Woocommerce')) {
        $args = apply_filters('woocommerce_related_products_args', array(
        	'post_type'				=> 'product',
            'meta_key'              => $key,
            'meta_value'            => 'yes',
        	'ignore_sticky_posts'	=> 1,
        	'no_found_rows' 		=> 1,
        	'posts_per_page' 		=> $limit
        ) );
    }
      // Narrow by categories
      if ( $categories != '' ) {
          $categories = explode(",", $categories);
          $gc = array();
          foreach ( $categories as $grid_cat ) {
              array_push($gc, $grid_cat);
          }
          $gc = implode(",", $gc);
          ////http://snipplr.com/view/17434/wordpress-get-category-slug/
          $args['category_name'] = $gc;
          $pt = array('product');

          $taxonomies = get_taxonomies('', 'object');
          $args['tax_query'] = array('relation' => 'OR');
          foreach ( $taxonomies as $t ) {
              if ( in_array($t->object_type[0], $pt) ) {
                  $args['tax_query'][] = array(
                      'taxonomy' => $t->name,//$t->name,//'portfolio_category',
                      'terms' => $categories,
                      'field' => 'id',
                  );
              }
          }
      }

    ob_start();
    etheme_create_slider($args,$title, $image_width, $image_height);
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

add_shortcode('etheme_new', 'etheme_new_shortcodes');
function etheme_new_shortcodes($atts, $content=null){
	global $wpdb;
	if ( !class_exists('WP_eCommerce') && !class_exists('Woocommerce') ) return false;

	extract(shortcode_atts(array(
		'image_width' => 215,
		'image_height' => 215,
        'limit' => 50,
        'categories' => '',
        'title' => __('New Products', ETHEME_DOMAIN)
	), $atts));

    $key = '_etheme_new_label';

    $post_type = 'wpsc-product';
    if(class_exists('Woocommerce')) {
        $args = apply_filters('woocommerce_related_products_args', array(
        	'post_type'				=> 'product',
            'meta_key'              => $key,
            'meta_value'            => 1,
        	'ignore_sticky_posts'	=> 1,
        	'no_found_rows' 		=> 1,
        	'posts_per_page' 		=> $limit
        ) );
    }

    if (class_exists('WP_eCommerce')){
        $args = array(
        	'post_type'				=> 'wpsc-product',
            'meta_key'              => $key,
            'meta_value'            => 1,
        	'ignore_sticky_posts'	=> 1,
        	'no_found_rows' 		=> 1,
        	'posts_per_page' 		=> 20,
        	'orderby' 				=> $orderby
        );
    }

      // Narrow by categories
      if ( $categories != '' ) {
          $categories = explode(",", $categories);
          $gc = array();
          foreach ( $categories as $grid_cat ) {
              array_push($gc, $grid_cat);
          }
          $gc = implode(",", $gc);
          ////http://snipplr.com/view/17434/wordpress-get-category-slug/
          $args['category_name'] = $gc;
          $pt = array('product');

          $taxonomies = get_taxonomies('', 'object');
          $args['tax_query'] = array('relation' => 'OR');
          foreach ( $taxonomies as $t ) {
              if ( in_array($t->object_type[0], $pt) ) {
                  $args['tax_query'][] = array(
                      'taxonomy' => $t->name,//$t->name,//'portfolio_category',
                      'terms' => $categories,
                      'field' => 'id',
                  );
              }
          }
      }

    ob_start();
    etheme_create_slider($args,$title, $image_width, $image_height);
    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}

add_shortcode('template_url', 'etheme_template_url_shortcode');
function etheme_template_url_shortcode(){
    return get_template_directory_uri();
}

add_shortcode('base_url', 'etheme_base_url_shortcode');
function etheme_base_url_shortcode(){
    return home_url();
}

/** -------------------------------------------------
/*	Typography shortcodes
/* -------------------------------------------------- */

/**	Buttons */
add_shortcode('button', 'etheme_btn_shortcode');
function etheme_btn_shortcode($atts){
    $a = shortcode_atts( array(
       'title' => 'Button',
       'url' => '#',
       'style' => ''
   ), $atts );
    return '<a class="button ' . $a['style'] . '" href="' . $a['url'] . '"><span>' . $a['title'] . '</span></a>';
}

/**	Blockquote */
add_shortcode('blockquote', 'etheme_blockquote_shortcode');
function etheme_blockquote_shortcode($atts, $content = null) {
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

/**	Lists */
add_shortcode('list', 'etheme_list_shortcode');
function etheme_list_shortcode($atts, $content = null) {
    $a = shortcode_atts( array(
        'style' => 'icon'
    ), $atts);
    switch($a['style']) {
        case 'icon':
            $class = 'with-icons';
        break;
        case 'arrow':
            $class = 'arrow dotted';
        break;
        case 'arrow_2':
            $class = 'arrow-2 dotted';
        break;
        case 'circle':
            $class = 'circle dotted';
        break;
        case 'check':
            $class = 'check dotted';
        break;
        case 'square':
            $class = 'list-square dotted';
        break;
        case 'star':
            $class = 'star dotted';
        break;
        case 'plus':
            $class = 'plus dotted';
        break;
        case 'dash':
            $class = 'dash dotted';
        break;
        default:
            $class = 'circle dotted';
    }
    return '<ul class="' . $class . '">' . do_shortcode($content) . '</ul>';
}

add_shortcode('list_item', 'etheme_list_item_shortcode');
function etheme_list_item_shortcode($atts, $content = null) {
    $a = shortcode_atts( array(
        'icon' => ''
    ), $atts);
    $icon = '';
    if($a['icon'] != '') $icon = '<i class="' . $a['icon'] . '"></i> ';
    return '<li>' . $icon . $content . '</li>';
}

/**	checklist */
add_shortcode('checklist', 'etheme_checklist_shortcode');
function etheme_checklist_shortcode($atts, $content = null) {
    $a = shortcode_atts( array(
        'style' => 'icon'
    ), $atts);
    switch($a['style']) {
        case 'icon':
            $class = 'with-icons';
        break;
        case 'arrow':
            $class = 'arrow dotted';
        break;
        case 'arrow_2':
            $class = 'arrow-2 dotted';
        break;
        case 'circle':
            $class = 'circle dotted';
        break;
        case 'check':
            $class = 'check dotted';
        break;
        case 'square':
            $class = 'list-square dotted';
        break;
        case 'star':
            $class = 'star dotted';
        break;
        case 'plus':
            $class = 'plus dotted';
        break;
        case 'dash':
            $class = 'dash dotted';
        break;
        default:
            $class = 'circle dotted';
    }
    return '<div class="' . $class . '">' . do_shortcode($content) . '</div	>';
}

/**	Dropcap */
add_shortcode('dropcap', 'etheme_dropcap_shortcode');
function etheme_dropcap_shortcode($atts,$content=null){
    $a = shortcode_atts( array(
       'style' => ''
   ), $atts );

    return '<span class="dropcap ' . $a['style'] . '">' . $content . '</span>';
}

/**	Tooltip */
add_shortcode('tooltip', 'etheme_tooltip_shortcode');
function etheme_tooltip_shortcode($atts,$content=null){
    $a = shortcode_atts( array(
       'position' => 'top',
       'text' => '',
       'class' => '',
       'link' => '#'
   ), $atts );

    return '<a href="'.$a['link'].'" class="'.$a['class'].'" rel="tooltip" data-placement="'.$a['position'].'" data-original-title="'.$a['text'].'">'.$content.'</a>';
}

/**	information blocks */
add_shortcode('iblock', 'etheme_iblock_shortcode');
function etheme_iblock_shortcode($atts,$content=null){
    $a = shortcode_atts( array(
       'type' => 'wide',
       'class' => '',
       'effect' => '',
       'btn' => '',
       'src' => '',
       'link' => '#'
   ), $atts );

   $class = '';

   switch($a['type']){
        case 'wide':
            $class .= 'banner_top_bottom ';
        break;
        case 'banner':
            $class .= 'banner banner-transform ';
        break;
        default:
            $class .= 'banner_top_bottom';
   }

   $output = '';
    $output .= '<div class="'.$class . $a['class'] .' effect-'.$a['effect'].'">';
        if($a['type'] == 'banner'){
            $output .= '<img src="'.$a['src'].'"/><div class="mask">';
            $output .= do_shortcode($content);
            $output .= '</div>';
        }elseif($a['type'] == 'wide'){
            $output .= do_shortcode($content);
        }else{
            $output .= do_shortcode($content);
        }

        if($a['btn'] != ''){
            $output .= '<div class="banner_top_button">';
                $output .= '<a href="'. $a['link'] .'" class="active button medium"><span>'. $a['btn'] .'</span></a>';
            $output .= '</div>';
        }
    $output .= '</div>';
    return $output;
}

add_shortcode('callto', 'etheme_callto_shortcode');
function etheme_callto_shortcode($atts, $content = null) {
    $a = shortcode_atts( array(
        'title' => 'Call To Action',
        'btn' => '',
        'btn_position' => 'right',
        'link' => '',
        'class' => ''
    ), $atts);
    $btn = '';
    $title = '';
    if($a['title'] != '') {
        $title = '<h4>' . $a['title'] . '</h4>';
    }
    $btnClass = '';
    if ($a['btn_position'] == 'right') $btnClass .= 'fl-r';
    if($a['btn'] != '') {
        $btn = '<a href="'.$a['link'].'" class="button active '.$btnClass.'">' . $a['btn'] . '</a>';
    }

    $output = '';

    $output .= '<div class="cta-block '.$a['class'].'">'.$title.'<div class="row-fluid">';
        if($a['btn'] != '') {

                if ($a['btn_position'] == 'left') {
                    $output .= '<div class="span3">'.$btn.'</div>';
                }
                $output .= '<div class="span9">'. do_shortcode($content) .'</div>';

                if ($a['btn_position'] == 'right') {
                    $output .= '<div class="span3">'.$btn.'</div>';
                }

        } else{
            $output .= '<div class="span12">'. do_shortcode($content) .'</div>';
        }
    $output .= '</div></div>';

    return $output;
}

/**	Alert Boxes */
add_shortcode('alert', 'etheme_alert_shortcode');
function etheme_alert_shortcode($atts, $content = null) {
    $a = shortcode_atts( array(
        'type' => 'success',
        'title' => '',
        'close' => 1
    ), $atts);
    switch($a['type']) {
        case 'error':
            $class = 'error';
        break;
        case 'success':
            $class = 'success';
        break;
        case 'info':
            $class = 'info';
        break;
        case 'notice':
            $class = 'notice';
        break;
        default:
            $class = 'success';
    }
    $closeBtn = $title = '';
    if($a['close'] == 1){
        $closeBtn = '<span class="close-parent">close</span>';
    }

    if($a['title'] != '') {
	    $title = '<h3>'.$a['title'].'</h3>';
    }

    return '<div class="' . $class . '">' . $title . do_shortcode($content) . $closeBtn . '</div>';
}

/**	Columns */
add_shortcode('row', 'etheme_row_shortcode');
function etheme_row_shortcode($atts, $content = null) {
    $a = shortcode_atts( array(
        'class' => ''
    ), $atts);

    $content = wpautop(trim($content));
    return '<div class="row ' . $a['class'] . '">' . do_shortcode($content) . '</div>';
}

add_shortcode('column', 'etheme_column_shortcode');
function etheme_column_shortcode($atts, $content = null) {
    $a = shortcode_atts( array(
        'size' => 'one_half',
        'class' => '',
    ), $atts);
    switch($a['size']) {
        case 'one-half':
            $class = 'span6 ';
        break;
        case 'one-third':
            $class = 'span4 ';
        break;
        case 'two-third':
            $class = 'span8 ';
        break;
        case 'one-fourth':
            $class = 'span3 ';
        break;
        case 'three-fourth':
            $class = 'span9 ';
        break;
        default:
            $class = $a['size'];
        }

        $class .= $class.' '.$a['class'];

        $content = wpautop(trim($content));
        return '<div class="' . $class . '">' . do_shortcode($content) . '</div>';
}

/**	Tabs */
add_shortcode('tabs', 'etheme_tabs_shortcode');
function etheme_tabs_shortcode($atts, $content = null) {
    $a = shortcode_atts(array(
        'class' => ''
    ), $atts);
    return '<div class="tabs '.$a['class'].'">' . do_shortcode($content) . '</div>';
}

add_shortcode('tab', 'etheme_tab_shortcode');
function etheme_tab_shortcode($atts, $content = null) {
	global $tab_count;
    $a = shortcode_atts(array(
        'title' => 'Tab',
        'class' => '',
        'active' => 0
    ), $atts);

    $class = $a['class'];
    $style = '';

    if ($a['active'] == 1)  {
        $style = ' style="display: block;"';
        $class .= 'opened';
    }

    $tab_count++;

    return '<a href="#tab_'.$tab_count.'" id="tab_'.$tab_count.'" class="tab-title ' . $class . '">' . $a['title'] . '</a><div id="content_tab_'.$tab_count.'" class="tab-content" ' . $style . '>' . do_shortcode($content) . '</div>';
}

/** icon */
add_shortcode('icon', 'etheme_icon_shortcode');
function etheme_icon_shortcode($atts, $content = null) {
$a = shortcode_atts(array(
        'name' => 'icon-circle-blank',
        'size' => '',
        'style' => '',
        'color' => ''
    ), $atts);

    return '<i class="'.$a['name'].'" style="color:#'.$a['color'].'; font-size:'.$a['size'].'px; '.$a['style'].'"></i>';
}

/** image */
add_shortcode('image', 'etheme_image_shortcode');
function etheme_image_shortcode($atts, $content = null) {
$a = shortcode_atts(array(
        'src' => '',
        'alt' => '',
        'height' => '',
        'width' => '',
        'class' => ''
    ), $atts);

    return '<img src="'.$a['src'].'" alt="'.$a['alt'].'" height="'.$a['height'].'" width="'.$a['width'].'" class="'.$a['class'].'" />';
}

/** Team Member Block */
add_shortcode('team_member', 'etheme_team_member_shortcode');
function etheme_team_member_shortcode($atts, $content = null) {
$a = shortcode_atts(array(
        'class' => 'span4',
        'name' => '',
        'position' => '',
        'img' => ''
    ), $atts);

    $html = '';
    $html .= '<div class="team-member '.$a['class'].'">';
	    if($a['img'] != ''){
		    $html .= '<img src="'.do_shortcode($a['img']).'" />';
	    }

    	$html .= '<div class="member-details">';
		    if($a['name'] != ''){
			    $html .= '<h5>'.$a['position'].'</h5>';
		    }
		    if($a['position'] != ''){
			    $html .= '<h3>'.$a['name'].'</h3>';
		    }
		    $html .= do_shortcode($content);
    	$html .= '</div>';
    $html .= '</div>';


    return $html;
}

/** Progress Bar */
add_shortcode('progress','etheme_progress_shortcode');
function etheme_progress_shortcode($atts) {
	$a = shortcode_atts(array(
		'complete' => '',
		'title'    => ''
	),$atts);

	if($a['complete'] > 100) {
		$a['complete'] = 100;
	}elseif($a['complete'] < 0) {
		$a['complete'] = 0;
	}

	return '<div class="progress-bar" data-width="'.$a['complete'].'"><span>'.$a['title'].'</span><div></div></div>';
}


/** Pricing Tables */
add_shortcode('ptable','etheme_ptable_shortcode');
function etheme_ptable_shortcode($atts, $content = null) {

	return '<ul class="p-table span3">'.do_shortcode($content).'</ul>';
}

add_shortcode('prow','etheme_prow_shortcode');
function etheme_prow_shortcode($atts, $content = null) {
	return '<li class="p-table-row">'.$content.'</li>';
}

add_shortcode('phrow','etheme_phrow_shortcode');
function etheme_phrow_shortcode($atts, $content = null) {
	return '<li class="p-table-head">'.$content.'</li>';
}

add_shortcode('rowprice','etheme_rowprice_shortcode');
function etheme_rowprice_shortcode($atts, $content = null) {
	$a = shortcode_atts(array(
		'value' => '20,99',
		'curr' => '$',
		'period' => 'mo'
	),$atts);

	$price = explode(',', $a['value']);

	return '<li class="p-table-price"><span>'.$a['curr'].'</span> '.$price[0].'<span>'.$price[1].'</span><small>'.$a['period'].'</small></li>';
}

/* Add Shortcodes Buttons to editor */
function etheme_add_shortcodes_buttons() {
   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
     return;
   if ( get_user_option('rich_editing') == 'true') {
     add_filter('mce_external_plugins', 'shortcodes_tinymce_plugin');
     add_filter('mce_buttons_3', 'register_shortcodes_button');
   }
}

function etheme_add_shortcodes_buttons2() {
   if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
     return;
   if ( get_user_option('rich_editing') == 'true') {
     add_filter('mce_external_plugins', 'shortcodes_tinymce_plugin2');
     add_filter('mce_buttons_4', 'register_shortcodes_button2');
   }
}

add_action('init', 'etheme_add_shortcodes_buttons');
add_action('init', 'etheme_add_shortcodes_buttons2');

function register_shortcodes_button($buttons) {
   array_push($buttons, "et_featured", "et_new_products", "et_contacts", "et_button", "et_blockquote", "et_list", "eth_dropcap", "et_tooltip", "et_iblock", "et_alert", "et_progress", "et_ptable");
   return $buttons;
}

function shortcodes_tinymce_plugin($plugin_array) {
   if(class_exists('WooCommerce')){
	   $plugin_array['et_featured'] = get_bloginfo('template_url').'/code/js/editor_plugin.js';
	   $plugin_array['et_new_products'] = get_bloginfo('template_url').'/code/js/editor_plugin.js';
   }
   $plugin_array['et_contacts'] = get_bloginfo('template_url').'/code/js/editor_plugin.js';
   $plugin_array['et_button'] = get_bloginfo('template_url').'/code/js/editor_plugin.js';
   $plugin_array['et_blockquote'] = get_bloginfo('template_url').'/code/js/editor_plugin.js';
   $plugin_array['et_list'] = get_bloginfo('template_url').'/code/js/editor_plugin.js';
   $plugin_array['eth_dropcap'] = get_bloginfo('template_url').'/code/js/editor_plugin.js';
   $plugin_array['et_tooltip'] = get_bloginfo('template_url').'/code/js/editor_plugin.js';
   $plugin_array['et_iblock'] = get_bloginfo('template_url').'/code/js/editor_plugin.js';
   $plugin_array['et_alert'] = get_bloginfo('template_url').'/code/js/editor_plugin.js';
   $plugin_array['et_progress'] = get_bloginfo('template_url').'/code/js/editor_plugin.js';
   $plugin_array['et_ptable'] = get_bloginfo('template_url').'/code/js/editor_plugin.js';
   return $plugin_array;
}

function register_shortcodes_button2($buttons) {
	array_push(
	$buttons,
	"et_row",
	"et_column1_2",
	"et_column1_3",
	"et_column1_4",
	"et_column3_4",
	"et_column2_3",
	"et_tabs",
	"et_icon",
	"et_tm");
	return $buttons;
}

function shortcodes_tinymce_plugin2($plugin_array) {
   $plugin_array['et_row'] = get_bloginfo('template_url').'/code/js/editor_plugin.js';
   $plugin_array['et_column1_2'] = get_bloginfo('template_url').'/code/js/editor_plugin.js';
   $plugin_array['et_column1_3'] = get_bloginfo('template_url').'/code/js/editor_plugin.js';
   $plugin_array['et_column2_3'] = get_bloginfo('template_url').'/code/js/editor_plugin.js';
   $plugin_array['et_column1_4'] = get_bloginfo('template_url').'/code/js/editor_plugin.js';
   $plugin_array['et_column3_4'] = get_bloginfo('template_url').'/code/js/editor_plugin.js';
   $plugin_array['et_tabs'] = get_bloginfo('template_url').'/code/js/editor_plugin.js';
   $plugin_array['et_icon'] = get_bloginfo('template_url').'/code/js/editor_plugin.js';
   $plugin_array['et_tm'] = get_bloginfo('template_url').'/code/js/editor_plugin.js';
   return $plugin_array;
}

function etheme_refresh_mce($ver) {
  $ver += 3;
  return $ver;
}

add_filter( 'tiny_mce_version', 'etheme_refresh_mce');

?>
