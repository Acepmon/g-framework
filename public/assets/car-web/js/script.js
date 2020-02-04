(function ($) {

    function stickyBar(){

        var conWidth = $('.container').width();
        var offset = $('.container').offset();

        $('.fixed-sidebar').css({
            "left": '' + (parseInt(conWidth) + parseInt(offset.left)) + "px",
            "visibility": "visible"
        });

    }
    $(window).resize(stickyBar);
    $(document).ready(stickyBar);

    $('.maz-burger-menu').on('click', function () {
        $(this).toggleClass('extend');
        $(".maz-navbar").toggleClass('extend');

    });

    $('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: (target.offset().top + 10)
                }, 1000, "easeInOutExpo");
                return false;
            }
        }
    });

    $(document).ready(function () {

        var searchBtn = $('.mh-search-input');

        searchBtn.on('click', function () {
            $(this).addClass('expand');
            $(this).find('input').focus();
        });

        $("input.search").on('blur', function () {
            if ($(this).val().length == 0) {
                searchBtn.removeClass('expand');
            }
        });


        var $heroSlider = $('.hero-slider').owlCarousel({
            loop: true,
            margin: 100,
            stagePadding: 30,
            // autoplay: true,
            // autoplaySpeed: 700,
            loop: true,
            nav: false,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: false
                },
                600: {
                    items: 1,
                    nav: false
                },
                1000: {
                    items: 1,
                    loop: false
                }
            }
        });

        $heroSlider.on("changed.owl.carousel", function (e) {
            $(".slider-text").removeClass("animated slideInLeft ");
            $(".slider-img").removeClass("animated slideInLeft ");

            var $currentOwlItem = $(".owl-item").eq(e.item.index);
            $currentOwlItem.find(".slider-text").addClass("animated slideInLeft ");
            $currentOwlItem.find(".slider-img").addClass("animated slideInLeft ");

        });

        $('.card-slide').owlCarousel({
            loop: true,
            margin: 20,
            thumbs: false,
            responsiveClass: true,
            slideTransition: 'ease-in-out',
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                600: {
                    items: 3,
                    nav: false
                },
                1000: {
                    items: 4,
                    nav: true,
                    loop: false
                }
            }
        });
        $('.wish-slide').owlCarousel({
            loop: true,
            margin: 20,
            thumbs: false,
            responsiveClass: true,
            slideTransition: 'ease-in-out',
            navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                600: {
                    items: 3,
                    nav: false
                },
                1000: {
                    items: 3,
                    nav: true,
                    loop: false
                }
            }
        });

        var cardMeta = $(".card-caption > .meta > .show-more");
        var cardInfo = $(".card-img > .info");

        $(document).on('click', '.card-caption > .meta', function (e) {

            var element = e.currentTarget.parentElement.parentElement.parentElement;
            element.classList.add("show");

            $(".card-slide .card").each(function (i, el) {
                if (el != element) {
                    $(el).removeClass("show");
                }
            })

        });
        $(document).on('click', '.card-img > .info', function (e) {

            var element = e.currentTarget.parentElement.parentElement;
            element.classList.remove("show");

        });

        $('.sidebar-slider').owlCarousel({
            loop: true,
            margin: 10,
            thumbs: false,
            nav: false,
            items: 1,
            responsive: {
                0: {
                    items: 1,
                },
                768: {
                    items: 1,
                },
                992: {
                    items: 1,
                }
            }
        });
        $('.banner-slider').owlCarousel({
            loop: true,
            margin: 0,
            autoplay: true,
            autoplaySpeed: 2000,
            thumbs: false,
            nav: false,
            items: 1,
        });
        $('.advantage-slider').owlCarousel({
            loop: false,
            margin: 0,
            autoplay: false,
            // loop: true,
            // autoplaySpeed: 2000,
            thumbs: false,
            autoWidth: true,
            dots: false,
            nav: true,
            rewind:true
        });

        $('.vehicle-imgSlider').owlCarousel({
            autoplay: false,
            autoplayHoverPause: true,
            dots: false,
            nav: true,
            video:true,
            thumbs: true,
            thumbImage: true,
            thumbsPrerendered: true,
            thumbContainerClass: 'owl-thumbs',
            thumbItemClass: 'owl-thumb-item',
            loop: true,
            navText: [
                "<i class='fa fa-chevron-left' aria-hidden='true'></i>",
                "<i class='fa fa-chevron-right' aria-hidden='true'></i>"
            ],
            items: 1,
            responsive: {
                0: {
                    items: 1,
                },
                768: {
                    items: 1,
                },
                992: {
                    items: 1,
                }
            }
        });

        // $("#ex18b").slider({
        //     min: 0,
        //     max: 10,
        //     value: [3, 6],
        //     labelledby: ['ex18-label-2a', 'ex18-label-2b']
        // });


    });

    function isMobile() {
        return /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ? true : false;
    }

    if (isMobile()) {

    } else {
        $(window).on('mousewheel DOMMouseScroll', function (e) {
            if (typeof e.originalEvent.detail == 'number' && e.originalEvent.detail !== 0) {
                if (e.originalEvent.detail > 0) {
                    $('#maz-nav').addClass('hider');
                } else if (e.originalEvent.detail < 0 && $(window).scrollTop() < 0) {
                    $('#maz-nav').addClass('sticky');
                    $('#maz-nav').removeClass('hider');
                } else if ($(window).scrollTop() < 500) {
                    $('#maz-nav').removeClass('sticky');
                }
            } else if (typeof e.originalEvent.wheelDelta == 'number') {
                if (e.originalEvent.wheelDelta < 90) {
                    $('#maz-nav').addClass('hider');
                } else if (e.originalEvent.wheelDelta > 90 && $(window).scrollTop() > $('#maz-nav').innerHeight()) {
                    $('#maz-nav').addClass('sticky');
                    $('#maz-nav').removeClass('hider');
                } else if ($(window).scrollTop() < 200) {
                    $('#maz-nav').removeClass('sticky');
                }
            }
        });
    }

    // Mouse wheel

    if ($(window).scrollTop() == 90) {
        $('#maz-nav').removeClass('sticky');
    }

    $(window).scroll(menuPos);

    function menuPos() {
        var ScrollTop = $(window).scrollTop();

        if (ScrollTop < 40) {
            $('#maz-nav').removeClass('sticky');
        }
    };

    function responsiveNav() {
        var brandOffset = $('.maz-brand').offset().left + $('.maz-brand').width();
        var mazMenuList = $('.maz-menu-list').offset().left;
        var mazMenuDistance = mazMenuList - brandOffset;

        if (mazMenuDistance < 10) {
            $('.header-menu').addClass('is-mobile');
        } if($('.header-menu').hasClass('is-mobile') && $(window).width() > 1200) {
            $('.header-menu').removeClass('is-mobile');
        }
    }

    $(window).resize(responsiveNav);
    $(document).ready(responsiveNav);

    $("input.manufacture").on("change", function () {

        $(".car-filter .models.active").hide();
        var subList = $(".car-filter .models." + $(this).val());
        if (subList.length) {
            $('.car-filter .manufacturer').hide(300);
            subList.show(300);
            $('.models-back').on('click', function () {
                subList.hide(300);
                $('.car-filter .manufacturer').show(300);
            })
        }
    });


})(jQuery)