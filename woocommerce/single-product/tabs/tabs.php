<?php
/**
 * Single Product tabs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>

    <div class="row">
        <div class="span12">
            <div class="tabs cfx">

                <?php $i=0; foreach ( $tabs as $key => $tab ) : $i++; ?>
            				<a href="#tab<?php echo $i; ?>" id="tab_<?php echo $i; ?>" class="tab-title <?php if($i==1): ?> opened<?php endif; ?>">
                      <?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ?>
                    </a>

              			<div id="content_tab_<?php echo $i; ?>" class="tab-content" <?php if($i==1): ?> style="display: block;" <?php endif; ?>>
              				<?php call_user_func( $tab['callback'], $key, $tab ) ?>
              			</div>
            		<?php endforeach; ?>

    		    </div>
    	  </div>
    </div>

<?php endif; ?>
