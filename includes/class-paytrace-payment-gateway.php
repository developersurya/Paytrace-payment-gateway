<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.lastdoorsolutions.com/
 * @since      1.0.0
 *
 * @package    paytrace_payment_gateway
 * @subpackage paytrace_payment_gateway/includes
 */


class Paytrace_payment_Gateway{
	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      paytrace_Payment_Gateway_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
	if ( defined( 'PLUGIN_NAME_VERSION' ) ) {
		$this->version = PLUGIN_NAME_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'paytrace-payment-gateway';

		$this->load_dependencies();
		//$this->set_locale();
		//$this->define_admin_hooks();
		//$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - paytrace_Payment_Gateway_option-page. Option page of the plugin.
	 * - paytrace_Payment_Gateway_form. Contain form/shortcode functionality.
	 * - paytrace_Payment_Gateway_mail. Defines mail function after submit.
	 * - paytrace_Payment_Gateway_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {
		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-paytrace-payment-gateway-public.php';
//		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-paytrace-payment-gateway-option-page.php';
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-paytrace-payment-gateway-form.php';
//		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-paytrace-payment-gateway-mail.php';
//		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-paytrace-payment-gateway-records.php';

		//$this->loader = new paytrace_Payment_Gateway_Loader();

	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
