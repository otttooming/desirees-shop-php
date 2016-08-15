<div class="header-links">
    <?php if (is_user_logged_in()) : ?>
        <?php if (class_exists('Woocommerce')): ?>
            <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" class="header-links__item"><?php _e( 'My Account Page', 'woocommerce' ); ?></a>
        <?php endif; ?>

        <span class="header-links__delimiter">/</span>

        <a class="header-links__item" href="<?php echo wp_logout_url(home_url()); ?>"><?php _e( 'Logout', 'woocommerce' ); ?></a>
    <?php else : ?>
        <?php if (class_exists('Woocommerce')): ?>
            <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" class="header-links__item"><?php _e( 'Login', 'woocommerce' ); ?></a>
        <?php endif; ?>

        <span class="header-links__delimiter">/</span>

        <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>" class="header-links__item"><?php _e( 'Register', 'woocommerce' ); ?></a>
    <?php endif; ?>
</div>
