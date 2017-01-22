<?php
/**
 * Desirees media.
 */

/**
 * [desirees_get_attachment_image_attributes description]
 * https://github.com/WordPress/WordPress/blob/master/wp-includes/media.php#L822
 */

function desirees_get_attachment_image_attributes($attr) {

  $attr['data-src'] = $attr['src'];
  $attr['data-srcset'] = $attr['srcset'];

  $attr['class'] .= ' lazyload';

  unset($attr['src']);
  unset($attr['srcset']);

  return $attr;
}

add_filter( 'wp_get_attachment_image_attributes', 'desirees_get_attachment_image_attributes');
