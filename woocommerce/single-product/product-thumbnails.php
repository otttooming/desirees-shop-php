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

if ($attachment_ids) {
?>
    <div class="views-gallery">
        <ul class="slider">
            <?php
                $loop = 0;

                foreach ( $attachment_ids as $id ) {

                    if ( get_post_meta( $id, '_woocommerce_exclude_image', true ) == 1 )
                    continue;
                    ?>
                    <li class="slide">
                        <a href="<?php echo wp_get_attachment_url( $id ) ?>" class="image" rel="thumbnails">
                            <img src="<?php echo wp_get_attachment_url( $id ); ?>" >
                        </a>
                    </li>

                    <?php
                }
            ?>
        </ul>
    </div>
    <?php
}
?>
