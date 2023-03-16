<?php

require_once __DIR__ . './../vendor/autoload.php';

use RtclPro\Api\RestApi;
use RtclPro\Controllers\Ajax\RtclProAjax;
use RtclPro\Controllers\AuthController;
use RtclPro\Controllers\ChatController;
use RtclPro\Controllers\CommentController;
use RtclPro\Controllers\CompareController;
use RtclPro\Controllers\CronController;
use RtclPro\Controllers\BlockProController;
use RtclPro\Controllers\Hooks\ActionHooks;
use RtclPro\Controllers\Hooks\AdminSettingsHook;
use RtclPro\Controllers\Hooks\FilterHooks;
use RtclPro\Controllers\Hooks\PushNotificationHooks;
use RtclPro\Controllers\Hooks\TemplateHooks;
use RtclPro\Controllers\Hooks\TemplateLoader;
use RtclPro\Controllers\QuickViewController;
use RtclPro\Controllers\ScriptController;
use RtclPro\Controllers\SubscriptionController;
use RtclPro\Controllers\TermMetas;
use RtclPro\Helpers\Installer;
use RtclPro\Models\Dependencies;
use RtclPro\Controllers\ElementorController as ElController;

if ( ! class_exists( RtclPro::class ) ) :
	final class RtclPro {


		/**
		 * Store the singleton object.
		 */
		private static $singleton = false;

		/**
		 * Create an inaccessible constructor.
		 */
		private function __construct() {
			$this->init();
		}

		/**
		 * Fetch an instance of the class.
		 */
		final public static function getInstance() {
			if ( self::$singleton === false ) {
				self::$singleton = new self();
			}

			return self::$singleton;
		}

		/**
		 * Prevent cloning.
		 */
		final public function __clone() {
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'classified-listing-pro' ), '1.0' );
		}

		/**
		 * Prevent unserializing.
		 */
		final public function __wakeup() {
			_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'classified-listing-pro' ), '1.0' );
		}

		/**
		 * Auto-load in-accessible properties on demand.
		 *
		 * @param mixed $key Key name.
		 *
		 * @return mixed
		 */
		public function __get( $key ) {
			if ( in_array( $key, [ 'init', 'payment_gateways', 'plugins_loaded' ], true ) ) {
				return $this->$key();
			}
		}

		/**
		 * Classified Listing Constructor.
		 */
		protected function init() {
			$this->define_constants();
			$this->load_language();
			$this->hooks();

			new BlockProController();
		}

		private function hooks() {
			$dependence = Dependencies::getInstance();
			if ( $dependence->check() ) {
				// LicensingController::init();
				ScriptController::init();
				AdminSettingsHook::init();
				CompareController::init();
				QuickViewController::init();
				
				if(function_exists('rtrs')) {
					$args = array(
						'post_type' => 'rtrs',
						// 'meta_key'   => 'rtrs_post_type',
						// 'meta_value'   => 'rtcl_listing',
						'meta_query' => array(
							'relation' => 'AND',
							array(
								'key'     => 'rtrs_post_type',
								'value'   => 'rtcl_listing',
							),
							array(
								'key'     => 'rtrs_support',
								'value'   => 'schema',
								'compare' => '!=',
							),
						),
					);
					$the_query = new \WP_Query($args);
					if(is_object($the_query) && ! $the_query->found_posts){
						CommentController::init();
					}

				} else {
					CommentController::init();
				}
				ChatController::init();
				FilterHooks::init();
				ActionHooks::init();
				PushNotificationHooks::init();
				RtclProAjax::init();
				CronController::init();
				TermMetas::init();
				AuthController::init();
				( new RestApi() )->init();
				SubscriptionController::getInstance();
				if ( rtcl()->is_request( 'frontend' ) ) {
					TemplateHooks::init();
					add_action( 'init', [ TemplateLoader::class, 'init' ] );
				}
				if ( did_action( 'elementor/loaded' ) ) {
					ElController::init();
				}
				Installer::init();
				do_action( 'rtcl_pro_loaded', $this );
			}
		}

		public function load_language() {
			load_plugin_textdomain( 'classified-listing-pro', false, trailingslashit( RTCL_PRO_PLUGIN_DIRNAME ) . 'languages' );
		}

		private function define_constants() {
			if ( ! defined( 'RTCL_PRO_PATH' ) ) {
				define( 'RTCL_PRO_PATH', plugin_dir_path( RTCL_PRO_PLUGIN_FILE ) );
			}
			if ( ! defined( 'RTCL_PRO_URL' ) ) {
				define( 'RTCL_PRO_URL', plugins_url( '', RTCL_PRO_PLUGIN_FILE ) );
			}
			if ( ! defined( 'RTCL_PRO_SLUG' ) ) {
				define( 'RTCL_PRO_SLUG', basename( dirname( RTCL_PRO_PLUGIN_FILE ) ) );
			}

			if ( ! defined( 'RTCL_PRO_PLUGIN_DIRNAME' ) ) {
				define( 'RTCL_PRO_PLUGIN_DIRNAME', dirname( plugin_basename( RTCL_PRO_PLUGIN_FILE ) ) );
			}
			if ( ! defined( 'RTCL_PRO_PLUGIN_BASENAME' ) ) {
				define( 'RTCL_PRO_PLUGIN_BASENAME', plugin_basename( RTCL_PRO_PLUGIN_FILE ) );
			}
		}

		/**
		 * Define constant if not already set.
		 *
		 * @param string      $name  Constant name.
		 * @param string|bool $value Constant value.
		 */
		public function define( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}

		public function is_rtcl_active() {
			return class_exists( Rtcl::class );
		}

		/**
		 * Get the plugin path.
		 *
		 * @return string
		 */
		public function plugin_path() {
			return untrailingslashit( plugin_dir_path( RTCL_PRO_PLUGIN_FILE ) );
		}

		public function get_plugin_template_path() {
			return $this->plugin_path() . '/templates/';
		}

		/**
		 * @return string
		 * @deprecated since 2.0.0  Use `RTCL_PRO_VERSION` instead
		 */
		public function version() {
			_deprecated_function( __METHOD__, '2.0.0', 'RTCL_PRO_VERSION' );

			return RTCL_PRO_VERSION;
		}

		/**
		 * @param $file
		 *
		 * @return string
		 */
		public function get_assets_uri( $file ) {
			$file = ltrim( $file, '/' );

			return trailingslashit( RTCL_PRO_URL . '/assets' ) . $file;
		}

		/**
		 * Returns true if the request is a non-legacy REST API request.
		 *
		 * Legacy REST requests should still run some extra code for backwards compatibility.
		 *
		 * @return bool
		 */
		public function is_rest_api_request() {
			if ( empty( $_SERVER['REQUEST_URI'] ) ) {
				return false;
			}
			$rest_prefix         = trailingslashit( rest_get_url_prefix() );
			$is_rest_api_request = ( false !== strpos( $_SERVER['REQUEST_URI'], $rest_prefix ) ); // phpcs:disable WordPress.Security.ValidatedSanitizedInput.MissingUnslash, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized

			return apply_filters( 'rtcl_is_rest_api_request', $is_rest_api_request );
		}
	}

	/**
	 * @return bool|RtclPro
	 */
	function rtclPro() {
		return rtclPro::getInstance();
	}

	add_action( 'plugins_loaded', 'rtclPro', 20 );

	register_activation_hook( RTCL_PRO_PLUGIN_FILE, [ Installer::class, 'install' ] );
	register_deactivation_hook( RTCL_PRO_PLUGIN_FILE, [ Installer::class, 'deactivate' ] );
endif;
