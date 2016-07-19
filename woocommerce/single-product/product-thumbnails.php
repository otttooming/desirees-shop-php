<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_attachment_ids();

?>

<div class="product__gallery" itemscope itemtype="http://schema.org/ImageGallery">
    <?php if ( has_post_thumbnail() ) : ?>

        <figure class="product__image-object is-disabled" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
            <a href="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' )[0]; ?>" itemprop="contentUrl" data-size="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' )[1] . 'x' . wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' )[2] ?>">
                <img src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' )[0]; ?>" class="product__image" itemprop="thumbnail">
            </a>
        </figure>
        
    <?php endif; ?>

    <?php
        if ($attachment_ids) {

            $loop = 0;

            foreach ( $attachment_ids as $id ) {

                if ( get_post_meta( $id, '_woocommerce_exclude_image', true ) == 1 )
                continue;

                $img = wp_get_attachment_image_src( $id, 'full' );
                ?>
                <figure class="product__image-object" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                    <a href="<?php echo wp_get_attachment_image_src( $id, 'full' )[0]; ?>" itemprop="contentUrl" data-size="<?php echo $img[1] . 'x' . $img[2] ?>">
                        <img src="<?php echo wp_get_attachment_image_src( $id, 'medium' )[0]; ?>" class="product__image" itemprop="thumbnail">
                    </a>
                </figure>

                <?php
            }
        }
    ?>
</div>
