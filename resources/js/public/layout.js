$( document ).ready(function() {

    $( ".main-menu__mobile-btn" ).click(function() {
        $( ".header" ).toggleClass("active");
    });

    var products = $( ".product-list__item" ).length;
    var viewportWidth = $( window ).width();
    var productWidth = $( ".product-list__item" ).width();
    var scrollbar;
    var isVertical = false;

    scrollbarInitialize(viewportWidth);

    $( window ).resize(function() {
        var viewportWidth = $(window).width();
        scrollbarRewrite(viewportWidth);
    });

    function scrollbarInitialize(viewportWidth) {

        if (products > 3 && viewportWidth > 650) {
            $( ".product-list" ).addClass("scroll");
            $( ".product-list__in" ).width( (productWidth + 16) * products );

            scrollbar = new PerfectScrollbar('.product-list');
            isVertical = true;
        }
    }

    function scrollbarRewrite(viewportWidth) {

        if (products > 3 && viewportWidth > 650 && isVertical == false) {
            $( ".product-list" ).addClass("scroll");
            $( ".product-list__in" ).width( (productWidth + 16) * products );

            scrollbar = new PerfectScrollbar('.product-list');
            isVertical = true;

        } else if (viewportWidth < 651 && isVertical == true) {
            scrollbar.destroy();
            scrollbar = null;
            $( ".product-list" ).removeClass("scroll");
            $( ".product-list__in" ).width( "auto" );

            isVertical = false;
        }
    }


});
