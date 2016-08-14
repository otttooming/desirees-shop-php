<?php
/**
 * The Header for our theme.
 *
 */

  require get_template_directory() . '/inc/components/head.php';
  global $template_header;
?>

	<div class="wrapper">

		<div class="header-top header-top-default hidden-desktop">
			<div class="container">
				<div class="row header-variant2">

					<div class="span4 header-phone">
            <?php echo _e( 'Telephone:', 'woocommerce' ) . ' ' .  get_option('contact_tel') ?>
					</div>

          <?php if ($template_header != 'min') : ?><?php // Load full header ?>

  					<div class="span8">
              <div class="search_form visible-desktop">
  							<?php get_search_form(); ?>
  						</div>

              <div id="top-cart" class="shopping-cart-wrapper widget_shopping_cart cfx">
  							<?php $cart_widget = new Etheme_WooCommerce_Widget_Cart(); $cart_widget->widget(); ?>
  						</div>

              <?php require get_template_directory() . '/inc/components/header-links.php'; ?>
  					</div>

          <?php endif; ?><?php // END Load full header ?>

				</div>
			</div>
		</div>

		<?php if(get_option('layout_fixed_nav')): ?>
		<div class="fixed-header-area visible-desktop">
			<div class="fixed-header container">
				<div class="row">

					<div class="span3 logo">
						<?php require get_template_directory() . '/inc/components/logo.php'; ?>
					</div>

					<div id="main-nav" class="span9 cfx">
						<?php	wp_nav_menu(array('theme_location' => 'top', 'name' => 'top', 'container' => 'div', 'container_class' => 'menu default-menu')); ?>
					</div>

				</div>
			</div>
		</div>
		<?php endif; ?>

		<div class="header-bg <?php echo ($template_header != 'min' ? 'header-type-default' : 'header-type-variant3' ) ?>">
			<div class="container header-area">

				<header class="row header ">
					<div class="span5 logo">
            <?php require get_template_directory() . '/inc/components/logo.php'; ?>
					</div>

          <?php if ($template_header != 'min') : ?><?php // Load full header ?>
            <div class="hidden-desktop">
              <span class="et-menu-title"><i class="icon-reorder"></i></span>
            </div>
          <?php endif; ?>

          <?php if ($template_header != 'min') : ?><?php // Load full header ?>
  					<div class="span6 visible-desktop">
              <span class="search_text">
                  <?php echo _e( 'Telephone:', 'woocommerce' ) . ' ' .  get_option('contact_tel') ?>
              </span>
              <div class="search__wrap">
  							<?php get_search_form(); ?>
  						</div>
  					</div>

  					<div class="span3 shopping_cart_wrap visible-desktop">

              <div id="top-cart" class="shopping-cart-wrapper widget_shopping_cart cfx">
  							<?php $cart_widget = new Etheme_WooCommerce_Widget_Cart(); $cart_widget->widget(); ?>
  						</div>

              <?php require get_template_directory() . '/inc/components/header-links.php'; ?>
  					</div>

          <?php endif; ?><?php // END Load full header ?>

				</header>

        <?php if ($template_header != 'min') : ?><?php // Load full header ?>
          <div class="row visible-desktop">
              <div id="main-nav" class="span12">
                  <?php wp_nav_menu(array('theme_location' => 'top', 'name' => 'top', 'container' => 'div', 'container_class' => 'menu default-menu')); ?>
              </div>
          </div>
        <?php endif; ?><?php // END Load full header ?>

			</div>

		</div>
