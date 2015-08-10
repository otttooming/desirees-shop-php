<?php
/**
 * The template for displaying search forms 
 *
 */
?>
    
<?php if(class_exists('Woocommerce')) : ?>
        
<form action="<?php echo home_url( '/' ); ?>" id="searchform" method="get"> 
    <input type="text" class="field" value="<?php if(get_search_query() == ''){  _e('Search for products', ETHEME_DOMAIN);} else { the_search_query(); } ?>"  onblur="if(this.value=='')this.value='<?php _e('Search for products', ETHEME_DOMAIN); ?>'" onfocus="if(this.value=='<?php _e('Search for products', ETHEME_DOMAIN); ?>')this.value=''" name="s" id="s" />
    <input type="submit" value="<?php esc_attr_e( 'Go', ETHEME_DOMAIN ); ?>" class="button"  /> 
    <input type="hidden" name="post_type" value="product" />
	<div  class="adv_search_option">
	<select name="product_cat">
		<option value="">Kategooria</option>
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
	</div>
</form>
<?php else: ?>
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search entire store here...', ETHEME_DOMAIN ); ?>" />
        <input type="hidden" name="post_type" value="post" />
        <input type="submit" value="<?php esc_attr_e( 'Go', ETHEME_DOMAIN ); ?>" class="button" />
	</form>
<?php endif ?>