<?php

function desirees_woocommerce_breadcrumbs() {
    return array(
            'delimiter'   => '<span class="bc__delim">/</span>',
            'wrap_before' => '<nav class="bc bg__common p1 mb1" itemprop="breadcrumb">',
            'wrap_after'  => '</nav>',
            'before'      => '<span class="bc__item">',
            'after'       => '</span>',
            'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
        );
}
add_filter( 'woocommerce_breadcrumb_defaults', 'desirees_woocommerce_breadcrumbs' );

remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0);
add_action('desirees_breadcrumbs', 'woocommerce_breadcrumb');
