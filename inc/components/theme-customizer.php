<?php
function mytheme_render_theme_customizer() {
    ?>
    
    <!-- Trigger Button -->
    <button type="button"
            class="btn btn-primary position-fixed theme-customizer end-0 z-3"
            data-bs-toggle="offcanvas"
            data-bs-target="#themeCustomizerPopup">
        🎨 Customize
    </button>

    <!-- Modal -->
    <div class="offcanvas offcanvas-end" data-bs-scroll="true" id="themeCustomizerPopup" tabindex="-1" aria-labelledby="themeCustomizerPopup">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="themeCustomizerPopup">Theme Customizer</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="d-flex">
                <div class="mb-3">
                    <label class="form-label">Primary Color</label>
                    <input type="color" id="primaryColorPicker" class="form-control form-control-color" value="#0d6efd">
                </div>    
                <div class="mb-3">
                    <label class="form-label">Secondary Color</label>
                    <input type="color" id="secondaryColorPicker" class="form-control form-control-color" value="#6c757d">
                </div>
            </div>
            <div class="d-flex">
                <button type="button" class="btn btn-outline-secondary" id="resetThemeColors">
                    Reset
                </button>
                <button type="button" class="btn btn-primary" id="saveThemeColors">
                    Apply
                </button>
            </div>
        </div>
    </div>

    <?php
}

// Hook to footer
add_action('wp_footer', 'mytheme_render_theme_customizer');

// Enqueue JS
function mytheme_enqueue_theme_customizer() {
    wp_enqueue_script(
        'theme-customizer',
        get_template_directory_uri() . '/assets/js/theme-customizer.js',
        array(),
        null,
        true
    );
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_theme_customizer');