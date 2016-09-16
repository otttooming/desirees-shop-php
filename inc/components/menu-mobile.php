<div class="menu-mobile">
  <?php wp_nav_menu(array('theme_location' => 'top', 'name' => 'top', 'container' => 'div', 'container_class' => 'menu-mobile__primary')); ?>

  <?php wp_nav_menu(array('theme_location' => 'top-right', 'name' => 'top-right', 'container' => 'div', 'container_class' => 'menu-mobile__secondary')); ?>

  <div class="menu-mobile__categories cfx">
    <?php dynamic_sidebar( 'product-widget-area' ); ?>
  </div>
</div>
