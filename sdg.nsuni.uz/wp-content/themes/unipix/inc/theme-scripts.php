<?php
function unipix_scripts() {
	//register styles
	global $unipix_option;
	wp_enqueue_style( 'boostrap', get_template_directory_uri() .'/assets/css/bootstrap.min.css' );	
	wp_enqueue_style( 'rt-icons', get_template_directory_uri() .'/assets/css/rt-icons.css');
    wp_enqueue_style( 'magnific-popup', get_template_directory_uri() .'/assets/css/magnific-popup.css');
	wp_enqueue_style( 'swiper', get_template_directory_uri().'/assets/css/swiper-bundle.min.css' );
	wp_enqueue_style( 'unipix-style-default', get_template_directory_uri() .'/assets/scss/theme.css' );
	wp_enqueue_style( 'unipix-style', get_stylesheet_uri() );		
	
	// register js 
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '5.2.0', true );
	wp_enqueue_script( 'swiper', get_template_directory_uri().'/assets/js/swiper-bundle.min.js', array('jquery'), '8.2.3');
	wp_enqueue_script( 'jquery-magnific-popup', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array('jquery'), '1.1.0', true );		
	wp_enqueue_script('unipix-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), wp_get_theme()->get( 'Version' ), true);	
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'unipix_scripts' );

add_action( 'wp_enqueue_scripts', 'unipix_rtl_scripts', 1500 );
if ( !function_exists( 'unipix_rtl_scripts' ) ) {
	function unipix_rtl_scripts() {	
		// RTL
		if ( is_rtl() ) {
			wp_enqueue_style( 'unipix-rtl', get_template_directory_uri() . '/assets/css/rtl.css', array(), 1.0 );
		}	
		
	}
}


add_action( 'admin_enqueue_scripts', 'unipix_load_admin_styles' );
function unipix_load_admin_styles($screen) {
	wp_enqueue_style( 'unipix-admin-style', get_template_directory_uri() . '/assets/css/admin-style.css', true, '1.0.0' );
	wp_enqueue_script( 'unipix-admin-script', get_template_directory_uri() . '/assets/js/admin-script.js', array('jquery'), '1.0.0', true );
} 