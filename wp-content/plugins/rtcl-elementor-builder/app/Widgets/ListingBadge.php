<?php
/**
 * Main Elementor ListingBadge Class
 *
 * ListingBadge main class
 *
 * @author  RadiusTheme
 * @since   2.0.10
 * @package  RTCL_Elementor_Builder
 * @version 1.2
 */

namespace RtclElb\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Rtcl\Helpers\Functions;
use RtclElb\Widgets\WidgetSettings\ListingBadgeSettings;

/**
 * ListingBadge class
 */
class ListingBadge extends ListingBadgeSettings {

	/**
	 * Construct function
	 *
	 * @param array  $data Some data.
	 * @param [type] $args some arg.
	 */
	public function __construct( $data = [], $args = null ) {
		$this->rtcl_name = __( 'Listing Badge', 'rtcl-elementor-builder' );
		$this->rtcl_base = 'rt-listing-badge';
		parent::__construct( $data, $args );
	}

	/**
	 * Display Output.
	 *
	 * @return mixed
	 */
	protected function render() {

		$settings = $this->get_settings();

		$template_style = 'single/badge';
		$data           = [
			'template'              => $template_style,
			'instance'              => $settings,
			'listing'               => $this->listing,
			'default_template_path' => rtclElb()->get_plugin_template_path(),
		];
		$data           = apply_filters( 'rtcl_el_listing_page_badge_data', $data );
		Functions::get_template( $data['template'], $data, '', $data['default_template_path'] );

	}

}

