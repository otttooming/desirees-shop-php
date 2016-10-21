<?php
/**
 * The logo for our theme.
 *
 * Displays text as fallback when no image selected
 *
 * @package desirees
 */

 $custom_logo_id = get_theme_mod( 'custom_logo' );
 $logoimg = wp_get_attachment_image_src( $custom_logo_id , 'full' );
 if ($logoimg) {
   $img_padding_ratio = $logoimg[2] / $logoimg[1] * 100 . '%';
 }
 ?>

<?php if ($logoimg) : ?>
    <div class="img-padding-ratio__wrap">

        <a href="<?php echo home_url(); ?>">
            <img src="<?php echo $logoimg[0]; ?>" width="<?php echo $logoimg[1]; ?>" height="<?php echo $logoimg[2]; ?>" alt="<?php bloginfo( 'description' ); ?>" class="header__logo-img" />
        </a>

        <div style="padding-bottom:<?php echo $img_padding_ratio; ?>"></div>
    </div>
<?php else : ?>
  <a href="<?php echo home_url(); ?>"><span class="logo-text-red">DE</span>SIREE</a>
<?php endif; ?>
