<?php
    session_start();
    require_once 'connect.php';
    
    if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
        $email = filter_input( INPUT_POST, 'email', FILTER_VALIDATE_EMAIL );
        
        if ( $email ) {
            if ( emailExistsInDatabase( $email ) ) {
                $verificationCode = generateVerificationCode();
                
                addVerificationCodeToDatabase( $email, $verificationCode );
                
                $resetLink = "http://localhost/reset_password.php?code=$verificationCode";
                
                $subject = "Password Reset";
                $message = "Click the following link to reset your password: $resetLink";
                
                $_SESSION[ 'email' ] = $email;
                $_SESSION[ 'subject' ] = $subject;
                $_SESSION[ 'message' ] = $message;
                header( "Location: send_mail.php" );
                exit();
            } else {
                $_SESSION[ 'Error' ] = "Użytkownik o takim emailu nie istnieje.";
                header( "Location: /" );
                exit();
            }
        }
    }
    
    function emailExistsInDatabase( $email ): bool
    {
        $conn = ConnectToDatabase();
        $stmt = $conn->prepare( "SELECT * FROM uzytkownicy WHERE email = ?" );
        $stmt->bind_param( "s", $email );
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();
        
        return $result->num_rows > 0;
    }
    
    function generateVerificationCode( $length = 8 ): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = '';
        for ( $i = 0; $i < $length; $i++ ) {
            $code .= $characters[ rand( 0, strlen( $characters ) - 1 ) ];
        }
        return $code;
    }
    
    function addVerificationCodeToDatabase( $email, $code ): void
    {
        $conn = ConnectToDatabase();
        $user_id = getUserIdByEmail( $email );
        $stmt = $conn->prepare( "INSERT INTO password_reset (user_id, verification_code, verification_expires) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 1 HOUR))" );
        $stmt->bind_param( "is", $user_id, $code );
        $stmt->execute();
        $stmt->close();
    }
    
    function getUserIdByEmail( $email )
    {
        $conn = ConnectToDatabase();
        $stmt = $conn->prepare( "SELECT Iduzytkownika FROM uzytkownicy WHERE email = ?" );
        $stmt->bind_param( "s", $email );
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        
        return $row[ 'Iduzytkownika' ];
    }
    