<?php
/**
 * The logo for our theme.
 *
 * Displays text as fallback when no image selected
 *
 * @package desirees
 */

 $custom_logo_id = get_theme_mod( 'custom_logo' );
 ?>

<?php if ($custom_logo_id) : ?>
  <a class="d__block" href="<?php echo home_url(); ?>"><?php echo desirees_get_attachment_image(  $custom_logo_id, 'medium_large', false, ["class" => "lazyload", "itemprop" => "image", "alt" => get_bloginfo('name')] ); ?></a>
<?php else : ?>
  <a href="<?php echo home_url(); ?>"><?php echo get_bloginfo('name'); ?></a>
<?php endif; ?>
