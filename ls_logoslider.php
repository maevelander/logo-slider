<?php

/*
 * Shortcode New
 */
function wp_lsp_sliders( $atts ) {
	global $wpdb;
	$tbl_sliders = $wpdb->prefix . "lsp_sliders";

	ob_start();
	extract( shortcode_atts( array(
		'slider' => '',
	), $atts ) );

	$get_sliders = $wpdb->get_results( "Select * From $tbl_sliders Where slider_shortname = '$slider'" );
	?>
    <div class="lsp_main_slider" style="height: <?php echo get_option('lsp_slider_height') ?>px">
	<?php
	foreach ( $get_sliders as $get_slider ) {
		$slider_id = $get_slider->slider_id;

		if ( LS_SLIDER_ARROW != 0 ) {
			?>
            <div class="lsp_slider_controls">
                <div id="lsp_next_btn_<?php echo $slider_id; ?>" class="lsp_next_btn">next</div>
                <div id="lsp_prev_btn_<?php echo $slider_id; ?>" class="lsp_prev_btn">prev</div>
            </div>
			<?php
		}
		?>
        <div class="lsp_slider_img">
			<?php
			$get_slider_image = $wpdb->get_results( "Select * From " . $wpdb->prefix . "lsp_images Where slider_id = $slider_id Order By image_order ASC" );

			$target = '';
			if ( LS_SLIDER_NEW_WINDOW == 'on' ) {
				$target = 'target="_blank"';
			} else {
				$target = 'target="_parent"';
			}
			?>

            <div class="cycle-slideshow" id="lsp_slideshow_<?php echo $slider_id; ?>"
                 data-cycle-fx="<?php echo LS_SLIDER_EFFECT; ?>"
                 data-cycle-timeout="<?php echo( ( LS_SLIDER_AUTO == 1 ) ? LS_SLIDER_TIME * 1000 : 0 ); ?>"
				<?php
				if ( LS_SLIDER_EFFECT == 'carousel' ) {
					?>
                    data-cycle-carousel-visible="<?php echo LS_SLIDER_PER_SLIDE + 2; ?>"
					<?php
				} else {
					?>
                    data-cycle-carousel-visible="<?php echo LS_SLIDER_PER_SLIDE; ?>"
					<?php
				}
				?>
                 data-cycle-next="#lsp_next_btn_<?php echo $slider_id; ?>"
                 data-cycle-prev="#lsp_prev_btn_<?php echo $slider_id; ?>"
                 data-cycle-speed="800"
                 data-cycle-slides="> div"
            >
				<?php
				if ( LS_SLIDER_EFFECT == 'carousel' ) {
					foreach ( $get_slider_image as $lsp_img ) {
						?>
                        <div>
							<?php if ( ! empty( $lsp_img->image_link_to ) ) { ?>
                                <a href="<?php echo $lsp_img->image_link_to; ?>" <?php echo $target; ?>>
                                    <img src="<?php echo $lsp_img->image_path . $lsp_img->image_name; ?>" alt="">
                                </a>
								<?php
							} else {
								?>
                                <img src="<?php echo $lsp_img->image_path . $lsp_img->image_name; ?>" alt="">
								<?php
							}
							?>
                        </div>
						<?php
					}
				} else {
					if ( LSP_IPOD || LSP_IPHONE ) {
						$lsp_data_chunk = array_chunk( $get_slider_image, 1 );
					} else if ( LSP_IPAD ) {
						$lsp_data_chunk = array_chunk( $get_slider_image, LS_SLIDER_PER_SLIDE );
					} else if ( LSP_ANDROID ) {
						$lsp_data_chunk = array_chunk( $get_slider_image, 1 );
					} else if ( LSP_WEBOS ) {
						$lsp_data_chunk = array_chunk( $get_slider_image, 1 );
					} else if ( LSP_MOBILE ) {
						$lsp_data_chunk = array_chunk( $get_slider_image, 1 );
					} else if ( LSP_BLACKBERRY ) {
						$lsp_data_chunk = array_chunk( $get_slider_image, 1 );
					} else if ( LSP_RIMTABLET ) {
						$lsp_data_chunk = array_chunk( $get_slider_image, 3 );
					} else if ( ( LSP_MSIE ) || ( LSP_FIREFOX ) || ( LSP_SAFARI ) || ( LSP_CHROME ) || ( LSP_IE11 ) ) {
						$lsp_data_chunk = array_chunk( $get_slider_image, (int) LS_SLIDER_PER_SLIDE );
					}

					if ( isset ( $lsp_data_chunk ) ) {

						foreach ( $lsp_data_chunk as $lsp_data_chunk_img ) {
							?>
                            <div style="width: 100%; hight: auto;">
								<?php
								foreach ( $lsp_data_chunk_img as $lsp_img ) {
									if ( ! empty( $lsp_img->image_link_to ) ) { ?>
                                        <a href="<?php echo $lsp_img->image_link_to; ?>" <?php echo $target; ?>>
                                            <img src="<?php echo $lsp_img->image_path . $lsp_img->image_name; ?>"
                                                 alt="">
                                        </a>
										<?php
									} else {
										?>
                                        <img src="<?php echo $lsp_img->image_path . $lsp_img->image_name; ?>" alt="">
										<?php
									}
								}
								?>
                            </div>
							<?php
						}
					}
				} ?>
            </div>
			<?php ?>
        </div>
        </div>

		<?php
	}

	return ob_get_clean();
}

add_shortcode( "lsp_slider", "wp_lsp_sliders" );


function lsp_logo_slider( $lsp_short_name ) {
	global $wpdb;
	$tbl_sliders = $wpdb->prefix . "lsp_sliders";

	$get_sliders = $wpdb->get_results( "Select * From $tbl_sliders Where slider_shortname = '$lsp_short_name'" );
	?>
    <div class="lsp_main_slider">
	<?php
	foreach ( $get_sliders as $get_slider ) {
		$slider_id = $get_slider->slider_id;
		if ( LS_SLIDER_ARROW != 0 ) {
			?>
            <div class="lsp_slider_controls">
                <div id="lsp_next_btn_<?php echo $slider_id; ?>" class="lsp_next_btn">next</div>
                <div id="lsp_prev_btn_<?php echo $slider_id; ?>" class="lsp_prev_btn">prev</div>
            </div>
			<?php
		}
		?>
        <div class="lsp_slider_img">
			<?php
			$get_slider_image = $wpdb->get_results( "Select * From " . $wpdb->prefix . "lsp_images Where slider_id = $slider_id Order By image_order ASC" );

			$target = '';
			if ( LS_SLIDER_NEW_WINDOW == 'on' ) {
				$target = 'target="_blank"';
			} else {
				$target = 'target="_parent"';
			}
			?>

            <div class="cycle-slideshow" id="lsp_slideshow_<?php echo $slider_id; ?>"
                 data-cycle-fx="<?php echo LS_SLIDER_EFFECT; ?>"
                 data-cycle-timeout="<?php echo( ( LS_SLIDER_AUTO == 1 ) ? LS_SLIDER_TIME * 1000 : 0 ); ?>"
				<?php
				if ( LS_SLIDER_EFFECT == 'carousel' ) {
					?>
                    data-cycle-carousel-visible="<?php echo LS_SLIDER_PER_SLIDE + 2; ?>"
					<?php
				} else {
					?>
                    data-cycle-carousel-visible="<?php echo LS_SLIDER_PER_SLIDE; ?>"
					<?php
				}
				?>
                 data-cycle-next="#lsp_next_btn_<?php echo $slider_id; ?>"
                 data-cycle-prev="#lsp_prev_btn_<?php echo $slider_id; ?>"
                 data-cycle-speed="800"
                 data-cycle-slides="> div"
            >
				<?php
				if ( LS_SLIDER_EFFECT == 'carousel' ) {
					foreach ( $get_slider_image as $lsp_img ) {
						?>
                        <div>
							<?php if ( ! empty( $lsp_img->image_link_to ) ) { ?>
                                <a href="<?php echo $lsp_img->image_link_to; ?>" <?php echo $target; ?>>
                                    <img src="<?php echo $lsp_img->image_path . $lsp_img->image_name; ?>" alt="">
                                </a>
								<?php
							} else {
								?>
                                <img src="<?php echo $lsp_img->image_path . $lsp_img->image_name; ?>" alt="">
								<?php
							}
							?>
                        </div>
						<?php
					}
				} else {
					if ( LSP_IPOD || LSP_IPHONE ) {
						$lsp_data_chunk = array_chunk( $get_slider_image, 1 );
					} else if ( LSP_IPAD ) {
						$lsp_data_chunk = array_chunk( $get_slider_image, LS_SLIDER_PER_SLIDE );
					} else if ( LSP_ANDROID ) {
						$lsp_data_chunk = array_chunk( $get_slider_image, 1 );
					} else if ( LSP_WEBOS ) {
						$lsp_data_chunk = array_chunk( $get_slider_image, 1 );
					} else if ( LSP_MOBILE ) {
						$lsp_data_chunk = array_chunk( $get_slider_image, 1 );
					} else if ( LSP_BLACKBERRY ) {
						$lsp_data_chunk = array_chunk( $get_slider_image, 1 );
					} else if ( LSP_RIMTABLET ) {
						$lsp_data_chunk = array_chunk( $get_slider_image, 3 );
					} else if ( ( LSP_MSIE ) || ( LSP_FIREFOX ) || ( LSP_SAFARI ) || ( LSP_CHROME ) || ( LSP_IE11 ) ) {
						$lsp_data_chunk = array_chunk( $get_slider_image, LS_SLIDER_PER_SLIDE );
					}

					foreach ( $lsp_data_chunk as $lsp_data_chunk_img ) {
						?>
                        <div style="width: 100%; hight: auto;">
							<?php
							foreach ( $lsp_data_chunk_img as $lsp_img ) {
								if ( ! empty( $lsp_img->image_link_to ) ) { ?>
                                    <a href="<?php echo $lsp_img->image_link_to; ?>" <?php echo $target; ?>>
                                        <img src="<?php echo $lsp_img->image_path . $lsp_img->image_name; ?>" alt="">
                                    </a>
									<?php
								} else {
									?>
                                    <img src="<?php echo $lsp_img->image_path . $lsp_img->image_name; ?>" alt="">
									<?php
								}
							}
							?>
                        </div>
					<?php }
				} ?>
            </div>

        </div>
        </div>
		<?php
	}

	ob_start();

	return $lsp_short_name;

	return ob_get_clean();
}

/*
 * Backward compatibility with old logo-slider shortcode.
 */

function ls_old_shortcode( $atts ) {

	global $wpdb;
	$tbl_sliders = $wpdb->prefix . "lsp_sliders";

	ob_start();
	extract( shortcode_atts( array(
		'slider' => '',
	), $atts ) );

	$get_sliders = $wpdb->get_results( "Select * From $tbl_sliders Where slider_shortname = 'first_slider'" );
	?>
    <div class="lsp_main_slider" style="height: <?php echo get_option('lsp_slider_height') ?>px">
	<?php
	foreach ( $get_sliders as $get_slider ) {
		$slider_id = $get_slider->slider_id;

		if ( LS_SLIDER_ARROW != 0 ) {
			?>
            <div class="lsp_slider_controls">
                <div id="lsp_next_btn_<?php echo $slider_id; ?>" class="lsp_next_btn">next</div>
                <div id="lsp_prev_btn_<?php echo $slider_id; ?>" class="lsp_prev_btn">prev</div>
            </div>
			<?php
		}
		?>
        <div class="lsp_slider_img">
			<?php
			$get_slider_image = $wpdb->get_results( "Select * From " . $wpdb->prefix . "lsp_images Where slider_id = $slider_id Order By image_order ASC" );

			$target = '';
			if ( LS_SLIDER_NEW_WINDOW == 'on' ) {
				$target = 'target="_blank"';
			} else {
				$target = 'target="_parent"';
			}
			?>

            <div class="cycle-slideshow" id="lsp_slideshow_<?php echo $slider_id; ?>"
                 data-cycle-fx="<?php echo LS_SLIDER_EFFECT; ?>"
                 data-cycle-timeout="<?php echo( ( LS_SLIDER_AUTO == 1 ) ? LS_SLIDER_TIME * 1000 : 0 ); ?>"
				<?php
				if ( LS_SLIDER_EFFECT == 'carousel' ) {
					?>
                    data-cycle-carousel-visible="<?php echo LS_SLIDER_PER_SLIDE + 2; ?>"
					<?php
				} else {
					?>
                    data-cycle-carousel-visible="<?php echo LS_SLIDER_PER_SLIDE; ?>"
					<?php
				}
				?>
                 data-cycle-next="#lsp_next_btn_<?php echo $slider_id; ?>"
                 data-cycle-prev="#lsp_prev_btn_<?php echo $slider_id; ?>"
                 data-cycle-speed="800"
                 data-cycle-slides="> div"
            >
				<?php
				if ( LS_SLIDER_EFFECT == 'carousel' ) {
					foreach ( $get_slider_image as $lsp_img ) {
						?>
                        <div>
							<?php if ( ! empty( $lsp_img->image_link_to ) ) { ?>
                                <a href="<?php echo $lsp_img->image_link_to; ?>" <?php echo $target; ?>>
                                    <img src="<?php echo $lsp_img->image_path . $lsp_img->image_name; ?>" alt="">
                                </a>
								<?php
							} else {
								?>
                                <img src="<?php echo $lsp_img->image_path . $lsp_img->image_name; ?>" alt="">
								<?php
							}
							?>
                        </div>
						<?php
					}
				} else {
					if ( LSP_IPOD || LSP_IPHONE ) {
						$lsp_data_chunk = array_chunk( $get_slider_image, 1 );
					} else if ( LSP_IPAD ) {
						$lsp_data_chunk = array_chunk( $get_slider_image, LS_SLIDER_PER_SLIDE );
					} else if ( LSP_ANDROID ) {
						$lsp_data_chunk = array_chunk( $get_slider_image, 1 );
					} else if ( LSP_WEBOS ) {
						$lsp_data_chunk = array_chunk( $get_slider_image, 1 );
					} else if ( LSP_MOBILE ) {
						$lsp_data_chunk = array_chunk( $get_slider_image, 1 );
					} else if ( LSP_BLACKBERRY ) {
						$lsp_data_chunk = array_chunk( $get_slider_image, 1 );
					} else if ( LSP_RIMTABLET ) {
						$lsp_data_chunk = array_chunk( $get_slider_image, 3 );
					} else if ( ( LSP_MSIE ) || ( LSP_FIREFOX ) || ( LSP_SAFARI ) || ( LSP_CHROME ) || ( LSP_IE11 ) ) {
						$lsp_data_chunk = array_chunk( $get_slider_image, (int) LS_SLIDER_PER_SLIDE );
					}

					if ( isset ( $lsp_data_chunk ) ) {

						foreach ( $lsp_data_chunk as $lsp_data_chunk_img ) {
							?>
                            <div style="width: 100%; hight: auto;">
								<?php
								foreach ( $lsp_data_chunk_img as $lsp_img ) {
									if ( ! empty( $lsp_img->image_link_to ) ) { ?>
                                        <a href="<?php echo $lsp_img->image_link_to; ?>" <?php echo $target; ?>>
                                            <img src="<?php echo $lsp_img->image_path . $lsp_img->image_name; ?>"
                                                 alt="">
                                        </a>
										<?php
									} else {
										?>
                                        <img src="<?php echo $lsp_img->image_path . $lsp_img->image_name; ?>" alt="">
										<?php
									}
								}
								?>
                            </div>
							<?php
						}
					}
				} ?>
            </div>
			<?php ?>
        </div>
        </div>

		<?php
	}

	return ob_get_clean();

}

add_shortcode( 'logo-slider', 'ls_old_shortcode' );

function logo_slider() {
	global $wpdb;
	$tbl_sliders = $wpdb->prefix . "lsp_sliders";
	$lsp_short_name = 'first_slider';

	$get_sliders = $wpdb->get_results( "Select * From $tbl_sliders Where slider_shortname = '$lsp_short_name'" );
	?>
    <div class="lsp_main_slider">
	<?php
	foreach ( $get_sliders as $get_slider ) {
		$slider_id = $get_slider->slider_id;
		if ( LS_SLIDER_ARROW != 0 ) {
			?>
            <div class="lsp_slider_controls">
                <div id="lsp_next_btn_<?php echo $slider_id; ?>" class="lsp_next_btn">next</div>
                <div id="lsp_prev_btn_<?php echo $slider_id; ?>" class="lsp_prev_btn">prev</div>
            </div>
			<?php
		}
		?>
        <div class="lsp_slider_img">
			<?php
			$get_slider_image = $wpdb->get_results( "Select * From " . $wpdb->prefix . "lsp_images Where slider_id = $slider_id Order By image_order ASC" );

			$target = '';
			if ( LS_SLIDER_NEW_WINDOW == 'on' ) {
				$target = 'target="_blank"';
			} else {
				$target = 'target="_parent"';
			}
			?>

            <div class="cycle-slideshow" id="lsp_slideshow_<?php echo $slider_id; ?>"
                 data-cycle-fx="<?php echo LS_SLIDER_EFFECT; ?>"
                 data-cycle-timeout="<?php echo( ( LS_SLIDER_AUTO == 1 ) ? LS_SLIDER_TIME * 1000 : 0 ); ?>"
				<?php
				if ( LS_SLIDER_EFFECT == 'carousel' ) {
					?>
                    data-cycle-carousel-visible="<?php echo LS_SLIDER_PER_SLIDE + 2; ?>"
					<?php
				} else {
					?>
                    data-cycle-carousel-visible="<?php echo LS_SLIDER_PER_SLIDE; ?>"
					<?php
				}
				?>
                 data-cycle-next="#lsp_next_btn_<?php echo $slider_id; ?>"
                 data-cycle-prev="#lsp_prev_btn_<?php echo $slider_id; ?>"
                 data-cycle-speed="800"
                 data-cycle-slides="> div"
            >
				<?php
				if ( LS_SLIDER_EFFECT == 'carousel' ) {
					foreach ( $get_slider_image as $lsp_img ) {
						?>
                        <div>
							<?php if ( ! empty( $lsp_img->image_link_to ) ) { ?>
                                <a href="<?php echo $lsp_img->image_link_to; ?>" <?php echo $target; ?>>
                                    <img src="<?php echo $lsp_img->image_path . $lsp_img->image_name; ?>" alt="">
                                </a>
								<?php
							} else {
								?>
                                <img src="<?php echo $lsp_img->image_path . $lsp_img->image_name; ?>" alt="">
								<?php
							}
							?>
                        </div>
						<?php
					}
				} else {
					if ( LSP_IPOD || LSP_IPHONE ) {
						$lsp_data_chunk = array_chunk( $get_slider_image, 1 );
					} else if ( LSP_IPAD ) {
						$lsp_data_chunk = array_chunk( $get_slider_image, LS_SLIDER_PER_SLIDE );
					} else if ( LSP_ANDROID ) {
						$lsp_data_chunk = array_chunk( $get_slider_image, 1 );
					} else if ( LSP_WEBOS ) {
						$lsp_data_chunk = array_chunk( $get_slider_image, 1 );
					} else if ( LSP_MOBILE ) {
						$lsp_data_chunk = array_chunk( $get_slider_image, 1 );
					} else if ( LSP_BLACKBERRY ) {
						$lsp_data_chunk = array_chunk( $get_slider_image, 1 );
					} else if ( LSP_RIMTABLET ) {
						$lsp_data_chunk = array_chunk( $get_slider_image, 3 );
					} else if ( ( LSP_MSIE ) || ( LSP_FIREFOX ) || ( LSP_SAFARI ) || ( LSP_CHROME ) || ( LSP_IE11 ) ) {
						$lsp_data_chunk = array_chunk( $get_slider_image, LS_SLIDER_PER_SLIDE );
					}

					foreach ( $lsp_data_chunk as $lsp_data_chunk_img ) {
						?>
                        <div style="width: 100%; hight: auto;">
							<?php
							foreach ( $lsp_data_chunk_img as $lsp_img ) {
								if ( ! empty( $lsp_img->image_link_to ) ) { ?>
                                    <a href="<?php echo $lsp_img->image_link_to; ?>" <?php echo $target; ?>>
                                        <img src="<?php echo $lsp_img->image_path . $lsp_img->image_name; ?>" alt="">
                                    </a>
									<?php
								} else {
									?>
                                    <img src="<?php echo $lsp_img->image_path . $lsp_img->image_name; ?>" alt="">
									<?php
								}
							}
							?>
                        </div>
					<?php }
				} ?>
            </div>

        </div>
        </div>
		<?php
	}

	ob_start();

	return $lsp_short_name;

	return ob_get_clean();
}

?>