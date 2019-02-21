<?php
	require_once "connect.php";

	$connect = mysqli_connect($host,$db_user,$db_password,$db_name);

	$login = $_POST['login'];
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$pass_rep = $_POST['pass_rep'];

	$gites = true;

	if(!$connect){
		echo mysqli_connect_error();
	}
	else
	{
		if (strlen($login) >= 3)
		{
			echo "gites";
		}
		else{
			$gites = false;
		}
	}

	if ($gites == false)
	{
		echo "lipa";
	}

?>