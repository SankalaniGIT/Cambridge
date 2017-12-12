var $current, $next, $slides = $(".slideshow .slide");

function doSlideShow () {
    $current = $slides.filter(".slide.current");
    $next = $current.next(".slide");
    if ($next.length < 1) {
        $next = $slides.first();
    }
    $slides.removeClass("previous");
    $current.addClass("previous").removeClass("current");
    $next.addClass("current");
    window.setTimeout(doSlideShow, 5000);
}
window.setTimeout(doSlideShow, 5000);



$(document).ready(function () {
    var trigger = $('.hamburger'),
        overlay = $('.overlay'),
        isClosed = false;

    trigger.click(function () {
        hamburger_cross();
    });

    function hamburger_cross() {

        if (isClosed == true) {
            overlay.hide();
            trigger.removeClass('is-open');
            trigger.addClass('is-closed');
            isClosed = false;
        } else {
            overlay.show();
            trigger.removeClass('is-closed');
            trigger.addClass('is-open');
            isClosed = true;
        }
    }

    $('[data-toggle="offcanvas"]').click(function () {
        $('#wrapper').toggleClass('toggled');
    });

    if (level == 1) {
        $('.lvl').addClass('hidden');
    }

});


