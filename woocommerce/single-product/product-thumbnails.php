<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_image_ids();

?>

<?php if ( $attachment_ids ) : ?>

    <div class="product-thumb__gallery" itemscope itemtype="http://schema.org/ImageGallery">
        <?php

            $loop = 0;

            foreach ( $attachment_ids as $id ) {

                if ( get_post_meta( $id, '_woocommerce_exclude_image', true ) == 1 )
                continue;

                $img = wp_get_attachment_image_src( $id, 'full' );
                ?>

                <a class="product-thumb__link lightbox" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" href="<?php echo $img[0]; ?>" data-size="<?php echo $img[1] . 'x' . $img[2] ?>">
                    <?php echo desirees_get_attachment_image( $id, 'medium', false, ["class" => "product__image lazyload", "itemprop" => "thumbnail", "alt" => get_the_title()] ); ?>
                </a>

                <?php
            }
        ?>
    </div>

<?php endif; ?>
