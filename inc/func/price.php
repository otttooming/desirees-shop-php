<?php

/**
 * Format the price with a currency symbol.
 *
 * @param float $price
 * @param array $args (default: array())
 * @return string
 */
function filter_wc_price( $price, $args = array() ) {
	extract( apply_filters( 'wc_price_args', wp_parse_args( $args, array(
		'ex_tax_label'       => false,
		'currency'           => '',
		'decimal_separator'  => wc_get_price_decimal_separator(),
		'thousand_separator' => wc_get_price_thousand_separator(),
		'decimals'           => wc_get_price_decimals(),
		'price_format'       => get_woocommerce_price_format(),
	) ) ) );

  $price = filter_var( $price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );

	$symbols = array('$', '€', '£', '-');

	$price = str_replace($symbols, '', $price);
	$negative        = $price < 0;

	$price           = apply_filters( 'raw_woocommerce_price', floatval( $negative ? $price * -1 : $price ) );
	$price           = apply_filters( 'formatted_woocommerce_price', number_format( $price, $decimals, $decimal_separator, $thousand_separator ), $price, $decimals, $decimal_separator, $thousand_separator );
	if ( apply_filters( 'woocommerce_price_trim_zeros', false ) && $decimals > 0 ) {
		$price = wc_trim_zeros( $price );
	}
	$formatted_price = ( $negative ? '-' : '' ) . sprintf( $price_format, '<span class="price__currency-format">' . get_woocommerce_currency_symbol( $currency ) . '</span>','<span class="price__sum">' . $price . '</span>' );
	$return          = '<span class="price__block">' . $formatted_price . '</span>';
	if ( $ex_tax_label && wc_tax_enabled() ) {
		$return .= ' <small class="woocommerce-Price-taxLabel tax_label">' . WC()->countries->ex_tax_or_vat() . '</small>';
	}
  return $return;
};

add_filter( 'wc_price', 'filter_wc_price', 10, 3 );
