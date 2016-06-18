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

$product_layout = etheme_get_option('single_product_layout');
$zoom = etheme_get_option('zoom_efect');
$thums_count = etheme_get_option('thumbs_count');
$crop = false;
$mainHeight = 600;
$mainWidth = 440;

$thumbImageWidth = etheme_get_option('single_product_thumb_width');
$thumbImageHeight = etheme_get_option('single_product_thumb_height');
$thumbImageCrop = false;


$attachment_ids = $product->get_gallery_attachment_ids();

if($attachment_ids){
    ?>
    <div class="views-gallery thumbs-count-<?php echo $thums_count ?>">
        <ul class="slider <?php if(count($attachment_ids) > 3 && $product_layout == 'variant3'){ ?>jcarousel-horizontal<?php } ?>">
            <li class="slide thumbnail-active">
                <a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>" class="image" <?php  if($zoom=='disable'):?> rel="thumbnails"<?php endif; ?> data-easyzoom-source="<?php echo etheme_get_image( get_post_thumbnail_id(), $mainWidth, $mainHeight, $crop ) ?>">
                    <img src="<?php echo etheme_get_image(false, $thumbImageWidth, $thumbImageHeight, $thumbImageCrop); ?>">
                </a>
            </li>
            <?php
                $loop = 0;

                foreach ( $attachment_ids as $id ) {

                    if ( get_post_meta( $id, '_woocommerce_exclude_image', true ) == 1 )
                    continue;
                    ?>
                    <li class="slide">
                        <a href="<?php echo wp_get_attachment_url( $id ) ?>" class="image" <?php  if($zoom=='disable'):?> rel="thumbnails"<?php endif; ?> data-easyzoom-source="<?php echo etheme_get_image( $id, $mainWidth, $mainHeight, $crop ) ?>">
                            <img src="<?php echo etheme_get_image($id, $thumbImageWidth, $thumbImageHeight, $thumbImageCrop); ?>" >
                        </a>
						<?php if(etheme_get_option('gallery_lightbox') && $zoom!='disable'): ?>
							<a href="<?php echo wp_get_attachment_url( $id ); ?>" rel="thumbnails" style="display:none;" data-original-title="" data-placement="left">&nbsp;</a>
						<?php endif; ?>
                    </li>

                    <?php
                }
            ?>
        </ul>
    </div>
    <?php if(count($attachment_ids) > 2 && $product_layout != 'variant3'){ $rand = rand(1000,99999);  ?>
        <div class="more-views-arrow prev arrow<?php echo $rand ?> disabled" style="cursor: pointer; ">&nbsp;</div>
        <div class="more-views-arrow next arrow<?php echo $rand ?>" style="cursor: pointer; ">&nbsp;</div>
    <?php } ?>


    <?php
}
?>
