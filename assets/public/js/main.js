(function ($) {
"use strict";

/*----------------------------
jQuery MeanMenu
------------------------------ */
  jQuery('nav#dropdown').meanmenu();  
/*----------------------------
slide-service
------------------------------ */  
jQuery(".slide-service").owlCarousel({
  autoPlay: true, 
  slideSpeed:3000,
  pagination:false,
  navigation:false,   
  items : 3,
  navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
  itemsDesktop : [1199,2],
  itemsDesktopSmall : [980,2],
  itemsTablet: [768,1],
  itemsMobile : [479,1],
});

/*----------------------------
wow js active
------------------------------ */
  new WOW().init();

/*-------------------------------------
jQuery Search Box customization
-------------------------------------*/
$(".search-box .search-button").on('click', function (event) {
  event.preventDefault();
  var v = $(this).prev('.search-text');
  if (v.hasClass('active')) {
    v.removeClass('active');
  } else {
    v.addClass('active');
  }
  return false;
});

/*---------------------------
nice select js
---------------------------*/    

/*--------------------------
scrollUp
---------------------------- */ 
jQuery.scrollUp({
  scrollText: '<i class="fa fa-angle-up"></i>',
  easingType: 'linear',
  scrollSpeed: 900,
  animation: 'fade'
});   

/*--------------------------
jquery Sticky Header
---------------------------- */
$(window).on('scroll', function(){
  if( $(window).scrollTop()>80 ){
    $('#sticky').addClass('stick');
  } else {
    $('#sticky').removeClass('stick');
  }
}); 

/*----------------------------
jQuery Smoth Scroll 
----------------------------*/
jQuery("#nav").onePageNav({
  scrollOffset:70
});

/*----------------------------
courses-list
------------------------------ */  
jQuery(".courses-list").owlCarousel({
  autoPlay: true, 
  slideSpeed:5000,
  pagination:true,
  navigation:false,   
  items : 3,
  navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
  itemsDesktop : [1199,3],
  itemsDesktopSmall : [980,2],
  itemsTablet: [768,2],
  itemsMobile : [479,1],
});

/*----------------------------
member-list
------------------------------ */  
jQuery(".member-list, .product-list").owlCarousel({
  autoPlay: true, 
  slideSpeed:3000,
  pagination:true,
  navigation:false,   
  items : 4,
  navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
  itemsDesktop : [1199,4],
  itemsDesktopSmall : [980,2],
  itemsTablet: [768,2],
  itemsMobile : [479,1],
});

/*----------------------------
testominial-slide
------------------------------ */  
jQuery(".testominial-slide").owlCarousel({
autoPlay: true, 
slideSpeed:3000,
pagination:true,
navigation:false,   
items : 1,
navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
itemsDesktop : [1199,1],
itemsDesktopSmall : [980,1],
itemsTablet: [768,1],
itemsMobile : [479,1],
});

/*----------------------------
slide-blog
------------------------------ */  
jQuery(".slide-blog, .service-slide").owlCarousel({
  autoPlay: true, 
  slideSpeed:3000,
  pagination:false,
  navigation:false,   
  items : 3,
  navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
  itemsDesktop : [1199,3],
  itemsDesktopSmall : [980,2],
  itemsTablet: [768,2],
  itemsMobile : [479,1],
});

/*----------------------------
singlemember-slide
------------------------------ */  
jQuery(".singlemember-slide, .productlist, .tainer-list").owlCarousel({
  autoPlay: true, 
  slideSpeed:3000,
  pagination:false,
  navigation:true,    
  items : 4,
  navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
  itemsDesktop : [1199,4],
  itemsDesktopSmall : [980,3],
  itemsTablet: [768,2],
  itemsMobile : [479,1],
});

/*----------------------------
single reserch slide-fedback
------------------------------ */  
jQuery(".slide-fedback, .fedback-slide").owlCarousel({
  autoPlay: true, 
  slideSpeed:3000,
  pagination:false,
  navigation:false,   
  items : 1,
  navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
  itemsDesktop : [1199,1],
  itemsDesktopSmall : [980,1],
  itemsTablet: [768,1],
  itemsMobile : [479,1],
});

/*-------------------------
home two courses slide 
---------------------------*/
jQuery(".chourses-list").owlCarousel({
  autoPlay: true, 
  slideSpeed:3000,
  pagination:false,
  navigation:true,   
  items : 3,
  navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
  itemsDesktop : [1199,3],
  itemsDesktopSmall : [980,2],
  itemsTablet: [768,2],
  itemsMobile : [479,1],
});

/*-------------------------
home two shop-list slide
---------------------------*/
jQuery(".shop-list").owlCarousel({
  autoPlay: true, 
  slideSpeed:3000,
  pagination:false,
  navigation:false,   
  items : 4,
  navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
  itemsDesktop : [1199,4],
  itemsDesktopSmall : [980,2],
  itemsTablet: [768,2],
  itemsMobile : [479,1],
});

/*-------------------------
home two clint-testomonial slide
---------------------------*/
jQuery(".clint-slide").owlCarousel({
  autoPlay: true, 
  slideSpeed:3000,
  pagination:false,
  navigation:true,   
  items : 1,
  navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
  itemsDesktop : [1199,1],
  itemsDesktopSmall : [980,1],
  itemsTablet: [768,1],
  itemsMobile : [479,1],
});

/*-------------------------
courses 4 slide 
---------------------------*/
$(".reletate-list, .chourses-lists").owlCarousel({
  autoPlay: true, 
  slideSpeed:5000,
  pagination:false,
  navigation:true,   
  items : 2,
  navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
  itemsDesktop : [1199,1],
  itemsDesktopSmall : [980,1],
  itemsTablet: [768,1],
  itemsMobile : [479,1],
});

/*-------------------------
 isotope js
---------------------------*/
jQuery(".gallary-menu li").on('click',function(){
  jQuery(".gallary-menu li").removeClass("active");
    jQuery(this).addClass("active")
  });

  $(".gallary-menu li").on('click',function(){
    var selector = $(this).attr('data-filter');
    $('.filter-gallary').isotope({
    filter:selector
  });
  });

  jQuery(window).load(function(){
    jQuery(".filter-gallary").isotope();
});
/*================================
              ============ Lightcase =============
              =================================*/
              var lightcase =$('a[data-rel^=lightcase]');
              jQuery(document).ready(function($) {
              lightcase.lightcase();
            });

/*---------------------
Input Number Incrementer
--------------------- */
$(".input-number").append('<div class="inc button">+</div><div class="dec button">-</div>');
$(".button").on("click", function() {
  var $button = $(this);
  var oldValue = $button.parent().find("input").val();
  if ($button.text() == "+") {
  var newVal = parseFloat(oldValue) + 1;
  } else {
  // Don't allow decrementing below zero
  if (oldValue > 0) {
  var newVal = parseFloat(oldValue) - 1;
  } else {
  newVal = 0;
  }
  }
  $button.parent().find("input").val(newVal);
});

/*---------------------------
slider range
-----------------------------*/
$( function() {
  $( "#slider-range" ).slider({
    range: true,
    min: 0,
    max: 500,
    values: [ 75, 300 ],
    slide: function( event, ui ) {
      $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
    }
  });
  $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
    " - $" + $( "#slider-range" ).slider( "values", 1 ) );
} );

/*-------------------------
home two counterup
---------------------------*/
$(".counter").counterUp({
  delay: 10,
  time: 3000
}); 

/*-----------------------
magnificPopup
-------------------------*/
/*
$('.test-popup-link').magnificPopup({
  type: 'image'
});*/

/*-------------------------------------
Single Product Slide
---------------------------------------*/
/*$('.bxslider').bxSlider({
  pagerCustom: '#bx-pager'
});*/

})(jQuery); 