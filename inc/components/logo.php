<?php
/**
 * The logo for our theme.
 *
 * Displays text as fallback when no image selected
 *
 * @package desirees
 */

$logoimg = get_option('company_logo');
?>

<?php if ($logoimg) : ?>
  <a href="<?php echo home_url(); ?>"><img src="<?php echo $logoimg ?>" alt="<?php bloginfo( 'description' ); ?>" class="header__logo-img" /></a>
<?php else : ?>
  <a href="<?php echo home_url(); ?>"><span class="logo-text-red">DE</span>SIREE</a>
<?php endif; ?>
