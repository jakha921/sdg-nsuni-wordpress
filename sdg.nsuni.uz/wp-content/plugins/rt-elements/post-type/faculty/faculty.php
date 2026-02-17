<?php
class ReacTheme_Project_Faculty{	

	public function __construct() {
		add_action( 'init', array( $this, 'rt_faculty_register_post_type' ) );		
		add_action( 'init', array( $this, 'rt_create_faculty_category' ) );
	}

	// Register Faculty Post Type
	function rt_faculty_register_post_type() {
		$labels = array(
			'name'               => esc_html__( 'Faculty', 'rsaddons'),
			'singular_name'      => esc_html__( 'Faculty', 'rsaddons'),
			'add_new'            => esc_html_x( 'Add New Faculty', 'rsaddons'),
			'add_new_item'       => esc_html__( 'Add New Faculty', 'rsaddons'),
			'edit_item'          => esc_html__( 'Edit Faculty', 'rsaddons'),
			'new_item'           => esc_html__( 'New Faculty', 'rsaddons'),
			'all_items'          => esc_html__( 'All Faculty', 'rsaddons'),
			'view_item'          => esc_html__( 'View Faculty', 'rsaddons'),
			'search_items'       => esc_html__( 'Search Faculty', 'rsaddons'),
			'not_found'          => esc_html__( 'No Faculty found', 'rsaddons'),
			'not_found_in_trash' => esc_html__( 'No Faculty found in Trash', 'rsaddons'),
			'parent_item_colon'  => esc_html__( 'Parent Faculty:', 'rsaddons'),
			'menu_name'          => esc_html__( 'Faculty', 'rsaddons'),
		);
		global $unipix_option;
		$faculty_slug = (!empty($unipix_option['faculty_slug'])) ? $unipix_option['faculty_slug'] : 'rt-faculty';
		$args = array(
			'labels'             => $labels,
			'public'             => true,	
			'show_in_menu'       => true,
			'show_in_admin_bar'  => true,
			'can_export'         => true,
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => 20,		
			'rewrite' => 		 array('slug' => $faculty_slug,'with_front' => false),
			'menu_icon'          =>  plugins_url( 'img/icon.png', __FILE__ ),
			'supports'           => array( 'title', 'thumbnail','editor', 'excerpt'),		
		);
		register_post_type( 'rt-faculty', $args );
	}

	function rt_create_faculty_category() {
		global $unipix_option;
		$category_slug = (!empty($unipix_option['faculty_cat_slug'])) ? $unipix_option['faculty_cat_slug'] : 'rt-faculty-category';
		register_taxonomy(
			'rt-faculty-category',
			'rt-faculty',
			array(
				'label' => esc_html__( 'Faculty Categories','rsaddons'),			
				'hierarchical' => true,
				'show_admin_column' => true,
				'rewrite'           => array('slug' => $category_slug, 'with_front' => false),
			)
		);
	}
}
new ReacTheme_Project_Faculty();
