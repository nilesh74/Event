/*
 * Title:   Eventus Design - HTML Template
 * Author:  VicThemes
 */

/* --------------------------------------------------------
 [Table of contents]

 1. initMap
 2. minusPlusToCart
 3. showInfoMemBer
 4. countDown
 5. showContentEventFaqs
 6. sliderCascadeSlider
 7. sliderUpcomingEvent
 8. addDotNav
 9. sliderOurTestimonials
 10. showMenuToggle
 11. showChildMenu
 12. galleryLightBox
 13. wowAnimation
 14. sendmailFormValidation
 15. countToNumber

 [End table of contents]
 ----------------------------------------------------------------------- */

function initMap() {
    if ($('.google-map').length) {
        var locations = [
            ['VicThemes One', 48.8610722, 2.352047, 2],
            ['VicThemes Two', 48.8310522, 2.332447, 1]
        ];
        
        var map = new google.maps.Map(document.getElementById('contact-page-google-map'), {
            zoom: 13,
            center: new google.maps.LatLng(48.8610722, 2.352047),
			scrollwheel: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP 
        });
        
        var infowindow = new google.maps.InfoWindow();
        
        var marker, i;
        
        for (i = 0; i < locations.length; i++) {
            var iconPath = new google.maps.MarkerImage('images/map.png');
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map,
                icon: iconPath
            });
            
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }
    };
}
function minusPlusToCart() {
    if($('.box-quantity').length) {
        $('.intput-qty').on('blur', function () {
            var $isInput = $(this);
            if ($isInput.parent().find('.intput-qty').val() === "" || parseInt($isInput.parent().find('.intput-qty').val()) === 0) {
                $isInput.parent().find('.intput-qty').val("1");
            }
        });
        $('.intput-qty').keypress(function (evt) {
            var $button = $(this);
            var charCode = (evt.which) ? evt.which : event.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        });
        $('.btn-plus').on('click', function () {
            var $isPlus = $(this);
            var intValue = $isPlus.parent().find('.intput-qty').val();
            $isPlus.parent().find('.intput-qty').val(parseInt(intValue) + 1);
            return false;
        });
        $('.btn-minus').on('click', function () {
            var $isMinus = $(this);
            var intValue = $isMinus.parent().find('.intput-qty').val();
            if (parseInt(intValue) > 1) {
                $isMinus.parent().find('.intput-qty').val(parseInt(intValue) - 1);
            }
            return false;
        });
    }
}
function showInfoMemBer() {
    if($('#member').length) {
        $('#member li a').on('click', function(){
           $('.img-member-info').attr('src',$(this).attr('data-img')); 
           $(this).parent().siblings('.overlay-active').addClass('uk-overlay-hover uk-animation-hover');
           $(this).parent().removeClass('uk-overlay-hover uk-animation-hover');
        });
        $('#member li').each(function(){
            var hClass = $(this).hasClass('uk-active');
            if(hClass) {
                $(this).removeClass('uk-overlay-hover uk-animation-hover');
            }
        });
    }
}
function countDown() {
    if($('#count_down').length) {
        $('#count_down').countdown({
            date: '08/31/2017 23:59:59',
            offset: -8,
            day: 'Day',
            days: 'Days'
        });
    }
}
function showContentEventFaqs() {
    if($('.event-faqs-content').length) {
        $('.event-faqs-content .box-body').on('click', function() {
           $(this).siblings('.box-body').children('.text-content').slideUp();
           $(this).siblings('.box-body').removeClass('uk-active');
           $(this).children('.text-content').slideDown();
           $(this).addClass('uk-active');
           return false;
        });
    }
}
function sliderCascadeSlider() {
    if($('#cascade-slider').length) {
        $('#cascade-slider').cascadeSlider({
            itemClass: 'cascade-slider_item',
            arrowClass: 'cascade-slider_arrow'
        });
    }
}
function sliderUpcomingEvent() {
    if($('#slider_up_down').length) {
        $('#slider_up_down .slider-up-down .upcoming-up').on('click', function(){
            var up = $(this).parent().siblings('.slider-wrap.uk-active').prev('.slider-wrap');
            $(this).parent().siblings('.slider-wrap.uk-active').removeClass('uk-active');
            if(!up.length) {
                $(this).parent().siblings('.slider-wrap:nth-child(3)').addClass('uk-active');
            }
            else {
                up.addClass('uk-active');
            }
            return false;
        });
        $('#slider_up_down .slider-up-down .upcoming-down').on('click', function(){
            var down = $(this).parent().siblings('.slider-wrap.uk-active').next('.slider-wrap');
            $(this).parent().siblings('.slider-wrap.uk-active').removeClass('uk-active');
            if(!down.length) {
                $(this).parent().siblings('.slider-wrap:nth-child(1)').addClass('uk-active');
            }
            else {
                down.addClass('uk-active');
            }
            return false;
        });
        $('#slider_up_down .slider-wrap').on('click', function(){
            $(this).siblings('.slider-wrap').removeClass('uk-active');
            $(this).addClass('uk-active');
           return false; 
       });
    }
}
function addDotNav() {
    if($('#add_dot_nav').length) {
        for(var i = 0; i < $('#slider_testimonials .uk-slidenav-position ul.uk-slideset li').length; i++) {
            if(i === 0) {
                $('#slider_testimonials ul.add-dotnav').append('<li class="uk-active" data-uk-slideset-item="'+i+'"><a href="#"></a></li>');
            }
            else {
                $('#slider_testimonials ul.add-dotnav').append('<li data-uk-slideset-item="'+i+'"><a href="#"></a></li>');
            }
        }
    }
}
function sliderOurTestimonials() {
    if($('#slider_testimonials').length) {
        $('#slider_testimonials .uk-slidenav-next').on('click', function(){
            var srcOpen = $(this).siblings('ul.uk-slideset').children('li.uk-open').children('.item').children('.box-thumbnai').children('img').attr('src');
            var nextOpen = $(this).siblings('ul.uk-slideset').children('li.uk-open').next('li');
            $(this).siblings('ul.uk-slideset').children('li.uk-open').removeClass('uk-open');
            $(this).siblings('.uk-slidenav-previous').children('.box-thumbnai').children('.box-img').children('img').attr('src', srcOpen);
            if(!nextOpen.length) {
                $(this).siblings('ul.uk-slideset').children('li:first-child').addClass('uk-open');
            }
            else {
                nextOpen.addClass('uk-open');
            }
            var nextSrc = $(this).siblings('ul.uk-slideset').children('li.uk-open').next('li').children('.item').children('.box-thumbnai').children('img');
            if(!nextSrc.length) {
                $(this).children('.box-thumbnai').children('.box-img').children('img').attr('src', $(this).siblings('ul.uk-slideset').children('li:first-child').children('.item').children('.box-thumbnai').children('img').attr('src'));
            }
            else {
                $(this).children('.box-thumbnai').children('.box-img').children('img').attr('src', nextSrc.attr('src'));    
            }
            var dotnavNext = $(this).parent().siblings('ul.add-dotnav').children('li.uk-active').next('li');
            $(this).parent().siblings('ul.add-dotnav').children('li.uk-active').removeClass('uk-active');
            if(!dotnavNext.length) {
                $(this).parent().siblings('ul.add-dotnav').children('li:first-child').addClass('uk-active');
            }
            else {
                dotnavNext.addClass('uk-active');
            }
        });
        $('#slider_testimonials .uk-slidenav-previous').on('click', function(){
            var srcOpen = $(this).siblings('ul.uk-slideset').children('li.uk-open').children('.item').children('.box-thumbnai').children('img').attr('src');
            var prevOpen = $(this).siblings('ul.uk-slideset').children('li.uk-open').prev('li');
            $(this).siblings('ul.uk-slideset').children('li.uk-open').removeClass('uk-open');
            $(this).siblings('.uk-slidenav-next').children('.box-thumbnai').children('.box-img').children('img').attr('src', srcOpen);
            if(!prevOpen.length) {
                $(this).siblings('ul.uk-slideset').children('li:last-child').addClass('uk-open');
            }
            else {
                prevOpen.addClass('uk-open');
            }
            var prevSrc = $(this).siblings('ul.uk-slideset').children('li.uk-open').prev('li').children('.item').children('.box-thumbnai').children('img');
            if(!prevSrc.length) {
                $(this).children('.box-thumbnai').children('.box-img').children('img').attr('src', $(this).siblings('ul.uk-slideset').children('li:last-child').children('.item').children('.box-thumbnai').children('img').attr('src'));
            }
            else {
                $(this).children('.box-thumbnai').children('.box-img').children('img').attr('src', prevSrc.attr('src'));
            }
            var dotnavPrev = $(this).parent().siblings('ul.add-dotnav').children('li.uk-active').prev('li');
            $(this).parent().siblings('ul.add-dotnav').children('li.uk-active').removeClass('uk-active');
            if(!dotnavPrev.length) {
                $(this).parent().siblings('ul.add-dotnav').children('li:last-child').addClass('uk-active');
            }
            else {
                dotnavPrev.addClass('uk-active');
            }
        });
        $('#slider_testimonials .add-dotnav li').on('click', function(){
            $('#slider_testimonials .add-dotnav li').removeClass('uk-active');
            $(this).addClass('uk-active');
            var index = $(this).index() + 1;
            var dotNext = $(this).parent().siblings('.uk-slidenav-position').children('ul.uk-slideset').children('li:nth-child('+index+')').next('li');
            var dotPrev = $(this).parent().siblings('.uk-slidenav-position').children('ul.uk-slideset').children('li:nth-child('+index+')').prev('li');
            $(this).parent().siblings('.uk-slidenav-position').children('.uk-slideset').children('li.uk-open').removeClass('uk-open');
            $(this).parent().siblings('.uk-slidenav-position').children('ul.uk-slideset').children('li:nth-child('+index+')').addClass('uk-open');
            if(!dotNext.length) {
                $(this).parent().siblings('.uk-slidenav-position').children('.uk-slidenav-next').children('.box-thumbnai').children('.box-img').children('img').attr('src', $(this).parent().siblings('.uk-slidenav-position').children('ul.uk-slideset').children('li:first-child').children('.item').children('.box-thumbnai').children('img').attr('src'));
            }
            if(dotNext.length) {
                $(this).parent().siblings('.uk-slidenav-position').children('.uk-slidenav-next').children('.box-thumbnai').children('.box-img').children('img').attr('src', dotNext.children('.item').children('.box-thumbnai').children('img').attr('src'));
            }
            if(!dotPrev.length) {
                $(this).parent().siblings('.uk-slidenav-position').children('.uk-slidenav-previous').children('.box-thumbnai').children('.box-img').children('img').attr('src', $(this).parent().siblings('.uk-slidenav-position').children('ul.uk-slideset').children('li:last-child').children('.item').children('.box-thumbnai').children('img').attr('src'));
            }
            if(dotPrev.length) {
                $(this).parent().siblings('.uk-slidenav-position').children('.uk-slidenav-previous').children('.box-thumbnai').children('.box-img').children('img').attr('src', dotPrev.children('.item').children('.box-thumbnai').children('img').attr('src'));
            }
        });
    }
}
function showMenuToggle() {
    if ($('#menu_primary_toggle').length) {
        $('#menu_primary_toggle').on('click', function () {
            $('.menu-media').toggle(0, 'linear');
            return false;
        });
    }
}
function showChildMenu() {
    if ($('.nav-holder').length) {
        $('.nav-holder li.has-submenu').children('a').append(function () {
            return '<button class="dropdown-expander"><i class="uk-icon-angle-right"></i></button>';
        });
        $('.nav-holder .dropdown-expander').on('click', function () {
            $(this).parent().parent().children('.submenu').slideToggle();
            $(this).find('i').toggleClass('uk-icon-angle-right uk-icon-angle-down');
            $(this).parent('a').parent('li').toggleClass('active');
            return false;
        });
    }
}
function galleryLightBox() {
    if($('#gallery_lightbox').length) {
        $('#gallery_lightbox').lightGallery();
    }
}
function wowAnimation() {
    if($('.wow').length) {
        new WOW().init();
    }
}
function sendmailFormValidation() {
    if ($('#send_mail').length) {
        jQuery.validator.addMethod("phoneUS", function (phone_number, element) {
            phone_number = phone_number.replace(/\s+/g, "");
            return this.optional(element) || phone_number.length > 9 &&
                    phone_number.match(/^(\+?1-?)?(\([2-9]\d{2}\)|[2-9]\d{2})-?[2-9]\d{2}-?\d{4}$/);
        }, "Please specify a valid phone number");
        $('#send_mail').validate({
            rules: {
                name: {
                    required: true
                },
                phone: {
                    required: true,
                    phoneUS: true
                },
                email: {
                    required: true,
                    email: true
                },
                website: {
                    required: true
                },
                comment: {
                    required: true
                }
            },
            submitHandler: function (form) {
                // sending value with ajax request
                $.post($(form).attr('action'), $(form).serialize(), function (response) {
                    $(form).find('.response').append(response).css('display', 'block');
                    $(form).find('input[type="text"]').val('');
                    $(form).find('textarea').val('');
                });
                return false;
            }
        });
    }
}
function countToNumber() {
    if($('.counter').length) {
        $('.counter').counterUp({
            delay: 10,
            time: 1000
        });
    }
}
// instance of fuction while Document ready event
jQuery(document).on('ready', function () {
     "use strict"; // Start of use strict 
      minusPlusToCart();
      showInfoMemBer();
      countDown();
      showContentEventFaqs();
      sliderCascadeSlider();
      sliderUpcomingEvent();
      addDotNav();
      sliderOurTestimonials();
      showMenuToggle();
      showChildMenu();
      galleryLightBox();
      wowAnimation();
      sendmailFormValidation();
      countToNumber();
}); 