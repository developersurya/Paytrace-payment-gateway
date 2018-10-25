<?php
include 'PhpApiSettings.php';
include 'Utilities.php';
include 'Json.php';


//call a function of Utilities.php to generate oAuth token 
//This sample code doesn't use any 0Auth Library
$oauth_result = oAuthTokenGenerator();

//call a function of Utilities.php to verify if there is any error with OAuth token. 
$oauth_moveforward = isFoundOAuthTokenError( $oauth_result );

//If IsFoundOAuthTokenError results True, means no error 
//next is to move forward for the actual request 

if ( ! $oauth_moveforward ) {
	//Decode the Raw Json response.
	$json = jsonDecode( $oauth_result['temp_json_response'] );

	//set Authentication value based on the successful oAuth response.
	//Add a space between 'Bearer' and access _token
	$oauth_token = sprintf( "Bearer %s", $json['access_token'] );

	// Build the transaction
	buildTransaction( $oauth_token );

}
//end of main script


function buildTransaction( $oauth_token ) {
	// Build the request data
	$request_data = buildRequestData();

	//call to make the actual request
	$result = processTransaction( $oauth_token, $request_data, URL_KEYED_SALE );

	/*echo "<br>json_response : " . $result['json_response'];
	echo "<BR>curl_error : ".$result['curl_error'];
	echo "<br>http_status_code :".  $result['http_status_code'];
	*/
	//check the result
	verifyTransactionResult( $result );
}


function buildRequestData() {

	//you can assign the values from any input source fields instead of hard coded values.

	//ajax submit data here
	if ( isset( $_POST['p'] ) ) {
		$p    = $_POST['p'];
		$cn   = $_POST['cn'];
		$ey   = $_POST['ey'];
		$em   = $_POST['em'];
		$csc  = $_POST['csc'];
		$ban  = $_POST['ban'];
		$basa = $_POST['basa'];
		$bac  = $_POST['bac'];
		$bas  = $_POST['bas'];
		$baz  = $_POST['baz'];
	}

	$request_data = array(
		"amount"          => $p,
		"credit_card"     => array(
			"number"           => $cn,
			"expiration_month" => $em,
			"expiration_year"  => $ey
		),
		"csc"             => $csc,
		"billing_address" => array(
			"name"           => $ban,
			"street_address" => $basa,
			"city"           => $bac,
			"state"          => $bas,
			"zip"            => $baz
		)
	);

	$request_data = json_encode( $request_data );

	//optional : Display the Jason response - this may be helpful during initial testing.
	//displayRawJsonRequest( $request_data );

	return $request_data;
}

//This function is to verify the Transaction result 
function verifyTransactionResult( $trans_result ) {

//Handle curl level error, ExitOnCurlError
	if ( $trans_result['curl_error'] ) {
		echo "<br>Error occcured : ";
		echo '<br>curl error with Transaction request: ' . $trans_result['curl_error'];
		exit();
	}

//If we reach here, we have been able to communicate with the service, 
//next is decode the json response and then review Http Status code, response_code and success of the response

	$json = jsonDecode( $trans_result['temp_json_response'] );

	if ( $trans_result['http_status_code'] != 200 ) {
		if ( $json['success'] === false ) {
			echo "Transaction Error occurred ! ";

			//Optional : display Http status code and message
			//displayHttpStatus( $trans_result['http_status_code'] );

			//Optional :to display raw json response
			//displayRawJsonResponse( $trans_result['temp_json_response'] );

			//echo "<br>  failed !";
			//to display individual keys of unsuccessful Transaction Json response
			//displayKeyedTransactionError( $json );
		} else {
			//In case of some other error occurred, next is to just utilize the http code and message.
			echo "<br><br> Request Error occurred !";
			//displayHttpStatus( $trans_result['http_status_code'] );
		}
	} else {
		// Optional : to display raw json response - this may be helpful with initial testing.
		//displayRawJsonResponse( $trans_result['temp_json_response'] );

		// Do your code when Response is available and based on the response_code.
		// Please refer PayTrace-Error page for possible errors and Response Codes

		// For transation successfully approved
		if ( $json['success'] == true && $json['response_code'] == 101 ) {

			echo "<br><br>  Success !";
			displayHttpStatus( $trans_result['http_status_code'] );
			//to display individual keys of successful OAuth Json response
			//displayKeyedTransactionResponse( $json );
		} else {
			//Do you code here for any additional verification such as - Avs-response and CSC_response as needed.
			//Please refer PayTrace-Error page for possible errors and Response Codes
			//success = true and response_code == 103 approved but voided because of CSC did not match.
		}
	}

}


//This function displays keyed transaction successful response.
function displayKeyedTransactionResponse( $json_string ) {

	//optional : Display the output

	echo "<br><br> Keyed Sale Response : ";
	//since php interprets boolean value as 1 for true and 0 for false when accessed.
	echo "<br>success : ";
	echo $json_string['success'] ? 'true' : 'false';
	echo "<br>response_code : " . $json_string['response_code'];
	echo "<br>status_message : " . $json_string['status_message'];
	echo "<br>transaction_id : " . $json_string['transaction_id'];
	echo "<br>approval_code : " . $json_string['approval_code'];
	echo "<br>approval_message : " . $json_string['approval_message'];
	echo "<br>avs_response : " . $json_string['avs_response'];
	echo "<br>csc_response : " . $json_string['csc_response'];
	echo "<br>external_transaction_id: " . $json_string['external_transaction_id'];
	echo "<br>masked_card_number : " . $json_string['masked_card_number'];

}


//This function displays keyed transaction error response.
function displayKeyedTransactionError( $json_string ) {
	//optional : Display the output
	echo "<br><br> Keyed Sale Response : ";
	//since php interprets boolean value as 1 for true and 0 for false when accessed.
	echo "<br>success : ";
	echo $json_string['success'] ? 'true' : 'false';
	echo "<br>response_code : " . $json_string['response_code'];
	echo "<br>status_message : " . $json_string['status_message'];
	echo "<br>external_transaction_id: " . $json_string['external_transaction_id'];
	echo "<br>masked_card_number : " . $json_string['masked_card_number'];

	//to check the actual API errors and get the individual error keys
	echo "<br>API Errors : ";

	foreach ( $json_string['errors'] as $error => $no_of_errors ) {
		//Do you code here as an action based on the particular error number
		//you can access the error key with $error in the loop as shown below.
		echo "<br>" . $error;
		// to access the error message in array assosicated with each key.
		foreach ( $no_of_errors as $item ) {
			//Optional - error message with each individual error key.
			echo "  " . $item;
		}
	}


}


