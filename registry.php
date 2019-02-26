<?php
	session_start();

	require_once "connect.php";

	$connect = mysqli_connect($host,$db_user,$db_password,$db_name);

	$login = $_POST['login'];
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$hash_pass_rep = password_hash($_POST['pass_rep'],PASSWORD_DEFAULT);

	$_SESSION['gites'] = true;

	if(!$connect){
		echo mysqli_connect_error();
	}
	else
	{
		if (strlen($login) < 3){
			$_SESSION['gites'] = false;
		}
		else
		{
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$_SESSION['gites'] = false;
			}
			else
			{
				if(strlen($pass) >= 6)
				{
					if(!password_verify($pass,$hash_pass_rep)){						
						$_SESSION['gites'] = false;
					}
				}
				else{
					$_SESSION['gites'] = false;
				}
			}
		}
	}

	if ($_SESSION['gites'] == false)
	{
		header('Location: index.php');
		mysqli_close($connect);
	}
	else
	{
		mysqli_query($connect,"INSERT INTO uzytkownicy (nick,haslo,email) VALUES ('$login','$hash_pass_rep','$email')");
		echo "poszło";
	}

?>