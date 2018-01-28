<!--==============
	>> Logo Slider Pro: Manage Images
==============-->
<div id="wpbody">
    <div id="wpbody-content">
        <div class="wrap">
            <h2><?php _e('Manage Slider Images','logo-slider')?></h2>
            
            <?php
                global $wpdb;
                $lsp_slider_id = $_GET['lsp_slider_id'];
                
                $lsp_msg = $_REQUEST['lsp_msg'];
                
                $slider_table = $wpdb->prefix."lsp_sliders";
                                
                $lspSlider = $wpdb->get_results("Select slider_id From $slider_table Where slider_id = $lsp_slider_id");
                
                switch ($lsp_msg){
                    case "add_image_success":
            ?>
                        <div class='updated' style='margin-top:10px;'>
                            <p>
                                <?php _e('Image save successfully.','logo-slider') ?>
                        <?php
                            foreach($lspSlider as $lspDliderID){
                        ?>
                                <a href="admin.php?page=manage_sliders&lsp_action=lsp_get_shortcode&lsp_slider_id=<?php echo $lspDliderID->slider_id; ?>">
                                    Get Shortcode here
                                </a>
                        <?php
                            }
                        ?>
                            </p>
                        </div>
            <?php
                    break;
                    case "add_image_error":
            ?>
                        <div class='error' style='margin-top:10px;'>
                            <p>
                                <?php _e('Image and Slider Required.','logo-slider') ?>
                        <?php
                            foreach($lspSlider as $lspDliderID){
                        ?>
                                <a href="admin.php?page=manage_sliders&lsp_action=lsp_get_shortcode&lsp_slider_id=<?php echo $lspDliderID->slider_id; ?>">
                                    Get Shortcode here
                                </a>
                        <?php
                            }
                        ?>
                            </p>
                        </div>
            <?php
                    break;
                    case "image_link_success":
            ?>
                        <div class='updated' style='margin-top:10px;'>
                            <p>
                                <?php _e('Link for Image save successfully.','logo-slider') ?>
                        <?php
                            foreach($lspSlider as $lspDliderID){
                        ?>
                                <a href="admin.php?page=manage_sliders&lsp_action=lsp_get_shortcode&lsp_slider_id=<?php echo $lspDliderID->slider_id; ?>">
                                    Get Shortcode here
                                </a>
                        <?php
                            }
                        ?>
                            </p>
                        </div>
            <?php
                    break;
                    case "image_del_success":
            ?>
                        <div class='updated' style='margin-top:10px;'>
                            <p><?php _e('Image Delete successfully.','logo-slider') ?>&nbsp; <a href="">Get Shortcode here</a></p>
                        </div>
            <?php
                    break;
                }
            ?>
            
            <div class="lsp_main_body">
                <div class="lsp_left_body">
                    
                    <div class="lsp_body_heading">
                        <h3><?php _e('Add Slider Images', 'logo-slider') ?></h3>
                    </div>
                    <div class="lsp_plugin_body">
                        <div class="lsp_plugin_div">
                        <form action="<?php echo LOGO_SLIDER; ?>ls_manage_process.php?lsp_action=add_image" method="post" enctype="multipart/form-data">
                            <table width="100%" border="0" cellspacing="4" cellpadding="0">
                                <tr>
                                    <td width="22%">
                                        <label>
                                            <?php _e("Select Slider", "lsp") ?>
                                        </label>
                                    </td>
                                    <td width="70%">
                            <?php
                                $get_sliders = $wpdb->get_results("Select * From $slider_table");
                            ?>
                                        <select name="lsp_sliders">
                                            <option value="" selected="selected"><?php _e('Select Slider', 'logo-slider'); ?></option>
                                    <?php
                                        foreach($get_sliders as $get_slider){
                                            if($get_slider->slider_id == $lsp_slider_id){
                                    ?>
                                            <option selected="selected" value="<?php echo $get_slider->slider_id; ?>">
                                                <?php echo $get_slider->slider_name; ?>
                                            </option>
                                    <?php
                                            }
                                            else{
                                    ?>
                                            <option value="<?php echo $get_slider->slider_id; ?>">
                                                <?php echo $get_slider->slider_name; ?>
                                            </option>
                                    <?php            
                                            }
                                        }
                                    ?>
                                        </select>
                                    </td>
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>
                                        <label>
                                            <?php _e("Upload New Image","lsp"); ?>
                                        </label>
                                    </td>
                                    <td>
                                        <input type="text" size="50" name="lsp_slide_image" id="lsp_slide_image" class="lsp_upload_url" />
                                    </td>
                                    <td>
                                        <input id="lsp_upload_button" class="lsp_upload_button" type="button" name="upload_button" value="<?php _e('Browse Image','logo-slider'); ?>">
                                    </td>
                                    <td>
                                        <input type="submit" name="lsp_save_images" value="<?php _e('Upload Image', 'logo-slider'); ?>">
                                    </td>
                                </tr>
                            </table>
                        </form>
                        </div>
                    </div>
                    
                </div>
                
                <div class="lsp_data_body">
                <?php
                    $table_images = $wpdb->prefix."lsp_images";
		
                    $images_results = $wpdb->get_results("SELECT * FROM $table_images Where slider_id = $lsp_slider_id Order By image_order ASC");
                    
                    if(!empty($images_results)){
                ?>
                    <p style="border:2px solid #999; border-radius: 10px; font-size: 12px; padding: 6px 10px; width: 24%;">
                        <strong>Note: </strong>Drag &amp; Drop is auto save.
                    </p>
                    <table width="100%" border="0" cellspacing="1" cellpadding="5">
                        <tr>
                            <td width="4%" class="lsp_data_heading" align="center">#</td>
                            <td width="15%" class="lsp_data_heading"><?php _e("Slider Image","lsp"); ?></td>
                            <td width="68%" class="lsp_data_heading"><?php _e("Image Links To","lsp"); ?></td>
                            <td width="14%" class="lsp_data_heading"><?php _e("Action","lsp"); ?></td>
                        </tr>
                    </table>
                    
                    <div id="lsp_sort_image">
                <?php
                    $image_count = 0;
                    
                    foreach($images_results as $lsp_image){
                        $image_count = $image_count + 1;
                        ($image_count%2==0 ? $row_class = "lsp_data_row2" : $row_class = "lsp_data_row1");
                ?>
                    <form action="<?php echo LOGO_SLIDER; ?>ls_manage_process.php?lsp_action=add_link" method="post">
                    <table width="100%" border="0" cellspacing="1" cellpadding="5" id="lsp_list_<?php echo $lsp_image->image_id; ?>" class="lsp_image_item">
                        <tr class="<?php echo $row_class; ?>">
                            <td width="4%" align="center" class="lsp_data_text">
                                <?php echo $image_count; ?>
                            </td>
                            <td width="15%">
                                <input type="hidden" name="lsp_image_id" value="<?php echo $lsp_image->image_id; ?>">
                                <input type="hidden" name="lsp_slide_id" value="<?php echo $lsp_image->slider_id; ?>">
                                <img src="<?php echo $lsp_image->image_path.$lsp_image->image_name; ?>" width="80" height="80">
                            </td>
                            <td width="68%">
                                <input type="text" name="lsp_image_link" value="<?php echo $lsp_image->image_link_to; ?>">
                            </td>
                            <td width="7%" align="center">
                                <input type="submit" value="Update" title="Update <?php echo $lsp_image->image_name; ?> Link">
                            </td>
                            <td width="7%" align="center">
                            <a href="<?php echo LOGO_SLIDER; ?>ls_manage_process.php?lsp_action=del_link&lsp_image=<?php echo $lsp_image->image_id; ?>&lsp_slide=<?php echo $lsp_image->slider_id; ?>" class="lsp_admin_del_btn">
                            Delete
                            </a>
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php
                    }
                ?>
                    </div>
                    
                    <table width="100%" border="0" cellspacing="1" cellpadding="5">
                        <tr>
                            <td width="4%" class="lsp_data_footer" align="center">#</td>
                            <td width="15%" class="lsp_data_footer"><?php _e("Slider Image","lsp"); ?></td>
                            <td width="68%" class="lsp_data_footer"><?php _e("Image Links To","lsp"); ?></td>
                            <td width="14%" class="lsp_data_footer"><?php _e("Action","lsp"); ?></td>
                        </tr>
                    </table>
                <?php
                    }
                    else{
                ?>
                    <span>
                        <?php _e("There are no Images for slider","lsp"); ?>
                    </span>
                <?php
                    }
                ?>
                </div>
            </div>
        </div>
    </div>
</div>