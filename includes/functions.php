<?php
require('add-assets-files.php');

add_shortcode('custom_profile_carousel_slider', 'custom_profile_carousel_slider_function');

function custom_profile_carousel_slider_function()
{
    ob_start();    
    ?>
    <div class="container custom-profile-list-wrapper">
        <div class="row">
            <!-- card item -->            
            <div class="col-sm-12 col-md-3 custom-profile-card-item">
                <div class="profile-card-header">
                    <div class="profile-cover-image">
                        <img src="http://mjeprofile.et/wp-content/uploads/2023/12/steamuserimages-a.akamaihd.jpeg">
                    </div>
                </div>
                <div class="profile-card-body">
                    <p class="profile-display-name">
                        Peter Chou
                    </p>
                    <div class="profile-card-rating" data-custom-rate="3"></div>
                    <div class="profile-card-reviewsNum">( 3 reviews )</div>
                    <div class="profile-location-language">
                        <p class="custom-profile-location"><i class="fa fa-map-marker"></i> Vietnam</p>
                        <p><i class="fa fa-globe"></i> English</p>
                    </div>
                    <div class="profile-bio-description">
                    It is a long established fact that a reader will be distracted by the readable content of a page when
                    </div>
                    <div class="custom-profile-view-btn">
                         <a href="#">View Profile</a>
                    </div>
                </div>
            </div>
            <!-- end card item -->

             <!-- card item -->            
             <div class="col-sm-12 col-md-3 custom-profile-card-item">
                <div class="profile-card-header">
                    <div class="profile-cover-image">
                        <img src="http://mjeprofile.et/wp-content/uploads/2023/12/steamuserimages-a.akamaihd.jpeg">
                    </div>
                </div>
                <div class="profile-card-body">
                    <p class="profile-display-name">
                        Peter Chou
                    </p>
                    <div class="profile-card-rating" data-custom-rate="3"></div>
                    <div class="profile-card-reviewsNum">( 3 reviews )</div>
                    <div class="profile-location-language">
                        <p class="custom-profile-location"><i class="fa fa-map-marker"></i> Vietnam</p>
                        <p><i class="fa fa-globe"></i> English</p>
                    </div>
                    <div class="profile-bio-description">
                    It is a long established fact that a reader will be distracted by the readable content of a page when
                    </div>
                    <div class="custom-profile-view-btn">
                         <a href="#">View Profile</a>
                    </div>
                </div>
            </div>
            <!-- end card item -->

             <!-- card item -->            
             <div class="col-sm-12 col-md-3 custom-profile-card-item">
                <div class="profile-card-header">
                    <div class="profile-cover-image">
                        <img src="http://mjeprofile.et/wp-content/uploads/2023/12/steamuserimages-a.akamaihd.jpeg">
                    </div>
                </div>
                <div class="profile-card-body">
                    <p class="profile-display-name">
                        Peter Chou
                    </p>
                    <div class="profile-card-rating" data-custom-rate="3"></div>
                    <div class="profile-card-reviewsNum">( 3 reviews )</div>
                    <div class="profile-location-language">
                        <p class="custom-profile-location"><i class="fa fa-map-marker"></i> Vietnam</p>
                        <p><i class="fa fa-globe"></i> English</p>
                    </div>
                    <div class="profile-bio-description">
                    It is a long established fact that a reader will be distracted by the readable content of a page when
                    </div>
                    <div class="custom-profile-view-btn">
                         <a href="#">View Profile</a>
                    </div>
                </div>
            </div>
            <!-- end card item -->

             <!-- card item -->            
             <div class="col-sm-12 col-md-3 custom-profile-card-item">
                <div class="profile-card-header">
                    <div class="profile-cover-image">
                        <img src="http://mjeprofile.et/wp-content/uploads/2023/12/steamuserimages-a.akamaihd.jpeg">
                    </div>
                </div>
                <div class="profile-card-body">
                    <p class="profile-display-name">
                        Peter Chou
                    </p>
                    <div class="profile-card-rating" data-custom-rate="3"></div>
                    <div class="profile-card-reviewsNum">( 3 reviews )</div>
                    <div class="profile-location-language">
                        <p class="custom-profile-location"><i class="fa fa-map-marker"></i> Vietnam</p>
                        <p><i class="fa fa-globe"></i> English</p>
                    </div>
                    <div class="profile-bio-description">
                    It is a long established fact that a reader will be distracted by the readable content of a page when
                    </div>
                    <div class="custom-profile-view-btn">
                         <a href="#">View Profile</a>
                    </div>
                </div>
            </div>
            <!-- end card item -->

            
        </div>
    </div>
    <?php
     wp_reset_query();
     return ob_get_clean();
}