$(document).ready(function(){


    $(document).on({
        mouseenter: function () {
            $(this).children('.cover').css({'display': 'none'});
        },
        mouseleave: function () {
            $(this).children('.cover').css({'display': 'block'});
        }
    }, '.thumbContainer');

    $(document).on('click', '.thumbContainer', function(){
        $('.selectedCover').css('display', 'none');

        $('.addCover').each(function(){
            if(!$(this).hasClass('cover'))
                $(this).addClass('cover');
        });

        $('.cover').css('display', 'block');
        $(this).children('.selectedCover').css('display', 'block').prev().removeClass('cover');
        var img = $(this).find('img').attr('id');
        $('.newAlbumCover').val(img);
    });

});