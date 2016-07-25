<?php
/**
 * Template Name: Page full width
 *
 */

global $wp_query, $template_common_page;

$template_common_page = 'full';

get_header();

require get_template_directory() . '/inc/components/common-page.php';

get_footer();
?>
