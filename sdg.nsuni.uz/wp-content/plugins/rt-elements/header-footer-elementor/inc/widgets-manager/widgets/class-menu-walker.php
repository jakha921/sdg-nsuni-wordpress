<?php
namespace Rts_HFE\WidgetsManager\Widgets;
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class Menu_Walker.
 */
class Menu_Walker extends \Walker_Nav_Menu {
	public function start_el( &$output, $item, $depth = 0, $args = [], $id = 0 ) {

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$args   = (object) $args;

		$class_names = '';
		$value       = '';
		$rel_xfn     = '';
		$rel_blank   = '';

		$classes = empty( $item->classes ) ? [] : (array) $item->classes;
		$submenu = $args->has_children ? ' rts-has-submenu' : '';

		if ( 0 === $depth ) {
			array_push( $classes, 'parent' );
		}
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = ' class="' . esc_attr( $class_names ) . $submenu . ' rts-creative-menu"';
		$value       = apply_filters( 'nav_menu_li_values', $value );

		$output .= $indent . '<li id="menu-item-' . $item->ID . '"' . $value . $class_names . '>';

		if ( isset( $item->target ) && '_blank' === $item->target && isset( $item->xfn ) && false === strpos( $item->xfn, 'noopener' ) ) {
			$rel_xfn = ' noopener';
		}
		if ( isset( $item->target ) && '_blank' === $item->target && isset( $item->xfn ) && empty( $item->xfn ) ) {
			$rel_blank = 'rel="noopener"';
		}

		$attributes  = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) . $rel_xfn . '"' : '' . $rel_blank;
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) . '"' : '';

		$atts = apply_filters( 'hfe_nav_menu_attrs', $attributes );

		$item_output  = $args->has_children ? '' : '';
		$item_output .= $args->before;
		$item_output .= '<a' . $atts;
		if ( 0 === $depth ) {
			$item_output .= ' class = "rts-menu-item"';
		} else {
			$item_output .= in_array( 'current-menu-item', $item->classes ) ? ' class = "rts-sub-menu-item rts-sub-menu-item-active"' : ' class = "rts-sub-menu-item"';
		}

		$item_output .= '>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		if ( $args->has_children ) {
			$item_output .= "<span class='sub-arrow";
			//$item_output .= $depth;
			$item_output .= "'><i class='ri-arrow-down-s-line'></i></span>";
		}
		$item_output .= '</a>';

		$item_output .= $args->after;
		$item_output .= $args->has_children ? '' : '';

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

	}

	function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {

		$id_field = $this->db_fields['id'];

		if ( is_object( $args[0] ) ) {
			$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
		}
		return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
}

