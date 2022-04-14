define(
    [
        'jquery'
    ],
    function(jQuery){
        jQuery(document).ready(function () {
            jQuery("#zipcode").keyup(function (e) {
                let zipcode = jQuery('#zipcode').val();
                let productSku = jQuery('#productsku').val();

                if(zipcode.length == 9){
                    jQuery('.freight-info .waiting').show();
                    jQuery.ajax({
                        url:  '/abraaomarques_correios/search/quotation',
                        type: 'POST',
                        data: {zipcode: zipcode, productSku: productSku},
                        success: function(response){
                            if(response){
                            console.log(response);
                                jQuery('.quotation .waiting').hide();
                                jQuery('.display_quotation').html(response);
                            }
                        },
                        error: function(){
                        }
                    });
                }
            });
        });
    }
)
