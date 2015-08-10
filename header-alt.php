<?php
/**
 * The Header for our theme.
 *
 */
?>
<?php global $etheme_responsive; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php if($etheme_responsive): ?>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
<?php endif; ?>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.7
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', ETHEME_DOMAIN ), max( $paged, $page ) );

	?></title>
	<link rel="shortcut icon" href="<?php etheme_option('favicon',true) ?>" />
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <script type="text/javascript">
        var etheme_wp_url = '<?php echo home_url(); ?>'; 
        var succmsg = '<?php _e('All is well, your e&ndash;mail has been sent!', ETHEME_DOMAIN); ?>';
        var menuTitle = '<?php _e('Menu', ETHEME_DOMAIN); ?>';
        var nav_accordion = false;
        var ajaxFilterEnabled = <?php echo (etheme_get_option('ajax_filter')) ? 1 : 0 ; ?>;
        var isRequired = ' <?php _e('Please, fill in the required fields!', ETHEME_DOMAIN); ?>';
        var someerrmsg = '<?php _e('Something went wrong', ETHEME_DOMAIN); ?>';
		var successfullyAdded = '<?php _e('Successfully added to your shopping cart', ETHEME_DOMAIN); ?>';
    </script>
	<!--[if IE]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    
<?php
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	wp_head();
?>
</head>
<body <?php $fixed = ''; if(etheme_get_option('fixed_nav')) $fixed = ' fixNav-enabled '; body_class('no-svg '.etheme_get_option('main_layout').' banner-mask-'.etheme_get_option('banner_mask').$fixed); ?>>
	
	<?php $header_type = apply_filters('custom_header_filter',@$header_type); ?>
	
	<div class="wrapper">
	
    <?php if(etheme_get_option('loader')): ?>
    <div id="loader">
        <div id="loader-status">
            <p class="center-text">
                <em><?php _e('Loading the content...', ETHEME_DOMAIN); ?></em>
                <em><?php _e('Loading depends on your connection speed!', ETHEME_DOMAIN); ?></em>
            </p>
        </div>
    </div>
    <?php endif; ?>
    
	<?php if((etheme_get_option('search_form') || (class_exists('Woocommerce') && !etheme_get_option('just_catalog') && etheme_get_option('cart_widget')) || etheme_get_option('top_links') || etheme_get_option('header_phone') != '')): ?>
		<div class="header-top header-top-<?php echo $header_type; ?> <?php if($header_type == "default") echo 'hidden-desktop'; ?>">
			<div class="container">
				<div class="row header-variant2">
		    		<div class="span4 header-phone"><?php etheme_option('header_phone') ?></div>
		            <div class="span8">
		            	
	                </div>
		    		
				</div>
			</div>
		</div>
	<?php endif; ?>

    
    
    <div class="header-bg header-type-variant3">
    <div class="container header-area"> 
	    
        <header class="row header ">
            <div class="span5 logo">
                <?php etheme_logo(); ?>
            </div>
	           
	     
	    	
		    
        </header> 
	  
    </div>
    <?php if($header_type == 'variant4') etheme_header_menu(); ?>
    
    <?php 
        get_template_part( 'et-styles' ); 
        if($etheme_responsive){
            get_template_part('large-resolution');
        }
    ?>
</div>