<?php
/**
 * Builds filterable classes throughout the theme.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'kinginrin_right_sidebar_class' ) ) {
	/**
	 * Display the classes for the sidebar.
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 */
	function kinginrin_right_sidebar_class( $class = '' ) {
		// Separates classes with a single space, collates classes for post DIV
		echo 'class="' . join( ' ', kinginrin_get_right_sidebar_class( $class ) ) . '"'; // WPCS: XSS ok, sanitization ok.
	}
}

if ( ! function_exists( 'kinginrin_get_right_sidebar_class' ) ) {
	/**
	 * Retrieve the classes for the sidebar.
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 * @return array Array of classes.
	 */
	function kinginrin_get_right_sidebar_class( $class = '' ) {

		$classes = array();

		if ( !empty($class) ) {
			if ( !is_array( $class ) )
				$class = preg_split('#\s+#', $class);
			$classes = array_merge($classes, $class);
		}

		$classes = array_map('esc_attr', $classes);

		return apply_filters('kinginrin_right_sidebar_class', $classes, $class);
	}
}

if ( ! function_exists( 'kinginrin_left_sidebar_class' ) ) {
	/**
	 * Display the classes for the sidebar.
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 */
	function kinginrin_left_sidebar_class( $class = '' ) {
		// Separates classes with a single space, collates classes for post DIV
		echo 'class="' . join( ' ', kinginrin_get_left_sidebar_class( $class ) ) . '"'; // WPCS: XSS ok, sanitization ok.
	}
}

if ( ! function_exists( 'kinginrin_get_left_sidebar_class' ) ) {
	/**
	 * Retrieve the classes for the sidebar.
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 * @return array Array of classes.
	 */
	function kinginrin_get_left_sidebar_class( $class = '' ) {

		$classes = array();

		if ( !empty($class) ) {
			if ( !is_array( $class ) )
				$class = preg_split('#\s+#', $class);
			$classes = array_merge($classes, $class);
		}

		$classes = array_map('esc_attr', $classes);

		return apply_filters('kinginrin_left_sidebar_class', $classes, $class);
	}
}

if ( ! function_exists( 'kinginrin_content_class' ) ) {
	/**
	 * Display the classes for the content.
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 */
	function kinginrin_content_class( $class = '' ) {
		// Separates classes with a single space, collates classes for post DIV
		echo 'class="' . join( ' ', kinginrin_get_content_class( $class ) ) . '"'; // WPCS: XSS ok, sanitization ok.
	}
}

if ( ! function_exists( 'kinginrin_get_content_class' ) ) {
	/**
	 * Retrieve the classes for the content.
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 * @return array Array of classes.
	 */
	function kinginrin_get_content_class( $class = '' ) {

		$classes = array();

		if ( !empty($class) ) {
			if ( !is_array( $class ) )
				$class = preg_split('#\s+#', $class);
			$classes = array_merge($classes, $class);
		}

		$classes = array_map('esc_attr', $classes);

		return apply_filters('kinginrin_content_class', $classes, $class);
	}
}

if ( ! function_exists( 'kinginrin_header_class' ) ) {
	/**
	 * Display the classes for the header.
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 */
	function kinginrin_header_class( $class = '' ) {
		// Separates classes with a single space, collates classes for post DIV
		echo 'class="' . join( ' ', kinginrin_get_header_class( $class ) ) . '"'; // WPCS: XSS ok, sanitization ok.
	}
}

if ( ! function_exists( 'kinginrin_get_header_class' ) ) {
	/**
	 * Retrieve the classes for the content.
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 * @return array Array of classes.
	 */
	function kinginrin_get_header_class( $class = '' ) {

		$classes = array();

		if ( !empty($class) ) {
			if ( !is_array( $class ) )
				$class = preg_split('#\s+#', $class);
			$classes = array_merge($classes, $class);
		}

		$classes = array_map('esc_attr', $classes);

		return apply_filters('kinginrin_header_class', $classes, $class);
	}
}

if ( ! function_exists( 'kinginrin_inside_header_class' ) ) {
	/**
	 * Display the classes for inside the header.
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 */
	function kinginrin_inside_header_class( $class = '' ) {
		// Separates classes with a single space, collates classes for post DIV
		echo 'class="' . join( ' ', kinginrin_get_inside_header_class( $class ) ) . '"'; // WPCS: XSS ok, sanitization ok.
	}
}

if ( ! function_exists( 'kinginrin_get_inside_header_class' ) ) {
	/**
	 * Retrieve the classes for inside the header.
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 * @return array Array of classes.
	 */
	function kinginrin_get_inside_header_class( $class = '' ) {

		$classes = array();

		if ( !empty($class) ) {
			if ( !is_array( $class ) )
				$class = preg_split('#\s+#', $class);
			$classes = array_merge($classes, $class);
		}

		$classes = array_map('esc_attr', $classes);

		return apply_filters('kinginrin_inside_header_class', $classes, $class);
	}
}

if ( ! function_exists( 'kinginrin_container_class' ) ) {
	/**
	 * Display the classes for the container.
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 */
	function kinginrin_container_class( $class = '' ) {
		// Separates classes with a single space, collates classes for post DIV
		echo 'class="' . join( ' ', kinginrin_get_container_class( $class ) ) . '"'; // WPCS: XSS ok, sanitization ok.
	}
}

if ( ! function_exists( 'kinginrin_get_container_class' ) ) {
	/**
	 * Retrieve the classes for the content.
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 * @return array Array of classes.
	 */
	function kinginrin_get_container_class( $class = '' ) {

		$classes = array();

		if ( !empty($class) ) {
			if ( !is_array( $class ) )
				$class = preg_split('#\s+#', $class);
			$classes = array_merge($classes, $class);
		}

		$classes = array_map('esc_attr', $classes);

		return apply_filters('kinginrin_container_class', $classes, $class);
	}
}

if ( ! function_exists( 'kinginrin_navigation_class' ) ) {
	/**
	 * Display the classes for the navigation.
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 */
	function kinginrin_navigation_class( $class = '' ) {
		// Separates classes with a single space, collates classes for post DIV
		echo 'class="' . join( ' ', kinginrin_get_navigation_class( $class ) ) . '"'; // WPCS: XSS ok, sanitization ok.
	}
}

if ( ! function_exists( 'kinginrin_get_navigation_class' ) ) {
	/**
	 * Retrieve the classes for the navigation.
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 * @return array Array of classes.
	 */
	function kinginrin_get_navigation_class( $class = '' ) {

		$classes = array();

		if ( !empty($class) ) {
			if ( !is_array( $class ) )
				$class = preg_split('#\s+#', $class);
			$classes = array_merge($classes, $class);
		}

		$classes = array_map('esc_attr', $classes);

		return apply_filters('kinginrin_navigation_class', $classes, $class);
	}
}

if ( ! function_exists( 'kinginrin_inside_navigation_class' ) ) {
	/**
	 * Display the classes for the inner navigation.
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 */
	function kinginrin_inside_navigation_class( $class = '' ) {
		$classes = array();

		if ( !empty($class) ) {
			if ( !is_array( $class ) )
				$class = preg_split('#\s+#', $class);
			$classes = array_merge($classes, $class);
		}

		$classes = array_map('esc_attr', $classes);

		$return = apply_filters('kinginrin_inside_navigation_class', $classes, $class);

		// Separates classes with a single space, collates classes for post DIV
		echo 'class="' . join( ' ', $return ) . '"'; // WPCS: XSS ok, sanitization ok.
	}
}

if ( ! function_exists( 'kinginrin_menu_class' ) ) {
	/**
	 * Display the classes for the navigation.
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 */
	function kinginrin_menu_class( $class = '' ) {
		// Separates classes with a single space, collates classes for post DIV
		echo 'class="' . join( ' ', kinginrin_get_menu_class( $class ) ) . '"'; // WPCS: XSS ok, sanitization ok.
	}
}

if ( ! function_exists( 'kinginrin_get_menu_class' ) ) {
	/**
	 * Retrieve the classes for the navigation.
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 * @return array Array of classes.
	 */
	function kinginrin_get_menu_class( $class = '' ) {

		$classes = array();

		if ( !empty($class) ) {
			if ( !is_array( $class ) )
				$class = preg_split('#\s+#', $class);
			$classes = array_merge($classes, $class);
		}

		$classes = array_map('esc_attr', $classes);

		return apply_filters('kinginrin_menu_class', $classes, $class);
	}
}

if ( ! function_exists( 'kinginrin_main_class' ) ) {
	/**
	 * Display the classes for the <main> container.
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 */
	function kinginrin_main_class( $class = '' ) {
		// Separates classes with a single space, collates classes for post DIV
		echo 'class="' . join( ' ', kinginrin_get_main_class( $class ) ) . '"'; // WPCS: XSS ok, sanitization ok.
	}
}

if ( ! function_exists( 'kinginrin_get_main_class' ) ) {
	/**
	 * Retrieve the classes for the footer.
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 * @return array Array of classes.
	 */
	function kinginrin_get_main_class( $class = '' ) {

		$classes = array();

		if ( !empty($class) ) {
			if ( !is_array( $class ) )
				$class = preg_split('#\s+#', $class);
			$classes = array_merge($classes, $class);
		}

		$classes = array_map('esc_attr', $classes);

		return apply_filters('kinginrin_main_class', $classes, $class);
	}
}

if ( ! function_exists( 'kinginrin_footer_class' ) ) {
	/**
	 * Display the classes for the footer.
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 */
	function kinginrin_footer_class( $class = '' ) {
		// Separates classes with a single space, collates classes for post DIV
		echo 'class="' . join( ' ', kinginrin_get_footer_class( $class ) ) . '"'; // WPCS: XSS ok, sanitization ok.
	}
}

if ( ! function_exists( 'kinginrin_get_footer_class' ) ) {
	/**
	 * Retrieve the classes for the footer.
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 * @return array Array of classes.
	 */
	function kinginrin_get_footer_class( $class = '' ) {

		$classes = array();

		if ( !empty($class) ) {
			if ( !is_array( $class ) )
				$class = preg_split('#\s+#', $class);
			$classes = array_merge($classes, $class);
		}

		$classes = array_map('esc_attr', $classes);

		return apply_filters('kinginrin_footer_class', $classes, $class);
	}
}

if ( ! function_exists( 'kinginrin_inside_footer_class' ) ) {
	/**
	 * Display the classes for the footer.
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 */
	function kinginrin_inside_footer_class( $class = '' ) {
		$classes = array();

		if ( !empty($class) ) {
			if ( !is_array( $class ) )
				$class = preg_split('#\s+#', $class);
			$classes = array_merge($classes, $class);
		}

		$classes = array_map('esc_attr', $classes);

		$return = apply_filters( 'kinginrin_inside_footer_class', $classes, $class );

		// Separates classes with a single space, collates classes for post DIV
		echo 'class="' . join( ' ', $return ) . '"'; // WPCS: XSS ok, sanitization ok.
	}
}

if ( ! function_exists( 'kinginrin_top_bar_class' ) ) {
	/**
	 * Display the classes for the top bar.
	 *
	 * @param string|array $class One or more classes to add to the class list.
	 */
	function kinginrin_top_bar_class( $class = '' ) {
		$classes = array();

		if ( !empty($class) ) {
			if ( !is_array( $class ) )
				$class = preg_split('#\s+#', $class);
			$classes = array_merge($classes, $class);
		}

		$classes = array_map('esc_attr', $classes);

		$return = apply_filters( 'kinginrin_top_bar_class', $classes, $class );

		// Separates classes with a single space, collates classes for post DIV
		echo 'class="' . join( ' ', $return ) . '"'; // WPCS: XSS ok, sanitization ok.
	}
}
