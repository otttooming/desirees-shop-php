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
          echo ' | '.sprintf(__('Page %s', 'desirees'), max($paged, $page));
      }

      ?>
    </title>

    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php wp_head(); ?>
</head>

<body <?php body_class('boxed'); ?>>
