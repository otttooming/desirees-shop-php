<?php

/**
 * Format the price with a currency symbol.
 *
 * @param float $price
 * @param array $args (default: array())
 * @return string
 */
function filter_wc_price( $args, $price ) {
	extract( apply_filters( 'wc_price_args', wp_parse_args( $args, array(
		'ex_tax_label'       => false,
		'currency'           => '',
		'decimal_separator'  => wc_get_price_decimal_separator(),
		'thousand_separator' => wc_get_price_thousand_separator(),
		'decimals'           => wc_get_price_decimals(),
		'price_format'       => get_woocommerce_price_format(),
	) ) ) );

	if ( $decimals > 0 ) {
		$price = wc_trim_zeros( $price );
	}

	$return = '<span class="price__block">' . $price . get_woocommerce_currency_symbol( $currency ) . '</span>';

	if ( $ex_tax_label && wc_tax_enabled() ) {
		$return .= ' <small class="woocommerce-Price-taxLabel tax_label">' . WC()->countries->ex_tax_or_vat() . '</small>';
	}

  return $return;
};

add_filter( 'wc_price', 'filter_wc_price', 10, 3);
