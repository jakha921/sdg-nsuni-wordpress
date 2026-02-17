<?php
/**
 * Main Elementor Extension Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class RTelements_Elementor_Extension {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '5.4';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Elementor_Test_Extension The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return Elementor_Test_Extension An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'plugins_loaded', [ $this, 'init' ] );
	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 *
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function i18n() {
		load_plugin_textdomain( 'rtelements' );
	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}
		// Add Plugin actions
		add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_category' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'resgister_header_footer_category' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'rtelements_register_widget_styles' ] );	
		add_action( 'wp_enqueue_scripts', [ $this, 'rsaddon_register_plugin_styles' ] );		
		add_action( 'admin_enqueue_scripts', [ $this, 'rsaddon_admin_defualt_css' ] );		
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'rsaddon_register_plugin_admin_styles' ] );
		$this->include_files();		
	}

	public function rtelements_register_widget_styles() {		
		$dir = plugin_dir_url(__FILE__); 	
		
	}

	public function rsaddon_register_plugin_styles() {		
		$dir = plugin_dir_url(__FILE__);       	
		wp_enqueue_style( 'aos', $dir.'assets/css/elements.css' );
        //enqueue javascript   		  	
        wp_enqueue_script( 'isotop', $dir.'assets/js/isotope.js' , array('jquery'), '201513434', true);
        wp_enqueue_script( 'scrolltigger', $dir.'assets/js/scrolltigger.js' , array('jquery'), '201513434', true);
        wp_enqueue_script( 'smooth-scroll', $dir.'assets/js/smooth-scroll.js' , array('jquery'), '201513434', true);
        wp_enqueue_script( 'jarallax', $dir.'assets/js/jarallax.min.js' , array('jquery'), '201513434', true);
        wp_enqueue_script( 'jarallax-video', $dir.'assets/js/jarallax-video.min.js' , array('jquery'), '201513434', true);
        wp_enqueue_script( 'rsaddons-custom-pro', $dir.'assets/js/custom.js', array('jquery', 'imagesloaded'), '201513434', true);   
		
		wp_localize_script( 'rsaddons-custom-pro', 'rtajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));

      
    }

    public function rsaddon_register_plugin_admin_styles(){
    	$dir = plugin_dir_url(__FILE__);
    	wp_enqueue_style( 'rsaddons-admin-pro', $dir.'assets/css/admin/admin.css' );
    	wp_enqueue_style( 'rsaddons-admin-floaticon-pro', $dir.'assets/fonts/flaticon.css' );
    } 

    public function rsaddon_admin_defualt_css(){
    	$dir = plugin_dir_url(__FILE__);
    	wp_enqueue_style( 'rsaddons-admin-pro-style', $dir.'assets/css/admin/style.css' );    	
    }

     public function include_files() {       
        require( __DIR__ . '/inc/rs-addon-icons.php' ); 
        require( __DIR__ . '/inc/form.php' );  
        require( __DIR__ . '/inc/helper.php' );  
		require( __DIR__ . '/widgets/academic-area/academic-ajax.php' );  
		require( __DIR__ . '/widgets/faculty-area/faculty-ajax.php' );  
		require( __DIR__ . '/widgets/team-member/team-ajax.php' );  
    }

	public function add_category( $elements_manager ) {
        $elements_manager->add_category(
            'pielements_category',
            [
                'title' => esc_html__('RT Elementor Addons', 'pielements' ),
                'icon' => 'fa fa-smile-o',
            ]
        );
    }

    public function resgister_header_footer_category( $elements_manager ) {
        $elements_manager->add_category(
            'header_footer_rts',
            [
                'title' => esc_html__('RTS Header Footer Elements', 'pielements' ),
                'icon' => 'fa fa-smile-o',
            ]
        );
    }

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'pielements' ),
			'<strong>' . esc_html__( 'RTS Addon Custom Elementor Addon', 'pielements' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'pielements' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'pielements' ),
			'<strong>' . esc_html__( 'RS Addon Custom Elementor Addon', 'pielements' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'pielements' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );
		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'pielements' ),
			'<strong>' . esc_html__( 'RS Addon Custom Elementor Addon', 'pielements' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'pielements' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {	

		require_once(__DIR__ . '/widgets/breadcrumb/breadcrumb.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \ReacTheme_Breadrumb_Widget());

		// language
		require_once( __DIR__ . '/widgets/languages/language.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_Languages_Widget() );

		// button  
		require_once( __DIR__ . '/widgets/button/button.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Button_Widget() );
		
		// site canvas 
		require_once( __DIR__ . '/widgets/header-footer/site-canvas.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \RTS_Offcanvas() );
			
		// site logo 
		require_once( __DIR__ . '/widgets/header-footer/site-logo.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \RTS_Site_Logo() );	

		// navigation 
		require_once( __DIR__ . '/widgets/header-footer/site-nav.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \RTS_Navigation_Menu() );	

		// copyright 
		require_once( __DIR__ . '/widgets/header-footer/copyright.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Elementor_Copyright_Widget() );

		// site serach 
		require_once( __DIR__ . '/widgets/header-footer/site-search.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \RTS_Search_Button() );

		//Video
		require_once( __DIR__ . '/widgets/video/rt-video.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Elementor_Video_Widget() );
	
		//Service Grid
		require_once( __DIR__ . '/widgets/services/service-grid.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Elementor_Sservices_Grid_Widget() );	
	
		// //Testimonial Slider
		require_once( __DIR__ . '/widgets/slider/slider.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Elementor_Slider_Widget() );
		
		// //Blog Grid        
		require_once( __DIR__ . '/widgets/blog-grid/blog-grid-widget.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \ReacTheme_Elementor_Blog_Grid_Widget () );

		// team grid 
		require_once( __DIR__ . '/widgets/team-member/team-grid-widget.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \ReacTheme_Elementor_Team_Grid_Widget() );
		
		//Portfolio Grid
		require_once( __DIR__ . '/widgets/portfolio-grid/portfolio-grid-widget.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Portfolio_Grid_Widget() );
	
		//Research Grid
		require_once( __DIR__ . '/widgets/research/research.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Research_Grid_Widget() );
		
		//Faculty Grid
		require_once( __DIR__ . '/widgets/faculty/faculty.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Faculty_Grid_Widget() );

		//Course Grid
		require_once( __DIR__ . '/widgets/course-grid/course-grid.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \ReacTheme_RT_Course_Grid_Widget() );
		
		//Program List
		require_once( __DIR__ . '/widgets/program-list/program-list.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \RTS_Program_List_Widget() );

		// //Logo Showcase
		require_once( __DIR__ . '/widgets/logo-widget/logo.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \ReacThemes_Logo_Showcase_Widget() );

		// Marque		
		require_once( __DIR__ . '/widgets/marquee/marquee.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Rsaddon_Elementor_pro_Marquee_Widget() );		
		
		// Notice		
		require_once( __DIR__ . '/widgets/notice/notice.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Notice_Widget() );		
		
		require_once(__DIR__ . '/widgets/tab/tab.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Reactheme_Tab_Widget());
				
		require_once( __DIR__ . '/widgets/image-widget/image.php' );	
		\Elementor\Plugin::instance()->widgets_manager->register( new \Reactheme_Image_Showcase_Widget() );		

		// //Accordion
		require_once( __DIR__ . '/widgets/accordion/accordion.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \ReacTheme_Widget_Accordion() );
		
		require_once(__DIR__ . '/widgets/table/table-normal.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Rsaddon_Pro_Table_Elementor_Widget());
		
		require_once(__DIR__ . '/widgets/department-pro-list/dep-program-list.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \RTS_Dep_Program_List_Widget());

		require_once(__DIR__ . '/widgets/departments/departments.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \RTS_Department_Widget());


		require_once( __DIR__ . '/widgets/related-post/related-post.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \ReacTheme_Related_Post_Slider_Widget() );

		require_once( __DIR__ . '/widgets/academic-area/academic.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \RTS_Academic_Widget() );

		require_once( __DIR__ . '/widgets/faculty-area/faculty.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \RTS_Faculty_Area_Widget() );
	
		// Register widget				
		add_action( 'elementor/elements/categories_registered', [$this, 'add_category'] );
		add_action( 'elementor/elements/categories_registered', [$this, 'resgister_header_footer_category'] );
	
	}
}
RTelements_Elementor_Extension::instance();