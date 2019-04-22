<?php
	session_start();
	error_reporting(0);

	$temat = $_SESSION['temat'];
	$tresc = $_SESSION['tresc'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/add_think.css">
	<link rel="shortcut icon" type="image/png" href="../img/favicon.png"/>
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
	<title>Rozkmina.pl - tu gdzie tworzy się myśl</title>
</head>
<body>
<?php
echo<<<END
	<label>
		<form action="insert.php" method="post">			
			<input type="text" name="temat" placeholder="Temat dla rozkminy" value="$temat">
			<textarea wrap="easy" name="tresc" placeholder="Napisz, o czym myślisz . . .">$tresc</textarea>
			<input type="submit" value="Dodaj rozkmine">
		</form>
	</label>
END
?>
</body>
</html>