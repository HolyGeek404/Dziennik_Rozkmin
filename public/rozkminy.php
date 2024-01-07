<?php
    require_once "./php/connect.php";
    require_once "./php/thinks_operation.php";
    require_once "./php/menu.php";
    $thinks = viewThinks();

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Document</title>
    <!DOCTYPE html>
    <html lang="en">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/fontello/fontello.css">
    <link rel="shortcut icon" type="image/png" href="./img/favicon.png"/>
    <link rel="stylesheet" type="text/css" href="./css/thinks.css">
    <link href="https://fonts.googleapis.com/css?family=Hind+Madurai:600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:900" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <title>Document</title>
    <script src="./js/cutthinks.js"></script>
    <style>


    </style>
</head>
<body>
<div id="container">
    <div class="menu"><?php echo generateMenu() ?></div>
    <div id="user_side_bar">

    </div>
    <div id="content">
        <?php
            foreach ( $thinks as $think ) {
                echo <<<END
    
        <div class="thinks">
            <div class="user_info">
END;
                if ( $think[ "user_img" ] ) {
                    echo '<img src="data:image/jpeg;base64,' . base64_encode( $think[ 'user_img' ] ) . '">';
                } else {
                    echo '<img src="img/login.png">';
                }
                echo "<p>";
                
                echo $think[ 'nick' ];
                echo <<<END
                </p>
            </div>
            <div class="think_container">
                <div class="think_topic">
END;
                echo '                 <a href="tresc_rozkminy.php?Idrozkminy=';
                echo $think[ 'idrozkminy' ];
                echo '">
                    <span>';
                echo $think[ 'temat' ];
                echo '               </span>
                        </a>
                </div>
                <div class="think_content">
                        <span>';
                echo $think[ 'tresc' ];
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
<script src="js/popup.js"></script>
<script src="js/menu.js"></script>
<?php
    
    if ( isset( $_SESSION[ 'Error' ] ) ) {
        echo "<script>displayErrorMessage('{$_SESSION['Error']}');</script>";
        unset( $_SESSION[ 'Error' ] );
    }
?>
</body>
</html>