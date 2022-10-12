<?php
$connect = mysqli_connect('localhost','root','','task');

if(mysqli_connect_error()){
	echo 'Database Not be Connected';
}
?>