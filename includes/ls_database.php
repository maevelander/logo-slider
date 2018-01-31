<?php
/*
	Logo Slider Pro database:
		Create two tables 1)lsp_slider, 2)lsp_iamges
*/

//++++++++++++++_ Create Table: lsp_sliders
global $lsp_table_sliders_version;
$lsp_table_sliders_version = "1.0";

add_action('plugins_loaded', 'ls_create_table_sliders');

function ls_create_table_sliders() {
	global $wpdb;
	global $lsp_table_sliders_version;

	$table_sliders = $wpdb->prefix . "lsp_sliders";
	$slider_ver    = get_option( "lsp_table_sliders_version" );

	$check_table_slider = $wpdb->get_var( "SHOW TABLES LIKE '$table_sliders'" );

	if ( $check_table_slider != $table_sliders || $slider_ver != $lsp_table_sliders_version ) {
		$lsp_slider_sql = "CREATE TABLE " . $table_sliders . " (
                           `slider_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
                           `slider_name` VARCHAR(255) NOT NULL COLLATE 'utf8_general_ci',
                           `slider_shortcode` VARCHAR(255) NOT NULL COLLATE 'utf8_general_ci',
                           `slider_shortname` VARCHAR(255) NOT NULL COLLATE 'utf8_general_ci',
                           PRIMARY KEY (slider_id)
                           )COLLATE='utf8_general_ci', ENGINE = 'InnoDB';";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $lsp_slider_sql );

		update_option( "lsp_table_sliders_version", $lsp_table_sliders_version );
	} else {
		add_option( "lsp_table_sliders_version", $lsp_table_sliders_version );
	}
	// @TODO Troubleshooting required for duplicate slider from the previous version of the plugin
	//  Add data from Logo Slider Free Version
	$lsp_prefix = $wpdb->prefix;

	$lsp_option_images   = get_option( 'wp_logo_slider_images' );
	$lsp_option_settings = get_option( 'wp_logo_slider_settings' );

	if ( ( $lsp_option_settings ) && ( $lsp_option_images ) ) {

		$lsp_option_insert_slider = "insert into " . $lsp_prefix . "lsp_sliders (`slider_name`,`slider_shortcode`,`slider_shortname`) value ('First Slider','[lsp_slider slider=first_slider]','first_slider')";
		$wpdb->query( $lsp_option_insert_slider );
	}
}


//++++++++++++++_ Create Table: lsp_images
global $lsp_table_images_version;
$lsp_table_images_version = "1.0";

add_action('plugins_loaded', 'ls_create_table_images');

function ls_create_table_images() {
	global $wpdb;
	global $lsp_table_images_version;

	$table_images  = $wpdb->prefix . "lsp_images";
	$table_sliders = $wpdb->prefix . "lsp_sliders";
	$images_ver    = get_option( "lsp_table_images_version" );

	$check_table_images = $wpdb->get_var( "SHOW TABLES LIKE '$table_images'" );

	if ( $check_table_images != $table_images || $images_ver != $lsp_table_images_version ) {
		$lsp_image_sql = "CREATE TABLE " . $table_images . " (
                         `image_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
			 `slider_id` INT(11) UNSIGNED NOT NULL,
        		 `image_order` INT(4) NOT NULL,
        		 `image_name` VARCHAR(255) NOT NULL COLLATE 'utf8_general_ci',
			 `image_path` VARCHAR(255) NOT NULL COLLATE 'utf8_general_ci',
			 `image_link_to` VARCHAR(255) NULL COLLATE 'utf8_general_ci',
			 PRIMARY KEY (image_id),
			 INDEX slider_id (slider_id),
			 FOREIGN KEY (slider_id) 
			 REFERENCES $table_sliders(slider_id)
			 ON UPDATE CASCADE ON DELETE CASCADE
                         )COLLATE='utf8_general_ci', ENGINE = 'InnoDB';";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $lsp_image_sql );

		update_option( "lsp_table_images_version", $lsp_table_images_version );
	} else {
		add_option( "lsp_table_images_version", $lsp_table_images_version );
	}

	//  Add data from Logo Slider Free Version
	$lsp_prefix = $wpdb->prefix;

	$lsp_option_images   = get_option( 'wp_logo_slider_images' );
	$lsp_option_settings = get_option( 'wp_logo_slider_settings' );

	if ( ( $lsp_option_settings ) || ( $lsp_option_images ) ) {
		$lsp_opt_img_count = 1;
		foreach ( (array) $lsp_option_images as $option_imags => $option_image ) {
			$lsp_image_opt_url = $option_image['file_url'];
			$lsp_get_opt_path  = pathinfo( $lsp_image_opt_url );

			$lsp_opt_img_order   = $lsp_opt_img_count ++;
			$lsp_image_dir       = $lsp_get_opt_path['dirname'] . "/";
			$lsp_opti_image_name = $lsp_get_opt_path['basename'];
			$lsp_image_opt_link  = $option_image['image_links_to'];

			$lsp_option_insert_img = "insert into " . $lsp_prefix . "lsp_images (slider_id,image_order,image_name,image_path,image_link_to) value ('1','$lsp_opt_img_order','$lsp_opti_image_name','$lsp_image_dir','$lsp_image_opt_link')";
			$wpdb->query( $lsp_option_insert_img );
		}

		$lsp_slider_width_opt    = $lsp_option_settings['slider_width'];
		$lsp_slider_height_opt   = $lsp_option_settings['slider_height'];
		$lsp_image_per_slide_opt = $lsp_option_settings['num_img'];
		$lsp_link_new_window_opt = $lsp_option_settings['new_window'];
		$lsp_slider_effect_opt   = $lsp_option_settings['select_slider'];
		$lsp_auto_slide_opt      = $lsp_option_settings['auto_slide'];
		$lsp_auto_slide_time_opt = $lsp_option_settings['auto_slide_time'];
		$lsp_slider_arrow_opt    = $lsp_option_settings['arrow'];
		$lsp_slider_bgcolor_opt  = $lsp_option_settings['bgcolour'];
		$lsp_slider_css_opt      = $lsp_option_settings['custom_css'];

		add_option( 'lsp_slider_width', $lsp_slider_width_opt, 'yes' );
		add_option( 'lsp_slider_height', $lsp_slider_height_opt, 'yes' );
		add_option( 'lsp_image_per_slide', $lsp_image_per_slide_opt, 'yes' );
		add_option( 'lsp_link_new_window', $lsp_link_new_window_opt, 'yes' );
		add_option( 'lsp_slider_effect', $lsp_slider_effect_opt, 'yes' );
		add_option( 'lsp_auto_slide', $lsp_auto_slide_opt, 'yes' );
		add_option( 'lsp_auto_slide_time', $lsp_auto_slide_time_opt, 'yes' );
		add_option( 'lsp_slider_arrow', $lsp_slider_arrow_opt, 'yes' );
		add_option( 'lsp_slider_bgcolor', $lsp_slider_bgcolor_opt, 'yes' );
		add_option( 'lsp_slider_css', $lsp_slider_css_opt, 'yes' );

		delete_option( 'wp_logo_slider_images' );
		delete_option( 'wp_logo_slider_settings' );
	}
}