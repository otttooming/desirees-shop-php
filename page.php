<?php
/**
 * Template Name: Page with sidebar
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 */

global $wp_query, $template_common_page;

$template_common_page = 'sidebar';

get_header();

require get_template_directory() . '/inc/components/common-page.php';

get_footer();
?>
