<?php
    session_start();
    require_once "connect.php";
    $polaczenie = mysqli_connect( $host, $db_user, $db_password, $db_name );
    
    if ( $polaczenie->connect_errno != 0 ) {
        echo "Coś nie pykło" . $polaczenie->connect_errno;
    } else {
        $Idrozkminy = $_GET[ "Idrozkminy" ];
        $rezulata = mysqli_query( $polaczenie,
            "SELECT temat, tresc
			FROM rozkminy 
			WHERE idrozkminy = '$Idrozkminy'" );
        
        if ( $rezulata->num_rows > 0 ) {
            $wiersze = $rezulata->fetch_assoc();
            $temat = $wiersze[ 'temat' ];
            $tresc = $wiersze[ 'tresc' ];
            
            $rezulata->free_result();
        }
        $polaczenie->close();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Rozkmina.pl</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/thinks.css">
    <link rel="stylesheet" type="text/css" href="css/fontello.css">
    <link href="https://fonts.googleapis.com/css?family=Hind+Madurai:600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:900" rel="stylesheet">
    <style>
        #topic {
            width: 800px;
            font-size: 24px;
            color: #008aa4;
            font-weight: bold;
            margin: auto;
            padding-top: 15px;
        }

        #content {
            text-align: justify;
            padding: 13px;
            font-size: 18px;
            white-space: pre-wrap;
            font-weight: bold;
            color: #06434f;
        }
    </style>
</head>
<body>
<div id="topic">
    <?php
        echo $temat;
    ?>
</div>
<div id="content">
    <?php
        echo $tresc;
    ?>
</div>
</body>
</html>