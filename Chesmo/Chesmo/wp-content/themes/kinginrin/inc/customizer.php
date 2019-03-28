<?php
/**
 * Builds our Customizer controls.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_action( 'customize_register', 'kinginrin_set_customizer_helpers', 1 );
/**
 * Set up helpers early so they're always available.
 * Other modules might need access to them at some point.
 *
 */
function kinginrin_set_customizer_helpers( $wp_customize ) {
	// Load helpers
	require_once trailingslashit( get_template_directory() ) . 'inc/customizer/customizer-helpers.php';
}

if ( ! function_exists( 'kinginrin_customize_register' ) ) {
	add_action( 'customize_register', 'kinginrin_customize_register' );
	/**
	 * Add our base options to the Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	function kinginrin_customize_register( $wp_customize ) {
		// Get our default values
		$defaults = kinginrin_get_defaults();

		// Load helpers
		require_once trailingslashit( get_template_directory() ) . 'inc/customizer/customizer-helpers.php';

		if ( $wp_customize->get_control( 'blogdescription' ) ) {
			$wp_customize->get_control('blogdescription')->priority = 3;
			$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
		}

		if ( $wp_customize->get_control( 'blogname' ) ) {
			$wp_customize->get_control('blogname')->priority = 1;
			$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
		}

		if ( $wp_customize->get_control( 'custom_logo' ) ) {
			$wp_customize->get_setting( 'custom_logo' )->transport = 'refresh';
		}

		// Add control types so controls can be built using JS
		if ( method_exists( $wp_customize, 'register_control_type' ) ) {
			$wp_customize->register_control_type( 'Kinginrin_Customize_Misc_Control' );
			$wp_customize->register_control_type( 'Kinginrin_Range_Slider_Control' );
		}

		// Add upsell section type
		if ( method_exists( $wp_customize, 'register_section_type' ) ) {
			$wp_customize->register_section_type( 'Kinginrin_Upsell_Section' );
		}

		// Add selective refresh to site title and description
		if ( isset( $wp_customize->selective_refresh ) ) {
			$wp_customize->selective_refresh->add_partial( 'blogname', array(
				'selector' => '.main-title a',
				'render_callback' => 'kinginrin_customize_partial_blogname',
			) );

			$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
				'selector' => '.site-description',
				'render_callback' => 'kinginrin_customize_partial_blogdescription',
			) );
		}

		// Remove title
		$wp_customize->add_setting(
			'kinginrin_settings[hide_title]',
			array(
				'default' => $defaults['hide_title'],
				'type' => 'option',
				'sanitize_callback' => 'kinginrin_sanitize_checkbox'
			)
		);

		$wp_customize->add_control(
			'kinginrin_settings[hide_title]',
			array(
				'type' => 'checkbox',
				'label' => __( 'Hide site title', 'kinginrin' ),
				'section' => 'title_tagline',
				'priority' => 2
			)
		);

		// Remove tagline
		$wp_customize->add_setting(
			'kinginrin_settings[hide_tagline]',
			array(
				'default' => $defaults['hide_tagline'],
				'type' => 'option',
				'sanitize_callback' => 'kinginrin_sanitize_checkbox'
			)
		);

		$wp_customize->add_control(
			'kinginrin_settings[hide_tagline]',
			array(
				'type' => 'checkbox',
				'label' => __( 'Hide site tagline', 'kinginrin' ),
				'section' => 'title_tagline',
				'priority' => 4
			)
		);

		$wp_customize->add_setting(
			'kinginrin_settings[retina_logo]',
			array(
				'type' => 'option',
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'kinginrin_settings[retina_logo]',
				array(
					'label' => __( 'Retina Logo', 'kinginrin' ),
					'section' => 'title_tagline',
					'settings' => 'kinginrin_settings[retina_logo]',
					'active_callback' => 'kinginrin_has_custom_logo_callback'
				)
			)
		);

		$wp_customize->add_setting(
			'kinginrin_settings[side_inside_color]', array(
				'default' => $defaults['side_inside_color'],
				'type' => 'option',
				'sanitize_callback' => 'kinginrin_sanitize_hex_color',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'kinginrin_settings[side_inside_color]',
				array(
					'label' => __( 'Inside padding', 'kinginrin' ),
					'section' => 'colors',
					'settings' => 'kinginrin_settings[side_inside_color]',
					'active_callback' => 'kinginrin_is_side_padding_active',
				)
			)
		);

		$wp_customize->add_setting(
			'kinginrin_settings[text_color]', array(
				'default' => $defaults['text_color'],
				'type' => 'option',
				'sanitize_callback' => 'kinginrin_sanitize_hex_color',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'kinginrin_settings[text_color]',
				array(
					'label' => __( 'Text Color', 'kinginrin' ),
					'section' => 'colors',
					'settings' => 'kinginrin_settings[text_color]'
				)
			)
		);

		$wp_customize->add_setting(
			'kinginrin_settings[link_color]', array(
				'default' => $defaults['link_color'],
				'type' => 'option',
				'sanitize_callback' => 'kinginrin_sanitize_hex_color',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'kinginrin_settings[link_color]',
				array(
					'label' => __( 'Link Color', 'kinginrin' ),
					'section' => 'colors',
					'settings' => 'kinginrin_settings[link_color]'
				)
			)
		);

		$wp_customize->add_setting(
			'kinginrin_settings[link_color_hover]', array(
				'default' => $defaults['link_color_hover'],
				'type' => 'option',
				'sanitize_callback' => 'kinginrin_sanitize_hex_color',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'kinginrin_settings[link_color_hover]',
				array(
					'label' => __( 'Link Color Hover', 'kinginrin' ),
					'section' => 'colors',
					'settings' => 'kinginrin_settings[link_color_hover]'
				)
			)
		);

		$wp_customize->add_setting(
			'kinginrin_settings[link_color_visited]', array(
				'default' => $defaults['link_color_visited'],
				'type' => 'option',
				'sanitize_callback' => 'kinginrin_sanitize_hex_color',
				'transport' => 'refresh',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'kinginrin_settings[link_color_visited]',
				array(
					'label' => __( 'Link Color Visited', 'kinginrin' ),
					'section' => 'colors',
					'settings' => 'kinginrin_settings[link_color_visited]'
				)
			)
		);

		if ( ! function_exists( 'kinginrin_colors_customize_register' ) && ! defined( 'KINGINRIN_PREMIUM_VERSION' ) ) {
			$wp_customize->add_control(
				new Kinginrin_Customize_Misc_Control(
					$wp_customize,
					'colors_get_addon_desc',
					array(
						'section' => 'colors',
						'type' => 'addon',
						'label' => __( 'More info', 'kinginrin' ),
						'description' => __( 'More colors are available in Kinginrin premium version. Visit wpkoi.com for more info.', 'kinginrin' ),
						'url' => esc_url( KINGINRIN_THEME_URL ),
						'priority' => 30,
						'settings' => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname'
					)
				)
			);
		}

		if ( class_exists( 'WP_Customize_Panel' ) ) {
			if ( ! $wp_customize->get_panel( 'kinginrin_layout_panel' ) ) {
				$wp_customize->add_panel( 'kinginrin_layout_panel', array(
					'priority' => 25,
					'title' => __( 'Layout', 'kinginrin' ),
				) );
			}
		}

		// Add Layout section
		$wp_customize->add_section(
			'kinginrin_layout_container',
			array(
				'title' => __( 'Container', 'kinginrin' ),
				'priority' => 10,
				'panel' => 'kinginrin_layout_panel'
			)
		);

		// Container width
		$wp_customize->add_setting(
			'kinginrin_settings[container_width]',
			array(
				'default' => $defaults['container_width'],
				'type' => 'option',
				'sanitize_callback' => 'kinginrin_sanitize_integer',
				'transport' => 'postMessage'
			)
		);

		$wp_customize->add_control(
			new Kinginrin_Range_Slider_Control(
				$wp_customize,
				'kinginrin_settings[container_width]',
				array(
					'type' => 'kinginrin-range-slider',
					'label' => __( 'Container Width', 'kinginrin' ),
					'section' => 'kinginrin_layout_container',
					'settings' => array(
						'desktop' => 'kinginrin_settings[container_width]',
					),
					'choices' => array(
						'desktop' => array(
							'min' => 700,
							'max' => 2000,
							'step' => 5,
							'edit' => true,
							'unit' => 'px',
						),
					),
					'priority' => 0,
				)
			)
		);

		// Add Top Bar section
		$wp_customize->add_section(
			'kinginrin_top_bar',
			array(
				'title' => __( 'Top Bar', 'kinginrin' ),
				'priority' => 15,
				'panel' => 'kinginrin_layout_panel',
			)
		);

		// Add Top Bar width
		$wp_customize->add_setting(
			'kinginrin_settings[top_bar_width]',
			array(
				'default' => $defaults['top_bar_width'],
				'type' => 'option',
				'sanitize_callback' => 'kinginrin_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add Top Bar width control
		$wp_customize->add_control(
			'kinginrin_settings[top_bar_width]',
			array(
				'type' => 'select',
				'label' => __( 'Top Bar Width', 'kinginrin' ),
				'section' => 'kinginrin_top_bar',
				'choices' => array(
					'full' => __( 'Full', 'kinginrin' ),
					'contained' => __( 'Contained', 'kinginrin' )
				),
				'settings' => 'kinginrin_settings[top_bar_width]',
				'priority' => 5,
				'active_callback' => 'kinginrin_is_top_bar_active',
			)
		);

		// Add Top Bar inner width
		$wp_customize->add_setting(
			'kinginrin_settings[top_bar_inner_width]',
			array(
				'default' => $defaults['top_bar_inner_width'],
				'type' => 'option',
				'sanitize_callback' => 'kinginrin_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add Top Bar width control
		$wp_customize->add_control(
			'kinginrin_settings[top_bar_inner_width]',
			array(
				'type' => 'select',
				'label' => __( 'Top Bar Inner Width', 'kinginrin' ),
				'section' => 'kinginrin_top_bar',
				'choices' => array(
					'full' => __( 'Full', 'kinginrin' ),
					'contained' => __( 'Contained', 'kinginrin' )
				),
				'settings' => 'kinginrin_settings[top_bar_inner_width]',
				'priority' => 10,
				'active_callback' => 'kinginrin_is_top_bar_active',
			)
		);

		// Add top bar alignment
		$wp_customize->add_setting(
			'kinginrin_settings[top_bar_alignment]',
			array(
				'default' => $defaults['top_bar_alignment'],
				'type' => 'option',
				'sanitize_callback' => 'kinginrin_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'kinginrin_settings[top_bar_alignment]',
			array(
				'type' => 'select',
				'label' => __( 'Top Bar Alignment', 'kinginrin' ),
				'section' => 'kinginrin_top_bar',
				'choices' => array(
					'left' => __( 'Left', 'kinginrin' ),
					'center' => __( 'Center', 'kinginrin' ),
					'right' => __( 'Right', 'kinginrin' )
				),
				'settings' => 'kinginrin_settings[top_bar_alignment]',
				'priority' => 15,
				'active_callback' => 'kinginrin_is_top_bar_active',
			)
		);

		// Add Header section
		$wp_customize->add_section(
			'kinginrin_layout_header',
			array(
				'title' => __( 'Header', 'kinginrin' ),
				'priority' => 20,
				'panel' => 'kinginrin_layout_panel'
			)
		);

		// Add Header Layout setting
		$wp_customize->add_setting(
			'kinginrin_settings[header_layout_setting]',
			array(
				'default' => $defaults['header_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'kinginrin_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add Header Layout control
		$wp_customize->add_control(
			'kinginrin_settings[header_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Header Width', 'kinginrin' ),
				'section' => 'kinginrin_layout_header',
				'choices' => array(
					'fluid-header' => __( 'Full', 'kinginrin' ),
					'contained-header' => __( 'Contained', 'kinginrin' )
				),
				'settings' => 'kinginrin_settings[header_layout_setting]',
				'priority' => 5
			)
		);

		// Add Inside Header Layout setting
		$wp_customize->add_setting(
			'kinginrin_settings[header_inner_width]',
			array(
				'default' => $defaults['header_inner_width'],
				'type' => 'option',
				'sanitize_callback' => 'kinginrin_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add Header Layout control
		$wp_customize->add_control(
			'kinginrin_settings[header_inner_width]',
			array(
				'type' => 'select',
				'label' => __( 'Inner Header Width', 'kinginrin' ),
				'section' => 'kinginrin_layout_header',
				'choices' => array(
					'contained' => __( 'Contained', 'kinginrin' ),
					'full-width' => __( 'Full', 'kinginrin' )
				),
				'settings' => 'kinginrin_settings[header_inner_width]',
				'priority' => 6
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'kinginrin_settings[header_alignment_setting]',
			array(
				'default' => $defaults['header_alignment_setting'],
				'type' => 'option',
				'sanitize_callback' => 'kinginrin_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'kinginrin_settings[header_alignment_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Header Alignment', 'kinginrin' ),
				'section' => 'kinginrin_layout_header',
				'choices' => array(
					'left' => __( 'Left', 'kinginrin' ),
					'center' => __( 'Center', 'kinginrin' ),
					'right' => __( 'Right', 'kinginrin' )
				),
				'settings' => 'kinginrin_settings[header_alignment_setting]',
				'priority' => 10
			)
		);

		$wp_customize->add_section(
			'kinginrin_layout_navigation',
			array(
				'title' => __( 'Primary Navigation', 'kinginrin' ),
				'priority' => 30,
				'panel' => 'kinginrin_layout_panel'
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'kinginrin_settings[nav_layout_setting]',
			array(
				'default' => $defaults['nav_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'kinginrin_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'kinginrin_settings[nav_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Navigation Width', 'kinginrin' ),
				'section' => 'kinginrin_layout_navigation',
				'choices' => array(
					'fluid-nav' => __( 'Full', 'kinginrin' ),
					'contained-nav' => __( 'Contained', 'kinginrin' )
				),
				'settings' => 'kinginrin_settings[nav_layout_setting]',
				'priority' => 15
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'kinginrin_settings[nav_inner_width]',
			array(
				'default' => $defaults['nav_inner_width'],
				'type' => 'option',
				'sanitize_callback' => 'kinginrin_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'kinginrin_settings[nav_inner_width]',
			array(
				'type' => 'select',
				'label' => __( 'Inner Navigation Width', 'kinginrin' ),
				'section' => 'kinginrin_layout_navigation',
				'choices' => array(
					'contained' => __( 'Contained', 'kinginrin' ),
					'full-width' => __( 'Full', 'kinginrin' )
				),
				'settings' => 'kinginrin_settings[nav_inner_width]',
				'priority' => 16
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'kinginrin_settings[nav_alignment_setting]',
			array(
				'default' => $defaults['nav_alignment_setting'],
				'type' => 'option',
				'sanitize_callback' => 'kinginrin_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'kinginrin_settings[nav_alignment_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Navigation Alignment', 'kinginrin' ),
				'section' => 'kinginrin_layout_navigation',
				'choices' => array(
					'left' => __( 'Left', 'kinginrin' ),
					'center' => __( 'Center', 'kinginrin' ),
					'right' => __( 'Right', 'kinginrin' )
				),
				'settings' => 'kinginrin_settings[nav_alignment_setting]',
				'priority' => 20
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'kinginrin_settings[nav_position_setting]',
			array(
				'default' => $defaults['nav_position_setting'],
				'type' => 'option',
				'sanitize_callback' => 'kinginrin_sanitize_choices',
				'transport' => ( '' !== kinginrin_get_setting( 'nav_position_setting' ) ) ? 'postMessage' : 'refresh'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'kinginrin_settings[nav_position_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Navigation Location', 'kinginrin' ),
				'section' => 'kinginrin_layout_navigation',
				'choices' => array(
					'nav-below-header' => __( 'Below Header', 'kinginrin' ),
					'nav-above-header' => __( 'Above Header', 'kinginrin' ),
					'nav-float-right' => __( 'Float Right', 'kinginrin' ),
					'nav-float-left' => __( 'Float Left', 'kinginrin' ),
					'nav-left-sidebar' => __( 'Left Sidebar', 'kinginrin' ),
					'nav-right-sidebar' => __( 'Right Sidebar', 'kinginrin' ),
					'' => __( 'No Navigation', 'kinginrin' )
				),
				'settings' => 'kinginrin_settings[nav_position_setting]',
				'priority' => 22
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'kinginrin_settings[nav_dropdown_type]',
			array(
				'default' => $defaults['nav_dropdown_type'],
				'type' => 'option',
				'sanitize_callback' => 'kinginrin_sanitize_choices'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'kinginrin_settings[nav_dropdown_type]',
			array(
				'type' => 'select',
				'label' => __( 'Navigation Dropdown', 'kinginrin' ),
				'section' => 'kinginrin_layout_navigation',
				'choices' => array(
					'hover' => __( 'Hover', 'kinginrin' ),
					'click' => __( 'Click - Menu Item', 'kinginrin' ),
					'click-arrow' => __( 'Click - Arrow', 'kinginrin' )
				),
				'settings' => 'kinginrin_settings[nav_dropdown_type]',
				'priority' => 22
			)
		);

		// Add navigation setting
		$wp_customize->add_setting(
			'kinginrin_settings[nav_search]',
			array(
				'default' => $defaults['nav_search'],
				'type' => 'option',
				'sanitize_callback' => 'kinginrin_sanitize_choices'
			)
		);

		// Add navigation control
		$wp_customize->add_control(
			'kinginrin_settings[nav_search]',
			array(
				'type' => 'select',
				'label' => __( 'Navigation Search', 'kinginrin' ),
				'section' => 'kinginrin_layout_navigation',
				'choices' => array(
					'enable' => __( 'Enable', 'kinginrin' ),
					'disable' => __( 'Disable', 'kinginrin' )
				),
				'settings' => 'kinginrin_settings[nav_search]',
				'priority' => 23
			)
		);

		// Add content setting
		$wp_customize->add_setting(
			'kinginrin_settings[content_layout_setting]',
			array(
				'default' => $defaults['content_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'kinginrin_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add content control
		$wp_customize->add_control(
			'kinginrin_settings[content_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Content Layout', 'kinginrin' ),
				'section' => 'kinginrin_layout_container',
				'choices' => array(
					'separate-containers' => __( 'Separate Containers', 'kinginrin' ),
					'one-container' => __( 'One Container', 'kinginrin' )
				),
				'settings' => 'kinginrin_settings[content_layout_setting]',
				'priority' => 25
			)
		);

		$wp_customize->add_section(
			'kinginrin_layout_sidecontent',
			array(
				'title' => __( 'Fixed Side Content', 'kinginrin' ),
				'priority' => 39,
				'panel' => 'kinginrin_layout_panel'
			)
		);
		
		$wp_customize->add_setting(
			'kinginrin_settings[fixed_side_content]',
			array(
				'default' => $defaults['fixed_side_content'],
				'type' => 'option',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'kinginrin_settings[fixed_side_content]',
			array(
				'type' 		 => 'textarea',
				'label'      => __( 'Fixed Side Content', 'kinginrin' ),
				'description'=> __( 'Content that You want to display fixed on the left.', 'kinginrin' ),
				'section'    => 'kinginrin_layout_sidecontent',
				'settings'   => 'kinginrin_settings[fixed_side_content]',
			)
		);

		$wp_customize->add_section(
			'kinginrin_layout_sidebars',
			array(
				'title' => __( 'Sidebars', 'kinginrin' ),
				'priority' => 40,
				'panel' => 'kinginrin_layout_panel'
			)
		);

		// Add Layout setting
		$wp_customize->add_setting(
			'kinginrin_settings[layout_setting]',
			array(
				'default' => $defaults['layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'kinginrin_sanitize_choices'
			)
		);

		// Add Layout control
		$wp_customize->add_control(
			'kinginrin_settings[layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Sidebar Layout', 'kinginrin' ),
				'section' => 'kinginrin_layout_sidebars',
				'choices' => array(
					'left-sidebar' => __( 'Sidebar / Content', 'kinginrin' ),
					'right-sidebar' => __( 'Content / Sidebar', 'kinginrin' ),
					'no-sidebar' => __( 'Content (no sidebars)', 'kinginrin' ),
					'both-sidebars' => __( 'Sidebar / Content / Sidebar', 'kinginrin' ),
					'both-left' => __( 'Sidebar / Sidebar / Content', 'kinginrin' ),
					'both-right' => __( 'Content / Sidebar / Sidebar', 'kinginrin' )
				),
				'settings' => 'kinginrin_settings[layout_setting]',
				'priority' => 30
			)
		);

		// Add Layout setting
		$wp_customize->add_setting(
			'kinginrin_settings[blog_layout_setting]',
			array(
				'default' => $defaults['blog_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'kinginrin_sanitize_choices'
			)
		);

		// Add Layout control
		$wp_customize->add_control(
			'kinginrin_settings[blog_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Blog Sidebar Layout', 'kinginrin' ),
				'section' => 'kinginrin_layout_sidebars',
				'choices' => array(
					'left-sidebar' => __( 'Sidebar / Content', 'kinginrin' ),
					'right-sidebar' => __( 'Content / Sidebar', 'kinginrin' ),
					'no-sidebar' => __( 'Content (no sidebars)', 'kinginrin' ),
					'both-sidebars' => __( 'Sidebar / Content / Sidebar', 'kinginrin' ),
					'both-left' => __( 'Sidebar / Sidebar / Content', 'kinginrin' ),
					'both-right' => __( 'Content / Sidebar / Sidebar', 'kinginrin' )
				),
				'settings' => 'kinginrin_settings[blog_layout_setting]',
				'priority' => 35
			)
		);

		// Add Layout setting
		$wp_customize->add_setting(
			'kinginrin_settings[single_layout_setting]',
			array(
				'default' => $defaults['single_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'kinginrin_sanitize_choices'
			)
		);

		// Add Layout control
		$wp_customize->add_control(
			'kinginrin_settings[single_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Single Post Sidebar Layout', 'kinginrin' ),
				'section' => 'kinginrin_layout_sidebars',
				'choices' => array(
					'left-sidebar' => __( 'Sidebar / Content', 'kinginrin' ),
					'right-sidebar' => __( 'Content / Sidebar', 'kinginrin' ),
					'no-sidebar' => __( 'Content (no sidebars)', 'kinginrin' ),
					'both-sidebars' => __( 'Sidebar / Content / Sidebar', 'kinginrin' ),
					'both-left' => __( 'Sidebar / Sidebar / Content', 'kinginrin' ),
					'both-right' => __( 'Content / Sidebar / Sidebar', 'kinginrin' )
				),
				'settings' => 'kinginrin_settings[single_layout_setting]',
				'priority' => 36
			)
		);

		$wp_customize->add_section(
			'kinginrin_layout_footer',
			array(
				'title' => __( 'Footer', 'kinginrin' ),
				'priority' => 50,
				'panel' => 'kinginrin_layout_panel'
			)
		);

		// Add footer setting
		$wp_customize->add_setting(
			'kinginrin_settings[footer_layout_setting]',
			array(
				'default' => $defaults['footer_layout_setting'],
				'type' => 'option',
				'sanitize_callback' => 'kinginrin_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add content control
		$wp_customize->add_control(
			'kinginrin_settings[footer_layout_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Footer Width', 'kinginrin' ),
				'section' => 'kinginrin_layout_footer',
				'choices' => array(
					'fluid-footer' => __( 'Full', 'kinginrin' ),
					'contained-footer' => __( 'Contained', 'kinginrin' )
				),
				'settings' => 'kinginrin_settings[footer_layout_setting]',
				'priority' => 40
			)
		);

		// Add footer setting
		$wp_customize->add_setting(
			'kinginrin_settings[footer_widgets_inner_width]',
			array(
				'default' => $defaults['footer_widgets_inner_width'],
				'type' => 'option',
				'sanitize_callback' => 'kinginrin_sanitize_choices',
			)
		);

		// Add content control
		$wp_customize->add_control(
			'kinginrin_settings[footer_widgets_inner_width]',
			array(
				'type' => 'select',
				'label' => __( 'Inner Footer Widgets Width', 'kinginrin' ),
				'section' => 'kinginrin_layout_footer',
				'choices' => array(
					'contained' => __( 'Contained', 'kinginrin' ),
					'full-width' => __( 'Full', 'kinginrin' )
				),
				'settings' => 'kinginrin_settings[footer_widgets_inner_width]',
				'priority' => 41
			)
		);

		// Add footer setting
		$wp_customize->add_setting(
			'kinginrin_settings[footer_inner_width]',
			array(
				'default' => $defaults['footer_inner_width'],
				'type' => 'option',
				'sanitize_callback' => 'kinginrin_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add content control
		$wp_customize->add_control(
			'kinginrin_settings[footer_inner_width]',
			array(
				'type' => 'select',
				'label' => __( 'Inner Footer Width', 'kinginrin' ),
				'section' => 'kinginrin_layout_footer',
				'choices' => array(
					'contained' => __( 'Contained', 'kinginrin' ),
					'full-width' => __( 'Full', 'kinginrin' )
				),
				'settings' => 'kinginrin_settings[footer_inner_width]',
				'priority' => 41
			)
		);

		// Add footer widget setting
		$wp_customize->add_setting(
			'kinginrin_settings[footer_widget_setting]',
			array(
				'default' => $defaults['footer_widget_setting'],
				'type' => 'option',
				'sanitize_callback' => 'kinginrin_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add footer widget control
		$wp_customize->add_control(
			'kinginrin_settings[footer_widget_setting]',
			array(
				'type' => 'select',
				'label' => __( 'Footer Widgets', 'kinginrin' ),
				'section' => 'kinginrin_layout_footer',
				'choices' => array(
					'0' => '0',
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5'
				),
				'settings' => 'kinginrin_settings[footer_widget_setting]',
				'priority' => 45
			)
		);

		// Copyright
		$wp_customize->add_setting(
			'kinginrin_settings[footer_copyright]',
			array(
				'default' => $defaults['footer_copyright'],
				'type' => 'option',
				'sanitize_callback' => 'wp_kses_post',
				'transport' => 'postMessage',
			)
		);

		$wp_customize->add_control(
			'kinginrin_settings[footer_copyright]',
			array(
				'type' 		 => 'textarea',
				'label'      => __( 'Copyright', 'kinginrin' ),
				'section'    => 'kinginrin_layout_footer',
				'settings'   => 'kinginrin_settings[footer_copyright]',
				'priority' => 50,
			)
		);

		// Add footer widget setting
		$wp_customize->add_setting(
			'kinginrin_settings[footer_bar_alignment]',
			array(
				'default' => $defaults['footer_bar_alignment'],
				'type' => 'option',
				'sanitize_callback' => 'kinginrin_sanitize_choices',
				'transport' => 'postMessage'
			)
		);

		// Add footer widget control
		$wp_customize->add_control(
			'kinginrin_settings[footer_bar_alignment]',
			array(
				'type' => 'select',
				'label' => __( 'Footer Bar Alignment', 'kinginrin' ),
				'section' => 'kinginrin_layout_footer',
				'choices' => array(
					'left' => __( 'Left','kinginrin' ),
					'center' => __( 'Center','kinginrin' ),
					'right' => __( 'Right','kinginrin' )
				),
				'settings' => 'kinginrin_settings[footer_bar_alignment]',
				'priority' => 47,
				'active_callback' => 'kinginrin_is_footer_bar_active'
			)
		);

		// Add back to top setting
		$wp_customize->add_setting(
			'kinginrin_settings[back_to_top]',
			array(
				'default' => $defaults['back_to_top'],
				'type' => 'option',
				'sanitize_callback' => 'kinginrin_sanitize_choices'
			)
		);

		// Add content control
		$wp_customize->add_control(
			'kinginrin_settings[back_to_top]',
			array(
				'type' => 'select',
				'label' => __( 'Back to Top Button', 'kinginrin' ),
				'section' => 'kinginrin_layout_footer',
				'choices' => array(
					'enable' => __( 'Enable', 'kinginrin' ),
					'' => __( 'Disable', 'kinginrin' )
				),
				'settings' => 'kinginrin_settings[back_to_top]',
				'priority' => 50
			)
		);

		// Add Layout section
		$wp_customize->add_section(
			'kinginrin_blog_section',
			array(
				'title' => __( 'Blog', 'kinginrin' ),
				'priority' => 55,
				'panel' => 'kinginrin_layout_panel'
			)
		);

		$wp_customize->add_setting(
			'kinginrin_settings[blog_header_image]',
			array(
				'default' => $defaults['blog_header_image'],
				'type' => 'option',
				'sanitize_callback' => 'esc_url_raw'
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'kinginrin_settings[blog_header_image]',
				array(
					'label' => __( 'First Blog Header image', 'kinginrin' ),
					'section' => 'kinginrin_blog_section',
					'settings' => 'kinginrin_settings[blog_header_image]',
					'description' => __( 'A standing image looks better. (Recommended size: 640*800px)', 'kinginrin' )
				)
			)
		);

		// Blog header texts
		$wp_customize->add_setting(
			'kinginrin_settings[blog_header_title]',
			array(
				'default' => $defaults['blog_header_title'],
				'type' => 'option',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'kinginrin_settings[blog_header_title]',
			array(
				'type' 		 => 'textarea',
				'label'      => __( 'Blog Header title', 'kinginrin' ),
				'section'    => 'kinginrin_blog_section',
				'settings'   => 'kinginrin_settings[blog_header_title]',
			)
		);
		
		$wp_customize->add_setting(
			'kinginrin_settings[blog_header_text]',
			array(
				'default' => $defaults['blog_header_text'],
				'type' => 'option',
				'sanitize_callback' => 'wp_kses_post',
			)
		);

		$wp_customize->add_control(
			'kinginrin_settings[blog_header_text]',
			array(
				'type' 		 => 'textarea',
				'label'      => __( 'Blog Header text', 'kinginrin' ),
				'section'    => 'kinginrin_blog_section',
				'settings'   => 'kinginrin_settings[blog_header_text]',
			)
		);
		
		$wp_customize->add_setting(
			'kinginrin_settings[blog_header_button_text]',
			array(
				'default' => $defaults['blog_header_button_text'],
				'type' => 'option',
				'sanitize_callback' => 'esc_html',
			)
		);

		$wp_customize->add_control(
			'kinginrin_settings[blog_header_button_text]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Blog Header button text', 'kinginrin' ),
				'section'    => 'kinginrin_blog_section',
				'settings'   => 'kinginrin_settings[blog_header_button_text]',
			)
		);
		
		$wp_customize->add_setting(
			'kinginrin_settings[blog_header_button_url]',
			array(
				'default' => $defaults['blog_header_button_url'],
				'type' => 'option',
				'sanitize_callback' => 'esc_url',
			)
		);

		$wp_customize->add_control(
			'kinginrin_settings[blog_header_button_url]',
			array(
				'type' 		 => 'text',
				'label'      => __( 'Blog Header button url', 'kinginrin' ),
				'section'    => 'kinginrin_blog_section',
				'settings'   => 'kinginrin_settings[blog_header_button_url]',
			)
		);

		// Add Layout setting
		$wp_customize->add_setting(
			'kinginrin_settings[post_content]',
			array(
				'default' => $defaults['post_content'],
				'type' => 'option',
				'sanitize_callback' => 'kinginrin_sanitize_blog_excerpt'
			)
		);

		// Add Layout control
		$wp_customize->add_control(
			'blog_content_control',
			array(
				'type' => 'select',
				'label' => __( 'Content Type', 'kinginrin' ),
				'section' => 'kinginrin_blog_section',
				'choices' => array(
					'full' => __( 'Full', 'kinginrin' ),
					'excerpt' => __( 'Excerpt', 'kinginrin' )
				),
				'settings' => 'kinginrin_settings[post_content]',
				'priority' => 10
			)
		);

		if ( ! function_exists( 'kinginrin_blog_customize_register' ) && ! defined( 'KINGINRIN_PREMIUM_VERSION' ) ) {
			$wp_customize->add_control(
				new Kinginrin_Customize_Misc_Control(
					$wp_customize,
					'blog_get_addon_desc',
					array(
						'section' => 'kinginrin_blog_section',
						'type' => 'addon',
						'label' => __( 'Learn more', 'kinginrin' ),
						'description' => __( 'More options are available for this section in our premium version.', 'kinginrin' ),
						'url' => esc_url( KINGINRIN_THEME_URL ),
						'priority' => 30,
						'settings' => ( isset( $wp_customize->selective_refresh ) ) ? array() : 'blogname'
					)
				)
			);
		}

		// Add Performance section
		$wp_customize->add_section(
			'kinginrin_general_section',
			array(
				'title' => __( 'General', 'kinginrin' ),
				'priority' => 99
			)
		);

		if ( ! apply_filters( 'kinginrin_fontawesome_essentials', false ) ) {
			$wp_customize->add_setting(
				'kinginrin_settings[font_awesome_essentials]',
				array(
					'default' => $defaults['font_awesome_essentials'],
					'type' => 'option',
					'sanitize_callback' => 'kinginrin_sanitize_checkbox'
				)
			);

			$wp_customize->add_control(
				'kinginrin_settings[font_awesome_essentials]',
				array(
					'type' => 'checkbox',
					'label' => __( 'Load essential icons only', 'kinginrin' ),
					'description' => __( 'Load essential Font Awesome icons instead of the full library.', 'kinginrin' ),
					'section' => 'kinginrin_general_section',
					'settings' => 'kinginrin_settings[font_awesome_essentials]',
				)
			);
		}

		// Add Kinginrin Premium section
		if ( ! defined( 'KINGINRIN_PREMIUM_VERSION' ) ) {
			$wp_customize->add_section(
				new Kinginrin_Upsell_Section( $wp_customize, 'kinginrin_upsell_section',
					array(
						'pro_text' => __( 'Get Premium for more!', 'kinginrin' ),
						'pro_url' => esc_url( KINGINRIN_THEME_URL ),
						'capability' => 'edit_theme_options',
						'priority' => 555,
						'type' => 'kinginrin-upsell-section',
					)
				)
			);
		}
	}
}

if ( ! function_exists( 'kinginrin_customizer_live_preview' ) ) {
	add_action( 'customize_preview_init', 'kinginrin_customizer_live_preview', 100 );
	/**
	 * Add our live preview scripts
	 *
	 */
	function kinginrin_customizer_live_preview() {
		wp_enqueue_script( 'kinginrin-themecustomizer', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/controls/js/customizer-live-preview.js', array( 'customize-preview' ), KINGINRIN_VERSION, true );
	}
}
