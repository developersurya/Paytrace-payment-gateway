<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.lastdoorsolutions.com/
 * @since      1.0.0
 *
 * @package    paytrace_Payment_Gateway
 * @subpackage paytrace_Payment_Gateway/public
 */


class Paytrace_Payment_Gateway_Public{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( ) {

		add_action( 'init', array( $this, 'enqueue_styles' ) );
		add_action( 'init', array( $this, 'enqueue_scripts' ) );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in paytrace_Payment_Gateway_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The paytrace_Payment_Gateway_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		//wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/paytrace-payment-gateway.css', array(), false, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in paytrace_Payment_Gateway_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The paytrace_Payment_Gateway_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		//wp_register_script( 'paytrace-localize', plugin_dir_url( __FILE__ ) . 'js/paytrace-localize.js');
		//wp_enqueue_script( 'paytrace-localize');
		wp_enqueue_script( 'paytrace',  'https://api.paytrace.com/assets/e2ee/paytrace-e2ee.js', array( 'jquery' ), false, false );
		wp_register_script( 'paytrace-script', plugin_dir_url( __FILE__ ) . 'js/paytrace-payment-gateway.js', array( 'jquery' ), false, false );

		wp_localize_script( 'paytrace-localize' , 'paytrace' , array('_url' => plugins_url('paytrace-payment-gateway/paytrace-api/')) );
		wp_enqueue_script( 'paytrace-script');

	}



}

$Paytrace = new Paytrace_Payment_Gateway_Public();
