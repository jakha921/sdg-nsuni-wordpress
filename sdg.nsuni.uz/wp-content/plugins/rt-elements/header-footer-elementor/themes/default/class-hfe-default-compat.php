<?php
/**
 * HFE_Default_Compat setup
 *
 * @package header-footer-elementor
 */

namespace Rts_HFE\Themes;

/**
 * Astra theme compatibility.
 */
class HFE_Default_Compat {

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
		if ( Rts_hfe_header_enabled() || Rts_hfe_is_Rts_topbar_enabled() || Rts_hfe_is_Rts_after__header_enabled()) {
			// Replace header.php template.
			add_action( 'get_header', [ $this, 'override_header' ] );

			// Display HFE's header in the replaced header.
			add_action( 'hfe_header', 'Rts_hfe_Rts_render_header' );
		}

		if ( Rts_hfe_footer_enabled() || Rts_hfe_is_before_footer_enabled() ) {
			// Replace footer.php template.
			add_action( 'get_footer', [ $this, 'override_footer' ] );
		}

		if ( Rts_hfe_footer_enabled() ) {
			// Display HFE's footer in the replaced header.
			add_action( 'hfe_footer', 'Rts_hfe_render_footer' );
		}

		if ( Rts_hfe_is_before_footer_enabled() ) {
			add_action( 'hfe_footer_before', [ 'Rts_Header_Footer_Elementor', 'get_before_footer_content' ] );
		}
		
		if ( Rts_hfe_is_Rts_topbar_enabled() ) {
			add_action( 'hfe_header_topbar', [ 'Rts_Header_Footer_Elementor', 'get_Rts_topbar_content' ] );
		}	
		
		if ( Rts_hfe_is_Rts_after__header_enabled() ) {
			add_action( 'hfe_header_after__header', [ 'Rts_Header_Footer_Elementor', 'get_Rts_after__header_content' ] );
		}
	}

	/**
	 * Function for overriding the header in the elmentor way.
	 *
	 * @since 1.2.0
	 *
	 * @return void
	 */
	public function override_header() {
		require Rts_HFE_DIR . 'themes/default/hfe-header.php';
		$templates   = [];
		$templates[] = 'header.php';
		// Avoid running wp_head hooks again.
		remove_all_actions( 'wp_head' );
		ob_start();
		locate_template( $templates, true );
		ob_get_clean();
	}

	/**
	 * Function for overriding the footer in the elmentor way.
	 *
	 * @since 1.2.0
	 *
	 * @return void
	 */
	public function override_footer() {
		require Rts_HFE_DIR . 'themes/default/hfe-footer.php';
		$templates   = [];
		$templates[] = 'footer.php';
		// Avoid running wp_footer hooks again.
		remove_all_actions( 'wp_footer' );
		ob_start();
		locate_template( $templates, true );
		ob_get_clean();
	}

}

new HFE_Default_Compat();
