<?php
/**
 * Entry point for the plugin. Checks if Elementor is installed and activated and loads it's own files and actions.
 *
 * @package header-footer-elementor
 */

use Rts_HFE\Lib\Astra_Target_Rules_Fields;

/**
 * Class Rts_Header_Footer_Elementor
 */
class Rts_Header_Footer_Elementor {

	/**
	 * Current theme template
	 *
	 * @var String
	 */
	public $template;

	/**
	 * Instance of Elemenntor Frontend class.
	 *
	 * @var \Elementor\Frontend()
	 */
	private static $elementor_instance;

	/**
	 * Instance of Rts_HFE_Admin
	 *
	 * @var Rts_Header_Footer_Elementor
	 */
	private static $_instance = null;

	/**
	 * Instance of Rts_Header_Footer_Elementor
	 *
	 * @return Rts_Header_Footer_Elementor Instance of Rts_Header_Footer_Elementor
	 */
	public static function instance() {
		if ( ! isset( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}
	/**
	 * Constructor
	 */
	function __construct() {
		$this->template = get_template();

		$is_elementor_callable = ( defined( 'ELEMENTOR_VERSION' ) && is_callable( 'Elementor\Plugin::instance' ) ) ? true : false;

		$required_elementor_version = '3.5.0';

		$is_elementor_outdated = ( $is_elementor_callable && ( ! version_compare( ELEMENTOR_VERSION, $required_elementor_version, '>=' ) ) ) ? true : false;

		if ( ( ! $is_elementor_callable ) || $is_elementor_outdated ) {
			$this->elementor_not_available( $is_elementor_callable, $is_elementor_outdated );
		}

		if ( $is_elementor_callable ) {
			self::$elementor_instance = Elementor\Plugin::instance();

			$this->includes();
			$this->load_textdomain();

			add_action( 'init', [ $this, 'setup_settings_page' ] );

			if ( 'genesis' == $this->template ) {
				require Rts_HFE_DIR . 'themes/genesis/class-hfe-genesis-compat.php';
			} elseif ( 'astra' == $this->template ) {
				require Rts_HFE_DIR . 'themes/astra/class-hfe-astra-compat.php';
			} elseif ( 'bb-theme' == $this->template || 'beaver-builder-theme' == $this->template ) {
				$this->template = 'beaver-builder-theme';
				require Rts_HFE_DIR . 'themes/bb-theme/class-hfe-bb-theme-compat.php';
			} elseif ( 'generatepress' == $this->template ) {
				require Rts_HFE_DIR . 'themes/generatepress/class-hfe-generatepress-compat.php';
			} elseif ( 'oceanwp' == $this->template ) {
				require Rts_HFE_DIR . 'themes/oceanwp/class-hfe-oceanwp-compat.php';
			} elseif ( 'storefront' == $this->template ) {
				require Rts_HFE_DIR . 'themes/storefront/class-hfe-storefront-compat.php';
			} elseif ( 'hello-elementor' == $this->template ) {
				require Rts_HFE_DIR . 'themes/hello-elementor/class-hfe-hello-elementor-compat.php';
			} else {
				add_filter( 'hfe_settings_tabs', [ $this, 'setup_unsupported_theme' ] );
				add_action( 'init', [ $this, 'setup_fallRts_support' ] );
			}

			if ( 'yes' === get_option( 'Rts_hfe_plugin_is_activated' ) ) {
				add_action( 'admin_init', [ $this, 'show_setup_wizard' ] );
			}

			// Scripts and styles.
			add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );

			add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_scripts' ] );

			add_filter( 'body_class', [ $this, 'body_class' ] );
			add_action( 'switch_theme', [ $this, 'reset_unsupported_theme_notice' ] );

			add_shortcode( 'hfe_template', [ $this, 'render_template' ] );

		}

	}

	/**
	 * Reset the Unsupported theme nnotice after a theme is switched.
	 *
	 * @since 1.0.16
	 *
	 * @return void
	 */
	public function reset_unsupported_theme_notice() {
		delete_user_meta( get_current_user_id(), 'unsupported-theme' );
	}



	/**
	 * Enqueue CSS for the Rating Notice.
	 *
	 * @since 1.2.0
	 * @return void
	 */
	public function rating_notice_css() {
		wp_enqueue_style( 'hfe-admin-style', Rts_HFE_URL . 'assets/css/admin-header-footer-elementor.css', [], Rts_HFE_VER );
	}

	/**
	 * Prints the admin notics when Elementor is not installed or activated or version outdated.
	 *
	 * @since 1.5.9
	 * @param  boolean $is_elementor_callable specifies if elementor is available.
	 * @param  boolean $is_elementor_outdated specifies if elementor version is old.
	 */
	public function elementor_not_available( $is_elementor_callable, $is_elementor_outdated ) {

		if ( ( ! did_action( 'elementor/loaded' ) ) || ( ! $is_elementor_callable ) ) {
			add_action( 'admin_notices', [ $this, 'elementor_not_installed_activated' ] );
			add_action( 'network_admin_notices', [ $this, 'elementor_not_installed_activated' ] );
			return;
		}

		if ( $is_elementor_outdated ) {
			add_action( 'admin_notices', [ $this, 'elementor_outdated' ] );
			add_action( 'network_admin_notices', [ $this, 'elementor_outdated' ] );
			return;
		}

	}

	/**
	 * Prints the admin notics when Elementor is not installed or activated.
	 */
	public function elementor_not_installed_activated() {

		$screen = get_current_screen();
		if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
			return;
		}

		if ( ! did_action( 'elementor/loaded' ) ) {
			// Check user capability.
			if ( ! ( current_user_can( 'activate_plugins' ) && current_user_can( 'install_plugins' ) ) ) {
				return;
			}

			/* TO DO */
			$class = 'notice notice-error';
			/* translators: %s: html tags */
			$message = sprintf( __( 'The %1$sElementor Header & Footer Builder%2$s plugin requires %1$sElementor%2$s plugin installed & activated.', 'header-footer-elementor' ), '<strong>', '</strong>' );

			$plugin = 'elementor/elementor.php';

			if ( _is_elementor_installed() ) {

				$action_url   = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
				$button_label = __( 'Activate Elementor', 'header-footer-elementor' );

			} else {

				$action_url   = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
				$button_label = __( 'Install Elementor', 'header-footer-elementor' );
			}

			$button = '<p><a href="' . esc_url( $action_url ) . '" class="button-primary">' . esc_html( $button_label ) . '</a></p><p></p>';

			printf( '<div class="%1$s"><p>%2$s</p>%3$s</div>', esc_attr( $class ), wp_kses_post( $message ), wp_kses_post( $button ) );
		}
	}

	/**
	 * Prints the admin notics when Elementor version is outdated.
	 */
	public function elementor_outdated() {

		// Check user capability.
		if ( ! ( current_user_can( 'activate_plugins' ) && current_user_can( 'install_plugins' ) ) ) {
			return;
		}

		/* TO DO */
		$class = 'notice notice-error';
		/* translators: %s: html tags */
		$message = sprintf( __( 'The %1$sElementor Header & Footer Builder%2$s plugin has stopped working because you are using an older version of %1$sElementor%2$s plugin.', 'header-footer-elementor' ), '<strong>', '</strong>' );

		$plugin = 'elementor/elementor.php';

		if ( file_exists( WP_PLUGIN_DIR . '/elementor/elementor.php' ) ) {

			$action_url   = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&amp;plugin=' ) . $plugin . '&amp;', 'upgrade-plugin_' . $plugin );
			$button_label = __( 'Update Elementor', 'header-footer-elementor' );

		} else {

			$action_url   = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
			$button_label = __( 'Install Elementor', 'header-footer-elementor' );
		}

		$button = '<p><a href="' . esc_url( $action_url ) . '" class="button-primary">' . esc_html( $button_label ) . '</a></p><p></p>';

		printf( '<div class="%1$s"><p>%2$s</p>%3$s</div>', esc_attr( $class ), wp_kses_post( $message ), wp_kses_post( $button ) );
	}

	/**
	 * Prints the admin notics when Elementor is not installed or activated.
	 */
	public function show_setup_wizard() {

		$screen    = get_current_screen();
		$screen_id = $screen ? $screen->id : '';

		if ( 'plugins' !== $screen_id ) {
			return;
		}

		/* TO DO */
		$class       = 'notice notice-info is-dismissible';
		$setting_url = admin_url( 'edit.php?post_type=rts-elementor-hf' );
		$image_path  = Rts_HFE_URL . 'assets/images/header-footer-elementor-icon.svg';

		/* translators: %s: html tags */
		$notice_message = sprintf( __( 'Thank you for installing %1$s Elementor Header & Footer Builder %2$s Plugin! Click here to %3$sget started. %4$s', 'header-footer-elementor' ), '<strong>', '</strong>', '<a href="' . $setting_url . '">', '</a>' );
	}

	/**
	 * Loads the globally required files for the plugin.
	 */
	public function includes() {
		require_once Rts_HFE_DIR . 'admin/class-hfe-admin.php';

		require_once Rts_HFE_DIR . 'inc/hfe-functions.php';

		// Load Elementor Canvas Compatibility.
		require_once Rts_HFE_DIR . 'inc/class-hfe-elementor-canvas-compat.php';

		// Load Target rules.
		require_once Rts_HFE_DIR . 'inc/lib/target-rule/class-astra-target-rules-fields.php';

		// Load the widgets.
		require Rts_HFE_DIR . 'inc/widgets-manager/class-widgets-loader.php';
	}

	/**
	 * Loads textdomain for the plugin.
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'header-footer-elementor' );
	}

	/**
	 * Enqueue styles and scripts.
	 */
	public function enqueue_scripts() {
		wp_enqueue_style( 'hfe-style', Rts_HFE_URL . 'assets/css/header-footer-elementor.css', [], Rts_HFE_VER );

		if ( class_exists( '\Elementor\Plugin' ) ) {
			$elementor = \Elementor\Plugin::instance();
			$elementor->frontend->enqueue_styles();
		}

		

		if ( Rts_hfe_header_enabled() ) {
			if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
				$css_file = new \Elementor\Core\Files\CSS\Post( Rts_get_hfe_header_id() );
			} elseif ( class_exists( '\Elementor\Post_CSS_File' ) ) {
				$css_file = new \Elementor\Post_CSS_File( Rts_get_hfe_header_id() );
			}

			$css_file->enqueue();
		}

		if ( Rts_hfe_footer_enabled() ) {
			if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
				$css_file = new \Elementor\Core\Files\CSS\Post( Rts_get_hfe_footer_id() );
			} elseif ( class_exists( '\Elementor\Post_CSS_File' ) ) {
				$css_file = new \Elementor\Post_CSS_File( Rts_get_hfe_footer_id() );
			}

			$css_file->enqueue();
		}

		if ( Rts_hfe_is_before_footer_enabled() ) {
			if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
				$css_file = new \Elementor\Core\Files\CSS\Post( Rts_hfe_get_before_footer_id() );
			} elseif ( class_exists( '\Elementor\Post_CSS_File' ) ) {
				$css_file = new \Elementor\Post_CSS_File( Rts_hfe_get_before_footer_id() );
			}
			$css_file->enqueue();
		}

		if ( Rts_hfe_is_Rts_topbar_enabled() ) {
			if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
				$css_file = new \Elementor\Core\Files\CSS\Post( Rts_hfe_get_Rts_topbar_id() );
			} elseif ( class_exists( '\Elementor\Post_CSS_File' ) ) {
				$css_file = new \Elementor\Post_CSS_File( Rts_hfe_get_Rts_topbar_id() );
			}
			$css_file->enqueue();
		}

		if ( Rts_hfe_is_Rts_after__header_enabled() ) {
			if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
				$css_file = new \Elementor\Core\Files\CSS\Post( Rts_hfe_get_Rts_after__header_id() );
			} elseif ( class_exists( '\Elementor\Post_CSS_File' ) ) {
				$css_file = new \Elementor\Post_CSS_File( Rts_hfe_get_Rts_after__header_id() );
			}
			$css_file->enqueue();
		}
	}

	/**
	 * Load admin styles on header footer elementor edit screen.
	 */
	public function enqueue_admin_scripts() {
		global $pagenow;
		$screen = get_current_screen();

		if ( ( 'rts-elementor-hf' == $screen->id && ( 'post.php' == $pagenow || 'post-new.php' == $pagenow ) ) || ( 'edit.php' == $pagenow && 'edit-rts-elementor-hf' == $screen->id ) ) {

			wp_enqueue_style( 'hfe-admin-style', Rts_HFE_URL . 'admin/assets/css/ehf-admin.css', [], Rts_HFE_VER );
			wp_enqueue_script( 'hfe-admin-script', Rts_HFE_URL . 'admin/assets/js/ehf-admin.js', [ 'jquery', 'updates' ], Rts_HFE_VER, true );

		}
	}

	/**
	 * Adds classes to the body tag conditionally.
	 *
	 * @param  Array $classes array with class names for the body tag.
	 *
	 * @return Array          array with class names for the body tag.
	 */
	public function body_class( $classes ) {
		if ( Rts_hfe_header_enabled() ) {
			$classes[] = 'ehf-header';
		}

		if ( Rts_hfe_footer_enabled() ) {
			$classes[] = 'ehf-footer';
		}

		$classes[] = 'ehf-template-' . $this->template;
		$classes[] = 'ehf-stylesheet-' . get_stylesheet();

		return $classes;
	}

	/**
	 * Display Settings Page options
	 *
	 * @since 1.6.0
	 */
	public function setup_settings_page() {

		require_once Rts_HFE_DIR . 'inc/class-hfe-settings-page.php';
	}

	/**
	 * Display Unsupported theme notice if the current theme does add support for 'header-footer-elementor'
	 *
	 * @param array $hfe_settings_tabs settings array tabs.
	 * @since 1.0.3
	 */
	public function setup_unsupported_theme( $hfe_settings_tabs = [] ) {
		if ( ! current_theme_supports( 'header-footer-elementor' ) ) {
			$hfe_settings_tabs['hfe_settings'] = [
				'name' => __( 'Theme Support', 'header-footer-elementor' ),
				'url'  => admin_url( 'themes.php?page=hfe-settings' ),
			];
		}
		return $hfe_settings_tabs;
	}

	/**
	 * Add support for theme if the current theme does add support for 'header-footer-elementor'
	 *
	 * @since  1.6.1
	 */
	public function setup_fallRts_support() {

		if ( ! current_theme_supports( 'header-footer-elementor' ) ) {
			$hfe_compatibility_option = get_option( 'hfe_compatibility_option', '1' );

			if ( '1' === $hfe_compatibility_option ) {
				if ( ! class_exists( 'HFE_Default_Compat' ) ) {
					require_once Rts_HFE_DIR . 'themes/default/class-hfe-default-compat.php';
				}
			} elseif ( '2' === $hfe_compatibility_option ) {
				require Rts_HFE_DIR . 'themes/default/class-global-theme-compatibility.php';
			}
		}
	}

	/**
	 * Prints the Header content.
	 */
	public static function get_header_content() {
        $header_id = Rts_get_hfe_header_id();
        // Check if WPML is active and get the translated version
        if ( function_exists( 'icl_object_id' ) ) {
            $header_id = icl_object_id( $header_id, 'elementor_library', true, ICL_LANGUAGE_CODE );
        }
        // Check if Polylang is active and get the translated version
        elseif ( function_exists( 'pll_get_post' ) ) {
            $header_id = pll_get_post( $header_id, pll_current_language() );
        }
        echo self::$elementor_instance->frontend->get_builder_content_for_display( $header_id );
    }
    /**
     * Prints the Footer content.
     */
    public static function get_footer_content() {
        $footer_id = Rts_get_hfe_footer_id();
        // Check if WPML is active and get the translated version
        if ( function_exists( 'icl_object_id' ) ) {
            $footer_id = icl_object_id( $footer_id, 'elementor_library', true, ICL_LANGUAGE_CODE );
        }
        // Check if Polylang is active and get the translated version
        elseif ( function_exists( 'pll_get_post' ) ) {
            $footer_id = pll_get_post( $footer_id, pll_current_language() );
        }
        echo "<div class='footer-width-fixer'>";
        echo self::$elementor_instance->frontend->get_builder_content_for_display( $footer_id );
        echo '</div>';
    }

	/**
	 * Prints the Before Footer content.
	 */
	public static function get_before_footer_content() {
		echo "<div class='footer-width-fixer'>";
		echo self::$elementor_instance->frontend->get_builder_content_for_display( Rts_hfe_get_before_footer_id() );
		echo '</div>';
	}

	/**
	 * Prints the Before Footer content.
	 */
	public static function get_Rts_topbar_content() {
		echo "<div class='rts-header-top-position'>";
		echo self::$elementor_instance->frontend->get_builder_content_for_display( Rts_hfe_get_Rts_topbar_id() );
		echo '</div>';
	}

	/**
	 * Prints the Before Footer content.
	 */
	public static function get_Rts_after__header_content() {
		echo "<div class='rts-header-after-position'>";
		echo self::$elementor_instance->frontend->get_builder_content_for_display( Rts_hfe_get_Rts_after__header_id() );
		echo '</div>';
	}

	/**
	 * Get option for the plugin settings
	 *
	 * @param  mixed $setting Option name.
	 * @param  mixed $default Default value to be received if the option value is not stored in the option.
	 *
	 * @return mixed.
	 */
	public static function get_settings( $setting = '', $default = '' ) {
		if ( 'Rts_type_header' == $setting || 'Rts_type_footer' == $setting || 'type_Rts_after__header' == $setting || 'type_before_footer' == $setting || 'type_Rts_topbar' == $setting ) {
			$templates = self::get_template_id( $setting );

			$template = ! is_array( $templates ) ? $templates : $templates[0];

			$template = apply_filters( "hfe_get_settings_{$setting}", $template );

			return $template;
		}
	}

	/**
	 * Get header or footer template id based on the meta query.
	 *
	 * @param  String $type Type of the template header/footer.
	 *
	 * @return Mixed       Returns the header or footer template id if found, else returns string ''.
	 */
	public static function get_template_id( $type ) {
		$option = [
			'location'  => 'ehf_target_include_locations',
			'exclusion' => 'ehf_target_exclude_locations',
			'users'     => 'ehf_target_user_roles',
		];

		$hfe_templates = Astra_Target_Rules_Fields::get_instance()->get_posts_by_conditions( 'rts-elementor-hf', $option );

		foreach ( $hfe_templates as $template ) {
			if ( get_post_meta( absint( $template['id'] ), 'ehf_template_type', true ) === $type ) {
				return $template['id'];
			}
		}

		return '';
	}

	/**
	 * Callback to shortcode.
	 *
	 * @param array $atts attributes for shortcode.
	 */
	public function render_template( $atts ) {
		$atts = shortcode_atts(
			[
				'id' => '',
			],
			$atts,
			'hfe_template'
		);

		$id = ! empty( $atts['id'] ) ? apply_filters( 'hfe_render_template_id', intval( $atts['id'] ) ) : '';

		if ( empty( $id ) ) {
			return '';
		}

		if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
			$css_file = new \Elementor\Core\Files\CSS\Post( $id );
		} elseif ( class_exists( '\Elementor\Post_CSS_File' ) ) {
			// Load elementor styles.
			$css_file = new \Elementor\Post_CSS_File( $id );
		}
			$css_file->enqueue();

		return self::$elementor_instance->frontend->get_builder_content_for_display( $id );
	}

}
/**
 * Is elementor plugin installed.
 */
if ( ! function_exists( '_is_elementor_installed' ) ) {

	/**
	 * Check if Elementor is installed
	 *
	 * @since 1.6.0
	 *
	 * @access public
	 */
	function _is_elementor_installed() {
		return ( file_exists( WP_PLUGIN_DIR . '/elementor/elementor.php' ) ) ? true : false;
	}
}
