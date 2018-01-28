<?php
//if uninstall not called from WordPress exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )
    exit ();

    global $wpdb;
    $lsp_tbl_prefix = $wpdb->prefix;
	
//++++++++++++_ Delete Logo slider Pro Plugin Settings from Options Table
    delete_option('lsp_auto_slide');
    delete_option('lsp_slider_css');
    delete_option('lsp_pro_license');
    delete_option('lsp_slider_arrow');
    delete_option('lsp_slider_width');
    delete_option('lsp_slider_height');
    delete_option('lsp_slider_effect');
    delete_option('lsp_slider_bgcolor');
    delete_option('lsp_image_per_slide');
    delete_option('lsp_link_new_window');
    delete_option('lsp_auto_slide_time');
    delete_option('lsp_table_images_version');
    delete_option('lsp_table_sliders_version');

//++++++++++++_ Delete Logo slider Pro Data From `posts` and `postmeta` Tables
    $lsp_upload_dir = wp_upload_dir();

    $lsp_postmeta_qry = $wpdb->get_results("Select * From ".$lsp_tbl_prefix."postmeta
                                            Where meta_value Like '%lsp_img_%'
                                            Group By post_id");
    foreach($lsp_postmeta_qry as $lsp_postmeta_result){
        $lsp_post_id = $lsp_postmeta_result->post_id;

        $lsp_posts_qry = $wpdb->get_results("Select * From ".$lsp_tbl_prefix."posts
                                             Where ID = $lsp_post_id
                                             And post_type = 'attachment'
                                             And post_mime_type = 'image/jpeg'");
        foreach($lsp_posts_qry as $lsp_posts_result){
            $lsp_postID = $lsp_posts_result->ID;

            // Extract path from images
            $lsp_img_path = get_post_meta($lsp_postID, "_wp_attached_file", true);
            $lsp_main_img_name = substr( $lsp_img_path, strrpos( $lsp_img_path, '/' )+1 );
            $lsp_sub_path = substr($lsp_img_path, 0, strrpos( $lsp_img_path, '/'));

            $lsp_img_meta = get_post_meta($lsp_postID, "_wp_attachment_metadata", true);

            $lsp_slider_img = $lsp_img_meta['file'];
            $lsp_upload_path = $lsp_upload_dir["basedir"];

            unlink($lsp_upload_path."/".$lsp_sub_path."/".$lsp_main_img_name);

            $wpdb->query("Delete From ".$lsp_tbl_prefix."postmeta Where post_id = $lsp_postID");

            $wpdb->query("Delete From ".$lsp_tbl_prefix."posts Where ID = $lsp_postID");
        }
    }

//++++++++++++_ Drop `lsp_images` and `lsp_sliders` Tables
    $wpdb->query("Drop Table ".$lsp_tbl_prefix."lsp_images");

    $wpdb->query("Drop Table ".$lsp_tbl_prefix."lsp_sliders");

?>