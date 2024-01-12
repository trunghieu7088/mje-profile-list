<?php
add_action('wp_enqueue_scripts', 'addAssetsFiles',9999);
function addAssetsFiles()
{
    wp_enqueue_script('swiper-slider-js', MJE_PROFILES_LIST_URL.'assets/js/swiper.js', array(), MJE_PROFILES_LIST_VERSION );

    wp_enqueue_script('mje-profile-list-js', MJE_PROFILES_LIST_URL.'assets/js/mje-profile-list.js', array(), MJE_PROFILES_LIST_VERSION);
    
    wp_enqueue_style('swiper-css', MJE_PROFILES_LIST_URL.'assets/css/swiper.css', array(), MJE_PROFILES_LIST_VERSION);

    wp_enqueue_style( 'mje-profile-list-style', MJE_PROFILES_LIST_URL. 'assets/css/mje-profile-list-style.css', array(), MJE_PROFILES_LIST_VERSION ) ;
 

 

}
