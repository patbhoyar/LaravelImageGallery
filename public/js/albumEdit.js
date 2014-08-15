$(document).ready(function(){


    $(document).on({
        mouseenter: function () {
            $(this).children('.cover').css({'display': 'block'});
        },
        mouseleave: function () {
            $(this).children('.cover').css({'display': 'none'});
        }
    }, '.thumbContainer');

});