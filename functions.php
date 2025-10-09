<?php
add_theme_support("custom-logo", ["height"=>300, "width"=>300]);
add_theme_support("post-thumbnails");
add_post_type_support( "page", "excerpt" );


//Shortcodes

function adder ($atts = []){
    
    $atts = shortcode_atts([
        "a" => 0,
        "b" => 0
    ], $atts, 'add');

    // Ensure numeric values for arithmetic
    return intval($atts["a"]) + intval($atts["b"]);
}



add_shortcode("add", "adder");

function get_phone_number($atts=["link"=>""]) {
    $number = get_theme_mod("mytheme_phone_number", "Default value");
    if ($atts["link"]==""){
        return $number;
    }
    else{
        return "<a href='tel:" .$number. "'>" .$number. "</a>";
    }

}

add_shortcode("tlf", "get_phone_number");

//Actions

function slider_post_type (){
    register_post_type(
        "my-slider-image",
        [
            "show_in_rest"          =>true,
            "public"                =>true,
            "label"                 => "slider-images",
            "labels"                => [
                "name"              =>"Slider Images",
                "singular_name"     =>"Slider Image"
            ],
            "exclude_from_search"   => true,
            "supports"              =>[
                    "thumbnail",
                    "title"
            ]
        ]
    );
}

add_action("init", "slider_post_type");


//WP QUERY

function slider () {
    $the_query = new WP_Query(
        [
            "post_type" => "my-slider-image",
            "order"     => "ASC"
        ]
    );
    
    if ($the_query->have_posts()){
        echo "<section class='slider-wrapper'>";
            echo "<button class='slide-arrow' id='slide-arrow-prev'>&#8249;</button>";
            echo "<button class='slide-arrow' id='slide-arrow-next'>&#8250;</button>";
            echo "<ul class='slides-container' id='slides-container'>";

            //loop
        while($the_query->have_posts()){
            
            $the_query->the_post();
            echo "<li class='slide'>";
                echo "<span class='slide-title'>";
                    the_title();
                echo "</span>";
                echo "<img src='".the_post_thumbnail('slider')."' alt=''>";
                echo "</li>";
        }
            echo "</ul>";
        echo "</section>";
    }
    wp_reset_postdata();
}


//Media

add_image_size("slider", 1200, 300, true);


//Wigets

function Mohamed_footer_widgets () {
    register_sidebar(
        [
            "name"          =>"Footer widget 1",
            "id"            =>"footer_widget_1",
            "description"   =>"I dette felt kan du indtaste indhold til første footer sektion",
            "before_widget" =>"<section class='footer-widget'>",
            "after_widget"  =>"</section>",
            "before_title"  =>"<h3 class='widget-title'>",
            "after_title"   =>"</h3>"
        ]
    );
    register_sidebar(
        [
            "name"          =>"Footer widget 2",
            "id"            =>"footer_widget_2",
            "description"   =>"I dette felt kan du indtaste indhold til anden footer sektion",
            "before_widget" =>"<section class='footer-widget'>",
            "after_widget"  =>"</section>",
            "before_title"  =>"<h3 class='widget-title'>",
            "after_title"   =>"</h3>"
        ]
    );
    register_sidebar(
        [
            "name"          =>"Footer widget 3",
            "id"            =>"footer_widget_3",
            "description"   =>"I dette felt kan du indtaste indhold til tredje footer sektion",
            "before_widget" =>"<section class='footer-widget'>",
            "after_widget"  =>"</section>",
            "before_title"  =>"<h3 class='widget-title'>",
            "after_title"   =>"</h3>"
        ]
    );

}
add_action("widgets_init", "Mohamed_footer_widgets");



//Customizer
//For at hente værdien fra et felt i vores templates 
//skal vi bruge feltets id (f.eks. "mytheme_phone_number")
//echo get_theme_mod('mytheme_phone_number', 'Default value'); 

function mytheme_customize_register($wp_customize) {
    // Step 1: Add a section
    $wp_customize->add_section(
        'mytheme_extra_settings', 
        [
        "title"    => "Tema indstillinger",
        "priority" => 30
        ]
    );

    // Step 2: Add a setting
    $wp_customize->add_setting(
        "mytheme_phone_number",
        [
        "default"           => "",
        "sanitize_callback" => "sanitize_text_field"
        ]
    );

    // Step 3: Add a control
    $wp_customize->add_control(
        "mytheme_text_field",
        [
        "label"    => "Firma Telefonnummer",
        "section"  => "mytheme_extra_settings",
        "settings" => "mytheme_phone_number",
        "type"     => "text"
        ]
    );


    //Gentag Step 2 og 3 for flere felter
    // Step 2: Add a setting
    $wp_customize->add_setting(
        "mytheme_enable_slider",
        [
        "default"           => "",
        "sanitize_callback" => "sanitize_text_field"
        ]
    );

    // Step 3: Add a control
    $wp_customize->add_control(
        "mytheme_checkbox",
        [
        "label"    => "Slideshow on/off",
        "section"  => "mytheme_extra_settings",
        "settings" => "mytheme_enable_slider",
        "type"     => "checkbox"
        ]
    );
    //Gentag Step 2 og 3 for flere felter
    // Step 2: Add a setting
    $wp_customize->add_setting(
        "mytheme_footer_color",
        [
        "default"           => "",
        "sanitize_callback" => "sanitize_text_field"
        ]
    );

    // Step 3: Add a control
    $wp_customize->add_control(
        "mytheme_color_picker",
        [
        "label"    => "Mørk footer farve",
        "section"  => "mytheme_extra_settings",
        "settings" => "mytheme_footer_color",
        "type"     => "checkbox"
        ]
    );
}
add_action("customize_register", "mytheme_customize_register");
 






//Scripts & Styles
function my_theme_scripts_and_styles(){
    wp_enqueue_style(
        "Main_Stylesheet",
        get_stylesheet_uri()
    );

    // Skills & Tools component styles
    wp_enqueue_style(
        "Skills_Tools_Stylesheet",
        get_template_directory_uri()."/components/SkillsTools.css",
        [],
        "1.0.0"
    );

    wp_enqueue_script(
        "Slider",
        get_template_directory_uri()."/scripts/slider.js",
        [],
        false,
        [
            "strategy" =>"defer",
            "in_footer" => false
        ]
    );

    // Skills & Tools component JavaScript
    wp_enqueue_script(
        "Skills_Tools_Script",
        get_template_directory_uri()."/scripts/skills-tools.js",
        [],
        "1.0.0",
        [
            "strategy" =>"defer",
            "in_footer" => true
        ]
    );
}

add_action("wp_enqueue_scripts", "my_theme_scripts_and_styles");

// Ensure the darkmode component is loaded early so it can register its enqueue handler
$dm_path = get_template_directory() . '/components/Darkmode.php';
if ( file_exists( $dm_path ) ) {
    require_once $dm_path;
}