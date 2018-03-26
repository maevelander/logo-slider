jQuery(document).ready(function ($) {


    $(".lsp_next_btn").click(function () {

        $(".cycle-slideshow").effect("fade", '', 500, callback);

        function callback() {

            setTimeout(function(){
                $(".cycle-slideshow").removeAttr("style").hide().fadeIn();
            }, 200);

        }

    })

});