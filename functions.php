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
    wp_enqueue_style( 'fa', 'https://use.fontawesome.com/releases/v5.15.3/css/all.css' );
    wp_enqueue_style( 'custom-sylesheet', get_stylesheet_directory_uri() . '/css/custom.css' );
    wp_enqueue_style( 'theme-stylesheet', get_stylesheet_uri(), false );

    wp_enqueue_script( 'bootstrap', get_stylesheet_directory_uri() . '/js/bootstrap.bundle.min.js', array(), null, true );
    wp_enqueue_script( 'custom', get_stylesheet_directory_uri() . '/js/custom.js', array( 'jquery' ), null, true );
}
add_action( 'wp_enqueue_scripts', 'yield_enqueue_style' );

add_action( 'generate_before_footer_content', 'about_section' );
function about_section() {
    if ( is_front_page() ) {
        include_once "section/about.php";
    }
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
            <div id="footer-widgets" class="site footer-widgets bg-about m-0">
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
                $inside_site_info_class = ' grid-container';
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
    $pros = get_field('pros', $post->ID );
    $cons = get_field('cons', $post->ID );
    ob_start();
    ?>
    <div class="row pros-cons">
        <div class="col-md-6 p-2 ps-0">
            <div class="bg-info">
                <h5 class="fw-bold left-bar m-0"><?php esc_html_e( 'PROS', 'generatepress' ); ?></h5>
                <ul class="">
                <?php foreach ( $pros as $key => $value ) : ?>
                    <li>
                        <?php echo esc_html($value['topic']); ?>        
                    </li>
                <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="col-md-6 p-2 ps-0">
            <div class="bg-info">
                <h5 class="left-bar fw-bold m-0"><?php esc_html_e( 'CONS', 'generatepress' ); ?></h5>
                <ul class="">
                <?php foreach ( $cons   as $key => $value ) : ?>
                    <li>
                        <?php echo esc_html( $value['topic'] ); ?>
                    </li>
                <?php endforeach; ?>
                </ul>
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
    $text = get_field( 'cta_button_text', $post->ID );
    $bg_color = get_field( 'cta_button_color', $post->ID);
    $link = get_field( 'cta_button_link', $post->ID);
    ob_start();
    ?>
    <div class="d-grid">
        <a href="<?php echo esc_attr( $link ); ?>" class="btn cta-btn" type="button" style="background-color: <?php echo esc_attr( $bg_color ); ?>"><?php echo esc_html( $text ); ?></a>
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
    $title = get_field( 'notice_title', $post->ID );
    $description = get_field( 'notice_description', $post->ID );
    ob_start();
    ?>
    <div class="row bg-info pt-4 notice">
        <h5 class="fw-bold left-bar raleway-semibold ps-4 mb-3"><?php echo esc_html( $title ); ?></h5>
        <p class="ps-4 pe-4"><?php echo esc_html( $description ); ?></p>
    </div>
    <?php
    return ob_get_clean();
}

/**
 * FAQ
 */
add_shortcode( 'faq', 'faq_cb' );
function faq_cb() {
    global $post;
    $faqs = get_field( 'faq', $post->ID );
    ob_start();
    if ( ! empty( $faqs ) ) :
    ?>
    <h2 class="border-top border-bottom py-4 raleway-semibold mb-0 mt-5">FAQ</h2>
    <div class="accordion accordion-flush border-bottom mb-5" id="accordionFaq">
        <?php foreach ( $faqs as $key => $value ) : ?>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFaqOne">
                <button class="raleway-semibold accordion-button <?php echo $key ? 'collapsed' : ''; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFaq<?php echo esc_attr( $key ); ?>" aria-expanded="true" aria-controls="collapseFaqOne">
                <?php echo esc_html( $value['faq_title'] ); ?>
                </button>
            </h2>
            <div id="collapseFaq<?php echo esc_attr( $key ); ?>" class="accordion-collapse collapse <?php echo ! $key ? 'show' : ''; ?>" aria-labelledby="headingFaqOne" data-bs-parent="#accordionFaq">
                <div class="accordion-body">
                <?php echo esc_html( $value['faq_description'] ); ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php
    endif;
    return ob_get_clean();
}

/**
 * User 
 */

// New Menu
add_action('admin_menu', 'admin_panel');
function admin_panel() {
	add_menu_page('Theme Panel', 'Theme Panel', 'manage_options', 'Theme Panel', '', 'dashicons-admin-page', 10);
}

add_action('admin_menu', 'admin_panel_menu');
function admin_panel_menu() {
	global $submenu;
	$submenu['Theme Panel'][0] = array( 'Homepage', 'manage_options', "https://searchacademia.com/tests/mrinal/wp-admin/post.php?post=29&action=edit");
	$submenu['Theme Panel'][1] = array( 'Review page', 'manage_options', "https://searchacademia.com/tests/mrinal/wp-admin/post.php?post=208&action=edit");
    $submenu['Theme Panel'][2] = array( 'Author box', 'manage_options', "");
}


// disable emojis
add_action( 'init', 'disable_emojis' );
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	
	// Remove from TinyMCE
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}


/**
 * Filter out the tinymce emoji plugin.
 */
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}


add_action( 'admin_enqueue_scripts', 'shapeSpace_disable_scripts_styles_admin_area', 100 );
function shapeSpace_disable_scripts_styles_admin_area() {
	wp_dequeue_style('jquery-ui-css');
}



function dequeue_jquery_migrate( $scripts ) {
	if ( ! is_admin() && ! empty( $scripts->registered['jquery'] ) ) {
		$scripts->registered['jquery']->deps = array_diff(
			$scripts->registered['jquery']->deps,
			[ 'jquery-migrate' ]
		);
	}
}
add_action( 'wp_default_scripts', 'dequeue_jquery_migrate' );

add_action('init', 'remove_editor_from_post');
function remove_editor_from_post() {
		$id = $_GET['post'];
		$posts = array(29);
		if ( in_array( $id, $posts ) ) {
			$template = get_post_meta($id, '_wp_page_template', true);
			remove_post_type_support('page', 'editor');
		}
}

include_once "inc/related-widget.php";