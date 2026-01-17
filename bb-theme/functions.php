<?php
/**
 * BB Cigarettes Theme Functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Theme Setup
function bb_theme_setup() {
	// Add theme support
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
	add_theme_support( 'custom-logo' );
	
	// Register navigation menus
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'bb-cigarettes' ),
		'footer'  => __( 'Footer Menu', 'bb-cigarettes' ),
	) );
}
add_action( 'after_setup_theme', 'bb_theme_setup' );

// Enqueue Styles and Scripts
function bb_theme_scripts() {
	// Google Fonts
	wp_enqueue_style( 'bb-google-fonts', 'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap', array(), null );
	
	// Main stylesheet
	wp_enqueue_style( 'bb-assets', get_template_directory_uri() . '/assets.css', array('bb-google-fonts'), '1.0.0' );
	
	// Page-specific styles
	wp_enqueue_style( 'bb-page-styles', get_template_directory_uri() . '/page-styles.css', array('bb-assets'), '1.0.0' );
	
	// Main JavaScript
	wp_enqueue_script( 'bb-main', get_template_directory_uri() . '/js/main.js', array(), '1.0.0', true );
	
	// Localize script for AJAX
	wp_localize_script( 'bb-main', 'bbTheme', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'nonce'   => wp_create_nonce( 'bb-nonce' )
	) );
}
add_action( 'wp_enqueue_scripts', 'bb_theme_scripts' );

// Age Verification Check
function bb_check_age_verification() {
	if ( ! isset( $_COOKIE['bb_age_verified'] ) ) {
		return true; // Show popup
	}
	return false;
}

// Set age verification cookie
function bb_set_age_verified() {
	check_ajax_referer( 'bb-nonce', 'nonce' );
	setcookie( 'bb_age_verified', '1', time() + ( 30 * DAY_IN_SECONDS ), COOKIEPATH, COOKIE_DOMAIN );
	wp_send_json_success();
}
add_action( 'wp_ajax_bb_age_verify', 'bb_set_age_verified' );
add_action( 'wp_ajax_nopriv_bb_age_verify', 'bb_set_age_verified' );

// Custom Image Sizes
add_image_size( 'bb-hero', 800, 800, false );
add_image_size( 'bb-product', 400, 400, false );
add_image_size( 'bb-thumbnail', 300, 300, true );

/**
 * Automatic Page Creation on Theme Activation
 */
function bb_create_default_pages() {
	// Check if pages already created
	if ( get_option( 'bb_pages_created' ) ) {
		return;
	}

	// Define all pages to create
	$pages = array(
		array(
			'title'    => 'Home',
			'template' => 'front-page.php',
			'slug'     => 'home'
		),
		array(
			'title'    => 'BB Full Flavor',
			'template' => 'template-full-flavor.php',
			'slug'     => 'bb-full-flavor',
			'content'  => 'Premium full-bodied BB Cigarettes'
		),
		array(
			'title'    => 'BB Lights',
			'template' => 'template-lights.php',
			'slug'     => 'bb-lights',
			'content'  => 'Smooth and mellow BB Lights Cigarettes'
		),
		array(
			'title'    => 'BB Menthol',
			'template' => 'template-menthol.php',
			'slug'     => 'bb-menthol',
			'content'  => 'Cool and refreshing BB Menthol Cigarettes'
		),
		array(
			'title'    => 'About Us',
			'template' => 'template-about.php',
			'slug'     => 'about',
			'content'  => 'Learn more about BB Cigarettes'
		),
		array(
			'title'    => 'Contact',
			'template' => 'template-contact.php',
			'slug'     => 'contact',
			'content'  => 'Get in touch with BB Cigarettes'
		),
		array(
			'title'    => 'Privacy Policy',
			'template' => 'template-privacy.php',
			'slug'     => 'privacy-policy',
			'content'  => 'Our privacy policy and data protection practices'
		),
		array(
			'title'    => 'Terms and Conditions',
			'template' => 'template-terms.php',
			'slug'     => 'terms-and-conditions',
			'content'  => 'Terms and conditions for using BB Cigarettes'
		)
	);

	// Create each page
	foreach ( $pages as $page ) {
		// Check if page already exists
		$existing_page = get_page_by_path( $page['slug'] );
		
		if ( ! $existing_page ) {
			$page_data = array(
				'post_title'   => $page['title'],
				'post_content' => isset( $page['content'] ) ? $page['content'] : '',
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_name'    => $page['slug']
			);

			// Insert the page
			$page_id = wp_insert_post( $page_data );

			// Set the page template
			if ( $page_id && isset( $page['template'] ) ) {
				update_post_meta( $page_id, '_wp_page_template', $page['template'] );
			}

			// Set the homepage
			if ( $page['slug'] === 'home' && $page_id ) {
				update_option( 'page_on_front', $page_id );
				update_option( 'show_on_front', 'page' );
			}
		}
	}

	// Mark as created
	update_option( 'bb_pages_created', true );
}
add_action( 'after_switch_theme', 'bb_create_default_pages' );
