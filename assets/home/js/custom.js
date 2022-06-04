$(".menubutton").click(function(){
    $(".rightmenu").toggleClass('show');
    $(".foroverlay").toggleClass('foroverlayshow');
    $(this).toggleClass('forBtn');   
  });
  $(".foroverlay").click(function(){
    $(".menubutton").removeClass('forBtn');
    $(".rightmenu").removeClass('show');
    $(this).removeClass('foroverlayshow');
  });

  $(document).ready(function(){
    $('.owl-carousel.owl-carousel1').owlCarousel({
      loop:true,
      margin:10,
      responsiveClass:true,
      responsive:{
        0:{
          items:1,
          nav:true
        },
        600:{
          items:1,
          nav:false
        },
        1000:{
          items:1,
          nav:true,
          loop:false
        }
      } 
    });

    $('.owl-carousel.owl-carousel2').owlCarousel({
      loop:true,
      margin:0,
      responsiveClass:true,
      autoHeight:true,
      responsive:{
        0:{
          items:1,
          nav:true
        },
        600:{
          items:1,
          nav:false
        },
        1000:{
          items:3,
          nav:true,
          loop:false
        }
      } 
    });

    $('.owl-carousel.owl-carousel3').owlCarousel({
        loop:true,
        margin:0,
        responsiveClass:true,
        autoHeight:true,
        responsive:{
          0:{
            items:1,
            nav:true
          },
          600:{
            items:1,
            nav:false
          },
          1000:{
            items:4,
            nav:true,
            loop:false
          }
        } 
      });

    $('.owl-carousel.owl-carouselimages').owlCarousel({
        loop:true,
        margin:0,
        responsiveClass:true,
        dots:true,
        responsive:{
          0:{
            items:1,
            nav:true
          },
          600:{
            items:1,
            nav:false
          },
          1000:{
            items:1,
            nav:true,
            loop:false
          }
        } 
      });
      

      $('.owl-carousel.owl-carousel-products').owlCarousel({
        loop:true,
        margin:0,
        responsiveClass:true,
        autoHeight:true,
        responsive:{
          0:{
            items:1,
            nav:true
          },
          600:{
            items:1,
            nav:false
          },
          1000:{
            items:4,
            nav:true,
            loop:false
          }
        } 
      });

     



    
  });
