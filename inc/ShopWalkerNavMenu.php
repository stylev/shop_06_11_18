<?php
class ShopWalkerNavMenu extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		if ( $depth == 0 ) $output .= '<div class="dropdown-menu multi-column columns-3"><div class="row">';
	}
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		if ( $depth == 0 ) $output .= '<div class="clearfix"></div></div></div>';		
	}
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$html = '';
		if ( $depth == 0 ) {
			$html .= '<li';
			if ( $args->walker->has_children ) {
				$html .= ' class="dropdown"><a href="%s" class="dropdown-toggle" data-toggle="dropdown">%s <b class="caret"></b></a>';
				$output .= sprintf( $html, $item->url, $item->title );
			} else {
				$html .= '><a href="%s">%s</a>';
				$output .= sprintf( $html, $item->url, $item->title );
			}
		} elseif ( $depth == 1 ) {
			$html .= '<div class="col-sm-4"><ul class="multi-column-dropdown"><li>%s</li>';
			$output .= sprintf( $html, $item->title );
		} elseif ( $depth == 2 ) {
			$html .= '<li><a href="%s">%s</a>';
			$output .= sprintf( $html, $item->url, $item->title );
		}
	}
	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		if ( $depth == 0 ) $output .= '</li>';
		if ( $depth == 1 ) $output .= '</ul></div>';
		if ( $depth == 2 ) $output .= '</li>';
	}
}
