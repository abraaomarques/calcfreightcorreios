define([
    'jquery',
    'AbraaoMarques_Correios/js/lib/jquery.mask.min'
], function($){
    'use strict'

     $.widget('correios.jqueryMask', {
            _create: function () {
                $('input[name="zipcode"]').mask('00000-000');
            },
        });

        return $.correios.jqueryMask;
})
