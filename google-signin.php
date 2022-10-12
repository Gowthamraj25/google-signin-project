<?php

include('db_connect.php');

require 'google-api-php-client/vendor/autoload.php';

if(isset($_GET['code'])){
			
	$client = new Google_Client();

	$client->setClientId('756743847038-sh9qga6vu35ngomvep7eq752ng6sa339.apps.googleusercontent.com');

	$client->setClientSecret('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');

	$client->setRedirectUri('http://localhost/login_signup_project/google-signin.php');

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
	
	$query = "SELECT * FROM users WHERE email='$email'";
	
	$result = mysqli_query($connect,$query);

	if($result){
		
		$rowcount = mysqli_num_rows($result);
		
		if($rowcount == 0){
			echo 0;die;
		} else {
			
			$row = mysqli_fetch_array($result);
			
			$session_name = $row['name'];
			$session_email = $row['email'];
			$session_id = $row['id'];
			
			session_start();
			
			$_SESSION['session_name'] = $session_name;
			$_SESSION['session_email'] = $session_email;
			$_SESSION['session_id'] = $session_id;
			header('location: dashboard.php');
		}
		
		
	} else {
		echo 'Data not Inserted';
	}
	
}

?>