<?php
/**
 * The template for displaying search forms
 *
 */
?>

<?php if(class_exists('Woocommerce')) : ?>

  <form action="<?php echo home_url( '/' ); ?>" method="get" id="search__form" class="search__form">
      <input
          type="text"
          class="search__field"
          value="<?php if(get_search_query() == ''){ _e( 'Search', 'woocommerce' ); } else { the_search_query(); } ?>"
          onblur="if(this.value=='')this.value='<?php _e( 'Search', 'woocommerce' ); ?>'"
          onfocus="if(this.value=='<?php _e( 'Search', 'woocommerce' ); ?>')this.value=''"
          name="s" id="s">

      <input type="hidden" name="post_type" value="product" />

    	<select name="product_cat" class="search__select">
    		<option value=""><?php  _e( 'Categories', 'woocommerce' ) ?></option>
    		<?php
    		// generate list of categories
    		$catTerms = get_terms('product_cat', array(
    		    'orderby'       => 'name',
    		    'order'         => 'ASC',
    		    'hide_empty'    => false,
    		    'exclude'       => array(),
    		    'exclude_tree'  => array(),
    		    'include'       => array(),
    		    'number'        => '',
    		    'fields'        => 'all',
    		    'slug'          => '',
    		    'parent'         => '0',
    		    'hierarchical'  => true,
    		    'child_of'      => 0,
    		    'get'           => '',
    		    'name__like'    => '',
    		    'pad_counts'    => false,
    		    'offset'        => '',
    		    'search'        => '',
    		    'cache_domain'  => 'core'
    		));
    		foreach ($catTerms as $catTerm) {
    		    echo '<option value="', $catTerm->slug, '">', $catTerm->name, "</option>\n";
    		}
    		?>
    	</select>

      <button type="submit" value="<?php _e( 'Search', 'woocommerce' ); ?>" class="search__button button">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 250.313 250.313"><path d="M244.186 214.604l-54.38-54.378c-.288-.29-.627-.49-.93-.76 10.7-16.23 16.946-35.66 16.946-56.554C205.822 46.075 159.747 0 102.912 0S0 46.075 0 102.91c0 56.836 46.074 102.912 102.91 102.912 20.895 0 40.323-6.245 56.554-16.945.27.3.47.64.76.93l54.38 54.38c8.168 8.167 21.412 8.167 29.582 0 8.168-8.17 8.168-21.414 0-29.583zM102.91 170.146c-37.133 0-67.235-30.102-67.235-67.235 0-37.133 30.103-67.235 67.236-67.235s67.236 30.103 67.236 67.236c0 37.134-30.103 67.236-67.235 67.236z" fill-rule="evenodd" clip-rule="evenodd" fill="currentColor"/></svg>
        <span><?php _e( 'Search', 'woocommerce' ); ?></span>
      </button>
  </form>

<?php else: ?>

	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		  <input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search entire store here...', 'desirees' ); ?>">
      <input type="hidden" name="post_type" value="post">
      <input type="submit" value="<?php esc_attr_e( 'Go', 'desirees' ); ?>" class="button">
	</form>

<?php endif ?>
