<?php
/**
 * The Header for our theme.
 *
 */

  require get_template_directory() . '/inc/components/head.php';
?>

<div class="wrapper">

	<header class="container">

    <div class="row center-xs">
      <div class="col-xs-12">
        <?php if (  is_active_sidebar( 'contacts' ) ) : ?>
            <?php dynamic_sidebar( 'contacts' ); ?>
        <?php endif; ?>
      </div>
    </div>

    <div class="row header-variant2 hidden-md-up">

      <div class="col-xs-12 center-xs header-variant2__wrap">
        <div id="cart__top" class="cart__top-wrapper">
          <?php require get_template_directory() . '/inc/components/cart-links.php'; ?>
        </div>

        <div class="menu-mobile__toggle vis-to-phone button">
          <span><?php _e('Menu', 'desirees'); ?></span>
          <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 302 302"><path d="M0 36h302v30H0zM0 236h302v30H0zM0 136h302v30H0z" fill="currentColor"/></svg>
        </div>
      </div>

    </div>

		<div class="row header middle-xs">
			<div class="col-xs-12 col-sm-3 header__logo">
        <?php require get_template_directory() . '/inc/components/logo.php'; ?>
			</div>

			<div class="col-md-5 header__search hidden-md-down">
        <div class="search__wrap">
					<?php get_search_form(); ?>
				</div>
			</div>

			<div class="col-sm-9 col-md-offset-5 col-lg-offset-0 col-md-4 col-lg-4 header__cart hidden-sm-down">

        <div class="cart__top-wrapper">
          <?php require get_template_directory() . '/inc/components/cart-links.php'; ?>
				</div>
			</div>

		</div>

    <div class="row hidden-sm-down">
        <div class="col-xs-8">
            <?php wp_nav_menu(array('theme_location' => 'top', 'name' => 'top', 'container' => 'div', 'container_class' => 'menu default-menu')); ?>
        </div>
        <div class="col-xs-4 end-xs">
            <?php wp_nav_menu(array('theme_location' => 'top-right', 'name' => 'top-right', 'container' => 'div', 'container_class' => 'menu default-menu')); ?>
        </div>
    </div>

    <div class="row">
        <?php do_action('desirees_breadcrumbs'); ?>
    </div>

	</header>
