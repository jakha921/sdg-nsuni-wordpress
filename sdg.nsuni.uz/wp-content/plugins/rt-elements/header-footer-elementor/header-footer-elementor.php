<?php
define( 'Rts_HFE_VER', '1.6.13' );
define( 'Rts_HFE_FILE', __FILE__ );
define( 'Rts_HFE_DIR', plugin_dir_path( __FILE__ ) );
define( 'Rts_HFE_URL', plugins_url( '/', __FILE__ ) );
define( 'Rts_HFE_PATH', plugin_basename( __FILE__ ) );
define( 'Rts_HFE_DOMAIN', trailingslashit( 'https://ultimateelementor.com' ) );

/**
 * Load the class loader.
 */
require_once Rts_HFE_DIR . '/inc/class-header-footer-elementor.php';

/**
 * Load the Plugin Class.
 */
function Rts_hfe_plugin_activation() {
	update_option( 'Rts_hfe_plugin_is_activated', 'yes' );
}

register_activation_hook( Rts_HFE_FILE, 'Rts_hfe_plugin_activation' );

/**
 * Load the Plugin Class.
 */
function Rts_hfe_init() {
	Rts_Header_Footer_Elementor::instance();
}

add_action( 'plugins_loaded', 'Rts_hfe_init' );

function rts_enqueue_font_awesome() {
    if ( class_exists( 'Elementor\Plugin' ) ) {
        // Ensure Elementor Icons CSS is loaded.
        wp_enqueue_style(
            'hfe-elementor-icons',
            plugins_url( '/elementor/assets/lib/eicons/css/elementor-icons.min.css', 'elementor' ),
            [],
            '5.34.0'
        );
        wp_enqueue_style(
            'hfe-icons-list',
            plugins_url( '/elementor/assets/css/widget-icon-list.min.css', 'elementor' ),
            [],
            '3.24.3'
        );
        wp_enqueue_style(
            'hfe-social-icons',
            plugins_url( '/elementor/assets/css/widget-social-icons.min.css', 'elementor' ),
            [],
            '3.24.0'
        );
        wp_enqueue_style(
            'hfe-social-share-icons-brands',
            plugins_url( '/elementor/assets/lib/font-awesome/css/brands.css', 'elementor' ),
            [],
            '5.15.3'
        );
        wp_enqueue_style(
            'hfe-social-share-icons-fontawesome',
            plugins_url( '/elementor/assets/lib/font-awesome/css/fontawesome.css', 'elementor' ),
            [],
            '5.15.3'
        );
        wp_enqueue_style(
            'hfe-nav-menu-icons',
            plugins_url( '/elementor/assets/lib/font-awesome/css/solid.css', 'elementor' ),
            [],
            '5.15.3'
        );
    }
    if ( class_exists( '\ElementorPro\Plugin' ) ) {
        wp_enqueue_style(
            'hfe-widget-blockquote',
            plugins_url( '/elementor-pro/assets/css/widget-blockquote.min.css', 'elementor' ),
            [],
            '3.25.0'
        );
        wp_enqueue_style(
            'hfe-mega-menu',
            plugins_url( '/elementor-pro/assets/css/widget-mega-menu.min.css', 'elementor' ),
            [],
            '3.26.2'
        );
        wp_enqueue_style(
            'hfe-nav-menu-widget',
            plugins_url( '/elementor-pro/assets/css/widget-nav-menu.min.css', 'elementor' ),
            [],
            '3.26.0'
        );
    }
}
add_action( 'wp_enqueue_scripts', 'rts_enqueue_font_awesome', 20 );