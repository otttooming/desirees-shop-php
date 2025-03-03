<?php
/**
 * Template Name: Frontpage minimal
 */

  get_header();
?>

<div class="container container__content">

  <?php if (  is_active_sidebar( 'fp-shopnav-1' ) || is_active_sidebar( 'fp-shopnav-2' ) ) : ?>
    <div class="row">
        <?php if (  is_active_sidebar( 'fp-shopnav-1' ) ) : ?>
          <div class="col-xs-12 col-sm-offset-2 <?php echo is_active_sidebar( 'fp-shopnav-2' ) ? 'col-sm-4' : 'col-sm-8'; ?>">
            <?php dynamic_sidebar( 'fp-shopnav-1' ); ?>
          </div>
        <?php endif; ?>

        <?php if (  is_active_sidebar( 'fp-shopnav-2' ) ) : ?>
          <div class="col-xs-12 <?php echo is_active_sidebar( 'fp-shopnav-1' ) ? 'col-sm-4' : 'col-sm-offset-2 col-sm-8'; ?>">
            <?php dynamic_sidebar( 'fp-shopnav-2' ); ?>
          </div>
        <?php endif; ?>
    </div>
  <?php endif; ?>

  <?php if (  is_active_sidebar( 'fp-slider-top' ) ) : ?>
    <div class="row">
        <div class="col-xs-12">
            <?php dynamic_sidebar( 'fp-slider-top' ); ?>
        </div>
    </div>
  <?php endif; ?>

  <?php if (  is_active_sidebar( 'fp-illustration-1' ) || is_active_sidebar( 'fp-illustration-2' ) || is_active_sidebar( 'fp-illustration-3' ) || is_active_sidebar( 'fp-illustration-4' ) ) : ?>
    <div class="row center-xs">
        <?php if (  is_active_sidebar( 'fp-illustration-1' ) ) : ?>
          <div class="col-xs-12 col-sm-3">
              <?php dynamic_sidebar( 'fp-illustration-1' ); ?>
          </div>
        <?php endif; ?>

        <?php if (  is_active_sidebar( 'fp-illustration-2' ) ) : ?>
          <div class="col-xs-12 col-sm-3">
            <?php dynamic_sidebar( 'fp-illustration-2' ); ?>
          </div>
        <?php endif; ?>

        <?php if (  is_active_sidebar( 'fp-illustration-3' ) ) : ?>
          <div class="col-xs-12 col-sm-3">
            <?php dynamic_sidebar( 'fp-illustration-3' ); ?>
          </div>
        <?php endif; ?>

        <?php if (  is_active_sidebar( 'fp-illustration-4' ) ) : ?>
          <div class="col-xs-12 col-sm-3">
            <?php dynamic_sidebar( 'fp-illustration-4' ); ?>
          </div>
        <?php endif; ?>
    </div>
  <?php endif; ?>


  <div class="row center-xs">
    <?php
    $args = array( 'taxonomy' => 'product_cat' );
    $terms = get_terms('product_cat', $args);

    if (count($terms) > 0) {
        foreach ($terms as $term) {
            if ($term->parent == 0) {
                $thumbnail_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
                ?>

                    <div class="col-xs-12 col-sm-3">
                        <a href="<?php echo get_term_link( $term->slug, 'product_cat' ); ?>" title="<?php echo __('Show', 'woocommerce') . ' ' . $term->name; ?>" class="button medium w-100">
                            <?php echo $term->name; ?>
                        </a>
                    </div>

                <?php
            }
        }
    } ?>
  </div>

  <?php if (  is_active_sidebar( 'fp-slogan-1' ) || is_active_sidebar( 'fp-slogan-2' ) || is_active_sidebar( 'fp-slogan-3' ) || is_active_sidebar( 'fp-slogan-4' ) ) : ?>
    <div class="row center-xs">
        <?php if (  is_active_sidebar( 'fp-slogan-1' ) ) : ?>
          <div class="col-xs-12 col-sm-6 col-md-3 d__flex">
            <div class="bg__common p1 w100">
              <?php dynamic_sidebar( 'fp-slogan-1' ); ?>
            </div>
          </div>
        <?php endif; ?>

        <?php if (  is_active_sidebar( 'fp-slogan-2' ) ) : ?>
          <div class="col-xs-12 col-sm-6 col-md-3 d__flex">
            <div class="bg__common p1 w100">
              <?php dynamic_sidebar( 'fp-slogan-2' ); ?>
            </div>
          </div>
        <?php endif; ?>

        <?php if (  is_active_sidebar( 'fp-slogan-3' ) ) : ?>
          <div class="col-xs-12 col-sm-6 col-md-3 d__flex">
            <div class="bg__common p1 w100">
              <?php dynamic_sidebar( 'fp-slogan-3' ); ?>
            </div>
          </div>
        <?php endif; ?>

        <?php if (  is_active_sidebar( 'fp-slogan-4' ) ) : ?>
          <div class="col-xs-12 col-sm-6 col-md-3 d__flex">
            <div class="bg__common p1 w100">
              <?php dynamic_sidebar( 'fp-slogan-4' ); ?>
            </div>
          </div>
        <?php endif; ?>
    </div>
  <?php endif; ?>
</div>

<?php get_footer(); ?>
