<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://extensions.kwproductions121.com
 * @since             1.0.0
 * @package           Kwpsbb for woocommerce
 *
 * @wordpress-plugin
 * Plugin Name:       Kwpsbb for woocommerce
 * Plugin URI:        https://extensions/kwproductions121.com/kwpsbbwc
 * Description:       In woocommerce product details page a button shall be added to return back to category page when each category container more than one page.
 * Version:           1.0.0
 * Author:            KWProductions Co.
 * Author URI:        https://kwproductions121.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       kwpsbb-for-woocommerce
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'KWPSBB_FOR_WOOCOMMERCE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_kwpsbb_for_woocommerce() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-kwpsbb-for-woocommerce-activator.php';
	Kwpsbb_for_woocommerce_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_kwpsbb_for_woocommerce() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-kwpsbb-for-woocommerce-deactivator.php';
	Kwpsbb_for_woocommerce_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_kwpsbb_for_woocommerce' );
register_deactivation_hook( __FILE__, 'deactivate_kwpsbb_for_woocommerce' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-kwpsbb-for-woocommerce.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_kwpsbb_for_woocommerce() {

	$plugin = new Kwpsbb_for_woocommerce();
	$plugin->run();

}
run_kwpsbb_for_woocommerce();
