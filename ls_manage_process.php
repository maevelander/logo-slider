<?php
    require_once( str_replace('//','/',dirname(__FILE__).'/') .'../../../wp-config.php');
    global $wpdb;
    $lsp_action = $_REQUEST['lsp_action'];
    
    switch ($lsp_action){
    /*_++++++++++^^^^^^^^=============== <Slider Proccess> ===============^^^^^^^^++++++++++_*/
        case "add_slider":
            $slider_add = $wpdb->prefix."lsp_sliders";
    
            $lsp_slider_name = stripslashes(strip_tags($_POST['lsp_add_slider']));

            $slider_shortname = str_replace(" ", "_", $lsp_slider_name);
            $slider_shortname = strtolower($slider_shortname);
            $slider_shortcode = "[lsp_slider slider=$slider_shortname]";

            $slider_data = array(
                'slider_name'       =>  $lsp_slider_name,
                'slider_shortcode'  =>  $slider_shortcode,
                'slider_shortname'  =>  $slider_shortname
            );

            if(!empty($lsp_slider_name)){
                
                $slider_insert = $wpdb->insert($slider_add,$slider_data);
            
                header( "Location: " . LS_SITE_URL . "/wp-admin/admin.php?page=manage_sliders&lsp_msg=add_slider_success");
            }
            else{
                header( "Location: " . LS_SITE_URL . "/wp-admin/admin.php?page=manage_sliders&lsp_msg=add_slider_error");
            }
        break;
    
        case "edit_slider":
            $slider_edit = $wpdb->prefix."lsp_sliders";
            
            $lsp_slider_id = $_POST['lsp_slider_id'];
            
            $lsp_edit_slider = stripslashes(strip_tags($_POST['lsp_edit_slider']));
            
            $slider_edit_shortname = str_replace(" ", "_", $lsp_edit_slider);
            $slider_edit_shortname = strtolower($slider_edit_shortname);
            $slider_edit_shortcode = "[lsp_slider slider=$slider_edit_shortname]";
            
            $slider_edit_data = array(
                'slider_name' => $lsp_edit_slider,
                'slider_shortcode' => $slider_edit_shortcode,
                'slider_shortname' => $slider_edit_shortname
            );
            
            $slider_where = array(
                'slider_id' => $lsp_slider_id
            );
            
            if(!empty($lsp_edit_slider)){
                
                $slider_update = $wpdb->update($slider_edit, $slider_edit_data, $slider_where);
            
                header( "Location: " . LS_SITE_URL . "/wp-admin/admin.php?page=manage_sliders&lsp_msg=edit_slider_success");
            }
            else{
                header( "Location: " . LS_SITE_URL . "/wp-admin/admin.php?page=manage_sliders&lsp_msg=edit_slider_error");
            }
        break;
    
        case "del_slider":
            $slider_del = $wpdb->prefix."lsp_sliders";
            
            $lsp_slider_id = $_GET['lsp_slider'];
            
            $slider_where = array(
                'slider_id' => $lsp_slider_id
            );
            
            $slider_delete = $wpdb->delete($slider_del, $slider_where);
            
            header( "Location: " . LS_SITE_URL . "/wp-admin/admin.php?page=manage_sliders&lsp_msg=delete_slider_success");
        break;
    
    /*_++++++++++^^^^^^^^=============== <Images Proccess> ===============^^^^^^^^++++++++++_*/
        case "add_image":
            $image_add = $wpdb->prefix."lsp_images";
            
            $lsp_sliders = $_POST['lsp_sliders'];
            $lsp_slide_image = strip_tags($_POST['lsp_slide_image']);
            
            $lsp_image_ext = pathinfo($lsp_slide_image, PATHINFO_EXTENSION);
            $lsp_image_name = pathinfo($lsp_slide_image, PATHINFO_BASENAME);
            $split_img_name = explode(".", $lsp_image_name);
            $split_img_name = $split_img_name[0];
            $lsp_image_path = pathinfo($lsp_slide_image, PATHINFO_DIRNAME)."/";
            
            $image_add_data = array(
                'slider_id' => $lsp_sliders,
                'image_name' => $split_img_name.".".$lsp_image_ext,
                'image_path' => $lsp_image_path,
                'image_link_to' => ''
            );
            
            if((!empty($lsp_sliders)) && (!empty($lsp_slide_image))){
                $image_save = $wpdb->insert($image_add, $image_add_data);
                header( "Location: " . LS_SITE_URL . "/wp-admin/admin.php?page=manage_images&lsp_msg=add_image_success&lsp_slider_id=$lsp_sliders");
            }
            else{
                header( "Location: " . LS_SITE_URL . "/wp-admin/admin.php?page=manage_images&lsp_msg=add_image_error&lsp_slider_id=$lsp_sliders");
            }
        break;
        
        case "add_link":
            $link_add = $wpdb->prefix."lsp_images";
            
            $lsp_image_id = $_REQUEST['lsp_image_id'];
            $lsp_slide_id = $_REQUEST['lsp_slide_id'];
            
            $lsp_image_link = strip_tags($_POST['lsp_image_link']);
            
            $image_link_data = array(
                'image_link_to' => $lsp_image_link
            );
            
            $image_link_where = array(
                'image_id' => $lsp_image_id
            );
            
            $link_update = $wpdb->update($link_add, $image_link_data, $image_link_where);
            header( "Location: " . LS_SITE_URL . "/wp-admin/admin.php?page=manage_images&lsp_slider_id=$lsp_slide_id&lsp_msg=image_link_success");
        break;
        
        case "del_link":
            $image_dell = $wpdb->prefix."lsp_images";
            
            $lsp_image_id = $_REQUEST['lsp_image'];
            $lsp_slide = $_REQUEST['lsp_slide'];
            
            $image_where = array(
                'image_id' => $lsp_image_id
            );
            
            $image_delete = $wpdb->delete($image_dell, $image_where);
            
            header( "Location: " . LS_SITE_URL . "/wp-admin/admin.php?page=manage_images&lsp_slider_id=$lsp_slide&lsp_msg=image_del_success");
        break;
    }
