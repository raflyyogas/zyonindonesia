<?php

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "zyon";

$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if(!$conn)
	{
		die(mysqli_error($conn));
	}

?> 