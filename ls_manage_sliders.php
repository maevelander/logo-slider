<!--==============
	>> Logo Slider Pro: Manage Sliders
==============-->
<div id="wpbody">
    <div id="wpbody-content">
        <div class="wrap">
            <h2><?php _e('Manage Sliders','logo-slider')?></h2>

            <?php
                global $wpdb;
                $lsp_msg = $_REQUEST['lsp_msg'];
                
                switch ($lsp_msg){
                    case "add_slider_success":
            ?>
                        <div class='updated' style='margin-top:10px;'>
                            <p><?php _e('Slider save successfully','logo-slider') ?></p>
                        </div>
            <?php
                    break;
                    case "add_slider_error":
            ?>
                        <div class='error' style='margin-top:10px;'>
                            <p><?php _e('Slider name required','logo-slider') ?></p>
                        </div>
            <?php
                    break;
                    case "edit_slider_success";
            ?>
                        <div class='updated' style='margin-top:10px;'>
                            <p><?php _e('Slider update successfully','logo-slider') ?></p>
                        </div>
            <?php
                    break;
                    case "edit_slider_error";
            ?>
                        <div class='error' style='margin-top:10px;'>
                            <p><?php _e('Slider name required','logo-slider') ?></p>
                        </div>
            <?php
                    break;
                    case "delete_slider_success";
            ?>
                        <div class='updated' style='margin-top:10px;'>
                            <p><?php _e('Slider deleted successfully','logo-slider') ?></p>
                        </div>
            <?php
                    break;
                }
            ?>
            
            <div class="lsp_main_body">
            <?php
                $lsp_action = $_GET['lsp_action'];
                $lsp_slider_id = $_REQUEST['lsp_slider_id'];
                
                switch ($lsp_action){
                    case "lsp_get_shortcode":
            ?>
                    <a href="admin.php?page=manage_sliders" class="lsp_admin_btn">
                        Add New
                    </a>
                    <div class="lsp_data_body">
                    <table width="100%" border="0" cellspacing="1" cellpadding="5">
                        <thead>
                            <tr>
                                <td width="20%" class="lsp_data_heading"><?php _e("Slider Name","lsp"); ?></td>
                                <td width="30%" class="lsp_data_heading"><?php _e("Slider Shortcode","lsp"); ?></td>
                                <td colspan="2" class="lsp_data_heading"><?php _e("Action","lsp"); ?></td>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <td class="lsp_data_footer"><?php _e("Slider Name","lsp"); ?></td>
                                <td class="lsp_data_footer"><?php _e("Slider Shortcode","lsp"); ?></td>
                                <td colspan="2" class="lsp_data_footer"><?php _e("Action","lsp"); ?></td>
                            </tr>
                        </tfoot>
                        <tbody>
                    <?php
                        $slide_shordcodes = $wpdb->get_results("Select * From wp_lsp_sliders Where slider_id = $lsp_slider_id");
                        foreach($slide_shordcodes as $slide_shordcode){
                    ?>
                        <tr>
                            <td class="lsp_data_text"><span><?php echo $slide_shordcode->slider_name; ?></span></td>
                            <td class="lsp_data_text">
                                <input type="text" readonly="readonly" value="<?php echo $slide_shordcode->slider_shortcode; ?>" class="lsp_readonly">
                            </td>
                            <td width="5%">
                                <a href="admin.php?page=manage_sliders&lsp_action=edit_slider&lsp_slider=<?php echo $slide_shordcode->slider_id; ?>" class="lsp_admin_btn" title="Edit <?php echo $slide_shordcode->slider_name; ?>">
                                    <?php _e("Edit","lsp") ?>
                                </a>
                            </td>
                            <td width="5%">
                                <a href="<?php echo LOGO_SLIDER; ?>ls_manage_process.php?lsp_action=del_slider&lsp_slider=<?php echo $slide_shordcode->slider_id; ?>" class="lsp_admin_del_btn">
                                    <?php _e("Delete","lsp") ?>
                                </a>
                            </td>
                        </tr>
                    <?php
                        }
                    ?>
                        </tbody>
                    </table>
                    </div>
            <?php
                    break;
                    default :
            ?>
                    <div class="lsp_left_body">
            <?php
                $lsp_action = $_REQUEST['lsp_action'];
                $slider_id = $_GET['lsp_slider'];
                
                switch ($lsp_action){
                    case "edit_slider":
                    $slider_edit = $wpdb->prefix."lsp_sliders";
                    $slide_result = $wpdb->get_results("Select * From $slider_edit Where slider_id = $slider_id");
            ?>
                    <div class="lsp_body_heading">
                        <h3><?php _e('Edit Slider', 'logo-slider') ?></h3>
                    </div>
                    <div class="lsp_plugin_body">
                        <div class="lsp_plugin_div">
                            <form action="<?php echo LOGO_SLIDER; ?>ls_manage_process.php?lsp_action=edit_slider" method="post" name="lsp_edit_slider">
                            <table width="100%" border="0" cellspacing="4" cellpadding="0">
                                <tr>
                                    <td width="15%">
                                        <label>
                                            <?php _e("Slider Name","lsp"); ?>
                                        </label>
                                    </td>
                            <?php
                                foreach($slide_result as $slider_edit){
                            ?>
                                    <td width="68%">
                                        <input type="hidden" name="lsp_slider_id" value="<?php echo $slider_edit->slider_id; ?>">
                                        <input type="text" name="lsp_edit_slider" id="lsp_edit_slider" value="<?php echo $slider_edit->slider_name; ?>">
                                    </td>
                            <?php
                                }
                            ?>
                                    <td width="10%" align="right">
                                        <input type="submit" name="lsp_update_slider" value="Edit Slider">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <span class="lsp_admin_notification">
                                            NOTE: Please do not use weird characters or symbols (like ! @ # $ * _ - etc)
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </form>
                        </div>
                    </div>
            <?php
                    break;
                    default:
            ?>
                    <div class="lsp_body_heading">
                        <h3><?php _e('Add Slider', 'logo-slider') ?></h3>
                    </div>
                    <div class="lsp_plugin_body">
                        <div class="lsp_plugin_div">
                            <form action="<?php echo LOGO_SLIDER; ?>ls_manage_process.php?lsp_action=add_slider" method="post" name="lsp_add_slider">
                            <table width="100%" border="0" cellspacing="4" cellpadding="0">
                                <tr>
                                    <td width="15%">
                                        <label>
                                            <?php _e("Slider Name","lsp"); ?>
                                        </label>
                                    </td>
                                    <td width="68%">
                                        <input type="text" name="lsp_add_slider" id="lsp_add_slider" value="">
                                    </td>
                                    <td width="10%" align="right">
                                        <input type="submit" name="lsp_save_slider" value="Add Slider">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <span class="lsp_admin_notification">
                                            NOTE: Please do not use weird characters or symbols (like ! @ # $ * _ - etc)
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </form>
                        </div>
                    </div>
            <?php
                }
            ?>
                </div>
                
                <div class="lsp_data_body">
                <?php
                    $table_slider = $wpdb->prefix."lsp_sliders";
		
                    $slider_results = $wpdb->get_results("SELECT * FROM $table_slider");
                    
                    if(!empty($slider_results)){
                ?>
                <table width="100%" border="0" cellspacing="1" cellpadding="5">
                    <thead>
                        <tr>
                            <td width="8%" class="lsp_data_heading" align="center">#</td>
                            <td width="24%" class="lsp_data_heading"><?php _e("Slider Name","lsp"); ?></td>
                            <td width="26%" class="lsp_data_heading"><?php _e("Slider Shortcode","lsp"); ?></td>
                            <td width="16%" class="lsp_data_heading"><?php _e("Short Name","lsp"); ?></td>
                            <td colspan="4" class="lsp_data_heading"><?php _e("Action","lsp"); ?></td>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td class="lsp_data_footer" align="center">#</td>
                            <td class="lsp_data_footer"><?php _e("Slider Name","lsp"); ?></td>
                            <td class="lsp_data_footer"><?php _e("Slider Shortcode","lsp"); ?></td>
                            <td class="lsp_data_footer"><?php _e("Short Name","lsp"); ?></td>
                            <td colspan="4" class="lsp_data_footer"><?php _e("Action","lsp"); ?></td>
                        </tr>
                    </tfoot>
                    <tbody>
                <?php
                    $slider_count = 0;
                    
                    foreach($slider_results as $slider_result){
                        $slider_count = $slider_count + 1;
                ?>
                    <tr>
                        <td align="center" class="lsp_data_text"><?php echo $slider_count; ?></td>
                        <td class="lsp_data_text"><span>
                                <a href="admin.php?page=manage_images&lsp_slider_id=<?php echo $slider_result->slider_id; ?>" title="Add images for <?php echo $slider_result->slider_name; ?>">
                                    <?php echo $slider_result->slider_name; ?>
                                </a>
                            </span></td>
                        <td class="lsp_data_text">
                            <input type="text" readonly="readonly" value="<?php echo $slider_result->slider_shortcode; ?>" class="lsp_readonly">
                        </td>
                        <td class="lsp_data_text">
                            <?php echo $slider_result->slider_shortname; ?>
                        </td>
                        <td width="12%">
                            <a href="admin.php?page=manage_images&lsp_slider_id=<?php echo $slider_result->slider_id; ?>" class="lsp_admin_btn" title="Add images for <?php echo $slider_result->slider_name; ?>">
                                <?php _e("Manage Images","lsp") ?>
                            </a>
                        </td>
                        <td width="8%">
                            <a href="admin.php?page=manage_sliders&lsp_action=edit_slider&lsp_slider=<?php echo $slider_result->slider_id; ?>" class="lsp_admin_btn" title="Edit <?php echo $slider_result->slider_name; ?>">
                                <?php _e("Edit Title","lsp") ?>
                            </a>
                        </td>
                        <td width="8%">
                            <a href="<?php echo LOGO_SLIDER; ?>ls_manage_process.php?lsp_action=del_slider&lsp_slider=<?php echo $slider_result->slider_id; ?>" class="lsp_admin_del_btn">
                                <?php _e("Delete","lsp") ?>
                            </a>
                        </td>
                    </tr>
                <?php
                    }
                ?>
                    </tbody>
                </table>
                <?php
                    }
                    else{
                ?>
                    <span>
                        <?php _e("There are no sliders","lsp"); ?>
                    </span>
                <?php
                    }
                ?>
                </div>
            <?php
                }
            ?>
            </div>
        </div>
    </div>
</div>