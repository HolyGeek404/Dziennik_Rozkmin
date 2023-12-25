<?php
    session_start();
    error_reporting( 0 );
    
    $temat = $_SESSION[ 'temat' ];
    $tresc = $_SESSION[ 'tresc' ];
?>
<!DOCTYPE html>
<html>
<head>
    <?php include 'head.php' ?>
    <link rel="stylesheet" type="text/css" href="css/add_think.css">
    <title>Rozkmina.pl - tu gdzie tworzy się myśl</title>
</head>
<body>
<?php
    echo <<<END
	<label>
		<form action="insert.php" method="post">
			<input type="text" name="temat" placeholder="Temat rozkminy" value="$temat">
			<textarea wrap="easy" name="tresc" placeholder="Napisz, o czym myślisz . . .">$tresc</textarea>
			<input type="submit" value="Dodaj rozkmine">
		</form>
	</label>
END
?>
</body>
</html>