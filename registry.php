<?php
	require_once "connect.php";

	$connect = mysqli_connect($host,$db_user,$db_password,$db_name);

	if(!$connect)
	{
		echo mysqli_connect_error();
	}
	else
	{
		echo "gites";
	}

?>