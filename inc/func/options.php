<?php
/**
 * Desirees engine room.
 */
function theme_settings_page() {
    ?>
	    <div class="wrap">
	    <h1>Theme Panel</h1>
	    <form method="post" action="options.php" enctype="multipart/form-data">
	      <?php
					settings_fields('section');
					do_settings_sections('theme-options');
    			submit_button();
    		?>
	    </form>
		</div>
	<?php
}

function desirees_theme_options_menu_item() {
    add_menu_page('Theme Panel', 'Theme Panel', 'manage_options', 'theme-panel', 'theme_settings_page', null, 99);
}

add_action('admin_menu', 'desirees_theme_options_menu_item');

function display_contact_element() {
    ?>
    	<input type="text" name="contact_tel" id="contact_tel" value="<?php echo get_option('contact_tel'); ?>" />
    <?php
}

function display_twitter_element() {
    ?>
    	<input type="text" name="twitter_url" id="twitter_url" value="<?php echo get_option('twitter_url'); ?>" />
    <?php
}

function display_facebook_element() {
    ?>
    	<input type="text" name="facebook_url" id="facebook_url" value="<?php echo get_option('facebook_url'); ?>" />
    <?php
}

function display_layout_element() {
    ?>
		<input type="checkbox" name="layout_fixed_nav" value="1" <?php checked(1, get_option('layout_fixed_nav'), true); ?> />
	<?php
}

add_action('admin_init', 'display_theme_panel_fields');

function display_company_logo() {
    ?>
        <input type="file" name="company_logo" />
        <?php echo get_option('company_logo'); ?>
   <?php
}

function handle_logo_upload() {
    if (!empty($_FILES['company_logo']['tmp_name'])) {
        $urls = wp_handle_upload($_FILES['company_logo'], array('test_form' => false));
        $temp = $urls['url'];

        return $temp;
    }

    return $option;
}

function display_theme_panel_fields() {
    add_settings_section('section', 'All Settings', null, 'theme-options');

		add_settings_field('contact_tel', 'Contact telephone nr', 'display_contact_element', 'theme-options', 'section');

    add_settings_field('twitter_url', 'Twitter Profile Url', 'display_twitter_element', 'theme-options', 'section');
    add_settings_field('facebook_url', 'Facebook Profile Url', 'display_facebook_element', 'theme-options', 'section');

    add_settings_field('layout_fixed_nav', 'Fixed navigation', 'display_layout_element', 'theme-options', 'section');

    add_settings_field('company_logo', 'Logo', 'display_company_logo', 'theme-options', 'section');

		register_setting('section', 'contact_tel');
    register_setting('section', 'twitter_url');
    register_setting('section', 'facebook_url');

    register_setting('section', 'layout_fixed_nav');

    register_setting('section', 'company_logo', 'handle_logo_upload');
}

add_action('admin_init', 'display_theme_panel_fields');
