<?php 
/**
 *Plugin Name: RT Elements
 * Description: Theme core addon pluign.
 * Version:     1.1.2
 * Text Domain: rtelements
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
define( 'RTELEMENTS_FILE', __FILE__ );
define( 'RTELEMENTS_DIR_PATH_PRO', plugin_dir_path( __FILE__ ) );
define( 'RTELEMENTS_DIR_URL_PRO', plugin_dir_url( __FILE__ ) );
define( 'RTELEMENTS_ASSETS_PRO', trailingslashit( RTELEMENTS_DIR_URL_PRO . 'assets' ) );
require RTELEMENTS_DIR_PATH_PRO . 'base.php';
require RTELEMENTS_DIR_PATH_PRO . 'post-type/post-type.php';
require RTELEMENTS_DIR_PATH_PRO . 'shortcode-elementor/elementor-shortcode.php';
require RTELEMENTS_DIR_PATH_PRO . 'inc/custom-rt-icon.php';
require RTELEMENTS_DIR_PATH_PRO . 'header-footer-elementor/header-footer-elementor.php';
require RTELEMENTS_DIR_PATH_PRO . 'jet-search/jet-search.php';
//support svg image funciton
function unipix_mime_types($mimes) {
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'unipix_mime_types');