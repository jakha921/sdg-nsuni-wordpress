<?php
class ReacTheme_Project_Department {	

    public function __construct() {
        add_action( 'init', array( $this, 'rt_department_register_post_type' ) );		
        add_action( 'init', array( $this, 'rt_create_department_category' ) );
        add_action( 'init', array( $this, 'rt_program_register_post_type' ) );   
        add_action( 'init', array( $this, 'rt_create_program_category' ) );  
    }

    // Register Department Post Type
    public function rt_department_register_post_type() {
        $labels = array(
            'name'               => esc_html__( 'Department', 'rsaddons'),
            'singular_name'      => esc_html__( 'Department', 'rsaddons'),
            'add_new'            => esc_html_x( 'Add New Department', 'rsaddons'),
            'add_new_item'       => esc_html__( 'Add New Department', 'rsaddons'),
            'edit_item'          => esc_html__( 'Edit Department', 'rsaddons'),
            'new_item'           => esc_html__( 'New Department', 'rsaddons'),
            'all_items'          => esc_html__( 'All Department', 'rsaddons'),
            'view_item'          => esc_html__( 'View Department', 'rsaddons'),
            'search_items'       => esc_html__( 'Search Department', 'rsaddons'),
            'not_found'          => esc_html__( 'No Department found', 'rsaddons'),
            'not_found_in_trash' => esc_html__( 'No Department found in Trash', 'rsaddons'),
            'parent_item_colon'  => esc_html__( 'Parent Department:', 'rsaddons'),
            'menu_name'          => esc_html__( 'Department', 'rsaddons'),
        );

        global $unipix_option;
        $department_slug = (!empty($unipix_option['department_slug'])) ? $unipix_option['department_slug'] : 'rt-department';

        $args = array(
            'labels'             => $labels,
            'public'             => true,	
            'show_in_menu'       => true,
            'show_in_admin_bar'  => true,
            'can_export'         => true,
            'has_archive'        => false,
            'hierarchical'       => false,
            'menu_position'      => 25,		
            'rewrite'            => array('slug' => $department_slug, 'with_front' => false),
            'menu_icon'          => plugins_url( 'img/icon.png', __FILE__ ),
            'supports'           => array( 'title', 'thumbnail', 'editor', 'excerpt' ),		
        );

        register_post_type( 'rt-department', $args );
    }

    public function rt_create_department_category() {		
        global $unipix_option;
		$dep_category_slug = (!empty($unipix_option['department_cat_slug'])) ? $unipix_option['department_cat_slug'] : 'rt-department-category';
        register_taxonomy(
            'rt-department-category',
            'rt-department',
            array(
                'label'             => esc_html__( 'Department Categories', 'rsaddons' ),
                'hierarchical'      => true,
                'show_admin_column' => true,
				'rewrite'           => array('slug' => $dep_category_slug, 'with_front' => false),
            )
        );
    }


    // program sub post type 
	function rt_program_register_post_type() {
		$labels = array(
			'name'               => esc_html__( 'Program', 'rsaddons'),
			'singular_name'      => esc_html__( 'Program', 'rsaddons'),
			'add_new'            => esc_html_x( 'Add New Program', 'rsaddons'),
			'add_new_item'       => esc_html__( 'Add New Program', 'rsaddons'),
			'edit_item'          => esc_html__( 'Edit Program', 'rsaddons'),
			'new_item'           => esc_html__( 'New Program', 'rsaddons'),
			'all_items'          => esc_html__( 'All Program', 'rsaddons'),
			'view_item'          => esc_html__( 'View Program', 'rsaddons'),
			'search_items'       => esc_html__( 'Search Program', 'rsaddons'),
			'not_found'          => esc_html__( 'No Program found', 'rsaddons'),
			'not_found_in_trash' => esc_html__( 'No Program found in Trash', 'rsaddons'),
			'parent_item_colon'  => esc_html__( 'Parent Program:', 'rsaddons'),
			'menu_name'          => esc_html__( 'Program', 'rsaddons'),
		);
	
		global $unipix_option;
		$rt_program_slug = (!empty($unipix_option['rt_program_slug'])) ? $unipix_option['rt_program_slug'] : 'rt-program';
	
		$args = array(
			'labels'             => $labels,
			'public'             => true,	
			'show_in_menu'       => true,
			'show_in_admin_bar'  => true,
			'show_in_nav_menus'  => false,
			'can_export'         => true,
			'has_archive'        => false,
			'hierarchical'       => false,
			'rewrite'            => array('slug' => $rt_program_slug, 'with_front' => false),
			'menu_icon'          => plugins_url( 'img/icon.png', __FILE__ ),
			'supports'           => array( 'title', 'thumbnail', 'editor', 'excerpt' ),		
		);
	
		register_post_type( 'rt-program', $args );        
	}
    public function rt_create_program_category() {	
        global $unipix_option;
		$program_category_slug = (!empty($unipix_option['program_cat_slug'])) ? $unipix_option['program_cat_slug'] : 'rt-program-category';	
        register_taxonomy(
            'rt-program-category',
            'rt-program',
            array(
                'label'             => esc_html__( 'Program Categories', 'rsaddons' ),
                'hierarchical'      => true,
                'show_admin_column' => true,
				'rewrite'           => array('slug' => $program_category_slug, 'with_front' => false),
            )
        );
    }
	
}
new ReacTheme_Project_Department();


// Register Program Post type 
function program_submenu_register() {
    add_submenu_page(
        'edit.php?post_type=rt-department', 
        'Program', 
        'Program', 
        'manage_options', 
        'edit.php?post_type=rt-program', 
        '',
		null
    );		
}
add_action('admin_menu', 'program_submenu_register');

function rt_add_program_category_menu() {
    add_submenu_page(
        'edit.php?post_type=rt-department', // Parent menu (related to Department)
        esc_html__( 'Program Categories', 'rsaddons' ), // Page title
        esc_html__( 'Program Categories', 'rsaddons' ), // Menu title
        'manage_options', // Capability
        'edit-tags.php?taxonomy=rt-program-category&post_type=rt-program' // Taxonomy URL
    );
}
add_action( 'admin_menu', 'rt_add_program_category_menu' );


function rt_program_register_post_type() {
    $labels = array(
        'name'               => esc_html__( 'Program', 'rsaddons'),
        'singular_name'      => esc_html__( 'Program', 'rsaddons'),
        'add_new'            => esc_html_x( 'Add New Program', 'rsaddons'),
        'add_new_item'       => esc_html__( 'Add New Program', 'rsaddons'),
        'edit_item'          => esc_html__( 'Edit Program', 'rsaddons'),
        'new_item'           => esc_html__( 'New Program', 'rsaddons'),
        'all_items'          => esc_html__( 'All Program', 'rsaddons'),
        'view_item'          => esc_html__( 'View Program', 'rsaddons'),
        'search_items'       => esc_html__( 'Search Program', 'rsaddons'),
        'not_found'          => esc_html__( 'No Program found', 'rsaddons'),
        'not_found_in_trash' => esc_html__( 'No Program found in Trash', 'rsaddons'),
        'parent_item_colon'  => esc_html__( 'Parent Program:', 'rsaddons'),
        'menu_name'          => esc_html__( 'Program', 'rsaddons'),
    );

    global $unipix_option;
    $program_slug = (!empty($unipix_option['program_slug'])) ? $unipix_option['program_slug'] : 'rt-program';
    $args = array(
        'labels'             => $labels,
        'public'             => true,	
        'show_in_menu'       => true,
        'show_in_admin_bar'  => true,
        'show_in_nav_menus'  => false,
        'can_export'         => true,
        'has_archive'        => false,
        'hierarchical'       => false,
        'rewrite'            => array('slug' => $program_slug, 'with_front' => false),
        'menu_icon'          => plugins_url( 'img/icon.png', __FILE__ ),
        'supports'           => array( 'title', 'thumbnail', 'editor', 'excerpt' ),		
    );
    register_post_type( 'rt-program', $args);

    
}
add_action( 'init', 'rt_program_register_post_type' );



function remove_program_post_type_menu() {
    remove_menu_page('edit.php?post_type=rt-program'); 
}
add_action('admin_menu', 'remove_program_post_type_menu', 9);




/**** department Select Faculty ***/
add_action('cmb2_admin_init', 'department_field_metabox');

function department_field_metabox() {
	$prefix = 'rt_department_';

	/**
	 * Metabox for selecting a department in the Faculty post type
	 */
	$cmb_faculty_dep = new_cmb2_box(array(
		'id'           => $prefix . 'metabox',
		'title'        => esc_html__('Faculty', 'rs-function'),
		'object_types' => array('rt-department'), // Apply to the 'rt-faculty' post type
		'priority'     => 'low',  // 'high', 'core', 'default' or 'low'		
	));

	// Add a field to select a department
	$cmb_faculty_dep->add_field(array(
		'name'    => esc_html__('Select Faculty', 'rs-function'),
		'id'      => 'department_select_faculty',
		'type'    => 'select',
		'options' => get_myposttype_options('rt-faculty'),
	));
}



