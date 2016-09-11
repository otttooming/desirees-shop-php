<?php
/**
 * The Header for our theme.
 *
 */

  require get_template_directory() . '/inc/components/head.php';
  global $template_header;
?>

	<div class="wrapper">

		<div class="header-top header-top-default vis-to-phone">
			<div class="container">
				<div class="row header-variant2">

          <?php if ($template_header != 'min') : ?><?php // Load full header ?>

  					<div class="span12 header-variant2__wrap">
              <div class="header-phone">
                <?php echo _e( 'Telephone:', 'woocommerce' ) . ' ' .  get_option('contact_tel') ?>
              </div>

              <div class="search_form visible-desktop">
  							<?php get_search_form(); ?>
  						</div>

              <div id="cart__top" class="cart__top-wrapper">
                <?php require get_template_directory() . '/inc/components/cart-links.php'; ?>
  						</div>
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
					<div class="span3 logo">
            <?php require get_template_directory() . '/inc/components/logo.php'; ?>
					</div>

          <?php if ($template_header != 'min') : ?><?php // Load full header ?>
            <div class="vis-to-phone">
              <span class="et-menu-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 302 302"><path d="M0 36h302v30H0zM0 236h302v30H0zM0 136h302v30H0z" fill="currentColor"/></svg>
              </span>
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

  					<div class="span3 shopping_cart_wrap vis-to-tablet-up">

              <div id="cart__top" class="cart__top-wrapper">
                <?php require get_template_directory() . '/inc/components/cart-links.php'; ?>
  						</div>
  					</div>

          <?php endif; ?><?php // END Load full header ?>

				</header>

        <?php if ($template_header != 'min') : ?><?php // Load full header ?>
          <div class="row vis-to-tablet-up">
              <div id="main-nav" class="span8">
                  <?php wp_nav_menu(array('theme_location' => 'top', 'name' => 'top', 'container' => 'div', 'container_class' => 'menu default-menu')); ?>
              </div>
              <div id="main-nav-top-right" class="span4 main-nav-top-right">
                  <?php wp_nav_menu(array('theme_location' => 'top-right', 'name' => 'top-right', 'container' => 'div', 'container_class' => 'menu default-menu')); ?>
              </div>
          </div>
        <?php endif; ?><?php // END Load full header ?>

			</div>

		</div>
