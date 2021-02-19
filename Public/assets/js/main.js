/*---------------------------------------------
Template name :  DVPN
Version       :  1.0
Author        :  ThemeLooks
Author url    :  http://themelooks.com

NOTE:
------
Please DO NOT EDIT THIS JS, you may need to use "custom.js" file for writing your custom js.
We may release future updates so it will overwrite this file. it's better and safer to use "custom.js".

[Table of Content]

    01: Main Menu
    02: Sticky Nav
    03: Background Image
    04: Check Data
    05: Owl Carousel
    06: Changing svg color 
    07: Google map
    08: Preloader 
    09: Contact Form
    10: Back to top button
    11: Collapse
    12: Search Page
    13: Offcanvas Triggar
    14: Banner Mousemove
    15: Popup Video
    16: Service Point
    17: Counter UP
    18: Countdown Timer
    19: Accordion
----------------------------------------------*/


(function ($) {
    "use strict";

    /*===================
    01: Main Menu
    =====================*/
    $('ul.nav li a[href="#"]').on('click', function (event) {
        event.preventDefault();
    });

    $('.header ul.nav > li > a').append('<span class="menu-mark"></span>')

    /* Menu Maker */
    $(".nav-wrapper").menumaker({
        title: '<span></span>',
        format: "multitoggle"
    });

    $($(window)).on('scroll', function () {
        if (!$('ul.nav').hasClass('open')) {
            $('#menu-button').removeClass('menu-opened');
        };
    });

    if ($(window).width() >= 992) {
        let $trigger = $('.menu-trigger');
        $trigger.on('click', function () {
            $(this).toggleClass('active');
            $('.main-menu-wrapper').toggleClass('show');
            $('.logo-holder').toggleClass('d-none');

            $('.nav-wrapper').toggleClass('active');
        })
    }

    /*========================
    02: Sticky Nav
    ==========================*/
    $(window).on("scroll", function () {
        var scroll = $(window).scrollTop();
        if (scroll < 100) {
            $(".header-main.love-sticky").removeClass("sticky fadeInDown animated");
        }
        else {
            $(".header-main.love-sticky").addClass("sticky fadeInDown animated");
        }
    });

    /*========================
    03: Background Image
    ==========================*/
    var $bgImg = $('[data-bg-img]');
    $bgImg.css('background-image', function () {
        return 'url("' + $(this).data('bg-img') + '")';
    }).removeAttr('data-bg-img').addClass('bg-img');


    /*==================================
    04: Check Data
    ====================================*/
    var checkData = function (data, value) {
        return typeof data === 'undefined' ? value : data;
    };

    /*==================================
    05: Owl Carousel
    ====================================*/
    var $owlCarousel = $('.owl-carousel');
    $owlCarousel.each(function () {
        var $t = $(this);

        $t.owlCarousel({
            items: checkData($t.data('owl-items'), 1),
            margin: checkData($t.data('owl-margin'), 0),
            loop: checkData($t.data('owl-loop'), true),
            smartSpeed: 450,
            autoplay: checkData($t.data('owl-autoplay'), true),
            autoplayTimeout: checkData($t.data('owl-speed'), 5000),
            center: checkData($t.data('owl-center'), false),
            animateIn: checkData($t.data('owl-animate-in'), false),
            animateOut: checkData($t.data('owl-animate-out'), false),
            nav: checkData($t.data('owl-nav'), false),
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            dots: checkData($t.data('owl-dots'), false),
            stagePadding: checkData($t.data('owl-stage-padding'), false),
            autoWidth: checkData($t.data('owl-auto-width'), false),
            responsive: checkData($t.data('owl-responsive'), {})
        });
    });

    /*==================================
    06: Changing svg color 
    ====================================*/
    jQuery('img.svg').each(function () {
        var $img = jQuery(this);
        var imgID = $img.attr('id');
        var imgClass = $img.attr('class');
        var imgURL = $img.attr('src');

        jQuery.get(imgURL, function (data) {
            // Get the SVG tag, ignore the rest
            var $svg = jQuery(data).find('svg');

            // Add replaced image's ID to the new SVG
            if (typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }
            // Add replaced image's classes to the new SVG
            if (typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass + ' replaced-svg');
            }

            // Remove any invalid XML tags as per http://validator.w3.org
            $svg = $svg.removeAttr('xmlns:a');

            // Check if the viewport is set, else we gonna set it if we can.
            if (!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
                $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'));
            }

            // Replace image with new SVG
            $img.replaceWith($svg);

        }, 'xml');
    });

    /*==================================
    07: Google map 
    ====================================*/
    let style = [
        {
            "featureType": "water",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#C7E5FD"
                },
                {
                    "lightness": 17
                }
            ]
        },
        {
            "featureType": "landscape",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#f5f5f5"
                },
                {
                    "lightness": 20
                }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#ffffff"
                },
                {
                    "lightness": 17
                }
            ]
        },
        {
            "featureType": "road.highway",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#ffffff"
                },
                {
                    "lightness": 29
                },
                {
                    "weight": 0.2
                }
            ]
        },
        {
            "featureType": "road.arterial",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#ffffff"
                },
                {
                    "lightness": 18
                }
            ]
        },
        {
            "featureType": "road.local",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#ffffff"
                },
                {
                    "lightness": 16
                }
            ]
        },
        {
            "featureType": "poi",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#f5f5f5"
                },
                {
                    "lightness": 21
                }
            ]
        },
        {
            "featureType": "poi.park",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#dedede"
                },
                {
                    "lightness": 21
                }
            ]
        },
        {
            "elementType": "labels.text.stroke",
            "stylers": [
                {
                    "visibility": "on"
                },
                {
                    "color": "#ffffff"
                },
                {
                    "lightness": 16
                }
            ]
        },
        {
            "elementType": "labels.text.fill",
            "stylers": [
                {
                    "saturation": 36
                },
                {
                    "color": "#333333"
                },
                {
                    "lightness": 40
                }
            ]
        },
        {
            "elementType": "labels.icon",
            "stylers": [
                {
                    "visibility": "off"
                }
            ]
        },
        {
            "featureType": "transit",
            "elementType": "geometry",
            "stylers": [
                {
                    "color": "#f2f2f2"
                },
                {
                    "lightness": 19
                }
            ]
        },
        {
            "featureType": "administrative",
            "elementType": "geometry.fill",
            "stylers": [
                {
                    "color": "#fefefe"
                },
                {
                    "lightness": 20
                }
            ]
        },
        {
            "featureType": "administrative",
            "elementType": "geometry.stroke",
            "stylers": [
                {
                    "color": "#fefefe"
                },
                {
                    "lightness": 17
                },
                {
                    "weight": 1.2
                }
            ]
        }
    ];

    var $map = $('[data-trigger="map"]'),
        $mapOps;

    if ($map.length) {
        // Map Options
        $mapOps = $map.data('map-options');

        // Map Initialization
        window.initMap = function () {
            $map.css('min-height', '600px');
            $map.each(function () {
                var $t = $(this), map, lat, lng, zoom;

                $mapOps = $t.data('map-options');
                lat = parseFloat($mapOps.latitude, 10);
                lng = parseFloat($mapOps.longitude, 10);
                zoom = parseFloat($mapOps.zoom, 10);

                map = new google.maps.Map($t[0], {
                    center: { lat: lat, lng: lng },
                    zoom: zoom,
                    scrollwheel: false,
                    disableDefaultUI: true,
                    zoomControl: true,
                    styles: style,
                });

                map = new google.maps.Marker({
                    position: { lat: lat, lng: lng },
                    map: map,
                    animation: google.maps.Animation.DROP,
                    draggable: false,
                    icon: 'assets/img/map-marker2.svg'
                });

            });
        };
        initMap();
    };

    /*==================================
    08: Preloader 
    ====================================*/
    $(window).on('load', function () {
        $('.preloader').fadeOut(1000);
    });

    /*==================================
    09: Contact Form
    ====================================*/
    $('.contact-form-wrap').on('submit', 'form', function (e) {
        e.preventDefault();

        var $el = $(this);

        $.post($el.attr('action'), $el.serialize(), function (res) {
            res = $.parseJSON(res);
            $el.parent('.contact-form-wrap').find('.form-response').html('<span>' + res[1] + '</span>');
        });
    });

    /*============================================
    10: Back to top button
    ==============================================*/
    var $backToTopBtn = $('.back-to-top');

    if ($backToTopBtn.length) {
        var scrollTrigger = 400, // px
            backToTop = function () {
                var scrollTop = $(window).scrollTop();
                if (scrollTop > scrollTrigger) {
                    $backToTopBtn.addClass('show');
                } else {
                    $backToTopBtn.removeClass('show');
                }
            };

        backToTop();

        $(window).on('scroll', function () {
            backToTop();
        });

        $backToTopBtn.on('click', function (e) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 700);
        });
    }

    /*==================================
    11: Collapse
    ====================================*/
    function collapse() {
        $(document.body).on('click', '[data-toggle="collapse"]', function (e) {
            var target = '#' + $(this).data('target');

            $(this).toggleClass('collapsed');
            $(target).slideToggle();
            
            e.preventDefault();
        });
    }
    collapse();

    /*==================================
    12: Search Page
    ====================================*/
    $('.search-toggle-btn').on('click', function() {
        $('.full-page-search').addClass('show')
    });

    $('.search-close-btn').on('click', function() {
        $('.full-page-search').removeClass('show')
    });

    /*==================================
    13: Offcanvas Triggar
    ====================================*/
    $('.offcanvas-trigger').on('click', function() {
        $('.offcanvas-wrapper, .offcanvas-overlay').addClass('show')
    });

    $('.offcanvas-overlay, .offcanvas-close').on('click', function() {
        $('.offcanvas-wrapper, .offcanvas-overlay').removeClass('show')
    });


    /*==================================
    14: Banner Mousemove
    ====================================*/
    var object1 = $('.sheild-img');
    var object2 = $('.check-img, .setting2-img, .card-img');
    var object3 = $('.setting-img, .box-img');
    var object4 = $('.s_man');
    var object5 = $('.s_woman');

    var layer = $('.layer');

    layer.mousemove(function(e) {
        var valueX = (e.pageX * -1 / 115);
        var valueY = (e.pageY * -1 / 115);
    
        object1.css({
            'transform' : 'translate3d('+valueX+ 'px, ' + valueY+'px,0)'
        });
    });
    layer.on('mousemove', function(e) {
        var valueX = (e.pageX * -1 / 80);
        var valueY = (e.pageY * -1 / 80);
        
        object2.css({
            'transform':'translate3d('+valueX+ 'px, ' + valueY+'px,0)'
        });
    });
    layer.mousemove(function(e) {
        var valueX = (e.pageX * -1 / 122);
        var valueY = (e.pageY * -1 / 122);
        
        object3.css({
            'transform':'translate3d('+valueX+ 'px, ' + valueY+'px,0)'
        });
    });
	
    layer.mousemove(function(e) {
        var valueX = (e.pageX * -1 / 85);
        var valueY = (e.pageY * -1 / 58);
        
        object4.css({
            'transform':'translate3d('+valueX+ 'px, ' + valueY+'px,0)'
        });
    });
    layer.mousemove(function(e) {
        var valueX = (e.pageX * -1 / 58);
        var valueY = (e.pageY * -1 / 85);
        
        object5.css({
            'transform':'translate3d('+valueX+ 'px, ' + valueY+'px,0)'
        });
    });

    /*==================================
    15: Popup Video
    ====================================*/
    $(".mfp-iframe, .video-btn").magnificPopup({type:"video"});


    /*==================================
    16: Service Point 
    ====================================*/
    $('.service_point-map-img').find('.l_info').on('mouseenter', function() {
        $('.service_point-map-img').find('.l_info').removeClass('active');
        $(this).addClass('active');
    });

    /*==================================
    17: Counter UP
    ====================================*/
    jQuery(document).ready(function($) {
        $('.count-number').counterUp({
            delay: 10,
            time: 2000
        });
    });


    /*==================================
    18: Countdown Timer
    ====================================*/
    $('#countdown').countdown({
        date: '08/16/2021 23:59:59'
    });

    /*==================================
    19: Accordion
    ====================================*/
    var accordionToggle = $('[data-accordion-tab="toggle"]');
    accordionToggle.each(function(){
        $(this).children('.accordion-content').hide();
        $(this).on('click', function(){
            $(this).addClass('active').siblings().removeClass('active');
            if ($(this).hasClass('active')){
                $(this).children('.accordion-content').slideDown(500).parents('[data-accordion-tab="toggle"]').siblings().children('.accordion-content').slideUp(500);
            }
        });
        if($(this).hasClass('active')){
            $(this).children('.accordion-content').show();
        }
    });


}(jQuery));