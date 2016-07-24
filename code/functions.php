<?php
/**
 * Load option tree plugin
 */

add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_show_new_layout', '__return_false' );
add_filter( 'ot_theme_mode', '__return_true' );
load_template( trailingslashit( get_template_directory() ) . 'option-tree/ot-loader.php' );

add_theme_support('woocommerce');

register_nav_menu('top', 'Top Navigation');

function remove_loop_button(){
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	remove_action( 'woocommerce_simple_add_to_cart', 'woocommerce_simple_add_to_cart', 30 );
	remove_action( 'woocommerce_grouped_add_to_cart', 'woocommerce_grouped_add_to_cart', 30 );
	remove_action( 'woocommerce_variable_add_to_cart', 'woocommerce_variable_add_to_cart', 30 );
	remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );
}

if (!isset( $content_width )) $content_width = 920;

function etheme_enqueue_styles() {

    if ( !is_admin() ) {
        // wp_enqueue_style("bootstrap",get_template_directory_uri().'/css/bootstrap.css');
        // wp_enqueue_style("style",get_stylesheet_directory_uri().'/style.css');
        // wp_enqueue_style("bootstrap-responsive",get_template_directory_uri().'/css/bootstrap-responsive.css');
        // wp_enqueue_style("responsive",get_template_directory_uri().'/css/responsive.css');
        // wp_enqueue_style("slider",get_template_directory_uri().'/css/slider.css');
        // wp_enqueue_style("font-awesome",get_template_directory_uri().'/css/font-awesome.min.css');
        // wp_enqueue_style("custom",get_template_directory_uri().'/custom.css');
        // wp_enqueue_style("dark",get_template_directory_uri().'/css/dark.css');
				// wp_enqueue_style("large",get_template_directory_uri().'/css/large-resolution.css');
    }

	wp_dequeue_style('woocommerce_prettyPhoto_css');

}

add_action( 'wp_enqueue_scripts', 'etheme_enqueue_styles' );
function jsString($str='') {
    return trim(preg_replace("/('|\"|\r?\n)/", '', $str));
}

function etheme_get_the_category_list($separator = '', $parents='', $post_id = false){
	global $wp_rewrite;
	$categories = get_the_category( $post_id );
	if ( !is_object_in_taxonomy( get_post_type( $post_id ), 'category' ) )
		return apply_filters( 'the_category', '', $separator, $parents );

	if ( empty( $categories ) )
		return apply_filters( 'the_category', __( 'Uncategorized' ), $separator, $parents );

	$rel = "";

	$thelist = '';
	if ( '' == $separator ) {
		$thelist .= '<ul class="post-categories">';
		foreach ( $categories as $category ) {
			$thelist .= "\n\t<li>";
			switch ( strtolower( $parents ) ) {
				case 'multiple':
					if ( $category->parent )
						$thelist .= get_category_parents( $category->parent, true, $separator );
					$thelist .= '<a href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>' . $category->name.'</a></li>';
					break;
				case 'single':
					$thelist .= '<a href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>';
					if ( $category->parent )
						$thelist .= get_category_parents( $category->parent, false, $separator );
					$thelist .= $category->name.'</a></li>';
					break;
				case '':
				default:
					$thelist .= '<a href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>' . $category->name.'</a></li>';
			}
		}
		$thelist .= '</ul>';
	} else {
		$i = 0;
		foreach ( $categories as $category ) {
			if ( 0 < $i )
				$thelist .= $separator;
			switch ( strtolower( $parents ) ) {
				case 'multiple':
					if ( $category->parent )
						$thelist .= get_category_parents( $category->parent, true, $separator );
					$thelist .= '<a href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>' . $category->name.'</a>';
					break;
				case 'single':
					$thelist .= '<a href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>';
					if ( $category->parent )
						$thelist .= get_category_parents( $category->parent, false, $separator );
					$thelist .= "$category->name</a>";
					break;
				case '':
				default:
					$thelist .= '<a href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" ' . $rel . '>' . $category->name.'</a>';
			}
			++$i;
		}
	}
	return apply_filters( 'the_category', $thelist, $separator, $parents );
}


function etheme_get_contents( $url ) {
	if ( function_exists('file_get_contents') ) {
		$output = file_get_contents( $url );
	}
	else {
		return false;
	}
	return $output;
}

function etheme_demo_alerts(){
    do_action('etheme_demo_alerts');
}

/* Header Template Parts */

add_action( 'after_setup_theme', 'et_promo_remove', 11 );
if(!function_exists('et_promo_remove')) {
	function et_promo_remove() {
		//update_option('et_close_promo_etag', 'ETag: "bca6c0-b9-500bba1239ca80"');
	}
}

add_action("wp_ajax_et_close_promo", "et_close_promo");
add_action("wp_ajax_nopriv_et_close_promo", "et_close_promo");
if(!function_exists('et_close_promo')) {
	function et_close_promo() {
		$versionsUrl = 'http://8theme.com/import/';
		$ver = 'promo';
		$folder = $versionsUrl.''.$ver;

		$txtFile = $folder.'/idstore.txt';
		$file_headers = @get_headers($txtFile);

		$etag = $file_headers[4];
		$res = update_option('et_close_promo_etag', $etag);
		die();
	}
}

function etheme_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'etheme_page_menu_args' );

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @return int
 */
function etheme_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'etheme_excerpt_length' );

/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @return string "Continue Reading" link
 */
function etheme_continue_reading_link() {
	return ' <a href="'. get_permalink() . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', ETHEME_DOMAIN ) . '</a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and etheme_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @return string An ellipsis
 */
function etheme_auto_excerpt_more( $more ) {
	return ' &hellip;' . etheme_continue_reading_link();
}
add_filter( 'excerpt_more', 'etheme_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function etheme_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= etheme_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'etheme_custom_excerpt_more' );

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Twenty Ten's style.css. This is just
 * a simple filter call that tells WordPress to not use the default styles.
 *
 */
add_filter( 'use_default_gallery_style', '__return_false' );

/**
 * Deprecated way to remove inline styles printed when the gallery shortcode is used.
 *
 * This function is no longer needed or used. Use the use_default_gallery_style
 * filter instead, as seen above.
 *
 *
 * @return string The gallery style filter, with the styles themselves removed.
 */
function etheme_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}
// Backwards compatibility with WordPress 3.0.
if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) )
	add_filter( 'gallery_style', 'etheme_remove_gallery_css' );

if ( ! function_exists( 'etheme_comment' ) ) :
function etheme_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
            <?php echo get_avatar( $comment, 55 ); ?>
            <div class="comment-meta">
                <h5 class="author"><?php echo get_comment_author_link() ?> / <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></h5>
                <?php if ( $comment->comment_approved == '0' ) : ?>
        			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', ETHEME_DOMAIN ); ?></em>
        		<?php endif; ?>
                <p class="date">
        			<?php
        				/* translators: 1: date, 2: time */
        				printf( __( '%1$s at %2$s', ETHEME_DOMAIN ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', ETHEME_DOMAIN ), ' ' );
        			?>
                </p>
            </div>
    		<div class="comment-body"><?php comment_text(); ?></div>
            <div class="clear"></div>
<!-- .reply -->
    	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', ETHEME_DOMAIN ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', ETHEME_DOMAIN ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * This function uses a filter (show_recent_comments_widget_style) new in WordPress 3.1
 * to remove the default style. Using Twenty Ten 1.2 in WordPress 3.0 will show the styles,
 * but they won't have any effect on the widget in default Twenty Ten styling.
 *
 */
function etheme_remove_recent_comments_style() {
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'etheme_remove_recent_comments_style' );

if ( ! function_exists( 'etheme_posted_on' ) ) :
function etheme_posted_on() {
	printf( __( '<span class="%1$s"></span> %2$s', ETHEME_DOMAIN ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		)
	);
}
endif;
if ( ! function_exists( 'etheme_posted_by' ) ) :
function etheme_posted_by() {
	printf( __( '<span class="%1$s">Posted by</span> %2$s', ETHEME_DOMAIN ),
		'meta-author',
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			esc_attr( sprintf( __( 'View all posts by %s', ETHEME_DOMAIN ), get_the_author() ) ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'etheme_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Twenty Ten 1.0
 */
function etheme_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', ETHEME_DOMAIN );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', ETHEME_DOMAIN );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', ETHEME_DOMAIN );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		etheme_get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

function etheme_excerpt_more($more) {
    global $post;
    return '<br><a class="button fl-r" style="margin-bottom:10px;" href="'. get_permalink($post->ID) . '"><span>'.__('Read More',ETHEME_DOMAIN).'</span></a><div class="clear"></div>';
}
add_filter('excerpt_more', 'etheme_excerpt_more');

function etheme_get_image( $attachment_id = 0, $width = null, $height = null, $crop = true, $post_id = null ) {

}

function etheme_product_page_banner(){
    global $post;
    $etheme_productspage_id = etheme_shortcode2id('[productspage]');
    if($post->ID == $etheme_productspage_id && etheme_get_option('product_bage_banner') && etheme_get_option('product_bage_banner') != ''):
    ?>
        <div class="wpsc_category_details">
            <img src="<?php etheme_option('product_bage_banner') ?>"/>
        </div>
    <?php endif;
}

function blog_breadcrumbs() {

  $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter = '<span class="delimeter">/</span>'; // delimiter between crumbs
  $home = __('Home', ETHEME_DOMAIN); // text for the 'Home' link
  $blogPage = 'Blog';
  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $before = '<span class="current">'; // tag before the current crumb
  $after = '</span>'; // tag after the current crumb

  global $post;
  $homeLink = home_url();

  if (is_front_page()) {

    if ($showOnHome == 1) echo '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a></div>';

  } else {

    echo '<div class="span12 breadcrumbs">';
    echo '<div id="breadcrumb">';
    echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';

    if ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
      if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
      echo $before . __('Archive by category', ETHEME_DOMAIN) .' "' . single_cat_title('', false) . '"' . $after;

    } elseif ( is_search() ) {
      echo $before . __('Search results for', ETHEME_DOMAIN) .' "' . get_search_query() . '"' . $after;

    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('d') . $after;

    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $before . get_the_time('F') . $after;

    } elseif ( is_year() ) {
      echo $before . get_the_time('Y') . $after;

    } elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
        $slug = $post_type->rewrite;
        echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
      } else {
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
        echo $cats;
        if ($showCurrent == 1) echo $before . get_the_title() . $after;
      }

    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $post_type = get_post_type_object(get_post_type());
      echo $before . $post_type->labels->singular_name . $after;

    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . get_the_title() . $after;

    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
      }
      if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

    } elseif ( is_tag() ) {
      echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;

    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . 'Articles posted by ' . $userdata->display_name . $after;

    } elseif ( is_404() ) {
      echo $before . 'Error 404' . $after;
    }else{

        echo $blogPage;
    }

    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo ' ('.__('Page') . ' ' . get_query_var('paged').')';
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }

    echo '</div>';
    // PA777 "back to" button change
    echo '<a class="back-to777 button active small arrow-left" href="javascript: history.go(-1)">'.__('Return to Previous Page',ETHEME_DOMAIN).'</a></div>';
      }
}

// Add GOOGLE fonts
function etheme_recognized_google_font_families( $array, $field_id = false ) {
	$array = array(
		'Open+Sans'           => '"Open Sans", sans-serif',
		'Droid+Sans'          => '"Droid Sans", sans-serif',
		'Lato'                => '"Lato"',
		'Cardo'               => '"Cardo"',
		'Fauna+One'           => '"Fauna One"',
		'Oswald'              => '"Oswald"',
		'Yanone+Kaffeesatz'   => '"Yanone Kaffeesatz"',
		'Muli'                => '"Muli"'
	);

	return $array;

}
