<?php
/**
 * @author  RadiusTheme
 * @since   1.0.0
 * @version 1.0.1
 */

namespace RadiusTheme\ClassifiedLite\Customizer\Settings;

use RadiusTheme\ClassifiedLite\Customizer\Customizer;
use RadiusTheme\ClassifiedLite\Helper;

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class Error_Layout extends Customizer {

	public function __construct() {
		parent::instance();
		$this->populated_default_data();
		// Register Page Controls
		add_action( 'customize_register', [ $this, 'register_error_layout_controls' ] );
	}

	public function register_error_layout_controls( $wp_customize ) {
		// Top bar
		$wp_customize->add_setting( 'error_top_bar',
			[
				'default'           => $this->defaults['error_top_bar'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'error_top_bar', [
			'type'    => 'select',
			'section' => 'error_layout_section',
			'label'   => esc_html__( 'Top Bar', 'cl-classified' ),
			'choices' => [
				'default' => esc_html__( 'Default', 'cl-classified' ),
				'on'      => esc_html__( 'Enable', 'cl-classified' ),
				'off'     => esc_html__( 'Disable', 'cl-classified' ),
			],
		] );

		// Header Layout
		$wp_customize->add_setting( 'error_header_style',
			[
				'default'           => $this->defaults['error_header_style'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'error_header_style', [
			'type'    => 'select',
			'section' => 'error_layout_section',
			'label'   => esc_html__( 'Header Layout', 'cl-classified' ),
			'choices' => Helper::get_header_list(),
		] );

		// Menu Alignment
		$wp_customize->add_setting( 'error_menu_alignment', [
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'rttheme_text_sanitization',
			'default'           => $this->defaults['menu_alignment'],
		] );

		$wp_customize->add_control( 'error_menu_alignment', [
			'type'    => 'select',
			'section' => 'error_layout_section', // Add a default or your own section
			'label'   => esc_html__( 'Menu Alignment', 'cl-classified' ),
			'choices' => [
				'default'     => esc_html__( 'Default', 'cl-classified' ),
				'menu-left'   => esc_html__( 'Left Alignment', 'cl-classified' ),
				'menu-center' => esc_html__( 'Center Alignment', 'cl-classified' ),
				'menu-right'  => esc_html__( 'Right Alignment', 'cl-classified' ),
			],
		] );

		// Header width
		$wp_customize->add_setting( 'error_header_width', [
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'rttheme_text_sanitization',
			'default'           => $this->defaults['error_header_width'],
		] );

		$wp_customize->add_control( 'error_header_width', [
			'type'    => 'select',
			'section' => 'error_layout_section', // Add a default or your own section
			'label'   => esc_html__( 'Header Width', 'cl-classified' ),
			'choices' => [
				'default'   => esc_html__( 'Default', 'cl-classified' ),
				'box-width' => esc_html__( 'Box width', 'cl-classified' ),
				'fullwidth' => esc_html__( 'Fullwidth', 'cl-classified' ),
			],
		] );

		// Transparent Header
		$wp_customize->add_setting( 'error_tr_header',
			[
				'default'           => $this->defaults['error_tr_header'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'error_tr_header', [
			'type'    => 'select',
			'section' => 'error_layout_section',
			'label'   => esc_html__( 'Transparent Header', 'cl-classified' ),
			'choices' => [
				'default' => esc_html__( 'Default', 'cl-classified' ),
				'on'      => esc_html__( 'Enable', 'cl-classified' ),
				'off'     => esc_html__( 'Disable', 'cl-classified' ),
			],
		] );

		// Breadcrumb
		$wp_customize->add_setting( 'error_breadcrumb',
			[
				'default'           => $this->defaults['error_breadcrumb'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'error_breadcrumb', [
			'type'    => 'select',
			'section' => 'error_layout_section',
			'label'   => esc_html__( 'Breadcrumb', 'cl-classified' ),
			'choices' => [
				'default' => esc_html__( 'Default', 'cl-classified' ),
				'on'      => esc_html__( 'Enable', 'cl-classified' ),
				'off'     => esc_html__( 'Disable', 'cl-classified' ),
			],
		] );

		// Banner Search
		$wp_customize->add_setting( 'error_banner_search',
			[
				'default'           => $this->defaults['error_banner_search'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'error_banner_search', [
			'type'    => 'select',
			'section' => 'error_layout_section',
			'label'   => esc_html__( 'Banner Search', 'cl-classified' ),
			'choices' => [
				'default' => esc_html__( 'Default', 'cl-classified' ),
				'on'      => esc_html__( 'Enable', 'cl-classified' ),
				'off'     => esc_html__( 'Disable', 'cl-classified' ),
			],
		] );

		// Padding Top
		$wp_customize->add_setting( 'error_padding_top',
			[
				'default'           => $this->defaults['error_padding_top'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'error_padding_top',
			[
				'label'       => esc_html__( 'Content Padding Top', 'cl-classified' ),
				'description' => esc_html__( '404 Page Content Padding Top ', 'cl-classified' ),
				'section'     => 'error_layout_section',
				'type'        => 'text',
			]
		);

		// Padding Bottom
		$wp_customize->add_setting( 'error_padding_bottom',
			[
				'default'           => $this->defaults['error_padding_bottom'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'error_padding_bottom',
			[
				'label'       => esc_html__( 'Content Padding Bottom', 'cl-classified' ),
				'description' => esc_html__( '404 Page Content Padding Bottom', 'cl-classified' ),
				'section'     => 'error_layout_section',
				'type'        => 'text',
			]
		);

		// Footer Layout
		$wp_customize->add_setting( 'error_footer_style',
			[
				'default'           => $this->defaults['error_footer_style'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'error_footer_style', [
			'type'    => 'select',
			'section' => 'error_layout_section',
			'label'   => esc_html__( 'Footer Layout', 'cl-classified' ),
			'choices'     => Helper::get_footer_list(),
		] );
	}
}