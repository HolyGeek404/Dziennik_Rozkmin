<?php
    session_start();
    
    require_once( 'connect.php' );
    
    $conn = connectToDatabase();
    
    $_SESSION[ 'gites' ] = true;
    $login = $_POST[ 'login' ];
    $email = $_POST[ 'email' ];
    $pass = $_POST[ 'pass' ];
    $hash_pass_rep = password_hash( $_POST[ 'pass_rep' ], PASSWORD_DEFAULT );
    $activationCode = generateActivationCode();
    
    if ( !$conn ) {
        $_SESSION[ 'Error' ] = "Błąd połączenia z bazą danych.";
        header( "Location: /registration.php" );
        exit();
    } else {
        if ( strlen( $login ) < 3 ) {
            $_SESSION[ 'Error' ] = "Login musi mieć co najmniej 3 znaki";
            header( "Location: /registration.php" );
            exit();
        } elseif ( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
            $_SESSION[ 'Error' ] = "Nieprawidłowy format adresu email";
            header( "Location: /registration.php" );
            exit();
        } elseif ( strlen( $pass ) < 8 || $pass !== $_POST[ 'pass_rep' ] ) {
            $_SESSION[ 'Error' ] = "Hasło musi mieć co najmniej 8 znaków i być zgodne z powtórzeniem";
            header( "Location: /registration.php" );
            exit();
        }
    }
    
    $result = mysqli_query( $conn, "SELECT nick, email FROM uzytkownicy WHERE nick='$login' OR email='$email'" );
    $row = mysqli_num_rows( $result );
    
    if ( $row != 0 ) {
        $_SESSION[ 'Error' ] = "Użytkownik o podanym loginie lub emailu już istnieje";
        header( "Location: /registration.php" );
        mysqli_close( $conn );
        exit();
    } else {
        $result = mysqli_query( $conn, "INSERT INTO uzytkownicy (nick, haslo, email,kod_aktywacyjny) VALUES ('$login', '$hash_pass_rep', '$email','$activationCode')" );
        
        if ( !$result ) {
            $_SESSION[ 'Error' ] = "Błąd podczas dodawania użytkownika do bazy danych";
        } else {
            $subject = "Aktywacja konta";
            $message = "Witaj $login,<br><br>Kliknij poniższy link, aby aktywować swoje konto:<br>http://localhost/php/activation_account.php?code=$activationCode";
            
            $_SESSION[ 'email' ] = $email;
            $_SESSION[ 'subject' ] = $subject;
            $_SESSION[ 'message' ] = $message;
            header( "Location: send_mail.php" );
            exit();
        }
        
        header( "Location: /" );
        mysqli_close( $conn );
        exit();
    }
    function generateActivationCode()
    {
        return bin2hex( random_bytes( 16 ) );
    }

