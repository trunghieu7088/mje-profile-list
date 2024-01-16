<?php
require('add-assets-files.php');

add_shortcode('custom_profile_carousel_slider', 'custom_profile_carousel_slider_function');

function custom_profile_carousel_slider_function()
{
    ob_start();    
    $mje_profile_list=get_profiles_by_custom_conditions();    
    $mjeprofile_settings=get_mjeprofile_settings();
    ?>
    <div class="mje-list-top-wrapper">
    <div class="container custom-profile-list-wrapper">
        <h2 class="custom-profile-title"><?php echo $mjeprofile_settings['slider_title']; ?></h2>
        <div class="row swiper listprofileSwiper">
            <div class="swiper-wrapper">
            <?php if($mje_profile_list) : ?>
                <?php  foreach( $mje_profile_list as $mje_profile): ?>                 
                    <div class="col-sm-12 col-md-3 custom-profile-card-item swiper-slide">

                        <div class="profile-card-header">
                            <div class="profile-cover-image">
                             <img src="<?php echo $mje_profile->avatar; ?>">
                            </div>
                        </div>

                        <div class="profile-card-body">
                            <p class="profile-display-name">
                                <?php echo $mje_profile->display_name; ?>
                            </p>                            
                            <div class="profile-card-rating" data-custom-rate="<?php echo $mje_profile->rating_score ?>"></div>
                            <div class="profile-card-reviewsNum"> <?php echo $mje_profile->review_text; ?> </div>
                            <div class="profile-location-language">
                                <p class="custom-profile-location"><i class="fa fa-map-marker"></i>  <?php echo $mje_profile->country; ?></p>
                                <p><i class="fa fa-globe"></i> <?php echo $mje_profile->language; ?></p>
                            </div>
                            <div class="profile-bio-description">
                                <?php echo $mje_profile->bio; ?>
                            </div>
                            <div class="custom-profile-view-btn">
                                <a href=" <?php echo $mje_profile->profile_link; ?>"><?php echo $mje_profile->profile_button_label; ?></a>
                            </div>
                        </div>

                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

         <!--   <img src="<?php echo MJE_PROFILES_LIST_URL.'assets/img/previous.png';  ?>" class="mje-profile-previous-icon" name="mje_profile_previous_slide" id="mje_profile_previous_slide">
        
        <img src="<?php echo MJE_PROFILES_LIST_URL.'assets/img/next.png';  ?>" class="mje-profile-next-icon" name="mje_profile_next_slide" id="mje_profile_next_slide"> -->

        <div class="mje-next-area">
             <i class="fa fa-chevron-right"></i>
        </div>

        <div class="mje-prev-area">
             <i class="fa fa-chevron-left"></i>
        </div>

        </div>

   
        

        </div>
    </div>
    <?php
     wp_reset_query();
     return ob_get_clean();
}

add_action( 'after_setup_theme', 'mje_profiles_list_crb_load',999,0 );
function mje_profiles_list_crb_load() {    
    if ( ! function_exists( 'carbon_get_post_meta' ) ) {
    require_once MJE_PROFILES_LIST_PATH . '/includes/carbon/vendor/autoload.php';
    \Carbon_Fields\Carbon_Fields::boot();
    }
}

function get_profiles_by_custom_conditions()
{
    global $post;
    $mjeprofile_settings=get_mjeprofile_settings();
    
    $number_of_profiles=$mjeprofile_settings['number_profiles'];
    
    $sort_by=$mjeprofile_settings['sort_by'];
    
    $order=$mjeprofile_settings['order'];


    
    $args=array('post_type' => 'mjob_profile',
                'posts_per_page' =>  $number_of_profiles,   
                'order'=> 'DESC',
                'orderby'=> 'date',                 
                );
    $query = new WP_Query($args);
    $mje_profile_list=array();
    if ($query->have_posts()) 
    {
        while($query->have_posts())
        {
            $query->the_post();
            $converted_profile=convert_profile_for_display($post);
            $mje_profile_list[]=$converted_profile;
        }        
    }
    wp_reset_postdata();     
    if($sort_by=='highrating')
    {
        if($order=='asc')
        {
            usort($mje_profile_list,'compareRatingScoreASC');
        }
        if($order=='desc')
        {
            usort($mje_profile_list,'compareRatingScoreDESC');
        }
        
    }
    if($sort_by=='nummjob')    
    {
        if($order=='asc')
        {
            usort($mje_profile_list,'compareNumberMjobASC');
        }
        if($order=='desc')
        {
            usort($mje_profile_list,'compareNumberMjobDESC');
        }
       
    }
    return $mje_profile_list;
}

function convert_profile_for_display($profile)
{    
    $mjeprofile_settings=get_mjeprofile_settings();
    $profile_owner=get_userdata($profile->post_author);

    $avatar = get_user_meta($profile->post_author, 'et_avatar_url', true);
    if (!$avatar)
    {
        $default_avatar = ae_get_option('default_avatar', '');   
        if($default_avatar)          
        {
            $avatar = $default_avatar['thumbnail'][0];  
        }
        
    }
    
    if (!$avatar)
    {
        $avatar = 'https://0.gravatar.com/avatar/6cf99d904a8800a571681d5eb9618d99?s=35&d=mm&r=G';
    }    
    $converted_profile['avatar']=$avatar;
    
    $converted_profile['display_name']=$profile_owner->display_name;
    
    $bio_description=get_post_meta($profile->ID,'profile_description',true);
    if(!$bio_description)
    {   
        $bio_description=carbon_get_theme_option('mje_profile_null_profile_description');
    }
    $bio_description=wp_trim_words($bio_description,18,'..');

    $rating_score=mje_get_total_reviews_by_user($profile->post_author);
    if(!$rating_score)
    {
        $rating_score=0;
    }

    $country_term=get_the_terms($profile->ID,'country');
    if($country_term && !is_wp_error($country_term))
    {
        $country_term_text=$country_term[0]->name;
    }
    else
    {
        $country_term_text=$mjeprofile_settings['null_country'];
    }

    $language_term=get_the_terms($profile->ID,'language');
    if($language_term && !is_wp_error($language_term))
    {
        $language_term_text=$language_term[0]->name;
    }
    else
    {
        $language_term_text=$mjeprofile_settings['null_language'];
    }

    $profile_link=get_author_posts_url($profile->post_author);
    
    $number_of_reiews=get_all_reviews_of_seller($profile->post_author);
    //convert data
    $converted_profile['rating_score']=$rating_score;
    $converted_profile['review_text']=$number_of_reiews['all_mjobs_count'].' '.$mjeprofile_settings['service_text'].' | '.$number_of_reiews['all_reviews_count'].' '.$mjeprofile_settings['review_text'];
    $converted_profile['bio']=$bio_description;
    $converted_profile['country']=  $country_term_text;
    $converted_profile['language']=$language_term_text;
    $converted_profile['profile_link']=$profile_link;
    $converted_profile['profile_button_label']=$mjeprofile_settings['view_profile_text'];
    $converted_profile['number_of_mjobs']=$number_of_reiews['all_mjobs_count'];

    return (object)$converted_profile;
    
}

function get_all_reviews_of_seller($seller_id)
{
    global $post;
    $args=array('post_type' => 'mjob_post',
        'posts_per_page' => -1,
        'author' =>$seller_id,
        'order'=> 'DESC',
        'orderby'=> 'date',                         
        );
    $query = new WP_Query($args);
    $all_reviews_count=0;
    $all_mjobs_count=0;
    if ($query->have_posts()) 
    {
        while($query->have_posts())
        {
            $query->the_post();
            $args_comment=array('post_id'=>$post->ID, 'count'=>true);
            $comment_counts=get_comments($args_comment);
            $all_reviews_count+=$comment_counts;
            $all_mjobs_count+=1;
        }        
    }
    wp_reset_postdata();     
    $all_info=array('all_reviews_count'=> $all_reviews_count,'all_mjobs_count'=>$all_mjobs_count);
    return $all_info;
}

function get_mjeprofile_settings()
{
    $mjeprofile_settings=array(                 
                   
                   
                    //color                    
                    'slide_header_color' =>carbon_get_theme_option('mje_profile_slide_item_header_color'),
                    'viewprofile_btn_bg_color' =>carbon_get_theme_option('mje_profile_slide_view_profile_bg_color'),
                    'viewprofile_btn_text_color' =>carbon_get_theme_option('mje_profile_slide_view_profile_text_color'),
                    'rating_star_color' =>carbon_get_theme_option('mje_profile_rate_star_color'),
                    'container_slider_bg_color' =>carbon_get_theme_option('mje_profile_slide_wrappger_bg_color'),
                    'navigation_bg_color' =>carbon_get_theme_option('mje_profile_slide_navigation_bg_color'),
                    'navigation_text_color' =>carbon_get_theme_option('mje_profile_slide_navigation_text_color'),
                    'navigation_opacity' =>carbon_get_theme_option('mje_profile_slide_navigation_opacity') ,
                   
                    //translation
                    'slider_title'=>carbon_get_theme_option('mje_profile_list_title'),
                    'null_profile_bio'=>carbon_get_theme_option('mje_profile_null_profile_description'),
                    'service_text'=>carbon_get_theme_option('mje_profile_service_text'),
                    'review_text'=>carbon_get_theme_option('mje_profile_review_text'),
                    'null_country'=>carbon_get_theme_option('mje_profile_null_country'),
                    'null_language'=>carbon_get_theme_option('mje_profile_null_language'),
                    'view_profile_text'=>carbon_get_theme_option('mje_profile_view_profile_button'),

                    //profile conditions
                    'number_profiles'=>carbon_get_theme_option('mje_profile_number_of_profiles'),
                    'sort_by'=>carbon_get_theme_option('mje_profile_sort_by'),
                    'order'=>carbon_get_theme_option('mje_profile_order'),

                    //carousel settings
                    'carousel_autoplay'=> carbon_get_theme_option('mje_profile_autoplay') ? carbon_get_theme_option('mje_profile_autoplay') : 'true',
                    'carousel_delay'=>carbon_get_theme_option('mje_profile_delay_autoplay') ? carbon_get_theme_option('mje_profile_delay_autoplay') : 1000,
                    'carousel_loop'=>carbon_get_theme_option('mje_profile_loop') ? carbon_get_theme_option('mje_profile_loop') : 'true' ,
                    'carousel_navigation_style' =>carbon_get_theme_option('mje_profile_carousel_navigation_style') ? carbon_get_theme_option('mje_profile_carousel_navigation_style') : 'classic',
                    'freeMode' =>carbon_get_theme_option('mje_profile_carousel_freemode') ? carbon_get_theme_option('mje_profile_carousel_freemode') : 'true',
                    
                    
                    );

    return $mjeprofile_settings;
}

add_action('wp_head','mje_profile_carousel_set_color_by_settings',999,0);

function mje_profile_carousel_set_color_by_settings()
{
    $color_settings=get_mjeprofile_settings();   
    ?>
    <style>     
        .mje-list-top-wrapper
        {
            
            background-color: <?php echo $color_settings['container_slider_bg_color'] ;?> !important;
        }
        .profile-card-header 
        {
            background-color: <?php echo $color_settings['slide_header_color'] ;?> !important;
        }
        .custom-profile-view-btn
        {
            background-color: <?php echo $color_settings['viewprofile_btn_bg_color'] ;?> !important;
          
        }
        .custom-profile-view-btn a
        {
            color: <?php echo $color_settings['viewprofile_btn_text_color'] ;?> !important;
        }
        .fa-star
        {
            color: <?php echo $color_settings['rating_star_color'] ;?> !important;
        }
        .mje-next-area, .mje-prev-area
        {            
            background-color: <?php echo $color_settings['navigation_bg_color'] ;?> !important;
            opacity:  <?php echo $color_settings['navigation_opacity'] ;?> !important;
        }
        .mje-next-area i, .mje-prev-area i
        {
            color: <?php echo $color_settings['navigation_text_color'] ;?> !important; 
        }
    </style>
    <?php
}

add_action('wp_head','mje_profile_carousel_settings',999,0);

function mje_profile_carousel_settings()
{
    $mjeprofile_settings=get_mjeprofile_settings();
    if($mjeprofile_settings['carousel_navigation_style']=='classic' || $mjeprofile_settings['carousel_navigation_style']=='both')
    {
        $navigation_button='visible';
    }
    else
    {
        $navigation_button='hidden';
    }
    if($mjeprofile_settings['carousel_navigation_style']=='newstyle' || $mjeprofile_settings['carousel_navigation_style']=='both')
    {
        $navigation_slide_newstyle=0.2;
    }
    else
    {
        $navigation_slide_newstyle=0;
    }
    ?>
    <style>
    .mje-next-area, .mje-prev-area
    {
        visibility: <?php echo $navigation_button; ?> !important; 
    }
    </style>
    <script type="text/javascript">
            var carousel_settings={ autoPlay: <?php echo $mjeprofile_settings['carousel_autoplay']; ?>,
                                    delay: <?php echo $mjeprofile_settings['carousel_delay']; ?>, 
                                    loop: <?php echo $mjeprofile_settings['carousel_loop']; ?>, 
                                    navigationStyle: '<?php echo $mjeprofile_settings['carousel_navigation_style']; ?>', 
                                    newStyle: <?php echo $navigation_slide_newstyle; ?>,
                                    freeMode: <?php echo $mjeprofile_settings['freeMode']; ?>, 
                                    
                                    };
            console.log(carousel_settings);   
    </script>
    <?php
}

function compareRatingScoreASC($item1,$item2)
{
    return $item1->rating_score - $item2->rating_score;
   
}

function compareRatingScoreDESC($item1,$item2)
{
    return $item2->rating_score - $item1->rating_score;
   
}

function compareNumberMjobASC($item1,$item2)
{
    return $item1->number_of_mjobs - $item2->number_of_mjobs;
}

function compareNumberMjobDESC($item1,$item2)
{
    return $item2->number_of_mjobs - $item1->number_of_mjobs;
}

