<?php
/*
 * Plugin Name: Logo Slider
 * Plugin URI: http://www.wordpress.org/extend/plugins/logo-slider
 * Description: Add a logo slideshow carousel to your site quickly and easily.
 * Version: 1.4.8
 * Author: EnigmaWeb
 * Author URI: https://profiles.wordpress.org/enigmaweb/
 * Text Domain: logo-slider
 * Domain Path: /languages
 */


include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

define( 'LOGO_SLIDER', plugin_dir_url( __FILE__ ) );

define( 'LS_SITE_URL', site_url() );


//++++++++++++++_ Register Admin Scripts
add_action( 'admin_enqueue_scripts', 'wp_lsp_scripts' );
function wp_lsp_scripts() {
	wp_enqueue_script( 'jquery' );

	wp_enqueue_script( 'jquery-ui-sortable' );

	wp_register_style( 'lsp_admin_css', LOGO_SLIDER . 'includes/css/lsp_style.css' );
	wp_enqueue_style( 'lsp_admin_css' );

	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'cp-script-handle', LOGO_SLIDER . 'includes/js/lsp_colorpicker.js', array( 'wp-color-picker' ), false, true );

	wp_enqueue_media();

	wp_enqueue_script( 'media-upload' );
	wp_enqueue_script( 'thickbox' );

	wp_enqueue_style( 'thickbox' );

	wp_register_script( 'lsp_media_box', LOGO_SLIDER . 'includes/js/lsp_media_box.js' );

	if ( isset( $_GET["page"] ) ) {

		$page = $_GET["page"];
		if ( $page == "manage_images" ) {
			wp_enqueue_script( 'lsp_media_box' );
		}

	}
}

//++++++++++++++_ Call jQuery Cycle2
add_action( 'wp_footer', 'ls_logoslider_scripts' );
function ls_logoslider_scripts() {
	if ( ! is_admin() ) {

	    wp_enqueue_script('jquery');

		wp_register_script( 'jquery_cycle2', LOGO_SLIDER . "includes/js/lsp_jquery.cycle2.js", 'jquery', '2.1.2', true );
	}
	wp_enqueue_script( 'jquery_cycle2' );
	/*------------------------------------------------------------------------------------------------------------------*/

	wp_register_script( 'jquery_cycle2_carousel_min', LOGO_SLIDER . 'includes/js/lsp_jquery.cycle2.carousel.min.js', 'jquery', true );
	wp_enqueue_script( 'jquery_cycle2_carousel_min' );

	wp_register_script( 'jquery_cycle2_shuffle', LOGO_SLIDER . 'includes/js/lsp_jquery_shuffle.js', 'jquery', true );
	wp_enqueue_script( 'jquery_cycle2_shuffle' );

	wp_register_script( 'jquery_cycle2_easing', LOGO_SLIDER . 'includes/js/lsp_jquery.easing.js', 'jquery', true );
	wp_enqueue_script( 'jquery_cycle2_easing' );

	wp_register_script( 'jquery_cycle2_tile', LOGO_SLIDER . 'includes/js/lsp_jquery_tile.js', 'jquery', true );
	wp_enqueue_script( 'jquery_cycle2_tile' );
}

//++++++++++++++_ Register Settings for Logo Slider Pro
add_action( 'admin_init', 'ls_register_settings' );
function ls_register_settings() {
	register_setting( 'lsp_settings_group', 'lsp_slider_width' );
	register_setting( 'lsp_settings_group', 'lsp_slider_height' );
	register_setting( 'lsp_settings_group', 'lsp_image_per_slide' );
	register_setting( 'lsp_settings_group', 'lsp_link_new_window' );
	register_setting( 'lsp_settings_group', 'lsp_slider_effect' );
	register_setting( 'lsp_settings_group', 'lsp_auto_slide' );
	register_setting( 'lsp_settings_group', 'lsp_auto_slide_time' );
	register_setting( 'lsp_settings_group', 'lsp_slider_arrow' );
	register_setting( 'lsp_settings_group', 'lsp_slider_bgcolor' );
	register_setting( 'lsp_settings_group', 'lsp_slider_css' );
	register_setting( 'lsp_settings_group', 'lsp_pro_license' );
}

//++++++++++++++_ Define Logo Slider Options
define( 'LS_SLIDER_WIDTH', get_option( 'lsp_slider_width' ) );
define( 'LS_SLIDER_HEIGHT', get_option( 'lsp_slider_height' ) );
define( 'LS_SLIDER_PER_SLIDE', get_option( 'lsp_image_per_slide' ) );
define( 'LS_SLIDER_NEW_WINDOW', get_option( 'lsp_link_new_window' ) );
define( 'LS_SLIDER_EFFECT', get_option( 'lsp_slider_effect' ) );
define( 'LS_SLIDER_AUTO', get_option( 'lsp_auto_slide' ) );
define( 'LS_SLIDER_TIME', get_option( 'lsp_auto_slide_time' ) );
define( 'LS_SLIDER_ARROW', get_option( 'lsp_slider_arrow' ) );
define( 'LS_SLIDER_BGCOLOR', get_option( 'lsp_slider_bgcolor' ) );
define( 'LS_SLIDER_CSS', get_option( 'lsp_slider_css' ) );

//++++++++++++++_ Plugin Menu
add_action( 'admin_menu', 'ls_plugin_menu' );
function ls_plugin_menu() {
	add_menu_page( 'Logo Slider', 'Logo Slider', 'manage_options', 'ls_options', 'wp_ls_options', LOGO_SLIDER . "/includes/images/lsp_icon.png", 66 );

	add_submenu_page( 'ls_options', 'Manage Logo Sliders', 'Manage Sliders', 'manage_options', 'manage_sliders', 'manage_logo_sliders' );

	add_submenu_page( 'ls_options', 'Plugin Settings', 'Settings', 'manage_options', 'ls_settings', 'wp_ls_options' );

	add_submenu_page( 'ls_options', '', '', 'manage_options', 'manage_images', 'manage_logo_images' );

	remove_submenu_page('ls_options', 'ls_options');
}

//++++++++++++++_ Require Files

require "includes/ls_database.php";

require "ls_logoslider.php";

function wp_ls_options() {
	require "ls_settings.php";
}

function manage_logo_sliders() {
	require "ls_manage_sliders.php";
}

function manage_logo_images() {
	require "ls_manage_images.php";
}

//++++++++++++++_ Re-Order Images
function ls_image_sorting() {
	?>
    <script type="text/javascript">

        jQuery(document).ready(function () {
            jQuery('#lsp_sort_image').sortable({
                items: '.lsp_image_item',
                opacity: 0.5,
                cursor: 'pointer',
                axis: 'y',
                update: function () {
                    var lsp_order = '&action=lsp_update_order&lsp_img=' + jQuery(this).sortable("toArray") + '&db_action=lsp_order_img_list';
                    //alert(lsp_order);
                    jQuery.ajax({
                        type: 'POST',
                        url: ajaxurl,
                        cache: false,
                        data: lsp_order,
                        beforeSend: function () {
                        },
                        success: function (res) {
                        }
                    });
                }
            });
        });

    </script>
	<?php
}

add_action( 'admin_head', 'ls_image_sorting' );

function ls_image_order_list() {
	global $wpdb;
	$order_tbl = $wpdb->prefix . "lsp_images";

	$lsp_img = stripslashes( strip_tags( $_POST['lsp_img'] ) );
	$lsp_img = stripslashes( str_replace( "lsp_list_", "", $lsp_img ) );

	$lsp_reorder_img = explode( ',', $lsp_img );

	$lsp_dbaction = stripslashes( strip_tags( $_POST['db_action'] ) );

	if ( $lsp_dbaction == "lsp_order_img_list" ) {
		$lsp_count = 1;

		foreach ( $lsp_reorder_img as $reorder_img ) {
			$order_data = array(
				"image_order" => $lsp_count
			);

			$order_where = array(
				"image_id" => $reorder_img
			);

			$wpdb->update( $order_tbl, $order_data, $order_where );

			$lsp_count = $lsp_count + 1;
		}
	}
}

add_action( 'wp_ajax_lsp_update_order', 'ls_image_order_list' );

//++++++++++++++_ Define Devices
$iPod       = stripos( $_SERVER['HTTP_USER_AGENT'], "iPod" );
$iPhone     = stripos( $_SERVER['HTTP_USER_AGENT'], "iPhone" );
$iPad       = stripos( $_SERVER['HTTP_USER_AGENT'], "iPad" );
$Android    = stripos( $_SERVER['HTTP_USER_AGENT'], "Android" );
$webOS      = stripos( $_SERVER['HTTP_USER_AGENT'], "webOS" );
$mobile     = stripos( $_SERVER['HTTP_USER_AGENT'], "mobile" );
$BlackBerry = stripos( $_SERVER['HTTP_USER_AGENT'], "BlackBerry" );
$RimTablet  = stripos( $_SERVER['HTTP_USER_AGENT'], "RIM Tablet" );

$msie    = strpos( $_SERVER["HTTP_USER_AGENT"], 'MSIE' );
$firefox = strpos( $_SERVER["HTTP_USER_AGENT"], 'Firefox' );
$safari  = strpos( $_SERVER["HTTP_USER_AGENT"], 'Safari' );
$chrome  = strpos( $_SERVER["HTTP_USER_AGENT"], 'Chrome' );
$Opera   = strpos( $_SERVER["HTTP_USER_AGENT"], 'OPR' );
$IE11    = strpos( $_SERVER["HTTP_USER_AGENT"], 'rv:11.0' );

define( 'LSP_IPOD', $iPod );
define( 'LSP_IPHONE', $iPhone );
define( 'LSP_IPAD', $iPad );
define( 'LSP_ANDROID', $Android );
define( 'LSP_WEBOS', $webOS );
define( 'LSP_MOBILE', $mobile );
define( 'LSP_BLACKBERRY', $BlackBerry );
define( 'LSP_RIMTABLET', $RimTablet );
define( 'LSP_MSIE', $msie );
define( 'LSP_FIREFOX', $firefox );
define( 'LSP_SAFARI', $safari );
define( 'LSP_CHROME', $chrome );
define( 'LSP_OPERA', $Opera );
define( 'LSP_IE11', $IE11 );

//++++++++++++++_ CSS Start
add_action( 'wp_head', 'lsp_css_style' );
function lsp_css_style() {
	$ls_arrows = get_option( 'lsp_slider_arrow' );

	$lsp_arraow_img_next = '';
	$lsp_arraow_img_prev = '';

	switch ( $ls_arrows ) {
		case '1':
			$lsp_arraow_img_next = LOGO_SLIDER . "ls_arrows/lsp_arrow1_next.png";
			$lsp_arraow_img_prev = LOGO_SLIDER . "ls_arrows/lsp_arrow1_prev.png";
			break;
		case '2':
			$lsp_arraow_img_next = LOGO_SLIDER . "ls_arrows/lsp_arrow2_next.png";
			$lsp_arraow_img_prev = LOGO_SLIDER . "ls_arrows/lsp_arrow2_prev.png";
			break;
		case '3':
			$lsp_arraow_img_next = LOGO_SLIDER . "ls_arrows/lsp_arrow3_next.png";
			$lsp_arraow_img_prev = LOGO_SLIDER . "ls_arrows/lsp_arrow3_prev.png";
			break;
		case '4':
			$lsp_arraow_img_next = LOGO_SLIDER . "ls_arrows/lsp_arrow4_next.png";
			$lsp_arraow_img_prev = LOGO_SLIDER . "ls_arrows/lsp_arrow4_prev.png";
			break;
		case '5':
			$lsp_arraow_img_next = LOGO_SLIDER . "ls_arrows/lsp_arrow5_next.png";
			$lsp_arraow_img_prev = LOGO_SLIDER . "ls_arrows/lsp_arrow5_prev.png";
			break;
		case '6':
			$lsp_arraow_img_next = LOGO_SLIDER . "ls_arrows/lsp_arrow6_next.png";
			$lsp_arraow_img_prev = LOGO_SLIDER . "ls_arrows/lsp_arrow6_prev.png";
			break;
		case '7':
			$lsp_arraow_img_next = LOGO_SLIDER . "ls_arrows/lsp_arrow7_next.png";
			$lsp_arraow_img_prev = LOGO_SLIDER . "ls_arrows/lsp_arrow7_prev.png";
			break;
	}

	$sp  = LS_SLIDER_WIDTH / 2;
	$sp1 = $sp - 45;
	?>
    <style type="text/css">
        <?php echo get_option('lsp_slider_css'); ?>
        .lsp_main_slider {
            background-color: <?php echo LS_SLIDER_BGCOLOR; ?>;
        / / float: left;
            width: <?php echo LS_SLIDER_WIDTH; ?>px;
            height: <?php echo LS_SLIDER_HEIGHT; ?>px;
            padding: 8px;
            position: relative;
            margin-bottom: 24px;
        }

        .lsp_slider_controls {
            position: relative;
            top: 50%;
            margin-top: -20px;
        }

        .lsp_next_btn {
            background: url(<?php echo $lsp_arraow_img_next; ?>) no-repeat center;
            float: right;
            width: 40px;
            height: 40px;
            display: inline-block;
            text-indent: -9000px;
            cursor: pointer;
        }

        .lsp_prev_btn {
            background: url(<?php echo $lsp_arraow_img_prev; ?>) no-repeat center;
            float: float;
            width: 40px;
            height: 40px;
            display: inline-block;
            text-indent: -9000px;
            cursor: pointer;
        }

        .lsp_slider_img {
            height: auto;
            margin-top: -<?php echo LS_SLIDER_HEIGHT / 2; ?>px;
            overflow: hidden;
            position: absolute;
            top: 50%;
            left: 50%;
        <?php
            if(LS_SLIDER_EFFECT != 'carousel'){
        ?> text-align: center;
        <?php
            }
        ?> width: <?php echo LS_SLIDER_WIDTH - 90; ?>px;
/*            margin-left: -*/<?php //echo $sp1; ?>/*px;*/
        }

        .lsp_img_div {
            width: 100%;
            height: auto;
        }

        /* Visibilties */
        .visible_phone {
            visibility: hidden;
            display: none;
        }

        .visible_desktop {
            visibility: visible;
        }

        /* ============================= */
        /* ! Layout for phone version   */
        /* ============================= */

        /*Rsponsive layout 1024*/
        @media screen and (min-width: 801px) and (max-width: 1024px) {

            .visible_phone {
                visibility: visible;
                display: inherit;
            }

            .visible_desktop {
                visibility: hidden;
                display: none;
            }

            .lsp_main_slider {
                background-color: <?php echo LS_SLIDER_BGCOLOR; ?>;
            / / float: left;
                height: <?php echo LS_SLIDER_HEIGHT; ?>px;
                padding: 8px;
                position: relative;
                width: 100%;
                margin-bottom: 24px;
            }

            .lsp_slider_img {
                height: auto;
                margin-left: -334px;
                margin-top: -65px;
                overflow: hidden;
                position: absolute;
                top: 50%;
                left: 50%;
                width: 668px;
            <?php
				if(LS_SLIDER_EFFECT != 'carousel'){
			?> text-align: center;
            <?php
				}
			?>
            }

        }

        /*Rsponsive layout 768*/
        @media screen and (min-width: 641px) and (max-width: 800px) {

            .visible_phone {
                visibility: visible;
                display: inherit;
            }

            .visible_desktop {
                visibility: hidden;
                display: none;
            }

            .lsp_main_slider {
                background-color: <?php echo LS_SLIDER_BGCOLOR; ?>;
            / / float: left;
                height: <?php echo LS_SLIDER_HEIGHT; ?>px;
                padding: 8px;
                position: relative;
                width: 100%;
                margin-bottom: 24px;
            }

            .lsp_slider_img {
                height: auto;
                margin-left: -256px;
                margin-top: -65px;
                overflow: hidden;
                position: absolute;
                top: 50%;
                left: 50%;
                width: 512px;
            <?php
				if(LS_SLIDER_EFFECT != 'carousel'){
			?> text-align: center;
            <?php
				}
			?>
            }

        }

        /*Rsponsive layout 640*/
        @media screen and (min-width: 481px) and (max-width: 640px) {

            .visible_phone {
                visibility: visible;
                display: inherit;
            }

            .visible_desktop {
                visibility: hidden;
                display: none;
            }

            .lsp_main_slider {
                background-color: <?php echo LS_SLIDER_BGCOLOR; ?>;
            / / float: left;
                height: <?php echo LS_SLIDER_HEIGHT; ?>px;
                padding: 8px;
                position: relative;
                width: 100%;
                margin-bottom: 24px;
            }

            .lsp_slider_img {
                height: auto;
                margin-left: -176px;
                margin-top: -65px;
                overflow: hidden;
                position: absolute;
                top: 50%;
                left: 50%;
                width: 346px;
            <?php
				if(LS_SLIDER_EFFECT != 'carousel'){
			?> text-align: center;
            <?php
				}
			?>
            }

        }

        /*Rsponsive layout 480*/
        @media screen and (min-width: 320px) and (max-width: 480px) {
            .visible_phone {
                visibility: visible;
                display: inherit;
            }

            .visible_desktop {
                visibility: hidden;
                display: none;
            }

            .lsp_main_slider {
                background-color: <?php echo LS_SLIDER_BGCOLOR; ?>;
            / / float: left;
                height: <?php echo LS_SLIDER_HEIGHT; ?>px;
                padding: 8px;
                position: relative;
                width: 100%;
                margin-bottom: 24px;
            }

            .lsp_slider_img {
                height: auto;
                margin-left: -91px;
                margin-top: -65px;
                overflow: hidden;
                position: absolute;
                top: 50%;
                left: 50%;
                width: 185px;
            <?php
				if(LS_SLIDER_EFFECT != 'carousel'){
			?> text-align: center;
            <?php
				}
			?>
            }

        }
    </style>
	<?php
}

?>