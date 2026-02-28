<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <?php /*<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i>eLEARNING</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="index.html" class="nav-item nav-link active">Home</a>
                <a href="about.html" class="nav-item nav-link">About</a>
                <a href="courses.html" class="nav-item nav-link">Courses</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                    <div class="dropdown-menu fade-down m-0">
                        <a href="team.html" class="dropdown-item">Our Team</a>
                        <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                        <a href="404.html" class="dropdown-item">404 Page</a>
                    </div>
                </div>
                <a href="contact.html" class="nav-item nav-link">Contact</a>
            </div>
            <a href="#" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Free Call<i class="fa fa-solid fa-phone ms-3"></i></a>
        </div>
    </nav> */ ?>
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0 header-menu">
        <?php
        if (function_exists('the_custom_logo')) {
            the_custom_logo();
        } else {
        ?>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
                <h2 class="m-0 text-primary"><i class="fa fa-book me-3"></i><?php bloginfo('name'); ?></h2>
            </a>
        <?php
        }
        ?>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">

            <?php
            // Dynamic menu
            if (has_nav_menu('primary')) {
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'container' => false,
                    'menu_class' => 'navbar-nav ms-auto p-4 p-lg-0',
                    'fallback_cb' => '__return_false',
                    'depth' => 2,
                    'walker' => new class extends Walker_Nav_Menu {
                        function start_lvl(&$output, $depth = 0, $args = null)
                        {
                            $output .= '<div class="dropdown-menu fade-down m-0">';
                        }
                        function end_lvl(&$output, $depth = 0, $args = null)
                        {
                            $output .= '</div>';
                        }
                        function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
                        {
                            $classes = empty($item->classes) ? [] : (array) $item->classes;
                            $has_children = in_array('menu-item-has-children', $classes);
                            $classes[] = 'nav-item';
                            $class_names = join(' ', $classes);

                            $atts = [
                                'title' => !empty($item->attr_title) ? $item->attr_title : '',
                                'target' => !empty($item->target) ? $item->target : '',
                                'rel' => !empty($item->xfn) ? $item->xfn : '',
                                'href' => !empty($item->url) ? $item->url : '',
                                'class' => 'nav-link' . ($has_children ? ' dropdown-toggle' : ''),
                                'data-bs-toggle' => $has_children ? 'dropdown' : '',
                            ];

                            $atts = array_map('esc_attr', $atts);
                            $output .= '<a ' . implode(' ', array_map(fn($k, $v) => "$k=\"$v\"", array_keys($atts), $atts)) . '>' . esc_html($item->title) . '</a>';
                        }
                        function end_el(&$output, $item, $depth = 0, $args = null)
                        {
                            // Close nav-item automatically handled by Bootstrap
                        }
                    }
                ]);
            }
            ?>

            <!-- CTA button -->
            <a href="#" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">
                Free Call<i class="fa fa-solid fa-phone ms-3"></i>
            </a>

        </div>
    </nav>
    <!-- Navbar End -->