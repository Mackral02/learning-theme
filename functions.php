<?php
add_filter('wp_enqueue_global_styles', '__return_false');
add_filter('should_load_separate_core_block_assets', '__return_false');
add_filter('global_styles_inline', '__return_empty_string');
add_action('after_setup_theme', function () {

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ]);

    register_nav_menus([
        'primary' => __('Primary Menu', 'consultancy')
    ]);
});
// Remove Emoji Scripts and Styles
add_action('init', function () {
    //     remove_action('wp_head', 'print_emoji_detection_script', 7);
    //     remove_action('wp_print_styles', 'print_emoji_styles');
    //     remove_action('admin_print_scripts', 'print_emoji_detection_script');
    //     remove_action('admin_print_styles', 'print_emoji_styles');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
});
// add_action('init', function () {
//     remove_action('rest_api_init', 'wp_oembed_register_route');
//     remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
//     remove_action('wp_head', 'wp_oembed_add_discovery_links');
//     remove_action('wp_head', 'wp_oembed_add_host_js');
// });
add_action('wp_head', function() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
}, 1);
add_action('wp_enqueue_scripts', function () {
    
}, 100);
// remove_action('wp_head', 'rsd_link');                // Really Simple Discovery
// remove_action('wp_head', 'wlwmanifest_link');        // Windows Live Writer
// remove_action('wp_head', 'wp_generator');           // WordPress version
// remove_action('wp_head', 'rest_output_link_wp_head'); // REST API link
// remove_action('wp_head', 'wp_shortlink_wp_head');   // Shortlink
function add_menu_link_class($atts, $item, $args) {
    if ($args->theme_location == 'primary') {
        $atts['class'] = 'btn btn-link';
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_menu_link_class', 10, 3);
class Footer_Menu_Walker extends Walker_Nav_Menu {

    // Remove <ul>
    public function start_lvl(&$output, $depth = 0, $args = null) {}
    public function end_lvl(&$output, $depth = 0, $args = null) {}

    // Remove <li> and print only <a>
    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {

        $url = ! empty($item->url) ? $item->url : '';
        $title = $item->title;

        $output .= '<a class="btn btn-link" href="' . esc_url($url) . '">';
        $output .= esc_html($title);
        $output .= '</a>';
    }

    public function end_el(&$output, $item, $depth = 0, $args = null) {}
}
add_action('wp_enqueue_scripts', function () {
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('classic-theme-styles');
    wp_dequeue_style('global-styles');
    //     wp_dequeue_style('wp-block-library-theme');
    // add_filter('global_styles_inline', '__return_empty_string');
    //      wp_dequeue_style('wp-block-library-inline-css');

    $version = wp_get_theme()->get('Version');

    wp_enqueue_style(
        'bootstrap',
        get_template_directory_uri() . '/assets/css/bootstrap.min.css',
        [],
        $version
    );
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap',
        [],
        null
    );
    wp_enqueue_style(
        'animate',
        get_template_directory_uri() . '/assets/lib/animate/animate.min.css',
        [],
        $version
    );
    wp_enqueue_style(
        'fontawesome-icons',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css',
        [],
        $version
    );
    wp_enqueue_style(
        'bootstrap-icons',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css',
        [],
        $version
    );
    wp_enqueue_style(
        'owl',
        get_template_directory_uri() . '/assets/lib/owlcarousel/assets/owl.carousel.min.css',
        [],
        $version
    );
    wp_enqueue_style(
        'main',
        get_template_directory_uri() . '/assets/css/style.css',
        [],
        $version
    );

    // wp_enqueue_script(
    //     'jquery',
    //     'https://code.jquery.com/jquery-3.4.1.min.js',
    //     [],
    //     $version,
    //     true
    // );
    wp_enqueue_script(
        'jquery'
    );
    wp_enqueue_script(
        'wow',
        get_template_directory_uri() . '/assets/lib/wow/wow.min.js',
        ['jquery'],
        $version,
        true
    );
    wp_enqueue_script(
        'owlcarousel',
        get_template_directory_uri() . '/assets/lib/owlcarousel/owl.carousel.min.js',
        ['jquery'],
        $version,
        true
    );
    wp_enqueue_script(
        'main',
        get_template_directory_uri() . '/assets/js/main.js',
        ['jquery'],
        $version,
        true
    );
});
//hide editor for pages
add_filter('use_block_editor_for_post_type', function($use, $post_type) {
    if ($post_type === 'page') {
        return false;
    }
    return $use;
}, 10, 2);