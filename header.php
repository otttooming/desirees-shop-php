<?php
/**
 * The Header for our theme.
 *
 */

  require get_template_directory() . '/inc/components/head.php';
  global $template_header;
?>

	<div class="wrapper">

		<?php if((etheme_get_option('search_form') || (class_exists('Woocommerce') && !etheme_get_option('just_catalog') && etheme_get_option('cart_widget')) || etheme_get_option('top_links') || etheme_get_option('header_phone') != '')): ?>
		<div class="header-top header-top-default hidden-desktop">
			<div class="container">
				<div class="row header-variant2">
					<div class="span4 header-phone">
						<?php etheme_option('header_phone') ?>
					</div>

          <?php if ($template_header != 'min') : ?><?php // Load full header ?>

  					<div class="span8">
  						<?php if(etheme_get_option('search_form')): ?>
  						<div class="search_form">
  							<?php get_search_form(); ?>
  						</div>
  						<?php endif; ?>
  						<?php if(class_exists('Woocommerce') && !etheme_get_option('just_catalog') && etheme_get_option('cart_widget')): ?>
  						<div id="top-cart" class="shopping-cart-wrapper widget_shopping_cart cfx">
  							<?php $cart_widget = new Etheme_WooCommerce_Widget_Cart(); $cart_widget->widget(); ?>
  						</div>
  						<?php endif ;?>
  						<?php if(etheme_get_option('top_links')): ?>
  						<?php  get_template_part( 'et-links' ); ?>
  						<?php endif; ?>
  					</div>

          <?php endif; ?><?php // END Load full header ?>

				</div>
			</div>
		</div>
		<?php endif; ?>

		<?php if(etheme_get_option('fixed_nav')): ?>
		<div class="fixed-header-area visible-desktop">
			<div class="fixed-header container">
				<div class="row">
					<div class="span3 logo">
						<?php etheme_logo(); ?>
					</div>
					<div id="main-nav" class="span9">
						<?php etheme_header_wp_navigation(); ?>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
		<?php endif; ?>

		<div class="header-bg <?php echo ($template_header != 'min' ? 'header-type-default' : 'header-type-variant3' ) ?>">
			<div class="container header-area">

				<header class="row header ">
					<div class="span5 logo">
						<?php etheme_logo(); ?>
					</div>

          <?php if ($template_header != 'min') : ?><?php // Load full header ?>
  					<div class="span3 visible-desktop">
  						<?php if(etheme_get_option('header_phone') && etheme_get_option('header_phone') != ''): ?>
  						<span class="search_text">
                  <?php etheme_option('header_phone') ?>
              </span>
  						<?php endif; ?>
  						<?php if(etheme_get_option('search_form')): ?>
  						<div class="search_form">
  							<?php get_search_form(); ?>
  						</div>
  						<?php endif; ?>
  					</div>

  					<div class="span3 shopping_cart_wrap visible-desktop">

  						<?php if(class_exists('Woocommerce') && !etheme_get_option('just_catalog') && etheme_get_option('cart_widget')): ?>
  						<div id="top-cart" class="shopping-cart-wrapper widget_shopping_cart">
  							<?php $cart_widget = new Etheme_WooCommerce_Widget_Cart(); $cart_widget->widget(); ?>
  						</div>
  						<?php endif ;?>
  						<div class="clear"></div>
  						<?php if(etheme_get_option('top_links')): ?>
  						<?php  get_template_part( 'et-links' ); ?>
  						<?php endif; ?>
  					</div>

          <?php endif; ?><?php // END Load full header ?>

				</header>

        <?php if ($template_header != 'min') : ?><?php // Load full header ?>
  				<?php etheme_header_menu(); ?>
        <?php endif; ?><?php // END Load full header ?>

			</div>

			<?php get_template_part( 'et-styles' ); ?>
		</div>
