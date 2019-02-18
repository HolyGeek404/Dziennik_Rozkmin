<?php
	require_once "connect.php";

	$temat = $_POST['temat'];
	$tresc = $_POST['tresc'];

	$polaczenie =  mysqli_connect($host,$db_user,$db_password,$db_name);
	mysqli_query($polaczenie, "SET CHARSET utf8");
	mysqli_query($polaczenie, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");

	$sql = "INSERT INTO rozkminy (temat,tresc) VALUES ('$temat','$tresc')";

	if($polaczenie->connect_errno!=0)
	{
		echo "C H U I";
	}
	else
	{			
		if(mysqli_query($polaczenie, $sql) === true )
		{
			header("Location: index.php");
		}
		else
		{
			echo $polaczenie->error;
		}
	}
?>