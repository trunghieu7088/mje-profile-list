<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'mje_profiles_list_settings',999,0 );

function mje_profiles_list_settings()
{
    
    Container::make( 'theme_options', __( 'MJE Profiles list Settings', 'crb' ) )
    ->set_icon( 'dashicons-admin-generic')
    ->set_page_menu_title( 'MJE Profile List Settings' )
    ->set_page_menu_position(4)
  ->add_tab( __( 'General' ), array(
   Field::make( 'text', 'mje_profile_number_of_profiles', __( 'Number of profiles to show' ) )->set_default_value(10)->set_width(30),
   Field::make( 'select', 'mje_profile_sort_by', __( 'Sort by' ) )->set_options(array('createdDate'=>'Created date','highrating'=>'High Rating'))->set_width(30),        
   Field::make( 'select', 'mje_profile_order', __( 'Order' ) )->set_options(array('asc'=>'Asc','desc'=>'Desc'))->set_width(30),        
    Field::make( 'radio', 'mje_profile_autoplay', __( 'Sider Autoplay' ) )
    ->set_options( array(
      'true' => 'yes',
      'false' => 'no',
      
    ) )->set_width(20),
    Field::make( 'text', 'mje_profile_delay_autoplay', __( 'Slider Autoplay delay time' ) )->set_default_value(1000)->set_width(20),
    
    Field::make( 'radio', 'mje_profile_loop', __( 'Slider Loop' ) )
    ->set_options( array(
      'true' => 'yes',
      'false' => 'no',
      
    ) )->set_width(20),
    Field::make( 'select', 'mje_profile_carousel_navigation_style', __( 'Slider Navigation Style' ) )->set_options(array('classic'=>'Button Navigation','newstyle'=>'New Style'))->set_width(20),              

    Field::make( 'html', 'display_shortcode_mje_profile', __( 'Shortcode' ) )
	->set_html('<p> <strong> Shortcode </strong> </p>[custom_profile_carousel_slider]'),


    )) 
  ->add_tab( __( 'Replacing text' ), array(
    Field::make( 'text', 'mje_profile_list_title', __( 'Title of list' ) )->set_default_value('Newest Profiles'),      
    Field::make( 'text', 'mje_profile_null_profile_description', __( 'Empty profile description' ) )->set_default_value('This is the description of prorfile but the user did not enter the description'),    
    Field::make( 'text', 'mje_profile_service_text', __( 'Services' ) )->set_default_value('Services'),    
    Field::make( 'text', 'mje_profile_review_text', __( 'Reviews' ) )->set_default_value('Reviews'),    
    Field::make( 'text', 'mje_profile_null_country', __( 'None ( Text for empty country )' ) )->set_default_value('None'),    
    Field::make( 'text', 'mje_profile_null_language', __( 'None ( Text for empty language )' ) )->set_default_value('None'),    
    Field::make( 'text', 'mje_profile_view_profile_button', __( 'View Profile' ) )->set_default_value('View Profile'),          
       )) 
  ->add_tab( __( 'Style' ), array(    
    Field::make( 'color', 'mje_profile_slide_wrappger_bg_color', 'Container Background Color' )->set_default_value('#ffffff'),  
    Field::make( 'color', 'mje_profile_slide_item_header_color', 'Slide Item Header color' )->set_default_value('#10A2F6')->set_width(50),  
    Field::make( 'color', 'mje_profile_rate_star_color', 'Rating Star Color' )->set_default_value('#10a2ef')->set_width(50),  
    Field::make( 'color', 'mje_profile_slide_view_profile_bg_color', 'View Profile Button Background Color' )->set_default_value('#10A2F6')->set_width(50),  
    Field::make( 'color', 'mje_profile_slide_view_profile_text_color', 'View Profile Button Text Color' )->set_default_value('#ffffff')->set_width(50),  


       ))       

  ;
}
//add tab for change color option , change text...