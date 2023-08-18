var theme = function () {

    // ---------------------------------------------------------------------------------------
    // prevent empty links
    function handlePreventEmptyLinks() {
        $('a[href=#]').click(function (event) {
            event.preventDefault();
        });
    }

    // ---------------------------------------------------------------------------------------
    // fix html5 placeholder attribute for ie7 & ie8
    function handlePlaceholder() {
        if ($.browser.msie && $.browser.version.substr(0, 1) < 9) { // ie7&ie8
            $('input[placeholder], textarea[placeholder]').each(function () {
                var input = $(this);

                $(input).val(input.attr('placeholder'));

                $(input).focus(function () {
                    if (input.val() == input.attr('placeholder')) {
                        input.val('');
                    }
                });

                $(input).blur(function () {
                    if (input.val() == '' || input.val() == input.attr('placeholder')) {
                        input.val(input.attr('placeholder'));
                    }
                });
            });
        }
    }

    // ---------------------------------------------------------------------------------------
    // Placeholdem
    function handlePlaceholdem() {
		if ($('input').length > 0)
			Placeholdem(document.querySelectorAll('[placeholder]'));
    }

    // ---------------------------------------------------------------------------------------
    // add hover class for correct view on mobile devices
    function handleHoverClass() {
        var hover = $('.thumbnail');
        hover.hover(
            function () {
                $(this).addClass('hover');
                /*
                 $(this).find('.img-responsive').addClass('zoom-12');
                 $(this).find('.caption-title').addClass('slideDown');
                 $(this).find('.caption-zoom').addClass('slideRight');
                 $(this).find('.caption-link').addClass('slideLeft');
                 $(this).find('.caption-category').addClass('slideUp');
                 */
            },
            function () {
                $(this).removeClass('hover');
                /*
                 $(this).find('.img-responsive').removeClass('zoom-12');
                 $(this).find('.caption-title').removeClass('slideDown');
                 $(this).find('.caption-zoom').removeClass('slideRight');
                 $(this).find('.caption-link').removeClass('slideLeft');
                 $(this).find('.caption-category').removeClass('slideUp');
                 */
            }
        );
    }

    // ---------------------------------------------------------------------------------------
    // superfish menu
    function handleSuperFish() {
        $('ul.sf-menu').superfish();
    }

    // ---------------------------------------------------------------------------------------
    // create mobile menu from exist superfish menu
    function handleMobileMenu() {
        $('.mobile-menu').on('change', function () {
            window.location = $(this).val();
        });
    }

    // ---------------------------------------------------------------------------------------
    // prettyPhoto
    function handlePrettyPhoto() {
        $("a[rel^='prettyPhoto']").prettyPhoto({theme: 'dark_square'});
    }

    // ---------------------------------------------------------------------------------------
    // Scroll totop button
    function handleToTopButton() {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 1) {
                $('.totop').css({bottom: "25px"});
            } else {
                $('.totop').css({bottom: "-100px"});
            }
        });
        $('.totop').click(function () {
            $('html, body').animate({scrollTop: '0px'}, 800);
            return false;
        });
    }

    // ---------------------------------------------------------------------------------------
    // TEMP

    // Sticky Menu
    function handleStickyMenu() {
        $(window).scroll(function () {
            if ($(window).scrollTop() > 35) {
                $('header.header').addClass('sticky-header');
            }
            else {
                $('header.header').removeClass('sticky-header');
            }
        });
    }

    /* **** */

    // ---------------------------------------------------------------------------------------

    // ---------------------------------------------------------------------------------------
    return {
        init: function () {
            handlePreventEmptyLinks();
            handlePlaceholder();
            //handlePlaceholdem();
            handleHoverClass();
            handleSuperFish();
            handleMobileMenu();
            handlePrettyPhoto();
            handleToTopButton();
        },
        // Isotope
        initIsotope: function () {
            $(window).resize(function () {
                // relayout on window resize
                $('.projects .items').isotope('reLayout');
            });
            $(window).load(function () {
                // cache container
                var $container = $('.projects .items');
                // initialize isotope
                $container.isotope({
                    // options...
                    itemSelector: '.item'
                });
                // filter items when filter link is clicked
                $('#filtrable a').click(function () {
                    var selector = $(this).attr('data-filter');
                    $("#filtrable li").removeClass("current");
                    $(this).parent().addClass("current");
                    $container.isotope({ filter: selector });
                    return false;
                });
                $container.isotope('reLayout');
            });
        },
        initIsotopeBlog: function () {
            $(window).resize(function () {
                // relayout on window resize
                $('.post-masonry').isotope('reLayout');
            });
            $(window).load(function () {
                // cache container
                var $container = $('.post-masonry');
                // initialize isotope
                $container.isotope({
                    // options...
                    itemSelector: '.post-wrap'
                });
                $container.isotope('reLayout');
            });
        },
        // Testimonials
        initTestimonials: function () {
            $("#testimonials").owlCarousel({
                items: 3,
                itemsDesktop: false,
                itemsDesktopSmall: [991, 2],
                itemsTablet: [768, 1],
                itemsMobile: [479, 1],
                autoPlay: true,
                pagination: false
            });
        },
        // Partners Slider
        initPartnerSlider: function () {
            $("#partners").owlCarousel({
                items: 6,
                itemsDesktop: false,
                itemsDesktopSmall: [991, 5],
                itemsTablet: [768, 3],
                itemsMobile: [479, 2],
                autoPlay: true,
                pagination: false
            });
        },
        // Images Carousel
        initImageCarousel: function () {
            $(".img-carousel").owlCarousel({
                navigation : true, // Show next and prev buttons
                slideSpeed : 300,
                paginationSpeed : 400,
                singleItem:true
            });
            $(".img-carousel .next").click(function () {
                $(".img-carousel").trigger('owl.next');
                return false;
            });
            $(".img-carousel .prev").click(function () {
                $(".img-carousel").trigger('owl.prev');
                return false;
            });
        },
        // Twitter / Last Tweet Carousel
        initLastTweet: function () {
            $("#last-tweets").owlCarousel({singleItem: true, autoPlay: true, pagination: false });
            $("#next-tweet").click(function () {
                $("#last-tweets").trigger('owl.next');
                return false;
            });
            $("#prev-tweet").click(function () {
                $("#last-tweets").trigger('owl.prev');
                return false;
            });
        },
        // easyPieChart
        initEasyPieChart: function () {
            var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
            if (isMobile == false) {
                $('.chart').waypoint(function (){
                    $('.chart').easyPieChart({
                        easing: 'easeOutBounce',
                        size: 160,
                        animate: 2000,
                        lineCap: 'square',
                        lineWidth: 19,
                        barColor: '#acd94c',
                        trackColor: '#f2f4f7',
                        scaleColor: false,
                        onStep: function (from, to, percent) {
                            $(this.el).find('.percent').text(Math.round(percent) + '%');
                        }
                    });
                }, {
                    //offset: 'bottom-in-view'
                    offset: '95%'
                });
            } else {
                $('.chart').easyPieChart({
                    easing: 'easeOutBounce',
                    size: 160,
                    animate: 2000,
                    lineCap: 'square',
                    lineWidth: 19,
                    barColor: '#acd94c',
                    trackColor: '#f2f4f7',
                    scaleColor: false,
                    onStep: function (from, to, percent) {
                        $(this.el).find('.percent').text(Math.round(percent) + '%');
                    }
                });
            }
        },
        // Parallax
        initParallax: function() {
            $(window).stellar();
        },
        // Animation on Scroll
        initAnimation: function () {
            var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
            if (isMobile == false) {
                $('*[data-animation]').addClass('animated');
                $('.animated').waypoint(function (down) {
                    var elem = $(this);
                    var animation = elem.data('animation');
                    if (!elem.hasClass('visible')) {
                        var animationDelay = elem.data('animation-delay');
                        if (animationDelay) {
                            setTimeout(function () {
                                elem.addClass(animation + " visible");
                            }, animationDelay);
                        } else {
                            elem.addClass(animation + " visible");
                        }
                    }
                }, {
                    offset: $.waypoints('viewportHeight')
                    //offset: 'bottom-in-view'
                    //offset: '95%'
                });
            }
        },
        // Google map
        initGoogleMap: function() {
            var map;
            function initialize() {
                var mapOptions = {
                    zoom: 8,
                    center: new google.maps.LatLng(-34.397, 150.644)
                };
                map = new google.maps.Map(document.getElementById('map-canvas'),
                    mapOptions);
            }
            google.maps.event.addDomListener(window, 'load', initialize);
        },
        // Flex Slider
        initFlexSlider: function() {
            $('.flexslider').flexslider({
                animation: "slide",
                controlNav: false
            });
        },
        // Owl Slider Team
        initOwlTeam: function() {
            $("#owl-team").owlCarousel({
                autoPlay: 3000, //Set AutoPlay to 3 seconds
                items : 3,
                itemsDesktop : [1199,3],
                itemsDesktopSmall : [979,3],
                itemsTablet: [768,2],
                itemsMobile: [479,1],
                pagination: false
            });
        }
    };
}();
