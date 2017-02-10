<?php
/**
 * Desirees links.
 */

function desirees_posts_link_attributes( $attr ) {
  $attr = 'class="pagination__btn button medium"';

  return $attr;
}

add_filter( 'previous_posts_link_attributes', 'desirees_posts_link_attributes');

add_filter( 'next_posts_link_attributes', 'desirees_posts_link_attributes');
