<?php
/* if (!defined('ABSPATH')) {
    exit; 
} */

// Register Custom Post Type for Projects
function register_projects_post_type() {
    $labels = array(
        'name'                  => 'Projects',
        'singular_name'         => 'Project',
        'menu_name'            => 'Projects',
        'add_new'              => 'Add New Project',
        'add_new_item'         => 'Add New Project',
        'edit_item'            => 'Edit Project',
        'new_item'             => 'New Project',
        'view_item'            => 'View Project',
        'search_items'         => 'Search Projects',
        'not_found'            => 'No projects found',
        'not_found_in_trash'   => 'No projects found in Trash'
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => true,
        'publicly_queryable'  => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'projects'),
        'capability_type'    => 'post',
        'menu_icon'          => 'dashicons-portfolio',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
    );

    register_post_type('project', $args);
}
add_action('init', 'register_projects_post_type');

//  details
function add_project_meta_boxes() {
    add_meta_box(
        'project_details',
        'Project Details',
        'render_project_meta_box',
        'project',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_project_meta_boxes');


function render_project_meta_box($post) {
    
    wp_nonce_field('project_meta_box', 'project_meta_box_nonce');

    //  values
    $github_url = get_post_meta($post->ID, '_github_url', true);
    $demo_url = get_post_meta($post->ID, '_demo_url', true);

    ?>
    <div class="project-meta-box">
        <p>
            <label for="github_url">GitHub URL:</label>
            <input type="url" id="github_url" name="github_url" value="<?php echo esc_url($github_url); ?>" style="width: 100%;">
        </p>
        <p>
            <label for="demo_url">Demo URL:</label>
            <input type="url" id="demo_url" name="demo_url" value="<?php echo esc_url($demo_url); ?>" style="width: 100%;">
        </p>
    </div>
    <?php
}

// Save meta box data
function save_project_meta_box($post_id) {
    // Security checks
    if (!isset($_POST['project_meta_box_nonce'])) {
        return $post_id;
    }
    if (!wp_verify_nonce($_POST['project_meta_box_nonce'], 'project_meta_box')) {
        return $post_id;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    if ('project' !== get_post_type($post_id)) {
        return $post_id;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    // Save the meta box data
    if (isset($_POST['github_url'])) {
        update_post_meta($post_id, '_github_url', sanitize_url($_POST['github_url']));
    }
    if (isset($_POST['demo_url'])) {
        update_post_meta($post_id, '_demo_url', sanitize_url($_POST['demo_url']));
    }
}
add_action('save_post', 'save_project_meta_box');

// Shortcode to display projects
function projects_shortcode($atts) {
    $atts = shortcode_atts(array(
        'count' => -1,
        'orderby' => 'date',
        'order' => 'DESC'
    ), $atts);

    $args = array(
        'post_type' => 'project',
        'posts_per_page' => $atts['count'],
        'orderby' => $atts['orderby'],
        'order' => $atts['order']
    );

    $query = new WP_Query($args);
    
    ob_start();
    ?>
    <div class="container">
        <div class="header">
            <h1 class="title">Featured Projects</h1>
            <p class="subtitle">
                A showcase of my best work demonstrating expertise in modern web technologies,
                user experience design, and full-stack development.
            </p>
        </div>

        <div class="projects-grid">
            <?php
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    $github_url = get_post_meta(get_the_ID(), '_github_url', true);
                    $demo_url = get_post_meta(get_the_ID(), '_demo_url', true);
                    ?>
                    <div class="project-card">
                        <div class="project-image">
                            <?php 
                            if (has_post_thumbnail()) {
                                the_post_thumbnail('large');
                            }
                            ?>
                        </div>
                        <div class="project-content">
                            <h3 class="project-title"><?php the_title(); ?></h3>
                            <p class="project-description"><?php echo get_the_excerpt(); ?></p>
                            <div class="project-links">
                                <?php if ($github_url) : ?>
                                <a href="<?php echo esc_url($github_url); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-github">
                                    <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22">
                                        </path>
                                    </svg>
                                    GitHub
                                </a>
                                <?php endif; ?>
                                <?php if ($demo_url) : ?>
                                <a href="<?php echo esc_url($demo_url); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-demo">
                                    <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                              d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                        </path>
                                    </svg>
                                    Live Demo
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('projects', 'projects_shortcode');