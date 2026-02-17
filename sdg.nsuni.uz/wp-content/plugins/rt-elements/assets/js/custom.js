/**
 *
 * --------------------------------------------------------------------
 *
 * Template : Custom Js Template
 * Author : reacthemes
 * Author URI : http://www.reactheme.com/
 *
 * --------------------------------------------------------------------
 *
 **/ 
(function ($) {
    "use strict";

    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    
    // Cart show & hide
    $(document).on('click', '.menu-cart-area', function () {
        $(".cart-icon-total-products").addClass("visible-cart");
        $(".body-overlay-cart").addClass("overlayshow");
    });
    $(document).on('click', '.body-overlay-cart', function () {
        $(this).removeClass("overlayshow");
        $(".cart-icon-total-products").removeClass("visible-cart");
    });

    $(document).on('click', '.close-cart', function () {
        $(".cart-icon-total-products").removeClass("visible-cart");
        $(".body-overlay-cart").removeClass("overlayshow");
    }); 
    
   
    $(document).on('click', '.translate__lang a', function(e) {
        e.preventDefault(); 
        var selectedLanguage = $(this).text();
        $(".selected__lang").text(selectedLanguage);
    });
    $(document).on('click', '#langSwitcher', function () {
        $(".translate__lang").toggleClass("show");
    });
    $(document).on('click', function (e) {
        if (!$(e.target).closest('#langSwitcher').length) {
            $(".translate__lang").removeClass("show");
        }
    });

    $(document).on('click', function (e) {
        $(".jarallax").jarallax();
    });

    document.addEventListener("DOMContentLoaded", function() {
        const circleText = document.querySelector('.circle-text');
        if (circleText) {
            const textSpans = circleText.querySelectorAll('span');
            let rotation = 0;
            const rotationStep = 360 / textSpans.length;
    
            textSpans.forEach((span, index) => {
                span.style.transform = `rotate(${rotation}deg) translateX(150px)`;
                rotation += rotationStep;
            });
        }
    });

   
    
})(jQuery);