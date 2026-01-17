<?php
/**
 * BB Astra Child Theme functions and definitions
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * 1. Enqueue Scripts and Styles
 */
function bb_child_enqueue_styles() {
	wp_enqueue_style( 'astra-parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'bb-google-fonts', 'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap', array(), null );
	wp_enqueue_style( 
		'bb-custom-styles', 
		get_stylesheet_directory_uri() . '/assets/css/bb-styles.css', 
		array('astra-parent-style', 'bb-google-fonts'), 
		'1.0.2' 
	);
}
add_action( 'wp_enqueue_scripts', 'bb_child_enqueue_styles' );

/**
 * 2. Register Custom Post Type: Products
 */
function bb_register_product_cpt() {
	$labels = array(
		'name'                  => _x( 'Products', 'Post Type General Name', 'bb-astra-child' ),
		'singular_name'         => _x( 'Product', 'Post Type Singular Name', 'bb-astra-child' ),
		'menu_name'             => __( 'BB Products', 'bb-astra-child' ),
	);
	$args = array(
		'label'                 => __( 'Product', 'bb-astra-child' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'excerpt' ),
		'taxonomies'            => array( 'category' ),
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-cart',
		'has_archive'           => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'bb_product', $args );
}
add_action( 'init', 'bb_register_product_cpt', 0 );

/**
 * 3. Register Custom Elementor Category and Widgets
 */
function bb_add_elementor_widget_categories( $elements_manager ) {
	$elements_manager->add_category(
		'bb-theme-widgets',
		[
			'title' => __( 'BB Theme Widgets', 'bb-astra-child' ),
			'icon'  => 'fa fa-plug',
		]
	);
}
add_action( 'elementor/elements/categories_registered', 'bb_add_elementor_widget_categories' );

function bb_register_elementor_widgets( $widgets_manager ) {
	require_once( __DIR__ . '/widgets/class-core-widgets.php' );
	require_once( __DIR__ . '/widgets/class-extra-widgets.php' );

	$widgets_manager->register( new \BB_Hero_Widget() );
	$widgets_manager->register( new \BB_Intro_Widget() );
	$widgets_manager->register( new \BB_Brand_Stats_Widget() );
	$widgets_manager->register( new \BB_Quality_Widget() );
	$widgets_manager->register( new \BB_Variants_Widget() );
	$widgets_manager->register( new \BB_Benefits_Widget() );
	$widgets_manager->register( new \BB_Purchase_Steps_Widget() );
	$widgets_manager->register( new \BB_FAQ_Widget() );
    $widgets_manager->register( new \BB_CTA_Widget() );

    $widgets_manager->register( new \BB_Testimonial_Widget() );
    $widgets_manager->register( new \BB_Pricing_Table_Widget() );
    $widgets_manager->register( new \BB_Team_Member_Widget() );
    $widgets_manager->register( new \BB_Content_Split_Widget() );
    $widgets_manager->register( new \BB_Logo_Grid_Widget() );
    $widgets_manager->register( new \BB_Newsletter_Widget() );
    $widgets_manager->register( new \BB_Process_Timeline_Widget() );
    $widgets_manager->register( new \BB_Stat_Counter_Widget() );
    $widgets_manager->register( new \BB_Video_Popup_Widget() );
    $widgets_manager->register( new \BB_CTA_Strip_Widget() ); 
}
add_action( 'elementor/widgets/register', 'bb_register_elementor_widgets' );

/**
 * 4. Header & Footer Override Logic
 */
function bb_override_astra_header() {
    $header = get_page_by_path('site-header', OBJECT, 'elementor_library');
    if ($header) {
        remove_action( 'astra_header', 'astra_header_markup' );
        echo do_shortcode( '[elementor-template id="' . $header->ID . '"]' );
    }
}
add_action( 'get_header', 'bb_override_astra_header' );

function bb_override_astra_footer() {
    $footer = get_page_by_path('site-footer', OBJECT, 'elementor_library');
    if ($footer) {
        remove_action( 'astra_footer', 'astra_footer_markup' );
        echo do_shortcode( '[elementor-template id="' . $footer->ID . '"]' );
    }
}
add_action( 'get_footer', 'bb_override_astra_footer' );

/**
 * 5. Automatic Site Setup & Image Sideloading
 */

/**
 * Helper: Sideload image from theme assets to Media Library
 */
function bb_sideload_image( $filename ) {
    $file_path = get_stylesheet_directory() . '/assets/images/' . $filename;
    if ( ! file_exists( $file_path ) ) return false;

    // Check if already in media library
    global $wpdb;
    $attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = '_wp_attached_file' AND meta_value LIKE %s", '%' . $filename . '%' ) );
    if ( $attachment_id ) return $attachment_id;

    // Sideload
    require_once( ABSPATH . 'wp-admin/includes/image.php' );
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
    require_once( ABSPATH . 'wp-admin/includes/media.php' );

    $upload = wp_upload_bits( $filename, null, file_get_contents( $file_path ) );
    if ( ! $upload['error'] ) {
        $wp_filetype = wp_check_filetype( $filename, null );
        $attachment = array(
            'post_mime_type' => $wp_filetype['type'],
            'post_title'     => preg_replace( '/\.[^.]+$/', '', $filename ),
            'post_content'   => '',
            'post_status'    => 'inherit'
        );
        $attachment_id = wp_insert_attachment( $attachment, $upload['file'] );
        if ( ! is_wp_error( $attachment_id ) ) {
            $attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload['file'] );
            wp_update_attachment_metadata( $attachment_id, $attachment_data );
            return $attachment_id;
        }
    }
    return false;
}

function bb_theme_activation_setup() {
    if ( get_option( 'bb_theme_complete_setup_done' ) ) return;

    // 1. Sideload images and build map
    $images = ['hero-product.png', 'intro-detail.png', 'full-flavor-pack.png', 'lights-pack.png', 'menthol-pack.png', 'tobacco-blend.png', 'online-order.png'];
    $img_map = [];
    foreach($images as $img) {
        $id = bb_sideload_image($img);
        if($id) $img_map[$img] = ['id' => $id, 'url' => wp_get_attachment_url($id)];
    }

    // 2. Setup Homepage
    $home_title = 'Home';
    $home_id = wp_insert_post( [ 'post_title' => $home_title, 'post_status' => 'publish', 'post_type' => 'page' ] );
    if ( $home_id ) {
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $home_id );
        update_post_meta( $home_id, '_wp_page_template', 'elementor_header_footer' );

        $home_data = [
            [
                'id' => 'sec_hero', 'elType' => 'section', 'settings' => [], 'elements' => [
                    [ 'id' => 'col_hero', 'elType' => 'column', 'settings' => [], 'elements' => [
                        [ 'id' => 'w_hero', 'elType' => 'widget', 'settings' => [
                            'title' => 'BB Cigarettes', 
                            'badge_text' => 'Premium Quality Since Inception', 
                            'subtitle' => 'Experience a <strong>smooth and rich</strong> premium smoking experience crafted with the <strong>highest quality ingredients</strong> for a <strong>consistent and satisfying</strong> taste.',
                            'btn_1_text' => 'Buy BB Cigarettes Online',
                            'btn_1_link' => ['url' => 'https://1smokes.ca/bb-cigarettes/'],
                            'btn_2_text' => 'View Products',
                            'btn_2_link' => ['url' => 'https://1smokes.ca/bb-cigarettes/'],
                            'show_calculator' => 'yes',
                            'image' => isset($img_map['hero-product.png']) ? $img_map['hero-product.png'] : []
                        ], 'widgetType' => 'bb_hero' ]
                    ] ]
                ]
            ],
            [
                'id' => 'sec_intro', 'elType' => 'section', 'settings' => [], 'elements' => [
                    [ 'id' => 'col_intro', 'elType' => 'column', 'settings' => [], 'elements' => [
                        [ 'id' => 'w_intro', 'elType' => 'widget', 'settings' => [
                            'title' => 'Truly Premium Tobacco', 'image' => isset($img_map['intro-detail.png']) ? $img_map['intro-detail.png'] : []
                        ], 'widgetType' => 'bb_intro' ]
                    ] ]
                ]
            ],
            [
                'id' => 'sec_variants', 'elType' => 'section', 'settings' => [], 'elements' => [
                    [ 'id' => 'col_variants', 'elType' => 'column', 'settings' => [], 'elements' => [
                        [ 'id' => 'w_variants', 'elType' => 'widget', 'settings' => [
                            'products' => [
                                ['name'=>'BB Full Flavor', 'image'=>isset($img_map['full-flavor-pack.png']) ? $img_map['full-flavor-pack.png'] : []],
                                ['name'=>'BB Lights', 'image'=>isset($img_map['lights-pack.png']) ? $img_map['lights-pack.png'] : []]
                            ]
                        ], 'widgetType' => 'bb_variants' ]
                    ] ]
                ]
            ]
        ];
        update_post_meta( $home_id, '_elementor_edit_mode', 'builder' );
        update_post_meta( $home_id, '_elementor_template_type', 'wp-page' );
        update_post_meta( $home_id, '_elementor_data', json_encode( $home_data ) );
    }

    // 3. Setup Product Pages
    $products = ['BB Full Flavor', 'BB Lights', 'BB Menthol'];
    foreach($products as $p) {
        $p_id = wp_insert_post( [ 'post_title' => $p, 'post_status' => 'publish', 'post_type' => 'page' ] );
        if ($p_id) {
            update_post_meta( $p_id, '_elementor_edit_mode', 'builder' );
            update_post_meta( $p_id, '_elementor_template_type', 'wp-page' );
            update_post_meta( $p_id, '_wp_page_template', 'elementor_header_footer' );
        }
    }

    update_option( 'bb_theme_complete_setup_done', true );
}
add_action( 'after_switch_theme', 'bb_theme_activation_setup' );
