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

<div class="product__gallery <?php if (!$attachment_ids) : ?>hidden-xs-up<?php endif; ?>" itemscope itemtype="http://schema.org/ImageGallery">
    <div class="swiper-container product__gallery-slider">

        <div class="swiper-wrapper">
            <?php
                if ($attachment_ids) {

                    $loop = 0;

                    foreach ( $attachment_ids as $id ) {

                        if ( get_post_meta( $id, '_woocommerce_exclude_image', true ) == 1 )
                        continue;

                        $img = wp_get_attachment_image_src( $id, 'full' );
                        ?>

                        <a class="product-thumb__link lightbox swiper-slide" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject" href="<?php echo $img[0]; ?>" data-size="<?php echo $img[1] . 'x' . $img[2] ?>">
                            <?php echo desirees_get_attachment_image( $id, 'medium', false, ["class" => "product__image lazyload", "itemprop" => "thumbnail", "alt" => get_the_title()] ); ?>
                        </a>

                        <?php
                    }
                }
            ?>
        </div>
    </div>

        <div class="product__gallery-control control__items">
            <svg class="control__prev" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 501.5 501.5"><g><path fill="currentColor" d="M302.67 90.877l55.77 55.508L254.575 250.75 358.44 355.116l-55.77 55.506L143.56 250.75z"></path></g></svg>
						<svg class="control__next" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 501.5 501.5"><g><path fill="currentColor" d="M199.33 410.622l-55.77-55.508L247.425 250.75 143.56 146.384l55.77-55.507L358.44 250.75z"></path></g></svg>
				</div>

</div>
