<?php

include('db_connect.php');

require 'google-api-php-client/vendor/autoload.php';

if(isset($_GET['code'])){
			
	$client = new Google_Client();

	$client->setClientId('756743847038-8dpl1vss9dlfqcd7nsf165uen70sq4bl.apps.googleusercontent.com');

	$client->setClientSecret('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');

	$client->setRedirectUri('http://localhost/login_signup_project/google-signup.php');

	$client->addScope("email");
	$client->addScope("profile");

	$token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
	$client->setAccessToken($token['access_token']);

	// getting profile information
	$google_oauth = new Google_Service_Oauth2($client);
	$google_account_info = $google_oauth->userinfo->get();
	//print_r($google_account_info);die;

	$email = $google_account_info['email'];
	$name = $google_account_info['given_name'];
	
	$query = "INSERT INTO users(`name`,`email`,`password`)
			  VALUES('$name','$email','')";

	if(mysqli_query($connect,$query)){
		echo 'Data Inserted Successfully';
		header('location: index.php');
	} else {
		echo 'Data not Inserted';
	}
	
}

?>