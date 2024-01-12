<?php
    error_reporting( 0 );
    session_start();
    
    if ( isset( $_SESSION[ 'user_id' ] ) ) {
        header( "Location: /" );
        exit();
    }
    $login = $_SESSION[ 'user_login' ];
    $user_img = $_SESSION[ 'user_img' ];
?>
<!DOCTYPE html>
<html>
<head>

    <title>Rozkmina.pl</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/fontello/fontello.css">
    <link rel="shortcut icon" type="image/png" href="./img/favicon.png"/>
    <link href="https://fonts.googleapis.com/css?family=Hind+Madurai:600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:900" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <style>
        #rejestracja {
            width: 400px;
            height: 210px;
            background-color: #06434f;
            z-index: -2;
            top: -1000;
            border: 5px solid #0089a4;
            margin-top: 5px;
            transition-property: opacity;
            transition-duration: 0.8s;
            transition-delay: 0.8s;
            opacity: 1 !important;
            visibility: visible !important;
            border-radius: 5px;
        }</style>
    <title>Document</title>
</head>
<body>

<div id="content">
    <header>
        <h2><a href="/">ROZKMINA.PL</a></h2>
    </header>
    <section>
        <h1>w tym miejscu możesz podzielić się swoimi przemyśleniami</h1>
    </section>

    <div id="options" style="margin:auto">
        <div class="type_option" style="margin:auto">
            <a href="/registration.php">
                <figure>
                    <img src="img/add_user.png">
                    <figcaption>Rejestracja</figcaption>
                </figure>
            </a>

            <div id="rejestracja">
                <form method="post" action="php/registry.php">
                    <fieldset>
                        <span>Login</span>
                        <input type="text" name="login" placeholder="3 do 15 znaków">
                    </fieldset>

                    <fieldset>
                        <span>E-mail</span>
                        <input type="email" name="email">
                    </fieldset>

                    <fieldset>
                        <span>Hasło</span>
                        <input type="password" name="pass" placeholder="Minimum 8 znaków">
                    </fieldset>

                    <fieldset>
                        <span>Powtórz hasło</span>
                        <input type="password" name="pass_rep">
                    </fieldset>
                    <input type="submit">
                </form>
            </div>

        </div>
    </div>
    <script src="js/popup.js"></script>
    <?php
        
        if ( isset( $_SESSION[ 'Error' ] ) ) {
            echo "<script>displayErrorMessage('{$_SESSION['Error']}');</script>";
            unset( $_SESSION[ 'Error' ] );
        }
    ?>
</body>
</html>