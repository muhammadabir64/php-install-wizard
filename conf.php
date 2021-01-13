<?php 

$host = "db_host";
$user = "db_user";
$pass = "db_pass";
$name = "db_name";

$con = @mysqli_connect($host, $user, $pass, $name);

if (!$con) {
	die("Database connection failed : " . mysqli_connect_error());
}
?>