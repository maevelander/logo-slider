<!--==============
	>> Logo Slider Pro Settings
==============-->
<div id="wpbody">
    <div id="wpbody-content">
        <div class="wrap">
            <h2><?php _e('Logo Slider Settings','logo-slider')?></h2>

            <?php
                if(isset($_GET['settings-updated'])){
            ?>
                <div class='updated' style='margin-top:10px;'>
                    <p><?php _e('Settings updated successfully','logo-slider') ?></p>
                </div>
            <?php
                }
            ?>
            
            <div class="lsp_main_body">
                <div class="lsp_left_body">
                    
                    <div class="lsp_body_heading">
                        <h3><?php _e('Plugin Settings', 'logo-slider') ?></h3>
                    </div>
                    <div class="lsp_plugin_body">
                        <div class="lsp_plugin_div">
                        <form action="options.php" method="post">
                        <?php
                            settings_fields('lsp_settings_group');
                        ?>
                            <div class="lsp_settings_div">
                                <div class="lsp_settings_left">
                                    <label for="Size">
                                        <?php _e('Size','logo-slider'); ?>
                                    </label>
                                </div>
                                <div class="lsp_settings_right">
                                    <label class="small_label">
                                        <?php _e('Width: ','logo-slider'); ?>
                                    </label>
                                    <input type="text" name="lsp_slider_width" class="lsp_small_input" value="<?php echo LS_SLIDER_WIDTH; ?>">
                                    <p>px</p>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label class="small_label">
                                        <?php _e('Height: ','logo-slider'); ?>
                                    </label>
                                    <input type="text" name="lsp_slider_height" class="lsp_small_input" value="<?php echo LS_SLIDER_HEIGHT; ?>">
                                    <p>px</p>
                                </div>
                            </div>

                            <div class="lsp_settings_div">
                                <div class="lsp_settings_left">
                                    <label for="Size">
                                        <?php _e('Background Color','logo-slider'); ?>
                                    </label>
                                </div>
                                <div class="lsp_settings_right">
                                    <input type="text" name="lsp_slider_bgcolor" class="cp-field" value="<?php echo LS_SLIDER_BGCOLOR; ?>">
                                    <p><?php _e('Format: ','logo-slider'); ?>#FFFFFF</p>
                                </div>
                            </div>

                            <div class="lsp_settings_div">
                                <div class="lsp_settings_left">
                                    <label for="Size">
                                        <?php _e('Select Slider Effect','logo-slider'); ?>
                                    </label>
                                </div>
                                <div class="lsp_settings_right">
                                    <select name="lsp_slider_effect">
                                        <option value="scrollHorz" <?php echo ( LS_SLIDER_EFFECT == 'scrollHorz' ? 'selected="selected"' : '' ) ?>>
                                            <?php _e('Slide','logo-slider') ?>
                                        </option>
                                        <option value="fade" <?php echo ( LS_SLIDER_EFFECT == 'fade' ? 'selected="selected"' : '' ) ?>>
                                            <?php _e('Fade','logo-slider') ?>
                                        </option>
                                        <option value="tileSlide" <?php echo ( LS_SLIDER_EFFECT == 'tileSlide' ? 'selected="selected"' : '' ) ?>>
                                            <?php _e('Tile Slide','logo-slider') ?>
                                        </option>
                                        <option value="tileBlind" <?php echo ( LS_SLIDER_EFFECT == 'tileBlind' ? 'selected="selected"' : '' ) ?>>
                                            <?php _e('Tile Blind','logo-slider') ?>
                                        </option>
                                        <option value="carousel" <?php echo ( LS_SLIDER_EFFECT == 'carousel' ? 'selected="selected"' : '' ) ?>>
                                            <?php _e('Carousel','logo-slider') ?>
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="lsp_settings_div">
                                <div class="lsp_settings_left">
                                    <label for="Size">
                                        <?php _e('Images Per Slide','logo-slider'); ?>
                                    </label>
                                </div>
                                <div class="lsp_settings_right">
                                    <select name="lsp_image_per_slide">
                                        <option value="1" <?php echo ( LS_SLIDER_PER_SLIDE == '1' ? 'selected="selected"' : '') ?>>
                                            <?php _e('1','logo-slider') ?>
                                        </option>
                                        <option value="2" <?php echo ( LS_SLIDER_PER_SLIDE == '2' ? 'selected="selected"' : '') ?>>
                                            <?php _e('2','logo-slider') ?>
                                        </option>
                                        <option value="3" <?php echo ( LS_SLIDER_PER_SLIDE == '3' ? 'selected="selected"' : '') ?>>
                                            <?php _e('3','logo-slider') ?>
                                        </option>
                                        <option value="4" <?php echo ( LS_SLIDER_PER_SLIDE == '4' ? 'selected="selected"' : '') ?>>
                                            <?php _e('4','logo-slider') ?>
                                        </option>
                                        <option value="5" <?php echo ( LS_SLIDER_PER_SLIDE == '5' ? 'selected="selected"' : '') ?>>
                                            <?php _e('5','logo-slider') ?>
                                        </option>
                                        <option value="6" <?php echo ( LS_SLIDER_PER_SLIDE == '6' ? 'selected="selected"' : '') ?>>
                                            <?php _e('6','logo-slider') ?>
                                        </option>
                                        <option value="7" <?php echo ( LS_SLIDER_PER_SLIDE == '7' ? 'selected="selected"' : '') ?>>
                                            <?php _e('7','logo-slider') ?>
                                        </option>
                                        <option value="8" <?php echo ( LS_SLIDER_PER_SLIDE == '8' ? 'selected="selected"' : '') ?>>
                                            <?php _e('8','logo-slider') ?>
                                        </option>
                                    </select>
                                    <p><?php _e('Number of logos per slide','logo-slider') ?></p>
                                </div>
                            </div>

                            <div class="lsp_settings_div">
                                <div class="lsp_settings_left">
                                    <label for="Size">
                                        <?php _e('Open Logo Links in New Window','logo-slider'); ?>
                                    </label>
                                </div>
                                <div class="lsp_settings_right">
                                    <input type="checkbox" name="lsp_link_new_window" <?php echo ( LS_SLIDER_NEW_WINDOW == 'on' ? 'checked="checked"' : '' ) ?> />
                                </div>
                            </div>

                            <div class="lsp_settings_div">
                                <div class="lsp_settings_left">
                                    <label for="Size">
                                        <?php _e('Auto Slide','logo-slider'); ?>
                                    </label>
                                </div>
                                <div class="lsp_settings_right">
                                    <label class="small_label"><?php _e('ON','lgs') ?></label>
                                    <input type="radio" name="lsp_auto_slide" value="1" <?php if( LS_SLIDER_AUTO == 1){echo 'checked="checked"';}?> />
                                    &nbsp; &nbsp;
                                    <label class="small_label"><?php _e('OFF','lgs') ?></label>
                                    <input type="radio" name="lsp_auto_slide" value="0" <?php if( LS_SLIDER_AUTO == 0){echo 'checked="checked"';}?>/>
                                </div>
                            </div>

                            <div class="lsp_settings_div">
                                <div class="lsp_settings_left">
                                    <label for="Size">
                                        <?php _e('Auto Slide Time','logo-slider'); ?>
                                    </label>
                                </div>
                                <div class="lsp_settings_right">
                                    <input type="text" name="lsp_auto_slide_time" class="lsp_small_input" value="<?php echo LS_SLIDER_TIME; ?>">
                                    <p><?php _e('Set auto slide duration in seconds','logo-slider'); ?></p>
                                </div>
                            </div>

                            <div class="lsp_settings_div">
                                <div class="lsp_settings_left">
                                    <label for="Size">
                                        <?php _e('Arrow Style','logo-slider'); ?>
                                    </label>
                                </div>
                                <div class="lsp_settings_right">
                                <table width="100%" border="0" cellspacing="4" cellpadding="0">
                                    <tr>
                                        <td width="12.1%" align="center">
                                            <img src="<?php echo plugin_dir_url(__FILE__); ?>/ls_arrows/lsp_off.png" alt="" />
                                        </td>
                                        <td width="12.1%" align="center">
                                            <img src="<?php echo plugin_dir_url(__FILE__); ?>/ls_arrows/lsp_arrow1_next.png" alt="" />
                                        </td>
                                        <td width="12.1%" align="center">
                                            <img src="<?php echo plugin_dir_url(__FILE__); ?>/ls_arrows/lsp_arrow2_next.png" alt="" />
                                        </td>
                                        <td width="12.1%" align="center">
                                            <img src="<?php echo plugin_dir_url(__FILE__); ?>/ls_arrows/lsp_arrow3_next.png" alt="" />
                                        </td>
                                        <td width="12.1%" align="center">
                                            <img src="<?php echo plugin_dir_url(__FILE__); ?>/ls_arrows/lsp_arrow4_next.png" alt="" />
                                        </td>
                                        <td width="12.1%" align="center">
                                            <img src="<?php echo plugin_dir_url(__FILE__); ?>/ls_arrows/lsp_arrow5_next.png" alt="" />
                                        </td>
                                        <td width="12.1%" align="center">
                                            <img src="<?php echo plugin_dir_url(__FILE__); ?>/ls_arrows/lsp_arrow6_next.png" alt="" />
                                        </td>
                                        <td width="12.1%" align="center">
                                            <img src="<?php echo plugin_dir_url(__FILE__); ?>/ls_arrows/lsp_arrow7_next.png" alt="" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <input type="radio" name="lsp_slider_arrow" value="0" <?php if( LS_SLIDER_ARROW == 0){echo 'checked="checked"';}?> />
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="lsp_slider_arrow" value="1" <?php if( LS_SLIDER_ARROW == 1){echo 'checked="checked"';}?> />
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="lsp_slider_arrow" value="2" <?php if( LS_SLIDER_ARROW == 2){echo 'checked="checked"';}?> />
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="lsp_slider_arrow" value="3" <?php if( LS_SLIDER_ARROW == 3){echo 'checked="checked"';}?> />
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="lsp_slider_arrow" value="4" <?php if( LS_SLIDER_ARROW == 4){echo 'checked="checked"';}?> />
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="lsp_slider_arrow" value="5" <?php if( LS_SLIDER_ARROW == 5){echo 'checked="checked"';}?> />
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="lsp_slider_arrow" value="6" <?php if( LS_SLIDER_ARROW == 6){echo 'checked="checked"';}?> />
                                        </td>
                                        <td align="center">
                                            <input type="radio" name="lsp_slider_arrow" value="7" <?php if( LS_SLIDER_ARROW == 7){echo 'checked="checked"';}?> />
                                        </td>
                                    </tr>
                                </table>
                                </div>
                            </div>

                            <div class="lsp_settings_div">
                                <div class="lsp_settings_left">
                                    <label for="Size">
                                        <?php _e('Custom CSS','logo-slider'); ?>
                                    </label>
                                </div>
                                <div class="lsp_settings_right">
                                    <textarea name="lsp_slider_css"><?php echo LS_SLIDER_CSS ?></textarea>
                                </div>
                            </div>

                            <div class="lsp_settings_div" style="border: 0px;">
                                <input type="submit" name="lsp_submit" value="Save Settings">
                            </div>
                        </form>
                        </div>
                    </div>
                    
                </div>

            </div>
        </div>
    </div>
</div>