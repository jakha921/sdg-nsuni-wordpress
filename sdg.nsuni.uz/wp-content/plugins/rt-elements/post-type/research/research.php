<?php
class ReacTheme_Project_Research{	

	public function __construct() {
		add_action( 'init', array( $this, 'rt_research_register_post_type' ) );		
		add_action( 'init', array( $this, 'rt_create_research_category' ) );
	}

	// Register research Post Type
	function rt_research_register_post_type() {
		$labels = array(
			'name'               => esc_html__( 'Research', 'rsaddons'),
			'singular_name'      => esc_html__( 'Research', 'rsaddons'),
			'add_new'            => esc_html_x( 'Add New Research', 'rsaddons'),
			'add_new_item'       => esc_html__( 'Add New Research', 'rsaddons'),
			'edit_item'          => esc_html__( 'Edit Research', 'rsaddons'),
			'new_item'           => esc_html__( 'New Research', 'rsaddons'),
			'all_items'          => esc_html__( 'All Research', 'rsaddons'),
			'view_item'          => esc_html__( 'View Research', 'rsaddons'),
			'search_items'       => esc_html__( 'Search Research', 'rsaddons'),
			'not_found'          => esc_html__( 'No Research found', 'rsaddons'),
			'not_found_in_trash' => esc_html__( 'No Research found in Trash', 'rsaddons'),
			'parent_item_colon'  => esc_html__( 'Parent Research:', 'rsaddons'),
			'menu_name'          => esc_html__( 'Research', 'rsaddons'),
		);
		global $unipix_option;
	   	$research_slug = (!empty($unipix_option['research_slug'])) ? $unipix_option['research_slug'] : 'rt-research';
		$args = array(
			'labels'             => $labels,
			'public'             => true,	
			'show_in_menu'       => true,
			'show_in_admin_bar'  => true,
			'can_export'         => true,
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => 20,		
			'rewrite' => 		 array('slug' => $research_slug,'with_front' => false),
			'menu_icon'          =>  plugins_url( 'img/icon.png', __FILE__ ),
			'supports'           => array( 'title', 'thumbnail','editor', 'excerpt'),		
		);
		register_post_type( 'rt-research', $args );
	}

	function rt_create_research_category() {
		global $unipix_option;
		$category_slug = (!empty($unipix_option['research_category_slug'])) ? $unipix_option['research_category_slug'] : 'rt-research-category';
		register_taxonomy(
			'rt-research-category',
			'rt-research',
			array(
				'label' => esc_html__( 'Research Categories','rsaddons'),			
				'hierarchical' => true,
				'show_admin_column' => true,
				'rewrite'           => array('slug' => $category_slug, 'with_front' => false),
			)
		);
	}
}
new ReacTheme_Project_Research();


