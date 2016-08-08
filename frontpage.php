<?php
/**
 * Template Name: Frontpage minimal
 */

  global $wp_query, $current_page_id, $template_header;
  $orig_query = $wp_query;
  $current_page_id = $wp_query->get_queried_object_id();
  $template_header = 'min';

  $fp_shopnav_1 = get_field('fp_shopnav_link_1') && get_field('fp_shopnav_text_1');
  $fp_shopnav_2 = get_field('fp_shopnav_link_2') && get_field('fp_shopnav_text_2');

  $fp_slider_1_image = wp_get_attachment_image_src(get_field('fp_slider_1'), 'full');
  $fp_slider_2_image = wp_get_attachment_image_src(get_field('fp_slider_2'), 'full');
  $fp_slider_3_image = wp_get_attachment_image_src(get_field('fp_slider_3'), 'full');
  $fp_slider_4_image = wp_get_attachment_image_src(get_field('fp_slider_4'), 'full');

  get_header();
?>

<div class="container center777 transparentbutton">
    <div class="row f-center">

        <?php if (  $fp_shopnav_1 ) : ?>
          <div class="span4">
              <p>
                  <a class="button big w100 c-warm" href="<?php echo the_field('fp_shopnav_link_1'); ?>">
                      <?php echo the_field('fp_shopnav_text_1'); ?>
                  </a>
              </p>
          </div>
        <?php endif; ?>

        <?php if (  $fp_shopnav_2 ) : ?>
          <div class="span4">
              <p>
                  <a class="button big w100 c-warm" href="<?php the_field('fp_shopnav_link_2'); ?>">
                      <?php the_field('fp_shopnav_text_2'); ?>
                  </a>
              </p>
          </div>
        <?php endif; ?>

    </div>
</div>

<div class="swiper-container slider-promo">
    <div class="slider-promo__wrapper swiper-wrapper">

        <?php if ($fp_slider_1_image) : ?>
  				<div class="swiper-slide">
            <img class="lazyload" data-src="<?php echo $fp_slider_1_image[0]; ?>" alt="<?php echo get_the_title(get_field('fp_slider_1')); ?>" />
  				</div>
        <?php endif; ?>

        <?php if ($fp_slider_2_image) : ?>
  				<div class="swiper-slide">
            <img class="lazyload" data-src="<?php echo $fp_slider_2_image[0]; ?>" alt="<?php echo get_the_title(get_field('fp_slider_2')); ?>" />
  				</div>
        <?php endif; ?>

        <?php if ($fp_slider_3_image) : ?>
  				<div class="swiper-slide">
            <img class="lazyload" data-src="<?php echo $fp_slider_3_image[0]; ?>" alt="<?php echo get_the_title(get_field('fp_slider_3')); ?>" />
  				</div>
        <?php endif; ?>

        <?php if ($fp_slider_4_image) : ?>
  				<div class="swiper-slide">
            <img class="lazyload" data-src="<?php echo $fp_slider_4_image[0]; ?>" alt="<?php echo get_the_title(get_field('fp_slider_4')); ?>" />
  				</div>
        <?php endif; ?>

    </div>

    <div class="swiper-pagination"></div>

</div>

<div class="container">

	<div class="center777 h2mod">
		<hr>

		<div class="row f-center">
      <?php if ( get_field('fp_slogan_1') ) : ?>
  			<div class="span3">
  				<h5><?php the_field('fp_slogan_1'); ?></h5>
  			</div>
      <?php endif; ?>
      <?php if ( get_field('fp_slogan_2') ) : ?>
  			<div class="span3">
  				<h5><?php the_field('fp_slogan_2'); ?></h5>
  			</div>
      <?php endif; ?>
      <?php if ( get_field('fp_slogan_3') ) : ?>
  			<div class="span3">
  				<h5><?php the_field('fp_slogan_3'); ?></h5>
  			</div>
      <?php endif; ?>
      <?php if ( get_field('fp_slogan_4') ) : ?>
  			<div class="span3">
  				<h5><?php the_field('fp_slogan_4'); ?></h5>
  			</div>
      <?php endif; ?>
		</div>

		<hr>
	</div>

	<div class="row ">
		<div class="imageboxshadow center777 f-center">
      <?php if ( get_field('fp_illustration_link_1') && get_field('fp_illustration_img_1') ) : ?>
  			<div class="span3">
          <p>
            <a href="<?php the_field('fp_illustration_link_1'); ?>">
              <img class="lazyload" data-src="<?php echo wp_get_attachment_image_src(get_field('fp_illustration_img_1'), 'medium')[0]; ?>" alt="<?php echo get_the_title(get_field('fp_illustration_img_1')); ?>">
            </a>
          </p>
  			</div>
      <?php endif; ?>
      <?php if ( get_field('fp_illustration_link_2') && get_field('fp_illustration_img_2') ) : ?>
        <div class="span3">
          <p>
            <a href="<?php the_field('fp_illustration_link_2'); ?>">
              <img class="lazyload" data-src="<?php echo wp_get_attachment_image_src(get_field('fp_illustration_img_2'), 'medium')[0]; ?>" alt="<?php echo get_the_title(get_field('fp_illustration_img_2')); ?>">
            </a>
          </p>
        </div>
      <?php endif; ?>
      <?php if ( get_field('fp_illustration_link_3') && get_field('fp_illustration_img_3') ) : ?>
        <div class="span3">
          <p>
            <a href="<?php the_field('fp_illustration_link_3'); ?>">
              <img class="lazyload" data-src="<?php echo wp_get_attachment_image_src(get_field('fp_illustration_img_3'), 'medium')[0]; ?>" alt="<?php echo get_the_title(get_field('fp_illustration_img_3')); ?>">
            </a>
          </p>
        </div>
      <?php endif; ?>
      <?php if ( get_field('fp_illustration_link_4') && get_field('fp_illustration_img_4') ) : ?>
        <div class="span4">
          <p>
            <a href="<?php the_field('fp_illustration_link_4'); ?>">
              <img class="lazyload" data-src="<?php echo wp_get_attachment_image_src(get_field('fp_illustration_img_4'), 'medium')[0]; ?>" alt="<?php echo get_the_title(get_field('fp_illustration_img_4')); ?>">
            </a>
          </p>
        </div>
      <?php endif; ?>
		</div>
	</div>

	<div class="center777">
		<hr>
		<div class="row f-center">

      <?php if ( get_field('fp_catdesc_text_1') && get_field('fp_catdesc_btn_link_1') ) : ?>
  			<div class="span4">
  				<h2><?php the_field('fp_catdesc_title_1'); ?></h2>
  				<div>
  				  <?php the_field('fp_catdesc_text_1'); ?>
  				</div>
          <p><a class="button small active" href="<?php the_field('fp_catdesc_btn_link_1'); ?>"><?php the_field('fp_catdesc_btn_1'); ?></a></p>
  			</div>
      <?php endif; ?>

      <?php if ( get_field('fp_catdesc_text_2') && get_field('fp_catdesc_btn_link_2') ) : ?>
        <div class="span4">
          <h2><?php the_field('fp_catdesc_title_2'); ?></h2>
          <div>
            <?php the_field('fp_catdesc_text_2'); ?>
          </div>
          <p><a class="button small active" href="<?php the_field('fp_catdesc_btn_link_2'); ?>"><?php the_field('fp_catdesc_btn_2'); ?></a></p>
        </div>
      <?php endif; ?>
		</div>
		<hr>
	</div>
	<div class="center777 button75">

    <div class="row f-center">
      <?php

      $args = array( 'taxonomy' => 'product_cat' );
      $terms = get_terms('product_cat', $args);

      if (count($terms) > 0) {
          foreach ($terms as $term) {
              if ($term->parent == 0) {
                  $thumbnail_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );

                  echo '<div class="span3">';
                    echo '<p class="w100"><a href="' . get_term_link( $term->slug, 'product_cat' ) . '" title="' . sprintf(__('View all products filed under %s', 'desirees'), $term->name) . '" class="w100">' . '<!--<img class="lazyload" data-src="' . $image = wp_get_attachment_url( $thumbnail_id ) . '">-->' . '<span class="button big w100">' . $term->name . '</span>' . '</a></p>';
                  echo '</div>';
              }
          }
      }

      // print_r($terms)

       ?>
    </div>

	</div>

  <!-- slider -->

	<div class="center777">
		<hr>
		<div class="row f-center">

      <?php if ( get_field('fp_shopdesc_title_1') || get_field('fp_shopdesc_text_1') ) : ?>
  			<div class="span4">
  				<img class="lazyload" data-src="<?php echo wp_get_attachment_image_src(get_field('fp_shopdesc_img_1'), 'medium')[0]; ?>" alt="<?php echo get_the_title(get_field('fp_shopdesc_img_1')); ?>">
  				<h2><?php the_field('fp_shopdesc_title_1'); ?></h2>
          <div>
            <?php the_field('fp_shopdesc_text_1'); ?>
          </div>
  			</div>
      <?php endif; ?>
      <?php if ( get_field('fp_shopdesc_title_2') || get_field('fp_shopdesc_text_2') ) : ?>
        <div class="span4">
          <img class="lazyload" data-src="<?php echo wp_get_attachment_image_src(get_field('fp_shopdesc_img_2'), 'medium')[0]; ?>" alt="<?php echo get_the_title(get_field('fp_shopdesc_img_2')); ?>">
          <h2><?php the_field('fp_shopdesc_title_2'); ?></h2>
          <div>
            <?php the_field('fp_shopdesc_text_2'); ?>
          </div>
        </div>
      <?php endif; ?>
      <?php if ( get_field('fp_shopdesc_title_3') || get_field('fp_shopdesc_text_3') ) : ?>
        <div class="span4">
          <img class="lazyload" data-src="<?php echo wp_get_attachment_image_src(get_field('fp_shopdesc_img_3'), 'medium')[0]; ?>" alt="<?php echo get_the_title(get_field('fp_shopdesc_img_3')); ?>">
          <h2><?php the_field('fp_shopdesc_title_3'); ?></h2>
          <div>
            <?php the_field('fp_shopdesc_text_3'); ?>
          </div>
        </div>
      <?php endif; ?>

		</div>
		<hr>
	</div>
</div>

<?php get_footer(); ?>
