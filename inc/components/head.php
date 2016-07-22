<?php
/**
 * The head for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package desirees
 */
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">

    <title>
      <?php
      /*
       * Print the <title> tag based on what is being viewed.
       */
      global $page, $paged;

      wp_title('|', true, 'right');

      // Add the blog name.
      bloginfo('name');

      // Add the blog description for the home/front page.
      $site_description = get_bloginfo('description', 'display');
      if ($site_description && (is_home() || is_front_page())) {
          echo " | $site_description";
      }

      // Add a page number if necessary:
      if ($paged >= 2 || $page >= 2) {
          echo ' | '.sprintf(__('Page %s', ETHEME_DOMAIN), max($paged, $page));
      }

      ?>
    </title>

	  <link rel="shortcut icon" href="<?php etheme_option('favicon', true) ?>">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <script type="text/javascript">
        var etheme_wp_url = '<?php echo home_url(); ?>';
        var succmsg = '<?php _e('All is well, your e&ndash;mail has been sent!', ETHEME_DOMAIN); ?>';
        var menuTitle = '<?php _e('Menu', ETHEME_DOMAIN); ?>';
        var nav_accordion = false;
        var ajaxFilterEnabled = <?php echo (etheme_get_option('ajax_filter')) ? 1 : 0; ?>;
        var isRequired = ' <?php _e('Please, fill in the required fields!', ETHEME_DOMAIN); ?>';
        var someerrmsg = '<?php _e('Something went wrong', ETHEME_DOMAIN); ?>';
        var view_mode_default = 'grid_list';
		    var successfullyAdded = '<?php _e('Successfully added to your shopping cart', ETHEME_DOMAIN); ?>';
    </script>

    <?php wp_head(); ?>
</head>

<body <?php body_class('boxed'); ?>>
