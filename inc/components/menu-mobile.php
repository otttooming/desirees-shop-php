<aside class="menu-mobile">
    <div class="menu-mobile__toggle button mb1">
      <span><?php _e('Close', 'woocommerce'); ?></span>
      <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 64 64"><path fill="currentColor" d="M28.94 31.786L.614 60.114a2.014 2.014 0 1 0 2.848 2.85L32.003 34.42l28.54 28.54c.395.395.91.59 1.425.59s1.03-.195 1.424-.59a2.014 2.014 0 0 0 0-2.848L35.065 31.786 63.41 3.438a2.014 2.014 0 0 0-2.848-2.85L32.002 29.15 3.443.59A2.015 2.015 0 0 0 .59 3.44l28.35 28.346z"/></svg>
    </div>

    <?php wp_nav_menu(array('theme_location' => 'top', 'name' => 'top', 'container' => 'div', 'container_class' => 'menu default-menu mb1')); ?>

    <?php wp_nav_menu(array('theme_location' => 'top-right', 'name' => 'top-right', 'container' => 'div', 'container_class' => 'menu default-menu mb1')); ?>

    <div class="sidebar_grid sidebar_left ">
  			<?php dynamic_sidebar( 'sidebar-widget-area' ); ?>
  	</div>
</aside>
