<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version   2.6.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();

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