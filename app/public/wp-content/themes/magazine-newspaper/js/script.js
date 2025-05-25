 jQuery(function($) { // DOM is now read and ready to be manipulated
  
    //Tab to top
    $(window).scroll(function() {
    if ($(this).scrollTop() > 1){  
        $('.scroll-top-wrapper').addClass("show");
    }
    else{
        $('.scroll-top-wrapper').removeClass("show");
    }
});
    $(".scroll-top-wrapper").on("click", function() {
     $("html, body").animate({ scrollTop: 0 }, 600);
    return false;
});










$(function() {
  $('#example').vTicker();
});





// $('#myCarousel').carousel({
//     interval: 4000
// });

// handles the carousel thumbnails
// $('[id^=carousel-selector-]').click( function(){
//   var id_selector = $(this).attr("id");
//   var id = id_selector.substr(id_selector.length -1);
//   id = parseInt(id);
//   $('#myCarousel').carousel(id);
//   $('[id^=carousel-selector-]').removeClass('selected');
//   $(this).addClass('selected');
// });

// when the carousel slides, auto update
// $('#myCarousel').on('slid', function (e) {
//   var id = $('.item.active').data('slide-number');
//   id = parseInt(id);
//   $('[id^=carousel-selector-]').removeClass('selected');
//   $('[id=carousel-selector-'+id+']').addClass('selected');
// });




 $('.dropdown').hover(function() {
      $(this).find('.dropdown-menu').first().stop(true, true).slideDown(150);
    }, function() {
      $(this).find('.dropdown-menu').first().stop(true, true).slideUp(150)
    });

var count=0;
$('.dropdown .caret').on('click',function(e){
    e.preventDefault();
  if (count===0){
    $(this).closest( "li" ).find('.dropdown-menu').first().stop(true, true).slideDown(150);
    count++;
  }
  else
  {
    $(this).closest( "li" ).find('.dropdown-menu').first().stop(true, true).slideUp(150);
    count=0;
  }

 });



$(window).scroll(function() {    
    var scroll = $(window).scrollTop();

    if (scroll >= 150) {
        $(".sticky-header").addClass("fix-top");
    } else {
        $(".sticky-header").removeClass("fix-top");
    }
});



$('#owl-topnews').owlCarousel({
      loop:true,
      margin:30,
      nav:true,
      dots:true,
      autoplay:true,
      autoplayTimeout:2000,
      autoplayHoverPause:true,
      responsive:{
          0:{
              items:1
          },
          640:{
              items:2
          },
          768:{
              items:3
          }
      }
  })



$('#owl-prom-slider').owlCarousel({
      loop:true,
      margin:30,
      nav:false,
      dots:false,
      autoplay:true,
      autoplayTimeout:4000,
      autoplayHoverPause:false,
      responsive:{
        0:{
            items:1
        }
      }
  })



$('#owl-slider').owlCarousel({
      loop:true,
      margin:1,
      nav:false,
      dots:true,
      autoplay:true,
      autoplayTimeout:4000,
      autoplayHoverPause:true,
      responsive:{
          0:{
              items:1
          },
          640:{
              items:2
          },
          768:{
              items:3
          }
      }
  })

$('#owl-slider-one').owlCarousel({
      loop:true,
      margin:0,
      nav:false,
      dots:true,
      autoplay:true,
      autoplayTimeout:4000,
      autoplayHoverPause:true,
      responsive:{
          0:{
              items:1
          },
          600:{
              items:1
          },
          1000:{
              items:1
          }
      }
  })

$('#owl-crewmembers').owlCarousel({
      loop:false,
      margin:15,
      nav:true,
      dots:true,
      autoplay:true,
      autoplayTimeout:2000,
      autoplayHoverPause:true,
      responsive:{
          0:{
              items:1
          },
          600:{
              items:3
          },
          1000:{
              items:4
          }
      }
  })







var wow = new WOW(
  {
    boxClass:     'wowload',      // animated element css class (default is wow)
    animateClass: 'animated', // animation css class (default is animated)
    offset:       0,          // distance to the element when triggering the animation (default is 0)
    mobile:       true,       // trigger animations on mobile devices (default is true)
    live:         true        // act on asynchronously loaded content (default is true)
  }
);
wow.init();


equalheight = function(container){

var currentTallest = 0,
     currentRowStart = 0,
     rowDivs = new Array(),
     $el,
     topPosition = 0;
 $(container).each(function() {

   $el = $(this);
   $($el).height('auto')
   topPostion = $el.position().top;

   if (currentRowStart != topPostion) {
     for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
       rowDivs[currentDiv].height(currentTallest);
     }
     rowDivs.length = 0; // empty the array
     currentRowStart = topPostion;
     currentTallest = $el.height();
     rowDivs.push($el);
   } else {
     rowDivs.push($el);
     currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
  }
   for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
     rowDivs[currentDiv].height(currentTallest);
   }
 });
}

$(window).load(function() {
  equalheight('.eq-blocks');
});


$(window).resize(function(){
  equalheight('.eq-blocks');
});

});
