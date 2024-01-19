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
            nextButton: '.mje-next-area',
            prevButton: '.mje-prev-area',          
            slidesPerView: 2,
            //centeredSlides: true,
            spaceBetween: 0,    
            //resistance: false,  
            speed:200,
            slidesPerGroup:1,  
            grabCursor: true,                       
            //resistanceRatio: 0.2,
            loop: carousel_settings.loop,
            autoplay:
            {
              enabled: carousel_settings.autoPlay,
              delay: carousel_settings.delay,
              //stopOnLastSlide: carousel_settings.loop,
            },
            freeMode:
            {
              enabled: carousel_settings.freeMode,
              sticky: false,
            },          
            
            breakpoints: {
    
             300: {
                slidesPerView: 1 + carousel_settings.newStyle,
                spaceBetween: 0,
              },
              640: {
                slidesPerView: 2 + carousel_settings.newStyle,
                spaceBetween: 20,
              },
              768: {
                slidesPerView: 2 + carousel_settings.newStyle,
                spaceBetween: 1,
              },
              1024: {
                slidesPerView: 4 + carousel_settings.newStyle,
                spaceBetween: 1.5,
              },
            },
    
          });    

          $(".mje-next-area").click(function(){
            mje_profile_slider.slideNext();
       
           });
       
          $(".mje-prev-area").click(function(){
            mje_profile_slider.slidePrev();
       
           });

         
        
           function toggleNavigationButtons() {

            if(mje_profile_slider.isBeginning)
            {
            
              $(".mje-prev-area").css('display','none');
            }
            else
            {
              $(".mje-prev-area").css('display','flex');
            }

            if (mje_profile_slider.isEnd) 
            {            
              $(".mje-next-area").css('display','none');
            } 
            else 
            {
              $(".mje-next-area").css('display','flex');
            }
          
                  
          }

          mje_profile_slider.on('slideChange', function () { 
            if(carousel_settings.navigationStyle=='both' || carousel_settings.navigationStyle=='classic')           
            {
              toggleNavigationButtons();
            }
            
          });
        
          if(carousel_settings.navigationStyle=='both' || carousel_settings.navigationStyle=='classic')           
          {
              toggleNavigationButtons();
          }

          

    });

})(jQuery);