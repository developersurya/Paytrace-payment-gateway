<?php

/**
 * The plugin main file
 *
 * @link              https://www.lastdoorsolutions.com/
 * @since             1.0.0
 * @package           paytrace_payment_gateway
 *
 * @wordpress-plugin
 * Plugin Name:       PayTrace payment gateway
 * Plugin URI:        https://www.lastdoorsolutions.com/
 * Description:       PayTrace Payment Gateway plugin allow you to integrate payment form easily by adding shortcode.Plugin provide simple interface and easy option to manage your credentials.Just use in any page or post with shortcode [paytrace_form].
 * Version:           1.0.0
 * Author:            lastdoorsolutions
 * Author URI:        https://www.lastdoorsolutions.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       paytrace-payment-gateway
 * Domain Path:       /languages
 */


//////////////Note/////////////////
//-API URL https://developers.paytrace.com/
//-Developer need to make sandbox account and get the public_key.pem
//-PayTrace api folder has been inspired by https://github.com/PayTrace/api-demo/tree/master/php
///////////////////////////////////


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-hbl-payment-gateway-activator.php
 */
function activate_paytrace_payment_gateway() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-paytrace-payment-gateway-activator.php';
	Paytrace_Payment_Gateway_Activator::activate();

}


/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-hbl-payment-gateway-deactivator.php
 */
function deactivate_paytrace_payment_gateway() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-paytrace-payment-gateway-deactivator.php';
	Paytrace_Payment_Gateway_Deactivator::deactivate();
}
register_activation_hook( __FILE__, 'activate_paytrace_payment_gateway' );
register_deactivation_hook( __FILE__, 'deactivate_paytrace_payment_gateway' );




/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-paytrace-payment-gateway.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_paytrace_payment_gateway() {

	$plugin = new Paytrace_Payment_Gateway();
	//$plugin->run();

}
run_paytrace_payment_gateway();
