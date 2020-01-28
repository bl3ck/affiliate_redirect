<?php
/**
 * Plugin Name: Affiliate Redirect
 * Description: Redirects Affiliate to the affiliate dashboard
 * Version: 1.0
 * Author: Eugen-Bleck
 *
 * @package    Affiliate_Redirect
 * @author     eugenbleck
 * @since      1.0.0
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2020
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Affiliate_Redirect' ) ) {
	/**
	 *  Affiliate Redirect Class, which implements the adding of a unique ID to each user on
	 *  WordPress site.
	 */
	class Affiliate_Redirect {

		/**
		 *  Contructor for Custom ID; which calls actions, registers shortcode, loads up the plugin.
		 */
		public function __construct() {
			register_deactivation_hook( __FILE__, array( $this, 'affiliate_redirect_deactivate' ) );

			add_action( 'plugins_loaded', array( $this, 'affiliate_redirect_activation' ) );

			// add_action( 'activated_plugin', array( $this, 'affiliate_redirect_activation' ), 10, 2 );
		}

		/**
		 * Some comment on this method ...
		 */
		public function affiliate_redirect_activation() {
			if ( defined( 'AFFILIATES_CORE_VERSION' ) ) {
				$this->affiliate_redirect_init();
			}
		}

		/**
		 * Redirects user
		 */
		private function affiliate_redirect_init() {
			$user_id      = wp_get_current_user();
			$is_affiliate = affiliates_user_is_affiliate( $user_id );

			if ( $is_affiliate ) {
				var_dump('fish');
				$return_value = wp_safe_redirect( get_permalink( 2 ) );
				$return_value ? error_log( 'true') : error_log( 'false' );
				die;
			}
		}

		/**
		 * Registers deactivation hooks
		 */
		public function affiliate_redirect_deactivate() { }
	}
}

// Creating an instance of Affiliate Redirect.
$affiliate_redirect = new Affiliate_Redirect();
