function checkInView(elem, partial) {
    var container = $(".value_right");
    var contHeight = container.height();
    var contTop = container.scrollTop();
    var contBottom = contTop + contHeight;
    var elemTop = $(elem).offset().top - container.offset().top;
    var elemBottom = elemTop + $(elem).height();
    var isPart = ((elemTop < 0 && elemBottom > 0) || (elemTop > 0 && elemTop <= container.height())) && partial;

    return isPart;
}

function sticky_relocate() {
    if ($(window).width() >= 767) {
        var window_top = $(window).scrollTop();
        var footer_top = $("#footer").offset().top - 150;
        var div_top = $('#sticky-anchor').offset().top - 250;
        var div_height = $("#sticky").height();

        if (window_top + div_height > footer_top) {
            //$('#sticky').removeClass('stick');
        } else if (window_top > div_top) {
            $('#sticky').addClass('stick');
        } else {
            $('#sticky').removeClass('stick');
        }
    } else {
        $('#sticky').removeClass('stick');
    }
}

$(function() {
    $(window).scroll(sticky_relocate);
    sticky_relocate();
});

$(document).ready(function() {
    $(document).on("scroll", onScroll);


});

function onScroll(event) {
    var scrollPos = $(document).scrollTop();
    $('.content-holder .value_box').each(function() {
        var currLink = $(this);
        var refElement = $('#' + currLink.attr("data-id"));
        if (refElement.position().top <= scrollPos + 100) {
            $('.content-holder .value_box').removeClass("active");
            $('#img_other').attr('src', currLink.attr('data-img-url'));
            currLink.addClass("active");
        } else {
            currLink.removeClass("active");
        }
    });
}