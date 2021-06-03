<?php

// New Menu
add_action('admin_menu', 'admin_panel');
function admin_panel() {
	add_menu_page('Theme Panel', 'Theme Panel', 'manage_options', 'Theme Panel', '', 'dashicons-admin-page', 10);
}

add_action('admin_menu', 'admin_panel_menu');
function admin_panel_menu() {
	global $submenu;
	$submenu['Theme Panel'][0] = array( 'Homepage', 'manage_options', "http://localhost:16000/wp-admin/post.php?post=17&action=edit");
	$submenu['Theme Panel'][1] = array( 'New Review', 'manage_options', "http://localhost:16000/wp-admin/post-new.php?post_type=review");
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

add_action( 'wp_default_scripts', 'dequeue_jquery_migrate' );
function dequeue_jquery_migrate( $scripts ) {
	if ( ! is_admin() && ! empty( $scripts->registered['jquery'] ) ) {
		$scripts->registered['jquery']->deps = array_diff(
			$scripts->registered['jquery']->deps,
			[ 'jquery-migrate' ]
		);
	}
}

if ( is_admin() ) {
    add_action('init', 'remove_editor_from_post');
}
function remove_editor_from_post() {
		$id = isset( $_GET['post'] ) ? $_GET['post'] : null;
		$posts = array( 17 );
		if ( in_array( $id, $posts ) ) {
			$template = get_post_meta($id, '_wp_page_template', true);
			remove_post_type_support('page', 'editor');
		}
}