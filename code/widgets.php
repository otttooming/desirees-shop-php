<?php
add_action( 'widgets_init', 'etheme_register_general_widgets' );
function etheme_register_general_widgets() {
  register_widget('Etheme_Subcategories_Widget');
}

class Etheme_Subcategories_Widget extends WP_Widget {

    function Etheme_Subcategories_Widget() {
        $widget_ops = array( 'clasname' => 'etheme_subcats', 'description' => __('Display a list of subcategories on Category Page', ETHEME_DOMAIN));
        $control_ops = array('id_base' => 'etheme-subcategories');
        parent::__construct('etheme-subcategories', '8theme - '.__('Subcategories List', ETHEME_DOMAIN), $widget_ops, $control_ops);
    }
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
	}
	function form( $instance ) {
		$defaults = array( 'title' => 'Categories' );
		$instance = wp_parse_args( (array) $instance, $defaults );
		etheme_widget_input_text( __('Title:', ETHEME_DOMAIN), $this->get_field_id( 'title' ), $this->get_field_name( 'title' ), $instance['title'] );
	}
    function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		echo $before_widget;
        if(class_exists('WP_eCommerce')) {
            etheme_get_categories_menu($title);
        }
        if(class_exists('Woocommerce')){
            etheme_get_wc_categories_menu($title);
        }
		echo $after_widget;
	}
}

/* Forms
-------------------------------------------------------------- */
function etheme_widget_label( $label, $id ) {
	echo "<label for='{$id}'>{$label}</label>";
}
function etheme_widget_input_checkbox( $label, $id, $name, $checked ) {
	echo "\n\t\t\t<p>";
	echo "<label for='{$id}'>";
	echo "<input type='checkbox' id='{$id}' name='{$name}' {$checked} /> ";
	echo "{$label}</label>";
	echo '</p>';
}
function etheme_widget_textarea( $label, $id, $name, $value ) {
	echo "\n\t\t\t<p>";
	etheme_widget_label( $label, $id );
	echo "<textarea id='{$id}' name='{$name}' rows='3' cols='10' class='widefat'>" . strip_tags( $value ) . "</textarea>";
	echo '</p>';
}
function etheme_widget_input_text( $label, $id, $name, $value ) {
	echo "\n\t\t\t<p>";
	etheme_widget_label( $label, $id );
	echo "<input type='text' id='{$id}' name='{$name}' value='" . strip_tags( $value ) . "' class='widefat' />";
	echo '</p>';
}
function etheme_widget_input_text_small( $label, $id, $name, $value ) {
	echo "\n\t\t\t<p>";
	etheme_widget_label( $label, $id );
	echo "<input type='text' id='{$id}' name='{$name}' value='" . strip_tags( $value ) . "' size='6' class='code' />";
	echo '</p>';
}
function etheme_widget_select_multiple( $label, $id, $name, $value, $options, $blank_option ) {
	$value = (array) $value;
	if ( $blank_option && is_array( $options ) )
		$options = array_merge( array( '' ), $options );
	echo "\n\t\t\t<p>";
	etheme_widget_label( $label, $id );
	echo "<select id='{$id}' name='{$name}[]' multiple='multiple' size='4' class='widefat' style='height:5.0em;'>";
	foreach ( $options as $option_value => $option_label )
		echo "<option value='" . ( ( $option_value ) ? $option_value : $option_label ) . "'" . ( ( in_array( $option_value, $value ) || in_array( $option_label, $value ) ) ? " selected='selected'" : '' ) . ">{$option_label}</option>";
	echo '</select>';
	echo '</p>';
}
function etheme_widget_select_single( $label, $id, $name, $value, $options, $blank_option, $class = '' ) {
	$class = ( ( $class ) ? $class : 'widefat;' );
	if ( $blank_option )
		$options = array_merge( array( '' ), $options );
	echo "\n\t\t\t<p>";
	etheme_widget_label( $label, $id );
	echo "<select id='{$id}' name='{$name}' class='{$class}'>";
	foreach ( $options as $option_value => $option_label ) {
		$option_value = (string) $option_value;
		$option_label = (string) $option_label;
		echo "<option value='" . ( ( $option_value ) ? $option_value : $option_label ) . "'" . ( ( $value == $option_value || $value == $option_label ) ? " selected='selected'" : '' ) . ">{$option_label}</option>";
	}
	echo '</select>';
	echo '</p>';
}
