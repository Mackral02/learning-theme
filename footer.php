    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-white mb-3">Quick Link</h4>
                    <?php
                    wp_nav_menu([
                        'theme_location' => 'primary',
                        'container'      => false,
                        'depth'          => 1,
                        'items_wrap'     => '%3$s',
                        'walker'         => new Footer_Menu_Walker(),
                    ]);
                    ?>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-white mb-3">Contact</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h4 class="text-white mb-3">Newsletter</h4>
                    <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <?php echo date('Y'); ?> <a class="border-bottom" href="#"><?php bloginfo('name'); ?></a>, All rights reserved.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        Designed with &hearts; by <a class="border-bottom" href="https://mackral.gonsalves.xyz/" target="_blank">Mac</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <?php wp_footer(); ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Select all WPForms fields inside a form
            const forms = document.querySelectorAll('.wpforms-form');

            forms.forEach(form => {
                const fields = form.querySelectorAll('.wpforms-field');

                fields.forEach(field => {
                    const label = field.querySelector('label');
                    const input = field.querySelector('input, textarea');

                    if (label && input) {
                        // Only do it if label is BEFORE input
                        if (label.compareDocumentPosition(input) & Node.DOCUMENT_POSITION_FOLLOWING) {
                            field.insertBefore(input, label); // Swap order
                        }

                        // Add Bootstrap floating label wrapper
                        if (!field.classList.contains('form-floating')) {
                            field.classList.add('form-floating');
                        }

                        // Ensure input has form-control
                        input.classList.add('form-control');

                        // Set input id if missing for label "for" attribute
                        if (!input.id) {
                            const randomId = 'wpf-' + Math.random().toString(36).substr(2, 9);
                            input.id = randomId;
                            label.setAttribute('for', randomId);
                        }
                    }
                });
            });
        });
    </script>
    </body>

    </html>