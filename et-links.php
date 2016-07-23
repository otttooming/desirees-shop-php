<ul class="header-links">
    <?php if (is_user_logged_in()) : ?>
        <?php if (class_exists('Woocommerce')): ?>
            <li><a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>"><?php _e( 'My Account Page', 'woocommerce' ); ?></a></li>
        <?php endif; ?>

        <span class="delimeter">/</span>

        <li class="no">
            <a class="black" href="<?php echo wp_logout_url(home_url()); ?>"><?php _e( 'Logout', 'woocommerce' ); ?></a>
        </li>
    <?php else : ?>
        <?php if (class_exists('Woocommerce')): ?>
            <li class="no"><a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>"><?php _e( 'Login', 'woocommerce' ); ?></a></li>
        <?php endif; ?>

        <span class="delimeter">/</span>

        <li><a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>"><?php _e( 'Register', 'woocommerce' ); ?></a></li>
    <?php endif; ?>
</ul>
