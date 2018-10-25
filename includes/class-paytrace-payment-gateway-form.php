<?php
/**
 *
 * Class for creating shortcode for displaying payment form.
 *
 * @link       https://www.lastdoorsolutions.com/
 * @since      1.0.0
 *
 * @package    paytrace_Payment_Gateway
 * @subpackage paytrace_Payment_Gateway/includes
 */


class Paytrace_Payment_Gateway_Form {

	/**
	 * Define the Option page functionality of the plugin.
	 */
	public function __construct() {
		//$this->options = get_option( 'hbl_option_name' );
		add_shortcode( 'paytrace_form',  array( $this,'paytrace_form_shortcode' ));
		//$this->hbl_form();

	}


	/**
	 * Add shortcode for payment form
	 */
	public function paytrace_form($atts)
	{
		//get the user input secret codes for payment form .
    // Access the encyrpted request fields and store the Encrypted Value
    // Send those values in the API request by prepending KeyName with 'encrypted_'.

		$form = '<h3>Paytrace Payment Form </h3>
		<div class="error-notice"></div>
		<div class="loading-notice">Processing Payment....Please wait</div>
        <div class="payment-form form-container"> 
        <Form method="post"   id="DemoForm"  action="" > ';
		$form .= '
		<div class="input-field">
        <label>Enter Price:</label>
        <input id="price" type="text" class="form-control pt-encrypt"   name="ccPrice" placeholder="11.20"/> 
        </div>
        <div class="input-field">
        <label>Enter Credit Card Number:</label>
        <input id="ccNumber" type="text" class="form-control pt-encrypt"   name="ccNumber" placeholder="Credit card number"/> 
        </div>
        <div class="input-field">
        <label>Enter Card Security code: </label>
        <input id="ccCSC" type="text"  class="form-control pt-encrypt"  name="ccCSC"  placeholder="Card security code" />
        </div>
        
        <div class="input-field">
        <input type="submit" id="submit_form" name="submit" value="submit"/>
        </div>
        </form>
        </div>';

		return $form;

	}

	/**
	 * Add shortcode for payment form
	 */
	public function paytrace_form_shortcode($atts)
	{

		$a = shortcode_atts( array(
			'price' => '000000010000',
			'productDesc' => 'something else',
		), $atts );


		return $this->paytrace_form($atts);
	}


}

//if( is_admin() )
$form_shortcode = new Paytrace_Payment_Gateway_Form();

