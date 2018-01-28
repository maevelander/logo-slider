//+++++++++++++_ Image Media Uploader
jQuery(document).ready(function() {

    jQuery('.lsp_upload_button').click(function() {
        targetfield = jQuery(this).parents().find('.lsp_upload_url');
        tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
        return false;
    });

    window.send_to_editor = function(html) {
        imgurl = jQuery('img',html).attr('src');
        jQuery(targetfield).val(imgurl);
        tb_remove();
    }
    
     jQuery('#toplevel_page_lsp_options ul li:last-child').css({'display':'none'});
});
