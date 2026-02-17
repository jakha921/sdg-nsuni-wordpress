<?php
/**
 * Header Footer Elementor Function
 *
 * @package  header-footer-elementor
 */

/**
 * Checks if Header is enabled from HFE.
 *
 * @since  1.0.2
 * @return bool True if header is enabled. False if header is not enabled
 */
function Rts_hfe_header_enabled() {
	$header_id = Rts_Header_Footer_Elementor::get_settings( 'Rts_type_header', '' );
	$status    = false;

	if ( '' !== $header_id ) {
		$status = true;
	}

	return apply_filters( 'Rts_hfe_header_enabled', $status );
}

/**
 * Checks if Footer is enabled from HFE.
 *
 * @since  1.0.2
 * @return bool True if header is enabled. False if header is not enabled.
 */
function Rts_hfe_footer_enabled() {
	$footer_id = Rts_Header_Footer_Elementor::get_settings( 'Rts_type_footer', '' );
	$status    = false;

	if ( '' !== $footer_id ) {
		$status = true;
	}

	return apply_filters( 'Rts_hfe_footer_enabled', $status );
}

/**
 * Get HFE Header ID
 *
 * @since  1.0.2
 * @return (String|boolean) header id if it is set else returns false.
 */
function Rts_get_hfe_header_id() {
	$header_id = Rts_Header_Footer_Elementor::get_settings( 'Rts_type_header', '' );

	if ( '' === $header_id ) {
		$header_id = false;
	}

	return apply_filters( 'Rts_get_hfe_header_id', $header_id );
}

/**
 * Get HFE Footer ID
 *
 * @since  1.0.2
 * @return (String|boolean) header id if it is set else returns false.
 */
function Rts_get_hfe_footer_id() {
	$footer_id = Rts_Header_Footer_Elementor::get_settings( 'Rts_type_footer', '' );

	if ( '' === $footer_id ) {
		$footer_id = false;
	}

	return apply_filters( 'Rts_get_hfe_footer_id', $footer_id );
}

/**
 * Display header markup.
 *
 * @since  1.0.2
 */
function Rts_hfe_Rts_render_header() {

	if ( false == apply_filters( 'Rts_enable_Rts_hfe_Rts_render_header', true ) ) {
		return;
	}

	?>
		
	<?php Rts_Header_Footer_Elementor::get_header_content(); ?>

	<?php

}

/**
 * Display footer markup.
 *
 * @since  1.0.2
 */
function Rts_hfe_render_footer() {

	if ( false == apply_filters( 'Rts_enable_Rts_hfe_render_footer', true ) ) {
		return;
	}

	?>
		<footer itemtype="https://schema.org/WPFooter" itemscope="itemscope" id="colophon" role="contentinfo">
			<?php Rts_Header_Footer_Elementor::get_footer_content(); ?>
		</footer>
	<?php

}


/**
 * Get HFE Before Footer ID
 *
 * @since  1.0.2
 * @return String|boolean before footer id if it is set else returns false.
 */
function Rts_hfe_get_before_footer_id() {

	$before_footer_id = Rts_Header_Footer_Elementor::get_settings( 'type_before_footer', '' );

	if ( '' === $before_footer_id ) {
		$before_footer_id = false;
	}

	return apply_filters( 'get_hfe_before_footer_id', $before_footer_id );
}

function Rts_hfe_get_Rts_topbar_id() {

	$Rts_topbar_id = Rts_Header_Footer_Elementor::get_settings( 'type_Rts_topbar', '' );

	if ( '' === $Rts_topbar_id ) {
		$Rts_topbar_id = false;
	}

	return apply_filters( 'get_hfe_Rts_topbar_id', $Rts_topbar_id );
}

function Rts_hfe_get_Rts_after__header_id() {

	$Rts_after__header_id = Rts_Header_Footer_Elementor::get_settings( 'type_Rts_after__header', '' );

	if ( '' === $Rts_after__header_id ) {
		$Rts_after__header_id = false;
	}

	return apply_filters( 'get_hfe_Rts_after__header_id', $Rts_after__header_id );
}

/**
 * Checks if Before Footer is enabled from HFE.
 *
 * @since  1.0.2
 * @return bool True if before footer is enabled. False if before footer is not enabled.
 */
function Rts_hfe_is_before_footer_enabled() {

	$before_footer_id = Rts_Header_Footer_Elementor::get_settings( 'type_before_footer', '' );
	$status           = false;

	if ( '' !== $before_footer_id ) {
		$status = true;
	}

	return apply_filters( 'hfe_before_footer_enabled', $status );
}

function Rts_hfe_is_Rts_topbar_enabled() {

	$Rts_topbar_id = Rts_Header_Footer_Elementor::get_settings( 'type_Rts_topbar', '' );
	$status           = false;

	if ( '' !== $Rts_topbar_id ) {
		$status = true;
	}

	return apply_filters( 'hfe_Rts_topbar_enabled', $status );
}


function Rts_hfe_is_Rts_after__header_enabled() {

	$Rts_after__header_id = Rts_Header_Footer_Elementor::get_settings( 'type_Rts_after__header', '' );
	$status           = false;

	if ( '' !== $Rts_after__header_id ) {
		$status = true;
	}

	return apply_filters( 'hfe_Rts_after__header_enabled', $status );
}

/**
 * Display before footer markup.
 *
 * @since  1.0.2
 */
function Rts_hfe_render_before_footer() {

	if ( false == apply_filters( 'enable_Rts_hfe_render_before_footer', true ) ) {
		return;
	}

	?>
		<div class="hfe-before-footer-wrap">
			<?php Rts_Header_Footer_Elementor::get_before_footer_content(); ?>
		</div>
	<?php

}

function Rts_hfe_render_Rts_topbar() {

	if ( false == apply_filters( 'enable_Rts_hfe_render_Rts_topbar', true ) ) {
		return;
	}

	?>
		<div class="hfe-topbar-wrap">
			<?php Rts_Header_Footer_Elementor::get_Rts_topbar_content(); ?>
		</div>
	<?php

}

function Rts_hfe_render_Rts_after__header() {

	if ( false == apply_filters( 'enable_Rts_hfe_render_Rts_after__header', true ) ) {
		return;
	}

	?>
		<div class="hfe-after__header-wrap">
			<?php Rts_Header_Footer_Elementor::get_Rts_after__header_content(); ?>
		</div>
	<?php

}
