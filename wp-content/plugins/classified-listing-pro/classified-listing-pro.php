<?php

/**
 * @wordpress-plugin
 * Plugin Name:             Classified Listing Pro – Classified ads & Business Directory Plugin
 * Plugin URI:              https://radiustheme.com/demo/wordpress/classifiedpro
 * Description:             This is the Add-on plugin for Classified Listing – Classified ads & Business Directory Plugin. By using this Addon you can get pro feature of all others Add-ons.
 * Version:                 2.1.11
 * Requires PHP:            7.4
 * Requires at least:       5.0
 * Tested up to:            6.1
 * Author:                  RadiusTheme
 * Author URI:              https://radiustheme.com
 * Text Domain:             classified-listing-pro
 * Domain Path:             /languages
 */

if ( defined( 'ABSPATH' ) === false ) {
	die( 'Keep Silent' );
}

// Define RTCL_PLUGIN_FILE

define( 'RTCL_PRO_VERSION', '2.1.11' );
define( 'RTCL_PRO_PLUGIN_FILE', __FILE__ );

require_once 'app/RtclPro.php';