<?php
/**
 * Theme bootstrap (My-theme)
 *

 * - Theme supports
 * - Shortcodes
 * - Custom Post Types
 * - WP_Query renderers
 * - Media sizes
 * - Widgets
 * - Customizer
 * - Scripts & Styles
 * - Component includes
 * - Feature renderers
 */
// Include components
require_once get_template_directory() . '/components/Projects.php';

// Enqueue project styles
function enqueue_project_styles() {
    wp_enqueue_style('project-styles', get_template_directory_uri() . '/components/projects.css', array(), '1.0.0');
}
add_action('wp_enqueue_scripts', 'enqueue_project_styles');

// ===== Theme supports =====
add_theme_support("custom-logo", ["height"=>300, "width"=>300]);
add_theme_support("post-thumbnails");
add_post_type_support( "page", "excerpt" );

// ===== Shortcodes =====

/**
 * [add a="1" b="2"] – returns a+b
 */


/**
 * [add a="" b=""] – simple arithmetic shortcode.
 * @param array $atts
 * @return int
 */
function adder ($atts = []){
    
    $atts = shortcode_atts([
        "a" => 0,
        "b" => 0
    ], $atts, 'add');

    // Ensure numeric values for arithmetic
    return intval($atts["a"]) + intval($atts["b"]);
}



// Register [add]
add_shortcode("add", "adder");

/**

 * @param array $atts
 * @return string
 */
function get_phone_number($atts=["link"=>""]) {
    $number = get_theme_mod("mytheme_phone_number", "Default value");
    if ($atts["link"]==""){
        return $number;
    }
    else{
        return "<a href='tel:" .$number. "'>" .$number. "</a>";
    }

}

// Register [tlf]
add_shortcode("tlf", "get_phone_number");

/**
 * [contact_form] 
 */
function mytheme_contact_form_shortcode($atts = []) {
    ob_start();
    get_template_part('components/contactform');
    return ob_get_clean();
}
add_shortcode('contact_form', 'mytheme_contact_form_shortcode');

add_shortcode ("get_skills" , "skills_tools");


// ===== Custom Post Types =====

/**
 * Register "my-slider-image" custom post type (Slider Images).
 */
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

/**
 * Register "my-skill" and "my-tool" custom post types.
 */
function skills_tools_post_types (){
    // Register Skills Post Type
    register_post_type(
        "my-skill",
        [
            "show_in_rest"          => true,
            "public"                => true,
            "label"                 => "skills",
            "labels"                => [
                "name"              => "Skills",
                "singular_name"     => "Skill",
                "add_new"           => "Add New Skill",
                "add_new_item"      => "Add New Skill",
                "edit_item"         => "Edit Skill",
                "new_item"          => "New Skill",
                "view_item"         => "View Skill",
                "search_items"      => "Search Skills",
                "not_found"         => "No skills found",
                "not_found_in_trash"=> "No skills found in Trash"
            ],
            "exclude_from_search"   => true,
            "supports"              => [
                "thumbnail",
                "title",
                "custom-fields"
            ],
            "menu_icon"             => "dashicons-star-filled"
        ]
    );

    // Register Tools Post Type
    register_post_type(
        "my-tool",
        [
            "show_in_rest"          => true,
            "public"                => true,
            "label"                 => "tools",
            "labels"                => [
                "name"              => "Tools",
                "singular_name"     => "Tool",
                "add_new"           => "Add New Tool",
                "add_new_item"      => "Add New Tool",
                "edit_item"         => "Edit Tool",
                "new_item"          => "New Tool",
                "view_item"         => "View Tool",
                "search_items"      => "Search Tools",
                "not_found"         => "No tools found",
                "not_found_in_trash"=> "No tools found in Trash"
            ],
            "exclude_from_search"   => true,
            "supports"              => [
                "thumbnail",
                "title",
                "custom-fields"
            ],
            "menu_icon"             => "dashicons-admin-tools"
        ]
    );
}

add_action("init", "skills_tools_post_types");

/**
 * Register "my-hero" custom post type for hero sections.
 */
function hero_post_type (){
    register_post_type(
        "my-hero",
        [
            "show_in_rest"          => true,
            "public"                => true,
            "label"                 => "hero",
            "labels"                => [
                "name"              => "Hero Sections",
                "singular_name"     => "Hero Section",
                "add_new"           => "Add New Hero",
                "add_new_item"      => "Add New Hero",
                "edit_item"         => "Edit Hero",
                "new_item"          => "New Hero",
                "view_item"         => "View Hero",
                "search_items"      => "Search Hero Sections",
                "not_found"         => "No hero sections found",
                "not_found_in_trash"=> "No hero sections found in Trash"
            ],
            "exclude_from_search"   => true,
            "supports"              => [
                "thumbnail",
                "title",
                "editor",
                "custom-fields"
            ],
            "menu_icon"             => "dashicons-id"
        ]
    );
}

add_action("init", "hero_post_type");


// ===== WP_Query Renderers =====

/**
 * Render slider from "my-slider-image" posts.
 */
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

/**
 * Render Skills & Tools lists from "my-skill" and "my-tool" posts.
 */
function skills_tools() {
    // Query for Skills
    $skills_query = new WP_Query([
        "post_type" => "my-skill",
        "posts_per_page" => -1,
        "orderby" => "menu_order",
        "order" => "ASC"
    ]);

    // Query for Tools
    $tools_query = new WP_Query([
        "post_type" => "my-tool", 
        "posts_per_page" => -1,
        "orderby" => "menu_order",
        "order" => "ASC"
    ]);

    // Only display if we have skills or tools
    if ($skills_query->have_posts() || $tools_query->have_posts()) {
        echo '<div class="skills-box" data-skills-box>';
        echo '<h1>Skills &amp; Tools</h1>';
        
        echo '<div class="skills-toggle" data-toggle-box>';
        echo '<button class="toggle-btn active" data-tab="skills" aria-expanded="true" aria-controls="skills-list">Skills</button>';
        echo '<button class="toggle-btn" data-tab="tools" aria-expanded="false" aria-controls="tools-list">Tools</button>';
        echo '</div>';
        
        // Skills List
        echo '<ul class="skills-list active" id="skills-list" role="list" aria-label="Skills" data-content="skills">';
        if ($skills_query->have_posts()) {
            while ($skills_query->have_posts()) {
                $skills_query->the_post();
                echo '<li>';
                echo '<div class="skills-card">';
                echo '<div class="tooltip">' . esc_html(get_the_title()) . '</div>';
                echo '<div class="card-icon">';
                
                // Check if post has featured image, otherwise use custom field for image URL
                if (has_post_thumbnail()) {
                    echo get_the_post_thumbnail(get_the_ID(), 'skill-icon', ['alt' => esc_attr(get_the_title()) . ' logo']);
                } else {
                    $image_url = get_post_meta(get_the_ID(), 'skill_image_url', true);
                    if ($image_url) {
                        echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr(get_the_title()) . ' logo" />';
                    }
                }
                
                echo '</div>';
                echo '</div>';
                echo '</li>';
            }
        }
        echo '</ul>';
        
        // Tools List
        echo '<ul class="tools-list" id="tools-list" role="list" aria-label="Tools" data-content="tools" style="display: none;">';
        if ($tools_query->have_posts()) {
            while ($tools_query->have_posts()) {
                $tools_query->the_post();
                echo '<li>';
                echo '<div class="skills-card">';
                echo '<div class="tooltip">' . esc_html(get_the_title()) . '</div>';
                echo '<div class="card-icon">';
                
                // Check if post has featured image, otherwise use custom field for image URL
                if (has_post_thumbnail()) {
                    echo get_the_post_thumbnail(get_the_ID(), 'skill-icon', ['alt' => esc_attr(get_the_title()) . ' logo']);
                } else {
                    $image_url = get_post_meta(get_the_ID(), 'tool_image_url', true);
                    if ($image_url) {
                        echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr(get_the_title()) . ' logo" />';
                    }
                }
                
                echo '</div>';
                echo '</div>';
                echo '</li>';
            }
        }
        echo '</ul>';
        
        echo '</div>';
    }
    
    // Reset post data for both queries
    wp_reset_postdata();
}


// ===== Media sizes =====

add_image_size("slider", 1200, 300, true);
add_image_size("skill-icon", 50, 50, true);
add_image_size("hero-portrait", 800, 800, true);


// ===== Widgets =====

/**
 * Register Footer widget areas (3 columns).
 */
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



// ===== Customizer =====
//For at hente værdien fra et felt i vores templates 
//skal vi bruge feltets id (f.eks. "mytheme_phone_number")
//echo get_theme_mod('mytheme_phone_number', 'Default value'); 

/**
 * Add Customizer settings/controls for phone, slider toggle, footer color.
 */
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
 






// ===== Scripts & Styles =====
/**
 * Enqueue theme styles and scripts.
 */
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

    // Hero section styles
    wp_enqueue_style(
        "Hero_Stylesheet",
        get_template_directory_uri()."/components/Hero.css",
        [],
        "1.0.0"
    );

    // Font Awesome for social icons used in Hero
    wp_enqueue_style(
        "font-awesome",
        "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css",
        [],
        "6.5.2"
    );
}

add_action("wp_enqueue_scripts", "my_theme_scripts_and_styles");

// ===== Component includes =====
// Ensure the darkmode component is loaded early so it can register its enqueue handler
$dm_path = get_template_directory() . '/components/Darkmode.php';
if ( file_exists( $dm_path ) ) {
    require_once $dm_path;
}

// ===== Feature renderers =====
/**
 * Render Hero section from latest "my-hero" post.
    * Coded defaults so the hero works even without WP content
 */
function hero() {

    $defaults = [
        'subtitle'   => "Hi, I'm robot.",
        'title'      => 'WEB UDVIKLER',
        'content'    => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. <br> Lorem Ipsum has been the
            industrys standard dummy text ever since the 1500s, <br> when an unknown printer took a galley of type and
            scrambled it to make a type <br> specimen book. It has survived not only five centuries, but also the leap
            into
            electronic
            I create <br> websites to do businesses do better <br> online.',
        /* 'cta_text'   => 'Hire Me', */
       /*  'cta_url'    => '#', */
        'image_url'  => 'http://localhost/cms-udvikling/wp-content/uploads/2025/10/cropped-photo-1563970065-4929be737b3a-1.png',
        'twitter'    => '#',
        'github'     => '#',
        'linkedin'   => '#',
    ];

    $hero_q = new WP_Query([
        'post_type' => 'my-hero',
        'posts_per_page' => 1,
        'orderby' => 'date',
        'order' => 'DESC',
    ]);

    // Helper: wrap first character of each word in <span>
    $wrap_title = function($title) {
        $words = preg_split('/\s+/', trim($title));
        $out = [];
        foreach ($words as $w) {
            if ($w === '') continue;
            $first = mb_substr($w, 0, 1);
            $rest  = mb_substr($w, 1);
            $out[] = '<span>'. esc_html($first) .'</span>'. esc_html($rest);
        }
        return implode(' ', $out);
    };

    if ($hero_q->have_posts()) {
        while ($hero_q->have_posts()) {
            $hero_q->the_post();

            $subtitle   = get_post_meta(get_the_ID(), 'hero_subtitle', true) ?: $defaults['subtitle'];
            $title      = get_the_title() ?: $defaults['title'];
            $content    = get_the_content();
            $content    = $content ? $content : $defaults['content'];
            $content_processed = apply_filters('the_content', $content);
            $cta_text   = get_post_meta(get_the_ID(), 'hero_cta_text', true) ?: $defaults['cta_text'];
        /*     $cta_url    = get_post_meta(get_the_ID(), 'hero_cta_url', true) ?: $defaults['cta_url']; */
            $tw_url     = get_post_meta(get_the_ID(), 'social_twitter', true) ?: $defaults['twitter'];
            $gh_url     = get_post_meta(get_the_ID(), 'social_github', true) ?: $defaults['github'];
            $li_url     = get_post_meta(get_the_ID(), 'social_linkedin', true) ?: $defaults['linkedin'];
            $highlight  = get_post_meta(get_the_ID(), 'hero_highlight', true) ?: 'robot';

            
            $subtitle_html = $subtitle;
            $content_html  = $content_processed;
            if (!empty($highlight)) {
                $pattern = '/(' . preg_quote($highlight, '/') . ')/iu';
                $subtitle_html = preg_replace($pattern, '<span>$1</span>', $subtitle_html, 1);
                $content_html  = preg_replace($pattern, '<span>$1</span>', $content_html);
            }

            echo '<section class="hero main">';
            echo '  <div class="info">';
            echo '    <h3>'. wp_kses($subtitle_html, [ 'span' => [] ]) .'</h3>';
            echo '    <h1>'. $wrap_title($title) .'</h1>';
            echo '    <div class="hero-content">'. wp_kses_post($content_html) .'</div>';
            /* echo '    <a href="'. esc_url($cta_url) .'">'. esc_html($cta_text) .'</a>'; */
            echo '  </div>';

            echo '  <div class="image">';
            if (has_post_thumbnail()) {
                echo get_the_post_thumbnail(get_the_ID(), 'hero-portrait', [ 'class' => 'girl', 'alt' => esc_attr(get_the_title() ?: 'photo') ]);
            } elseif (!empty($defaults['image_url'])) {
                echo '<img class="girl" src="'. esc_url($defaults['image_url']) .'" alt="photo">';
            }
            echo '  </div>';

            echo '  <ul class="wrapper">';
            echo '    <li class="icon twitter"><span class="tooltip">Twitter</span><span><a href="'. esc_url($tw_url) .'" target="_blank" rel="noopener"><i class="fab fa-twitter"></i></a></span></li>';
            echo '    <li class="icon github"><span class="tooltip">Github</span><span><a href="'. esc_url($gh_url) .'" target="_blank" rel="noopener"><i class="fab fa-github"></i></a></span></li>';
            echo '    <li class="icon linkedin"><span class="tooltip">LinkedIn</span><span><a href="'. esc_url($li_url) .'" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i></a></span></li>';
            echo '  </ul>';

            echo '</section>';
        }
    } else {
        // No hero posts — render with coded defaults
        $highlight = 'robot';
    $subtitle_html = $defaults['subtitle'];
    $content_html  = $defaults['content'];
    $pattern = '/(' . preg_quote($highlight, '/') . ')/iu';
    $subtitle_html = preg_replace($pattern, '<span>$1</span>', $subtitle_html, 1);
    $content_html  = preg_replace($pattern, '<span>$1</span>', $content_html);
        echo '<section class="hero main">';
        echo '  <div class="info">';
        echo '    <h3>'. wp_kses($subtitle_html, [ 'span' => [] ]) .'</h3>';
        echo '    <h1>'. $wrap_title($defaults['title']) .'</h1>';
    echo '    <div class="hero-content">'. wp_kses_post($content_html) .'</div>';
    /*     echo '    <a href="'. esc_url($defaults['cta_url']) .'">'. esc_html($defaults['cta_text']) .'</a>'; */
        echo '  </div>';
        echo '  <div class="image">';
        if (!empty($defaults['image_url'])) {
            echo '<img class="girl" src="'. esc_url($defaults['image_url']) .'" alt="photo">';
        }
        echo '  </div>';
        echo '  <ul class="wrapper">';
        echo '    <li class="icon twitter"><span class="tooltip">Twitter</span><span><a href="'. esc_url($defaults['twitter']) .'" target="_blank" rel="noopener"><i class="fab fa-twitter"></i></a></span></li>';
        echo '    <li class="icon github"><span class="tooltip">Github</span><span><a href="'. esc_url($defaults['github']) .'" target="_blank" rel="noopener"><i class="fab fa-github"></i></a></span></li>';
        echo '    <li class="icon linkedin"><span class="tooltip">LinkedIn</span><span><a href="'. esc_url($defaults['linkedin']) .'" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i></a></span></li>';
        echo '  </ul>';
        echo '</section>';
    }

    wp_reset_postdata();
}