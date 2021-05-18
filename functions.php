<?php
/**
 * GeneratePress child theme functions and definitions.
 *
 * Add your custom PHP in this file.
 * Only edit this file if you have direct access to it on your server (to fix errors if they happen).
 */

function yield_enqueue_style() {
    if ( is_child_theme() ) {
        // load parent stylesheet first if this is a child theme
	    wp_enqueue_style( 'parent-stylesheet', trailingslashit( get_template_directory_uri() ) . 'style.css', false );
        
    }

    // load active theme stylesheet in both cases
    wp_enqueue_style( 'custom-sylesheet', get_stylesheet_directory_uri() . '/css/custom.css' );
    wp_enqueue_style( 'theme-stylesheet', get_stylesheet_uri(), false );

    wp_enqueue_script( 'bootstrap', get_stylesheet_directory_uri() . '/js/bootstrap.bundle.min.js', array(), null, true );
    wp_enqueue_script( 'custom', get_stylesheet_directory_uri() . '/js/custom.js', array( 'jquery' ), null, true );
}
add_action( 'wp_enqueue_scripts', 'yield_enqueue_style' );

add_action( 'generate_before_footer_content', 'about_section' );
function about_section() {
    include_once "section/about.php";
}
add_action( 'wp_head', 'remove_parent_theme_action' );
function remove_parent_theme_action() {
    remove_action( 'generate_credits', 'generate_add_footer_info' );
    // remove_action( 'generate_footer', 'generate_construct_footer' );
    remove_action( 'generate_footer', 'generate_construct_footer_widgets', 5 );
    remove_action( 'generate_footer', 'generate_construct_footer' );
}

add_action( 'generate_credits', 'yield_footer_copyright' );
/**
 * Add the copyright to the footer
 *
 * @since 0.1
 */
function yield_footer_copyright() {
    $copyright = sprintf(
        '<span class="copyright">Copyright &copy; %1$s %2$s</span> Use of this web site constitutes acceptance of the Terms of Use , Privacy Policy and Copyright Policy . The material appearing on is for educational use only. It should not be used as a substitute for professional medical advice, diagnosis or treatment. is a registered trademark of the Foundation. The Foundation and do not endorse any of the products or services that are advertised on the web site. Moreover, we do not select every advertiser or advertisement that appears on the web site-many of the advertisements are served by third party advertising companies.',
        date( 'Y' ), // phpcs:ignore
        'Ltd.'
    );
    echo apply_filters( 'generate_copyright', $copyright ); // phpcs:ignore
}

if ( ! function_exists( 'yield_footer_widgets' ) ) {
    add_action( 'generate_footer', 'yield_footer_widgets', 5 );
    /**
     * Build our footer widgets.
     *
     * @since 1.3.42
     */
    function yield_footer_widgets() {
        ?>
            <div id="footer-widgets" class="site footer-widgets bg-dark">
                <div <?php generate_do_element_classes( 'inside_footer' ); ?>>
                    <div class="inside-footer-widgets">
                        <div class="row">
                            <div class="col-md-3 social order-sm-1">
                                <?php dynamic_sidebar('footer-1'); ?>
                            </div>
                            <div class="col-md-2 order-sm-3 w-sm-50">
                                <?php dynamic_sidebar('footer-2'); ?>
                            </div>
                            <div class="col-md-3 order-sm-4 w-sm-50">
                                <?php dynamic_sidebar('footer-3'); ?>
                            </div>
                            <div class="col-md-4 form order-sm-2 order-md-5">
                                <?php dynamic_sidebar('footer-4'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php

        /**
         * generate_after_footer_widgets hook.
         *
         * @since 0.1
         */
        do_action( 'generate_after_footer_widgets' );
    }
}

if ( ! function_exists( 'yield_construct_footer' ) ) {
    add_action( 'generate_footer', 'yield_construct_footer' );
    /**
     * Build our footer.
     *
     * @since 1.3.42
     */
    function yield_construct_footer() {
        $inside_site_info_class = '';

        if ( 'full-width' !== generate_get_option( 'footer_inner_width' ) ) {
            $inside_site_info_class = ' grid-container grid-parent';

            if ( generate_is_using_flexbox() ) {
                $inside_site_info_class = ' grid-container bg-dark';
            }
        }
        ?>
        <footer <?php generate_do_element_classes( 'site-info', 'site-info' ); ?>>
            <div class="inside-site-info<?php echo $inside_site_info_class; // phpcs:ignore ?>">
                <?php
                /**
                 * generate_before_copyright hook.
                 *
                 * @since 0.1
                 *
                 * @hooked generate_footer_bar - 15
                 */
                do_action( 'generate_before_copyright' );
                ?>
                <div class="copyright-bar">
                    <?php
                    /**
                     * generate_credits hook.
                     *
                     * @since 0.1
                     *
                     * @hooked generate_add_footer_info - 10
                     */
                    do_action( 'generate_credits' );
                    ?>
                </div>
            </div>
        </footer>
        <?php
    }
}

/* Change Search ... to Search */
add_filter( 'generate_search_placeholder', 'yield_search_placeholder' );
function yield_search_placeholder() {
    return 'Search';
}
add_action( 'wp','generate_remove_post_image', 20 );
function generate_remove_post_image() {
    remove_action( 'generate_after_header', 'generate_featured_page_header', 10 );
}
add_action( 'generate_after_header', function() {
    if ( ! is_home() && ! is_front_page() ) {
        if ( function_exists('yoast_breadcrumb') ) {
            yoast_breadcrumb( '<div class="grid-container grid-parent pt-5"><p id="breadcrumbs" class="pt-5 ps-2 text-uppercase">','</p></div>' );
        }
    }
} );

/**
 * Get post thumbnail
 */
add_shortcode( 'get_thumbnail', 'get_thumbnail_cb' );
function get_thumbnail_cb() {
    global $post;
    ob_start();
    ?>
    <img src="<?php echo esc_attr( get_the_post_thumbnail_url( $post->ID, 'full' ) ); ?>" class="img-fluid"/>
    <?php
    return ob_get_clean();
}

/**
 * Pros & Cons area
 */
add_shortcode( 'pros_cons', 'pros_cons_cb' );
function pros_cons_cb() {
    global $post;
    ob_start();
    ?>
    <div class="row">
        <div class="col-md-6">
            <div class="accordion accordion-flush" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Accordion Item #1
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                        </div>
                    </div>
                </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
        Accordion Item #2
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        Accordion Item #3
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>
  </div>
</div>
        </div>
        <div class="col-md-6">
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Accordion Item #1
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            Accordion Item #2
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled with some actual content.</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                            Accordion Item #3
                        </button>
                    </h2>
                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more representative of how this would look in a real-world application.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * CTA button
 */
add_shortcode( 'cta_button', 'cta_button_cb' );
function cta_button_cb() {
    global $post;
    ob_start();
    ?>
    <div class="d-grid gap-2">
        <button class="btn btn-primary" type="button">Buy Now</button>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * Special text area
 */
add_shortcode( 'text', 'text_cb' );
function text_cb() {
    global $post;
    ob_start();
    ?>
    <div class="row bg-primary">
        <h3>TEXT HERE</h3>
        <p>Performing at the highest level requires many things and what it requires most is a peak level of readiness. As a performance coach, it is my job to make sure that the people I coach are as ready and prepared as possible.</p>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * FAQ
 */
add_shortcode( 'faq', 'faq_cb' );
function faq_cb() {
    ob_start();
    ?>
    <div class="accordion accordion-flush" id="accordionFaq">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFaqOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFaqOne" aria-expanded="true" aria-controls="collapseFaqOne">
                        Accordion Item #1
                        </button>
                    </h2>
                    <div id="collapseFaqOne" class="accordion-collapse collapse show" aria-labelledby="headingFaqOne" data-bs-parent="#accordionFaq">
                        <div class="accordion-body">
                            <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                        </div>
                    </div>
                </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingFaqTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFaqTwo" aria-expanded="false" aria-controls="collapseFaqTwo">
        Accordion Item #2
      </button>
    </h2>
    <div id="collapseFaqTwo" class="accordion-collapse collapse" aria-labelledby="headingFaqTwo" data-bs-parent="#accordionFaq">
      <div class="accordion-body">
        <strong>This is the second item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="headingFaqThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFaqThree" aria-expanded="false" aria-controls="collapseFaqThree">
        Accordion Item #3
      </button>
    </h2>
    <div id="collapseFaqThree" class="accordion-collapse collapse" aria-labelledby="headingFaqThree" data-bs-parent="#accordionFaq">
      <div class="accordion-body">
        <strong>This is the third item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
      </div>
    </div>
  </div>
</div>
    <?php
    return ob_get_clean();
}

/**
 * User 
 */