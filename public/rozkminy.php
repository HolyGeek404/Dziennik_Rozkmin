<?php
    session_start();
    require_once "connect.php";
    $conn = connectToDatabase();
    
    // Strona domyślna to 1, ale możesz przekazać wartość strony jako parametr w URL.
    $current_page = isset( $_GET[ 'page' ] ) ? intval( $_GET[ 'page' ] ) : 1;
    $items_per_page = 5;
    
    // Oblicz indeks początkowy dla wyników na danej stronie
    $start_index = ( $current_page - 1 ) * $items_per_page;
    
    $query = "SELECT uzytkownicy.Iduzytkownika,
                 uzytkownicy.nick,
                 uzytkownicy.user_img,
                 rozkminy.idrozkminy,
                 rozkminy.temat,
                 rozkminy.tresc
          FROM `rozkminy`
          JOIN uzytkownicy
          ON rozkminy.Iduzytkownika = uzytkownicy.Iduzytkownika
          ORDER BY rozkminy.idrozkminy DESC
          LIMIT $start_index, $items_per_page";
    
    $QueryResult = executeQuery( $conn, $query );
    $NumberOfRows = mysqli_num_rows( $QueryResult );
    
    closeConnection( $conn );
?>
<!DOCTYPE html>
<html lang="pl">
<head>

    <title>Document</title>
    <?php include 'head.php' ?>
    <link rel="stylesheet" type="text/css" href="./css/thinks.css">

</head>
<body>
<div id="container">
    <div id="user_side_bar">

    </div>
    <div id="content">
        <?php
            for ( $i = 1; $i <= $NumberOfRows; $i++ ) {
                $RowFromQueryResult = mysqli_fetch_assoc( $QueryResult );
                echo <<<END
    
        <div class="thinks">
            <div class="user_info">
END;
                if ( $RowFromQueryResult[ "user_img" ] ) {
                    echo '<img src="data:image/jpeg;base64,' . base64_encode( $RowFromQueryResult[ 'user_img' ] ) . '">';
                } else {
                    echo '<img src="img/login.png">';
                }
                echo "<p>";
                
                echo $RowFromQueryResult[ 'nick' ];
                echo <<<END
                </p>
            </div>
            <div class="think_container">
                <div class="think_topic">
END;
                echo '                 <a href="tresc_rozkminy.php?Idrozkminy=';
                echo $RowFromQueryResult[ 'idrozkminy' ];
                echo '">
                    <span>';
                echo $RowFromQueryResult[ 'temat' ];
                echo '               </span>
                        </a>
                </div>
                <div class="think_content">
                        <span>';
                echo $RowFromQueryResult[ 'tresc' ];
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