(function ($) {
    $(document).ready(function () {
        console.log('dsff');
              
        $('.profile-card-rating').each(function() {
            $('.profile-card-rating').raty({
                readOnly: true,
                half: true,
                score: function () {
                    return $(this).attr('data-custom-rate');
                },                
            });
        });
           

    });

})(jQuery);