/**
 * Created by Abu Seraj on 10/8/2017.
 */
$(document).ready(function () {
    'user strict';

    var winH = $(window).height();
    var upperH = $('.upper-bar').innerHeight();

    var nav = $('.navbar').innerHeight();

    $('.slider , .carousel-item').height(winH - (upperH + nav));

    $('.features-work ul li').on('click', function () {
        $(this).addClass('active').siblings().removeClass('active');
        if ($(this).data('class') == 'all') {
            $('.photo .col-sm').css('opacity', '1')
        } else {
            $('.photo .col-sm').css('opacity', '.07');
            $($(this).data('class')).parent().css('opacity', '1');

        }
    });
});