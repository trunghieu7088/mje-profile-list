<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'mje_profiles_list_settings',999,0 );

function mje_profiles_list_settings()
{
    
    Container::make( 'theme_options', __( 'MJE Profiles list Settings', 'crb' ) )     
    ->set_icon( 'dashicons-admin-generic')
    ->set_page_menu_title( 'MJE Profile List Settings' )    
    ->set_page_menu_position(6)    
  ->add_tab('General', array(
   Field::make( 'text', 'mje_profile_number_of_profiles', __( 'Number of profiles to show' ) )->set_default_value(10)->set_width(30),
   Field::make( 'select', 'mje_profile_sort_by', __( 'Sort by' ) )->set_options(array('createdDate'=>'Created date','highrating'=>'High Rating','nummjob'=>'Number of Mjob'))->set_width(30),        
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
    Field::make( 'select', 'mje_profile_carousel_navigation_style', __( 'Slider Navigation Style' ) )->set_options(array('classic'=>'Button Navigation','newstyle'=>'New Style','both'=>'Both'))->set_width(20),              

    Field::make( 'radio', 'mje_profile_carousel_freemode', __( 'Fast mode' ) )->set_options(array('true'=>'Yes','false'=>'No'))->set_width(20),              
    Field::make( 'html', 'display_shortcode_mje_profile', __( 'Shortcode' ) )->set_html('<p> <strong> Shortcode </strong> </p>[custom_profile_carousel_slider]'),
    Field::make( 'html', 'display_button_submit_0', __( 'Shortcode' ) )->set_html('<input type="submit" value="Save Changes" name="publish" id="publish" class="button button-primary button-large">'),
    )) 
  ->add_tab( 'Replacing text', array(
    Field::make( 'text', 'mje_profile_list_title', __( 'Title of list' ) )->set_default_value('Latest Profiles'),      
    Field::make( 'text', 'mje_profile_null_profile_description', __( 'Empty profile description' ) )->set_default_value('This is the description of prorfile but the user did not enter the description'),    
    Field::make( 'text', 'mje_profile_service_text', __( 'Services' ) )->set_default_value('Services'),    
    Field::make( 'text', 'mje_profile_review_text', __( 'Reviews' ) )->set_default_value('Reviews'),    
    Field::make( 'text', 'mje_profile_null_country', __( 'None ( Text for empty country )' ) )->set_default_value('None'),    
    Field::make( 'text', 'mje_profile_null_language', __( 'None ( Text for empty language )' ) )->set_default_value('None'),    
    Field::make( 'text', 'mje_profile_view_profile_button', __( 'View Profile' ) )->set_default_value('View Profile'),    
    Field::make( 'html', 'display_button_submit_1', __( 'Shortcode' ) )
	->set_html('<input type="submit" value="Save Changes" name="publish" id="publish" class="button button-primary button-large">'),      
       )) 

       
  ->add_tab('Style', array(    
    Field::make( 'color', 'mje_profile_slide_wrappger_bg_color', 'Container Background Color' )->set_default_value('#ffffff'),  
    Field::make( 'color', 'mje_profile_slide_item_header_color', 'Slide Item Header color' )->set_default_value('#10A2F6')->set_width(50),  
    Field::make( 'color', 'mje_profile_rate_star_color', 'Rating Star Color' )->set_default_value('#10a2ef')->set_width(50),  
    Field::make( 'color', 'mje_profile_slide_view_profile_bg_color', 'View Profile Button Background Color' )->set_default_value('#10A2F6')->set_width(50),  
    Field::make( 'color', 'mje_profile_slide_view_profile_text_color', 'View Profile Button Text Color' )->set_default_value('#ffffff')->set_width(50),  
    Field::make( 'color', 'mje_profile_slide_navigation_bg_color', 'Navigation Background color' )->set_default_value('#10A2F6')->set_width(30),  
    Field::make( 'color', 'mje_profile_slide_navigation_text_color', 'Navigation Text color' )->set_default_value('#ffffff')->set_width(30),  
    Field::make( 'text', 'mje_profile_slide_navigation_opacity', 'Navigation Opacity' )->set_attribute('placeholder','Min: 0.1 - Max: 1')->set_default_value(0.5)->set_width(30),  
    Field::make( 'html', 'display_button_submit_2', __( 'Shortcode' ) )
	->set_html('<input type="submit" value="Save Changes" name="publish" id="publish" class="button button-primary button-large">'),
    ))

  ->add_tab('Support',array(
    Field::make( 'html', 'display_document_guide', __( 'Shortcode' ) )
    ->set_html('<h4>You can read the documentation <a target="_blank" href="https://docs.enginethemes.com/article/602-how-to-use-mje-profile-list-plugin"> here.</a> </h4> <h4>Drop us a support ticket <a href="https://www.enginethemes.com/help/i-have-a-basic-question/" target="_blank"> here!</a></h4>'),
  ))

  ;
}

add_action('admin_head','hide_default_submit_button');

function hide_default_submit_button()
{
  ?>
  <style>
    #post-body-content #carbon_fields_container_mje_profiles_list_settings
    {
      width:100% !important;
    }
    #postbox-container-1
    {
      display:none !important;
    }
  </style>
  <?php
}
