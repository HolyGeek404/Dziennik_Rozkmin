<?php
    session_start();
    
    if ( isset( $_SESSION[ 'user_id' ] ) ) {
        header( "Location: /" );
        exit();
    }
    
    require_once( './php/resetPassword.php' );
    
    if ( isset( $_GET[ 'code' ] ) ) {
        $verificationCode = $_GET[ 'code' ];
        
        $userId = getUserIdByVerificationCode( $verificationCode );
        
        if ( $userId !== false ) {
            if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
                $newPassword = $_POST[ 'newPassword' ];
                $confirmNewPassword = $_POST[ 'confirmNewPassword' ];
                
                resetPassword( connectToDatabase(), $userId, $newPassword, $confirmNewPassword, $verificationCode );
                
                exit();
            }
        } else {
            $_SESSION[ 'Error' ] = "Czas na zmianę hasła wygasł lub kod weryfikacyjny jest niepoprawny.";
            header( "Location: /" );
            exit();
        }
    } else {
        header( "Location: /" );
        exit();
    }

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Rozkmina.pl - profil użytkownika</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <link rel="shortcut icon" type="image/png" href="./img/favicon.png"/>
    <link href="https://fonts.googleapis.com/css?family=Hind+Madurai:600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:900" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>
<body>
<a href="index.php">
    <button>Powrót</button>
</a>
<div id="container">
    <div id="content">
        <div class="about_user">

            <div class="changePass">
                <span>Zmiana hasła</span>
                <form id="resetPasswordForm" method="post"
                      style="margin: 20px; color: #000000">
                    <label for="newPassword">Nowe Hasło:</label>
                    <input type="password" id="newPassword" name="newPassword" required>

                    <br>

                    <label for="confirmNewPassword">Potwierdź Nowe Hasło:</label>
                    <input type="password" id="confirmNewPassword" name="confirmNewPassword" required>
                    <span id="passwordError" class="error"></span>

                    <br>
                    <input type="hidden" name="action" value="resetPasswordForm">
                    <input type="submit" value="Zmień Hasło">
                </form>
                <div id="error_message"></div>
            </div>


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
<script src="js/profile_think.js"></script>
</body>
</html>

