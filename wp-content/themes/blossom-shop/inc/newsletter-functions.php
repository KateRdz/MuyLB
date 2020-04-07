<?php

if( ! function_exists( 'blossom_shop_newsletter_bg_image_size' ) ) :
    function blossom_shop_newsletter_bg_image_size(){
        return 'full';
    }
endif;
add_filter( 'bt_newsletter_img_size', 'blossom_shop_newsletter_bg_image_size' );

if( ! function_exists( 'blossom_shop_newsletter_bg_color' ) ) :
    function blossom_shop_newsletter_bg_color(){
        return '#dde9ed';
    }
endif;
add_filter( 'bt_newsletter_bg_color_setting', 'blossom_shop_newsletter_bg_color' );

if( ! function_exists( 'blossom_shop_blossomthemes_email_widget_filter' ) ) :
/**
 * Filter for email newsletter widget
*/
function blossom_shop_blossomthemes_email_widget_filter( $content = "", $atts ){
	$obj = new Blossomthemes_Email_Newsletter_Functions;

	$atts = shortcode_atts( array(
	  'id' => '',
	  ), $atts, 'BTEN' );
	$atts['id'] = absint($atts['id']);
    $rrsb_bg = '';
    $rrsb_font = '';
    $blossomthemes_email_newsletter_setting = get_post_meta( $atts['id'], 'blossomthemes_email_newsletter_setting', true );
    $settings = get_option( 'blossomthemes_email_newsletter_settings', true );
    $rrsb_option = ! empty( $blossomthemes_email_newsletter_setting['appearance']['newsletter-bg-option'] ) ? sanitize_text_field( $blossomthemes_email_newsletter_setting['appearance']['newsletter-bg-option'] ) : 'bg-color';

    if( $rrsb_option == 'image' )
    {
        $overlay = isset( $blossomthemes_email_newsletter_setting['appearance']['overlay'] ) &&  $blossomthemes_email_newsletter_setting['appearance']['overlay'] == '1' ? ' has-overlay' : ' no-overlay';
        if( isset( $blossomthemes_email_newsletter_setting['appearance']['bg']) &&  $blossomthemes_email_newsletter_setting['appearance']['bg']!='' )
        {
            $attachment_id = $blossomthemes_email_newsletter_setting['appearance']['bg'];
            $newsletter_bio_img_size = apply_filters('bt_newsletter_img_size','full');
            $image_array   = wp_get_attachment_image_src( $attachment_id, $newsletter_bio_img_size );
            $rrsb_bg = 'url('.$image_array[0].') no-repeat';
        }
    }
    else{
        if( isset( $blossomthemes_email_newsletter_setting['appearance']['bgcolor'] ) &&  $blossomthemes_email_newsletter_setting['appearance']['bgcolor']!='' )
        {
           $rrsb_bg = ! empty( $blossomthemes_email_newsletter_setting['appearance']['bgcolor'] ) ? sanitize_text_field( $blossomthemes_email_newsletter_setting['appearance']['bgcolor'] ) : apply_filters('bt_newsletter_bg_color','#ffffff'); 
        }
        elseif( isset( $settings['appearance']['bgcolor'] ) &&  $settings['appearance']['bgcolor']!='' )
        {
           $rrsb_bg = ! empty( $settings['appearance']['bgcolor'] ) ? sanitize_text_field( $settings['appearance']['bgcolor'] ) : apply_filters('bt_newsletter_bg_color','#ffffff'); 
        }
    }
    if( isset( $blossomthemes_email_newsletter_setting['appearance']['fontcolor'] ) &&  $blossomthemes_email_newsletter_setting['appearance']['fontcolor']!='' )
    {
       $rrsb_font = ! empty( $blossomthemes_email_newsletter_setting['appearance']['fontcolor'] ) ? sanitize_text_field( $blossomthemes_email_newsletter_setting['appearance']['fontcolor'] ) : apply_filters('bt_newsletter_font_color_setting','#ffffff'); 
    }
    elseif( isset( $settings['appearance']['fontcolor'] ) &&  $settings['appearance']['fontcolor']!='' )
    {
       $rrsb_font = ! empty( $settings['appearance']['fontcolor'] ) ? sanitize_text_field( $settings['appearance']['fontcolor'] ) : apply_filters('bt_newsletter_font_color_setting','#ffffff'); 
    }

        ob_start();
        ?>
        <div class="blossomthemes-email-newsletter-wrapper<?php if(isset($rrsb_option) && $rrsb_option == 'image'){ echo ' bg-img', $overlay;}?>" id="boxes-<?php echo esc_attr($atts['id']);?>" style="background: <?php echo esc_attr($rrsb_bg);?>; color: <?php echo esc_attr($rrsb_font);?> ">
            <div class="newsletter-inner-wrapper">
            <div class="text-holder" >
                <?php if( get_the_title( $atts['id'] ) ) { $title = get_the_title( $atts['id'] ); echo '<h3>'.esc_html($title).'</h3>'; }?>
                <?php
                if( isset($blossomthemes_email_newsletter_setting['appearance']['note']) && $blossomthemes_email_newsletter_setting['appearance']['note']!='' )
                {
                    $note = $blossomthemes_email_newsletter_setting['appearance']['note'];
                    echo '<span>'.esc_html($note).'</span>';
                }
                ?>
            </div>
            <form id="blossomthemes-email-newsletter-<?php echo esc_attr($atts['id']);?>" class="blossomthemes-email-newsletter-window-<?php echo esc_attr($atts['id']);?>">
                <?php
                $val = isset($blossomthemes_email_newsletter_setting['field']['select']) ? esc_attr($blossomthemes_email_newsletter_setting['field']['select']):'email';
                if( $val=='email' )
                { 
                    ?>
                    <input type="text" name="subscribe-email" required="required" class="subscribe-email-<?php echo esc_attr($atts['id']);?>" value="" placeholder="<?php echo isset($blossomthemes_email_newsletter_setting['field']['email_placeholder']) && $blossomthemes_email_newsletter_setting['field']['email_placeholder'] !='' ? esc_attr($blossomthemes_email_newsletter_setting['field']['email_placeholder']): __('Your Email', 'blossom-shop');?>">
                <?php
                }
                else{ ?>
                    <input type="text" name="subscribe-fname" required="required" class="subscribe-fname-<?php echo esc_attr($atts['id']);?>" value="" placeholder="<?php echo isset($blossomthemes_email_newsletter_setting['field']['first_name_placeholder']) && $blossomthemes_email_newsletter_setting['field']['first_name_placeholder'] != '' ? esc_attr($blossomthemes_email_newsletter_setting['field']['first_name_placeholder']): __('Your Name', 'blossom-shop');?>">

                    <input type="text" name="subscribe-email" required="required" class="subscribe-email-<?php echo esc_attr($atts['id']);?>" value="" placeholder="<?php echo isset($blossomthemes_email_newsletter_setting['field']['email_placeholder']) && $blossomthemes_email_newsletter_setting['field']['email_placeholder'] != '' ? esc_attr($blossomthemes_email_newsletter_setting['field']['email_placeholder']): __('Your Email', 'blossom-shop');?>">
                <?php
                }
                if( isset( $blossomthemes_email_newsletter_setting['appearance']['gdpr'] ) && $blossomthemes_email_newsletter_setting['appearance']['gdpr'] == '1' )
                {
                ?>
                <label for="subscribe-confirmation-<?php echo esc_attr($atts['id']);?>">
                    <div class="subscribe-inner-wrap">
                        <input type="checkbox" class="subscribe-confirmation-<?php echo esc_attr($atts['id']);?>" name="subscribe-confirmation" id="subscribe-confirmation-<?php echo esc_attr($atts['id']);?>" required/><span class="check-mark"></span>
                        <span class="text">
                            <?php
                            $blossomthemes_email_newsletter_settings = get_option( 'blossomthemes_email_newsletter_settings', true );
                            $gdprmsg = isset($blossomthemes_email_newsletter_settings['gdpr-msg']) && $blossomthemes_email_newsletter_settings['gdpr-msg'] !='' ? $blossomthemes_email_newsletter_settings['gdpr-msg']: __('By checking this, you agree to our Privacy Policy.', 'blossom-shop');
                            echo wp_kses_post($gdprmsg);
                            ?>
                        </span>
                    </div>
                </label>
                <?php
                }
                ?>
                <div id="loader-<?php echo esc_attr($atts['id']);?>" style="display: none">
                    <div class="table">
                        <div class="table-row">
                            <div class="table-cell">
                                <img src="<?php echo BLOSSOMTHEMES_EMAIL_NEWSLETTER_FILE_URL.'/public/css/loader.gif';?>">
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" name="subscribe-submit" class="subscribe-submit-<?php echo esc_attr($atts['id']);?>" value="<?php echo isset($blossomthemes_email_newsletter_setting['field']['submit_label']) && $blossomthemes_email_newsletter_setting['field']['submit_label'] !='' ? esc_attr($blossomthemes_email_newsletter_setting['field']['submit_label']): __('Subscribe', 'blossom-shop');?>">
            </form>
        	</div>
            <div class="bten-response" id="bten-response-<?php echo esc_attr($atts['id']);?>"><span></span></div>
            <div id="mask-<?php echo esc_attr($atts['id']);?>"></div>
        </div>
        <?php
        global $post;
        $bten_settings = get_option( 'blossomthemes_email_newsletter_settings', true ); 
                $style = '<style>
                    #mask-'.$atts['id'].' {
                      position: fixed;
                      width: 100%;
                      height: 100%;
                      left: 0;
                      top: 0;
                      z-index: 9000;
                      background-color: #000;
                      display: none;
                    }

                    #boxes-'.$atts['id'].' #dialog {
                      width: 750px;
                      height: 300px;
                      padding: 10px;
                      background-color: #ffffff;
                      font-family: "Segoe UI Light", sans-serif;
                      font-size: 15pt;
                    }

                    
                    #loader-'.$atts['id'].' {
                        position: absolute;
                        top: 27%;
                        left: 0;
                        width: 100%;
                        height: 80%;
                        text-align: center;
                        font-size: 50px;
                    }

                    #loader-'.$atts['id'].' .table{
                        display: table;
                        width: 100%;
                        height: 100%;
                    }

                    #loader-'.$atts['id'].' .table-row{
                        display: table-row;
                    }

                    #loader-'.$atts['id'].' .table-cell{
                        display: table-cell;
                        vertical-align: middle;
                    }
                </style>';
                echo $obj->bten_minify_css($style);
                // echo $style;

                $ajax =
                    '<script>
                    jQuery(document).ready(function() { 
                        jQuery(document).on("submit","form#blossomthemes-email-newsletter-'.$atts['id'].'", function(e){
                        e.preventDefault();
                        jQuery(".subscribe-submit-'.$atts['id'].'").attr("disabled", "disabled" );
                        var email = jQuery(".subscribe-email-'.$atts['id'].'").val();
                        var fname = jQuery(".subscribe-fname-'.$atts['id'].'").val();
                        var confirmation = jQuery(".subscribe-confirmation-'.$atts['id'].'").val();
                        var sid = '.$atts['id'].';
                            jQuery.ajax({
                                type : "post",
                                dataType : "json",
                                url : bten_ajax_data.ajaxurl,
                                data : {action: "subscription_response", email : email, fname : fname, sid : sid, confirmation : confirmation},
                                beforeSend: function(){
                                    jQuery("#loader-'.$atts['id'].'").fadeIn(500);
                                },
                                success: function(response){
                                    jQuery(".subscribe-submit-'.$atts['id'].'").attr("disabled", "disabled" );';
                                $bten_settings = get_option( 'blossomthemes_email_newsletter_settings', true ); 
                                $option = isset($bten_settings['thankyou-option']) ? esc_attr($bten_settings['thankyou-option']):'text';
                                $ajax .='if(response.type === "success") {';
                                if($option == 'text')
                                {
                                    $ajax .= 'jQuery("#bten-response-'.$atts['id'].' span").html(response.message);jQuery("#bten-response-'.$atts['id'].'").fadeIn("slow").delay("3000").fadeOut("3000",function(){
                                            jQuery(".subscribe-submit-'.$atts['id'].'").removeAttr("disabled", "disabled" );
                                            jQuery("form#blossomthemes-email-newsletter-'.$atts['id'].'").find("input[type=text]").val("");
                                            jQuery("form#blossomthemes-email-newsletter-'.$atts['id'].'").find("input[type=checkbox]").prop("checked", false);
                                        });';
                                }
                                else{
                                    $selected_page = isset($bten_settings['page'])?esc_attr($bten_settings['page']):'';
                                    $url = get_permalink($selected_page);
                                    $ajax.= 'window.location.href = "'.$url.'"';
                                }

                                $ajax.='}
                                else{
                                    jQuery("#bten-response-'.$atts['id'].' span").html(response.message);jQuery("#bten-response-'.$atts['id'].'").fadeIn("slow").delay("3000").fadeOut("3000",function(){
                                            jQuery(".subscribe-submit-'.$atts['id'].'").removeAttr("disabled", "disabled" );
                                            jQuery("form#blossomthemes-email-newsletter-'.$atts['id'].'").find("input[type=text]").val("");
                                            jQuery("form#blossomthemes-email-newsletter-'.$atts['id'].'").find("input[type=checkbox]").prop("checked", false); 

                                        });
                                    }
                                },
                                complete: function(){
                                    jQuery("#loader-'.$atts['id'].'").fadeOut(500);             
                                } 
                            });  
                        });
                    });
                    </script>';
    echo $obj->bten_minify_js($ajax);
 	$output = ob_get_contents();
  	ob_end_clean();
    return $output;
}
endif;
add_filter( 'blossomthemes_newsletter_shortcode_filter', 'blossom_shop_blossomthemes_email_widget_filter', 10, 2 );