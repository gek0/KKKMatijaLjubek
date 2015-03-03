/**
 * main JS file for initialization
 */

jQuery(document).ready(function(){
    /*
     *   gallery image scroll
     */
    $('#banner').carousel({
        interval: 3500,
        cycle: true,
        pause: "false"
    });

    /*
     *   latest news slider
     */
    $('#main-news-slider').liquidSlider({
        autoSlide: true,
        autoSlideInterval: 4500,
        includeTitle: false,
        mobileNavigation: false,
        autoHeight: false,
        swipe: true
    });

    /*
    *   google maps
    */
    var map;
    // main directions
    map = new GMaps({
        el: '#map', lat: 45.787143, lng: 15.912107, zoom: 15, linksControl:true, zoomControl : false,
        panControl : true, scrollwheel: false, streetViewControl: true
    });

    // add address markers
    var image = 'css/assets/images/map-marker.png';
    map.addMarker({ lat: 45.787143, lng: 15.912107, title: 'KKK Matija Ljubek', icon: image });
    //apply custom styles
    var styles = [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#46bcec"},{"visibility":"on"}]}    ];
    map.setOptions({styles: styles});
});

/*
*	page layout - animations - scroll
*/
(function($){
    $(document).ready(function(){

        // Fixed header
        //-----------------------------------------------
        $(window).scroll(function() {
            if (($(".header.fixed").length > 0)) {
                if(($(this).scrollTop() > 0) && ($(window).width() > 767)) {
                    $("body").addClass("fixed-header-on");
                } else {
                    $("body").removeClass("fixed-header-on");
                }
            };
        });

        $(window).load(function() {
            if (($(".header.fixed").length > 0)) {
                if(($(this).scrollTop() > 0) && ($(window).width() > 767)) {
                    $("body").addClass("fixed-header-on");
                } else {
                    $("body").removeClass("fixed-header-on");
                }
            };
        });

        //Scroll Spy
        //-----------------------------------------------
        if($(".scrollspy").length>0) {
            $("body").addClass("scroll-spy");
            $('body').scrollspy({
                target: '.scrollspy',
                offset: 152
            });
        }

        //Smooth Scroll
        //-----------------------------------------------
        if ($(".smooth-scroll").length>0) {
            $('.smooth-scroll a[href*=#]:not([href=#]), a[href*=#]:not([href=#]).smooth-scroll').click(function() {
                if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                    var target = $(this.hash);
                    target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                    if (target.length) {
                        $('html,body').animate({
                            scrollTop: target.offset().top-151
                        }, 1000);
                        return false;
                    }
                }
            });
        }

        // Animations
        //-----------------------------------------------
        if (($("[data-animation-effect]").length>0) && !Modernizr.touch) {
            $("[data-animation-effect]").each(function() {
                var $this = $(this),
                    animationEffect = $this.attr("data-animation-effect");
                if(Modernizr.mq('only all and (min-width: 768px)') && Modernizr.csstransitions) {
                    $this.appear(function() {
                        setTimeout(function() {
                            $this.addClass('animated object-visible ' + animationEffect);
                        }, 400);
                    }, {accX: 0, accY: -130});
                } else {
                    $this.addClass('object-visible');
                }
            });
        };

        // Isotope filters
        //-----------------------------------------------
        if ($('.isotope-container').length>0) {
            $(window).load(function() {
                $('.isotope-container').fadeIn();
                var $container = $('.isotope-container').isotope({
                    itemSelector: '.isotope-item',
                    layoutMode: 'masonry',
                    transitionDuration: '0.6s',
                    filter: "*"
                });
                // filter items on button click
                $('.filters').on( 'click', 'ul.nav li a', function() {
                    var filterValue = $(this).attr('data-filter');
                    $(".filters").find("li.active").removeClass("active");
                    $(this).parent().addClass("active");
                    $container.isotope({ filter: filterValue });
                    return false;
                });
            });
        };

        //Modal
        //-----------------------------------------------
        if($(".modal").length>0) {
            $(".modal").each(function() {
                $(".modal").prependTo( "body" );
            });
        }

    }); // End document ready
})(this.jQuery);