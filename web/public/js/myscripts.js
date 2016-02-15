/* 
 Magister - single-page Bootstrap template ADAPTED
 Credits  - Design and development: Sergey Pozhilov - http://pozhilov.com
 Photos used in template: Unsplash - http://unsplash.com
 More free templates by Sergey: http://gettemplate.com
 
 */

var current_new_item = 0;
var new_hide_time = 900;
var new_show_time = 500;

jQuery(document).ready(function ($) {
    
    $('.datepicker').datepicker({
    format: 'mm/dd/yyyy',
    startDate: '-3d'
});

    $('.news-menu-link').click(function ()
    {
        if (!$(this).hasClass('active')) {
            current_new_item = this;
            $('.news-item:visible').fadeOut(new_hide_time, function () {
                $('.news-menu-link').removeClass('active');
                $(current_new_item).addClass('active');
                var new_new = $($(current_new_item).attr('href'));
                new_new.fadeIn(new_show_time);
                $("body, html").animate({
                    scrollTop: new_new.offset().top
                }, 600);
            });
        }
        return false;
    });
});


$(document).ready(function () {

    /*
    $('.arrow-up').click(function () {
        $('html, body').animate({scrollTop: '-=3000'}, 3000);
    });

    $('.arrow-down').click(function () {
        $('html, body').animate({scrollTop: '+=3000'}, 3000);
    });
    */

    $('#etsatopia_gallery').justifiedGallery({
        'rowHeight': 150,
        'lastRow': 'nojustify',
        'margins': 4,
        'border': 2,
        'captions': true,
        'cssAnimation': true,
        'captionSettings':
                {'animationDuration': 500,
                    'visibleOpacity': 0.9,
                    'nonVisibleOpacity': 0.5}
    });
    $('#paiporta_gallery').justifiedGallery({
        'rowHeight': 150,
        'lastRow': 'nojustify',
        'margins': 4,
        'border': 2,
        'captions': true,
        'cssAnimation': true,
        'captionSettings':
                {'animationDuration': 500,
                    'visibleOpacity': 0.9,
                    'nonVisibleOpacity': 0.5}
    });
});



