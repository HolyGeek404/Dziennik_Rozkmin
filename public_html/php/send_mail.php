<?php
    session_start();
    
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;
    
    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';
    
    
    if ( isset( $_SESSION[ 'email' ], $_SESSION[ 'subject' ], $_SESSION[ 'message' ] ) ) {
        $email = $_SESSION[ 'email' ];
        $subject = $_SESSION[ 'subject' ];
        $message = $_SESSION[ 'message' ];
        
        try {
            $mail = new PHPMailer( true );
            
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'glikuuu@gmail.com';
            $mail->Password = 'hgbcqhdcfrduvute';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
            
            $mail->CharSet = 'UTF-8';
            $mail->setFrom( 'kontakt@rozkmina.pl', 'Rozkmina.pl' );
            $mail->addAddress( $email );
            $mail->addReplyTo( 'kontakt@rozkmina.pl', 'Rozkmina.pl' );
            
            $mail->isHTML( true );
            $mail->Subject = $subject;
            $mail->Body = $message;
            
            $mail->send();
            
            $_SESSION[ 'Error' ] = 'Wiadomość została wysłana pomyślnie';
            
            
        } catch ( Exception $e ) {
            $_SESSION[ 'Error' ] = "Nie udało się wysłać wiadomości. Błąd mailera: {$e->getMessage()}";
        }
    } else {
        $_SESSION[ 'Error' ] = 'Nieprawidłowe żądanie. Proszę wypełnić formularz.';
    }
    
    header( "Location: ../user_profile.php" );
    exit();
