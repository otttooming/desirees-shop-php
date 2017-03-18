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

if ( ! is_admin() ) {
  add_filter( 'wp_get_attachment_image_attributes', 'desirees_get_attachment_image_attributes');
}

/**
 * [desirees_get_attachment_image description]
 * wp_get_attachment_image with aspect ratio placeholder
 * https://css-tricks.com/snippets/sass/maintain-aspect-ratio-mixin/
 * @param  [type]  $attachment_id [description]
 * @param  string  $size          [description]
 * @param  boolean $icon          [description]
 * @param  string  $attr          [description]
 * @return [type]                 [description]
 */
function desirees_get_attachment_image($attachment_id, $size = 'thumbnail', $icon = false, $attr = '') {
  $attr['class'] .= ' aspect-ratio__img';

  $image_html = wp_get_attachment_image($attachment_id, $size, $icon, $attr);

  $image = wp_get_attachment_image_src($attachment_id, $size, $icon);

  if ( $image ) {
    list($src, $width, $height) = $image;
  }

  $html = '<figure class="aspect-ratio" style="padding-bottom: ' . $height / $width * 100 . '%;">' . $image_html . '</figure>';

  return $html;
}
