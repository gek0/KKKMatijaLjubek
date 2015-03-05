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
     *   content font resize
     */
    $('#fontUp').click(function(){
        var container = $('#content-description-body');
        var fontSize = parseInt(container.css('font-size'));
        if(fontSize < 25){
            container.css('font-size', fontSize + 2);
        }
        else{
            container.css('font-size', fontSize);
        }
    });
    $('#fontDown').click(function(){
        var container = $('#content-description-body');
        var fontSize = parseInt(container.css('font-size'));
        if(fontSize > 9){
            container.css('font-size', fontSize - 2);
        }
        else{
            container.css('font-size', fontSize);
        }
    });

    /*
     *   latest news slider
     */
    if($('#main-news-slider').length > 0) {
        $('#main-news-slider').liquidSlider({
            autoSlide: true,
            autoSlideInterval: 4500,
            includeTitle: false,
            mobileNavigation: false,
            autoHeight: false,
            swipe: true
        });
    }

    /*
     *   add lazy loading to images out of screen viewport
     */
    $(function() {
        $("img.lazy").lazyload({
            effect : "fadeIn"
        });
    });

    /*
     *   google maps
     */
    if($("#map").length > 0) {
        var map;
        // main directions
        map = new GMaps({
            el: '#map', lat: 45.787143, lng: 15.912107, zoom: 15, linksControl: true, zoomControl: false,
            panControl: true, scrollwheel: false, streetViewControl: true
        });

        // add address markers
        var image = 'css/assets/images/map-marker.png';
        map.addMarker({lat: 45.787143, lng: 15.912107, title: 'KKK Matija Ljubek', icon: image});
        //apply custom styles
        var styles = [{
            "featureType": "administrative",
            "elementType": "labels.text.fill",
            "stylers": [{"color": "#444444"}]
        }, {"featureType": "landscape", "elementType": "all", "stylers": [{"color": "#f2f2f2"}]}, {
            "featureType": "poi",
            "elementType": "all",
            "stylers": [{"visibility": "off"}]
        }, {
            "featureType": "road",
            "elementType": "all",
            "stylers": [{"saturation": -100}, {"lightness": 45}]
        }, {
            "featureType": "road.highway",
            "elementType": "all",
            "stylers": [{"visibility": "simplified"}]
        }, {
            "featureType": "road.arterial",
            "elementType": "labels.icon",
            "stylers": [{"visibility": "off"}]
        }, {
            "featureType": "transit",
            "elementType": "all",
            "stylers": [{"visibility": "off"}]
        }, {"featureType": "water", "elementType": "all", "stylers": [{"color": "#46bcec"}, {"visibility": "on"}]}];
        map.setOptions({styles: styles});
    }
});

/*
*	page layout - animations - scroll
*/
(function($){
    $(document).ready(function(){
        /*
         *  fixed header
         */
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

        /*
         *  scroll spy
         */
        if($(".scrollspy").length > 0) {
            $("body").addClass("scroll-spy");
            $('body').scrollspy({
                target: '.scrollspy',
                offset: 152
            });
        }

        /*
         *  smooth scroll
         */
        if($(".smooth-scroll").length > 0) {
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

        /*
         *  animations
         */
        if(($("[data-animation-effect]").length > 0) && !Modernizr.touch) {
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

        /*
         *  isotope filters
         */
        if($('.isotope-container').length > 0) {
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

        /*
         *  image lightbox gallery
         */
        //activity indicator
        var activityIndicatorOn = function(){
                $( '<div id="imagelightbox-loading"><div></div></div>' ).appendTo('body');
            },
            activityIndicatorOff = function(){
                $('#imagelightbox-loading').remove();
            },
        //overlay
            overlayOn = function(){
                $( '<div id="imagelightbox-overlay"></div>' ).appendTo('body');
            },
            overlayOff = function(){
                $('#imagelightbox-overlay').remove();
            },
        //close button
            closeButtonOn = function(instance){
                $( '<button type="button" id="imagelightbox-close" title="Zatvori"></button>' ).appendTo('body').on('click touchend', function(){ $(this).remove(); instance.quitImageLightbox(); return false; });
            },
            closeButtonOff = function(){
                $('#imagelightbox-close').remove();
            },
        //arrows
            arrowsOn = function(instance, selector){
                var $arrows = $('<button type="button" class="imagelightbox-arrow imagelightbox-arrow-left" title="Prethodna"></button><button type="button" class="imagelightbox-arrow imagelightbox-arrow-right" title="Sljedeća"></button>');
                $arrows.appendTo('body');

                $arrows.on('click touchend', function(e){
                    e.preventDefault();

                    var $this = $(this),
                        $target	= $(selector + '[href="' + $('#imagelightbox').attr('src') + '"]'),
                        index = $target.index(selector);

                    if ($this.hasClass('imagelightbox-arrow-left')) {
                        index = index - 1;
                        if (!$(selector).eq(index).length)
                            index = $(selector).length;
                    } else {
                        index = index + 1;
                        if (!$(selector).eq(index).length)
                            index = 0;
                    }

                    instance.switchImageLightbox(index);
                    return false;
                });
            },
            arrowsOff = function(){
                $('.imagelightbox-arrow').remove();
            };

        //run gallery
        var selector = 'a[data-imagelightbox="gallery-images"]';
        var instance = $(selector).imageLightbox({
                onStart:		function() { overlayOn(); closeButtonOn(instance); arrowsOn(instance, selector); },
                onEnd:			function() { overlayOff(); closeButtonOff(); arrowsOff(); activityIndicatorOff(); },
                onLoadStart: 	function() { activityIndicatorOn(); },
                onLoadEnd:	 	function() { activityIndicatorOff(); $('.imagelightbox-arrow').css('display', 'block'); }
            });



    });
})(this.jQuery);

