$(function() {
    let header = $('.header');
    let mobileTel = $('.header__tel').first(); 
    let hederHeight = header.height(); 

    $(window).scroll(function() {
        if ($(this).scrollTop() > 1) {
            header.addClass('header_fixed');
            $('body').css({
                'paddingTop': hederHeight + 'px' 
            });
        } else {
            header.removeClass('header_fixed');
            $('body').css({
                'paddingTop': 0 
            })
        }

        if ($(this).scrollTop() > 1) {
            header.css({
                'padding': '5px 0',
                'background': '#f6ffdb',
                'transition': '.3s'
            });
        } else {
            header.css({
                'padding': '15px 0',
                'background': '#ffffff',
                'transition': '.3s'
            });
        }


        if ($(this).scrollTop() > 500) {
            mobileTel.fadeOut();
        } else {
            mobileTel.fadeIn();
        }
    });
});

  
  