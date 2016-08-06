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

<div class="product__gallery" itemscope itemtype="http://schema.org/ImageGallery">
    <div class="swiper-container product__gallery-slider">

        <div class="swiper-wrapper">

            <?php if ( has_post_thumbnail() ) : ?>


                <figure class="swiper-slide product__image-object is-disabled" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                    <a href="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' )[0]; ?>" itemprop="contentUrl" data-size="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' )[1] . 'x' . wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' )[2] ?>">
                        <img data-src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id(), 'medium' )[0]; ?>" class="product__image lazyload" itemprop="thumbnail">
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
                        <figure class="swiper-slide product__image-object" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">
                            <a href="<?php echo wp_get_attachment_image_src( $id, 'full' )[0]; ?>" itemprop="contentUrl" data-size="<?php echo $img[1] . 'x' . $img[2] ?>">
                                <img data-src="<?php echo wp_get_attachment_image_src( $id, 'medium' )[0]; ?>" class="product__image lazyload" itemprop="thumbnail">
                            </a>
                        </figure>

                        <?php
                    }
                }
            ?>
        </div>
    </div>

    <?php if ($attachment_ids) : ?>
        <div class="product__gallery-control control__items">
            <svg class="control__prev" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 501.5 501.5"><g><path fill="currentColor" d="M302.67 90.877l55.77 55.508L254.575 250.75 358.44 355.116l-55.77 55.506L143.56 250.75z"></path></g></svg>
						<svg class="control__next" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 501.5 501.5"><g><path fill="currentColor" d="M199.33 410.622l-55.77-55.508L247.425 250.75 143.56 146.384l55.77-55.507L358.44 250.75z"></path></g></svg>
				</div>
    <?php endif; ?>

</div>
