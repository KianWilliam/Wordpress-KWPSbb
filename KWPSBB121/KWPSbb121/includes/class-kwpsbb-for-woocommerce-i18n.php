<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://extensions.kwproductions121.com
 * @since      1.0.0
 *
 * @package    Kwpsbb_for_woocommerce
 * @subpackage Kwpsbb_for_woocommerce/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Kwpsbb_for_woocommerce
 * @subpackage Kwpsbb_for_woocommerce/includes
 * @author     Kian William Nowrouzian<webarchitect@kwproductions121.com>
 */
class Kwpsbb_for_woocommerce_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'kwpsbb-for-woocommerce',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
