<?php
include('db_connect.php');

if(!isset($_POST['name'])){
	echo 'Name parameter is not passed';die;
} else if($_POST['name'] == ''){
	echo 'Please fill the Name';die;
}

$name = $_POST['name'];

if(!isset($_POST['email'])){
	echo 'Email parameter is not passed';die;
} else if($_POST['email'] == ''){
	echo 'Please fill the Email';die;
}

$email = $_POST['email'];

if(!isset($_POST['password'])){
	echo 'Password parameter is not passed';die;
} else if($_POST['password'] == ''){
	echo 'Please fill the Password';die;
}

$password = $_POST['password'];


$query = "INSERT INTO users(`name`,`email`,`password`)
		VALUES('$name','$email','$password')";

if(mysqli_query($connect,$query)){
	echo 1;
} else {
	echo 0;die;
}
?>