<?php
    //TODO create small user panel,
    // add feature to read full think
    session_start();
    require_once "connect.php";
    $Connect = mysqli_connect($host,$db_user,$db_password,$db_name);

    $QueryResult = mysqli_query($Connect,
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
    $NumberOfRows = $QueryResult->num_rows;
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/thinks.css">
    <link rel="shortcut icon" type="image/png" href="../img/favicon.png" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <title>Document</title>
    <script>
    function CutThinkContent() 
    {
        var ThinkContentClassArrary = document.getElementsByClassName("think_content");

        for (let i = 1; i <= ThinkContentClassArrary.length; i++) {
           
            var ContentOfThinkContentClass = ThinkContentClassArrary[i - 1].textContent;
            if (ContentOfThinkContentClass.length > 416) {
               
                ThinkContentClassArrary[i - 1].innerHTML = "";
                
                var CorrectContentSizeOfThinkContentClass = ContentOfThinkContentClass.substring(0, 416); 
                CorrectContentSizeOfThinkContentClass += "...";
              
                var x = document.createElement('div');
                var TextNode = document.createTextNode(CorrectContentSizeOfThinkContentClass);
              
                x.id = "test";
                x.appendChild(TextNode);

                ThinkContentClassArrary[i - 1].appendChild(x);
            }
        }
    }
    </script>
    <style>
    #test 
    {
        display: flex;
        align-items: center;
        padding: 10px;
    }
    </style>
</head>
<body>
    <div id="container">
        <div id="user_side_bar">
        
        </div>
        <div id="content">
<?php
        for ($i=1; $i <= $NumberOfRows; $i++) 
        { 
            $RowFromQueryResult = mysqli_fetch_assoc($QueryResult);
echo<<<END
    
        <div class="thinks">
            <div class="user_info">
END;
                if($RowFromQueryResult["user_img"])
                {
                    echo '<img src="data:image/jpeg;base64,'.base64_encode( $RowFromQueryResult['user_img'] ).'">';
                }
                else
                {
                    echo '<img src="../img/login.png">';
                }
echo            "<p>";

echo                $RowFromQueryResult['nick'];
echo<<<END
                </p>
            </div>
            <div class="think_container">
                <div class="think_topic">
END;
echo '                 <a href="tresc_rozkminy.php?Idrozkminy=';
echo                    $RowFromQueryResult['idrozkminy'];
echo '">
                    <span>';
echo                     $RowFromQueryResult['temat'];
echo'               </span>
                        </a>
                </div>
                <div class="think_content">
                        <span>';
echo                      $RowFromQueryResult['tresc'];
echo '                 </span>         
                </div>
            </div>
        </div>
         ';
          }
?>
            <script>
            CutThinkContent();
            </script>
        </div>
    </div>
</body>
</html>