<?php
class ReacTheme_Notice_notice{	

	public function __construct() {
		add_action( 'init', array( $this, 'rt_notice_register_post_type' ) );		
		add_action( 'init', array( $this, 'rt_create_notice_category' ) );
	}

	// Register notice Post Type
	function rt_notice_register_post_type() {
		$labels = array(
			'name'               => esc_html__( 'Notice', 'rsaddons'),
			'singular_name'      => esc_html__( 'Notice', 'rsaddons'),
			'add_new'            => esc_html_x( 'Add New Notice', 'rsaddons'),
			'add_new_item'       => esc_html__( 'Add New Notice', 'rsaddons'),
			'edit_item'          => esc_html__( 'Edit Notice', 'rsaddons'),
			'new_item'           => esc_html__( 'New Notice', 'rsaddons'),
			'all_items'          => esc_html__( 'All Notice', 'rsaddons'),
			'view_item'          => esc_html__( 'View Notice', 'rsaddons'),
			'search_items'       => esc_html__( 'Search Notice', 'rsaddons'),
			'not_found'          => esc_html__( 'No Notice found', 'rsaddons'),
			'not_found_in_trash' => esc_html__( 'No Notice found in Trash', 'rsaddons'),
			'parent_item_colon'  => esc_html__( 'Parent Notice:', 'rsaddons'),
			'menu_name'          => esc_html__( 'Notice', 'rsaddons'),
		);
		global $unipix_option;
	   	$notice_slug = (!empty($unipix_option['notice_slug']))? $unipix_option['notice_slug'] :'rt-notice';
		$args = array(
			'labels'             => $labels,
			'public'             => true,	
			'show_in_menu'       => true,
			'show_in_admin_bar'  => true,
			'can_export'         => true,
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => 20,		
			'rewrite' => 		 array('slug' => $notice_slug,'with_front' => false),
			'menu_icon'          =>  plugins_url( 'img/icon.png', __FILE__ ),
			'supports'           => array( 'title', 'thumbnail','editor', 'excerpt'),		
		);
		register_post_type( 'rt-notice', $args );
	}

	function rt_create_notice_category() {		
		global $unipix_option;
	   	$category_slug = (!empty($unipix_option['notice_cat_slug']))? $unipix_option['notice_cat_slug'] :'rt-notice-category';
		register_taxonomy(
			'rt-notice-category',
			'rt-notice',
			array(
				'label' => esc_html__( 'Notice Categories','rsaddons'),			
				'hierarchical' => true,
				'show_admin_column' => true,
				'rewrite'           => array('slug' => $category_slug, 'with_front' => false),
			)
		);
	}
}
new ReacTheme_Notice_notice();


