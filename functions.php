<?php
add_theme_support("custom-logo", ["height"=>300, "width"=>300]);
add_theme_support("post-thumbnails");
add_post_type_support( "page", "excerpt" );


//Shortcodes

function adder ($atts=["a"=>0, "b"=>0]){
    return $atts["a"] + $atts["b"];
}



add_shortcode("add", "adder");

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

function niller_footer_widgets () {
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
add_action("widgets_init", "niller_footer_widgets");



//Customizer

 add_theme_support( 'customize-selective-refresh-widgets' );

function themeslug_customize_register( $wp_customize ) {
  
   $wp_customize->add_setting( 'accent_color', array(
    'default' => '#f72525',
    'sanitize_callback' => 'sanitize_hex_color',
    ) );

}
add_action( 'customize_register', 'themeslug_customize_register' );





//Scripts & Styles
function my_theme_scripts_and_styles(){
    wp_enqueue_style(
        "Main_Stylesheet",
        get_stylesheet_uri()
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
}

add_action("wp_enqueue_scripts", "my_theme_scripts_and_styles");