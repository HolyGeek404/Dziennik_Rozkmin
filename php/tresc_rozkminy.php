<?php
	//TODO implemate TODO form rozkminy.php

	session_start();

	require_once "connect.php";
	$polaczenie =  mysqli_connect($host,$db_user,$db_password,$db_name);
	mysqli_query($polaczenie, "SET CHARSET utf8");
	mysqli_query($polaczenie, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
	
	if ($polaczenie->connect_errno!=0)
	{
		echo "Coś nie pykło".$polaczenie->connect_errno;
	}
    else
    {
	    $data = $_GET["data"];
	  	$rezulata = mysqli_query($polaczenie, "SELECT temat, tresc FROM rozkminy WHERE idrozkminy = '$data'");
	  	
	   	if($rezulata->num_rows > 0)
	   	{
	   		$wiersze = $rezulata->fetch_assoc();
	   		$temat = $wiersze['temat'];
	 			$tresc = $wiersze['tresc'];

	  	 	$rezulata->free_result();
	   	}
	   
	 	$polaczenie->close(); 
	 }
    
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dziennik Rozkmin</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="css/fontello.css">
	<link href="https://fonts.googleapis.com/css?family=Hind+Madurai:600" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:900" rel="stylesheet">
</head>
<body>
<header>
<?php echo	"<h2>".$temat."</h2>" ?>
</header>
<div id="content">
	<article>
<?php
echo<<<END
	$tresc
END;
?>
	</article>
</div>
</body>
</html>