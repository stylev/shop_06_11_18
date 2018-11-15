<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! empty( $breadcrumb ) ) {		

	if ( is_product_category() ) {
		echo $wrap_before;

		foreach ( $breadcrumb as $key => $crumb ) {

			echo $before;

			if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
				echo '<a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a>';
			} else {
				echo '<span class="act">' . esc_html( $crumb[0] ) . '</span>&nbsp;';
			}

			echo $after;

			if ( sizeof( $breadcrumb ) !== $key + 1 ) {
				echo $delimiter;
			}
		}

		echo $wrap_after;
	} else {
		echo $wrap_before;

		foreach ( $breadcrumb as $key => $crumb ) {

			echo $before;

			if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
				echo '<li class="home"><a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a>';
			} else {
				echo '<li class="women">' . esc_html( $crumb[0] );
			}

			echo $after;

			if ( sizeof( $breadcrumb ) !== $key + 1 ) {
				echo $delimiter;
			}
		}

		echo $wrap_after;
	}

}
