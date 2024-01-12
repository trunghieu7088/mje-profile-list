(function ($) {
    $(document).ready(function () {
                      
        $('.profile-card-rating').each(function() {
            $('.profile-card-rating').raty({
                readOnly: true,
                half: true,
                score: function () {
                    return $(this).attr('data-custom-rate');
                },                
            });
        });

        

        var mje_profile_slider = new Swiper(".listprofileSwiper", {  
            nextButton: '#mje_profile_next_slide',
          prevButton: '#mje_profile_previous_slide',          
            slidesPerView: 2,
            //centeredSlides: true,
            spaceBetween: 0,    
            //resistance: false,  
            speed:200,
            slidesPerGroup:1,                         
            //resistanceRatio: 0.2,
            loop: carousel_settings.loop,
            autoplay:
            {
              enabled: carousel_settings.autoPlay,
              delay: carousel_settings.delay,
              //stopOnLastSlide: carousel_settings.loop,
            },
            freemode:
            {
              enabled: true,
              sticky: true,
            },          
            
            breakpoints: {
    
             300: {
                slidesPerView: 1.1,
                spaceBetween: 0,
              },
              640: {
                slidesPerView: 2.1,
                spaceBetween: 20,
              },
              768: {
                slidesPerView: 2.1,
                spaceBetween: 1,
              },
              1024: {
                slidesPerView: 4,
                spaceBetween: 1,
              },
            },
    
          });    

          $("#mje_profile_next_slide").click(function(){
            mje_profile_slider.slideNext();
       
           });
       
          $("#mje_profile_previous_slide").click(function(){
            mje_profile_slider.slidePrev();
       
           });
        

    });

})(jQuery);