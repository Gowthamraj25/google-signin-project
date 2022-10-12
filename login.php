<?php
include('db_connect.php');

if(!isset($_POST['email'])){
	echo 'Email parameter not passed';die;
} else if($_POST['email'] == ''){
	echo 'Please fill your email';die;
}

$email = $_POST['email'];

if(!isset($_POST['password'])){
	echo 'Password parameter not passed';die;
} else if($_POST['password'] == ''){
	echo 'Please fill your Password';die;
}

$password = $_POST['password'];

$query = "SELECT * FROM users WHERE email='$email' AND password='$password'";

$result = mysqli_query($connect,$query);

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
	
	echo 1;die;
	
}
?>