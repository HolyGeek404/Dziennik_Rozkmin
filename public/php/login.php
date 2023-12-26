<?php
    session_start();
    require_once "connect.php";
    
    $conn = connectToDatabase();
    
    $login = $_POST[ 'login' ];
    $pass = $_POST[ 'pass' ];
    
    $query = "SELECT * FROM uzytkownicy WHERE nick='$login'";
    $QueryResult = executeQuery( $conn, $query );
    $row = mysqli_fetch_assoc( $QueryResult );
    
    if ( $row != NULL ) {
        $user_pass = $row[ 'haslo' ];
        
        if ( password_verify( $pass, $user_pass ) ) {
            
            $_SESSION[ 'user_id' ] = $row[ 'Iduzytkownika' ];
            $_SESSION[ 'user_img' ] = $row[ 'user_img' ];
            $_SESSION[ 'user_login' ] = $row[ 'nick' ];
            if ( $row[ 'aktywowany' ] == 1 ) {
                header( "Location: /" );
                exit();
            } else {
                $_SESSION[ 'Error' ] = "Twoje konto nie jest jeszcze aktywowane. Sprawdź skrzynkę e-mail.";
                header( "Location: /" );
                exit();
            }
        } else {
            $_SESSION[ 'Error' ] = "Nieprawidłowe hasło.";
            header( "Location: /" );
            exit();
        }
    } else {
        $_SESSION[ 'Error' ] = "Użytkownik o podanym loginie nie istnieje.";
        header( "Location: /" );
        exit();
    }