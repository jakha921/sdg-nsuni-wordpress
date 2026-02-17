<?php
/**
 * Support all themes.
 *
 * @package header-footer-elementor
 */

namespace Rts_HFE\Themes;

/**
 * Global theme compatibility.
 */
class Global_Theme_Compatibility {

	/**
	 *  Initiator
	 */
	public function __construct() {
		add_action( 'wp', [ $this, 'hooks' ] );
	}

	/**
	 * Run all the Actions / Filters.
	 */
	public function hooks() {
		if ( Rts_hfe_header_enabled() ) {
			// Replace header.php.
			add_action( 'get_header', [ $this, 'option_override_header' ] );

			add_action( 'wp_body_open', [ 'Rts_Header_Footer_Elementor', 'get_header_content' ] );
			add_action( 'hfe_fallRts_header', [ 'Rts_Header_Footer_Elementor', 'get_header_content' ] );
		}

		if ( Rts_hfe_is_before_footer_enabled() ) {
			add_action( 'wp_footer', [ 'Rts_Header_Footer_Elementor', 'get_before_footer_content' ], 20 );
		}

		if ( Rts_hfe_is_Rts_topbar_enabled() ) {
			add_action( 'wp_header', [ 'Rts_Header_Footer_Elementor', 'get_Rts_topbar_content' ], 20 );
		}

		if ( Rts_hfe_is_Rts_after__header_enabled() ) {
			add_action( 'wp_header', [ 'Rts_Header_Footer_Elementor', 'get_Rts_after__header_content' ], 20 );
		}

		if ( Rts_hfe_footer_enabled() ) {
			add_action( 'wp_footer', [ 'Rts_Header_Footer_Elementor', 'get_footer_content' ], 50 );
		}

		if ( Rts_hfe_header_enabled() || Rts_hfe_footer_enabled() ) {
			add_action( 'wp_enqueue_scripts', [ $this, 'force_fullwidth' ] );
		}
	}

	/**
	 * Force full width CSS for the header.
	 *
	 * @since 1.2.0
	 * @return void
	 */
	public function force_fullwidth() {
		$css = '
		.force-stretched-header {
			width: 100vw;
			position: relative;
			margin-left: -50vw;
			left: 50%;
		}';

		if ( true === Rts_hfe_header_enabled() ) {
			$css .= 'header#masthead {
				display: none;
			}';
		}

		if ( true === Rts_hfe_footer_enabled() ) {
			$css .= 'footer#colophon {
				display: none;
			}';
		}

		wp_add_inline_style( 'hfe-style', $css );
	}

	/**
	 * Function overriding the header in the wp_body_open way.
	 *
	 * @since 1.2.0
	 *
	 * @return void
	 */
	public function option_override_header() {
		$templates   = [];
		$templates[] = 'header.php';
		locate_template( $templates, true );

		if ( ! did_action( 'wp_body_open' ) ) {
			echo '<div class="force-stretched-header">';
			do_action( 'hfe_fallRts_header' );
			echo '</div>';
		}
	}
}
new Global_Theme_Compatibility();
