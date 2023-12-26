<?php
    require_once "connect.php";
    require_once "session.php";
    
    
    if ( $_SERVER[ "REQUEST_METHOD" ] == "POST" ) {
        if ( isset( $_POST[ 'action' ] ) ) {
            $action = $_POST[ 'action' ];
            switch ( $action ) {
                case 'changeImg':
                    changeImg();
                    break;
                case 'changePasswordForm':
                    changePassword();
                    break;
                case 'updateAboutMe':
                    updateAboutMe();
                    break;
                case 'changeNick':
                    changeNick();
                    break;
            }
        }
    }
    
    function changeImg()
    {
        $img = addslashes( file_get_contents( $_FILES[ 'img' ][ 'tmp_name' ] ) );
        
        $x = $_SESSION[ 'user_id' ];
        
        $query = "UPDATE uzytkownicy SET user_img = '{$img}' WHERE Iduzytkownika='$x'";
        
        executeQuery( connectToDatabase(), $query );
        header( "Location: ../user_profile.php" );
        $_SESSION[ 'Error' ] = 'Avatar został zmieniony';
    }
    
    function changePassword()
    {
        $currentPassword = $_POST[ 'currentPassword' ];
        $newPassword = $_POST[ 'newPassword' ];
        $confirmNewPassword = $_POST[ 'confirmNewPassword' ];
        
        $x = $_SESSION[ 'user_id' ];
        
        $query = "SELECT haslo FROM uzytkownicy WHERE Iduzytkownika='$x'";
        $result = executeQuery( connectToDatabase(), $query );
        $row = mysqli_fetch_assoc( $result );
        $hashedPassword = $row[ 'haslo' ];
        
        if ( password_verify( $currentPassword, $hashedPassword ) ) {
            if ( $newPassword === $confirmNewPassword ) {
                if ( strlen( $newPassword ) >= 8 ) {
                    if ( $newPassword !== $currentPassword ) {
                        $hashedNewPassword = password_hash( $newPassword, PASSWORD_DEFAULT );
                        $updateQuery = "UPDATE uzytkownicy SET haslo = '$hashedNewPassword' WHERE Iduzytkownika='$x'";
                        $_SESSION[ 'Error' ] = 'Hasło zostało zmienione';
                        executeQuery( connectToDatabase(), $updateQuery );
                        header( "Location: ../user_profile.php" );
                        exit();
                        
                    } else {
                        $errorMessage = "Nowe hasło nie może być takie samo jak obecne.";
                    }
                } else {
                    $errorMessage = "Nowe hasło musi mieć co najmniej 8 znaków.";
                }
            } else {
                $errorMessage = "Nowe hasła nie pasują do siebie.";
            }
        } else {
            $errorMessage = "Obecne hasło jest niepoprawne.";
        }
        if ( isset( $errorMessage ) ) {
            echo '<script>alert("' . $errorMessage . '"); window.location.href="../user_profile.php";</script>';
            exit();
        }
    }
    
    function updateAboutMe()
    {
        $newAboutMe = $_POST[ 'aboutMe' ];
        $userId = $_SESSION[ 'user_id' ];
        
        $query = "UPDATE uzytkownicy SET Omnie='$newAboutMe' WHERE Iduzytkownika=$userId";
        
        $success = mysqli_query( connectToDatabase(), $query );
        
        if ( $success ) {
            $_SESSION[ 'Error' ] = 'Opis został zmieniony';
            header( 'Location: ../user_profile.php' );
            exit();
        } else {
            $_SESSION[ 'Error' ] = 'Wystąpił błąd podczas aktualizacji informacji o sobie.';
        }
    }
    
    function changeNick()
    {
        $nick = $_POST[ 'nick' ];
        $userId = $_SESSION[ 'user_id' ];
        
        if ( strlen( $nick ) < 3 ) {
            $_SESSION[ 'Error' ] = 'Nick musi mieć co najmniej 3 znaki.';
            header( 'Location: ../user_profile.php' );
            exit();
        }
        
        $query = "UPDATE uzytkownicy SET nick='$nick' WHERE Iduzytkownika=$userId";
        $success = mysqli_query( connectToDatabase(), $query );
        
        if ( $success ) {
            $_SESSION[ 'Error' ] = 'Nick został zmieniony';
            header( 'Location: ../user_profile.php' );
            exit();
        } else {
            $_SESSION[ 'Error' ] = 'Wystąpił błąd podczas aktualizacji nicku.';
            header( 'Location: ../user_profile.php' );
            exit();
        }
    }