<?php
    //TODO create small user panel,
    // add feature to read full think
    
    session_start();

    require_once "connect.php";
    $Connect = mysqli_connect($host,$db_user,$db_password,$db_name);

    $QueryResoult = mysqli_query($Connect,
    "SELECT uzytkownicy.Iduzytkownika,
     uzytkownicy.nick, 
     uzytkownicy.user_img,
      rozkminy.idrozkminy, 
      rozkminy.temat, 
      rozkminy.tresc 
      FROM `rozkminy` 
      JOIN uzytkownicy
      ON rozkminy.Iduzytkownika = uzytkownicy.Iduzytkownika
    ");
    $NumberOfRows = $QueryResoult->num_rows;
    //$NumberOfRows = mysqli_num_rows($RowsFromQueryResoult);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/thinks.css">
    <link rel="shortcut icon" type="image/png" href="../img/favicon.png"/>
    <title>Document</title>
</head>
<body>
<div id="container">
    <div id="content">
<?php
        for ($i=1; $i <= $NumberOfRows; $i++) 
        { 
            $RowFromQueryResoult = mysqli_fetch_assoc($QueryResoult);
echo<<<END
    
        <div class="thinks">
            <div class="user_info">
END;
                if($RowFromQueryResoult["user_img"])
                {
                    echo '<img src="data:image/jpeg;base64,'.base64_encode( $RowFromQueryResoult['user_img'] ).'">';
                }
                else
                {
                    echo '<img src="../img/login.png">';
                }
                echo "<p>";

                 echo $RowFromQueryResoult['nick'];
echo<<<END
                </p>
            </div>
            <div class="think_container">
                <div class="think_topic">
                    <span>
END;
                echo $RowFromQueryResoult['temat'];

                    echo'</span>
                </div>
                <div class="think_content">
                    <span>';

                echo $RowFromQueryResoult['tresc'];
   
                echo '</span>
                </div>
            </div>
        </div>';
          }
?>  
    </div>
</div>
</body>
</html>