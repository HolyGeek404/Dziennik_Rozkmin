<?php
    require_once "connect.php";
    
    
    function getUserIdByVerificationCode( $code )
    {
        $conn = connectToDatabase();
        $stmt = $conn->prepare( "SELECT user_id FROM password_reset WHERE verification_code = ? AND verification_expires > NOW()" );
        $stmt->bind_param( "s", $code );
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        
        return ( $result->num_rows > 0 ) ? $row[ 'user_id' ] : false;
    }
    
    function resetPassword( $conn, $userId, $newPassword, $confirmNewPassword, $verificationCode )
    {
        $query = "SELECT haslo FROM uzytkownicy WHERE Iduzytkownika=?";
        $stmt = $conn->prepare( $query );
        $stmt->bind_param( "i", $userId );
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $currentPassword = $row[ 'haslo' ];
        $stmt->close();
        
        if ( $newPassword === $confirmNewPassword ) {
            if ( strlen( $newPassword ) >= 8 ) {
                if ( !password_verify( $newPassword, $currentPassword ) ) {
                    $hashedNewPassword = password_hash( $newPassword, PASSWORD_DEFAULT );
                    
                    $updateQuery = "UPDATE uzytkownicy SET haslo = ? WHERE Iduzytkownika=?";
                    $stmt = $conn->prepare( $updateQuery );
                    $stmt->bind_param( "si", $hashedNewPassword, $userId );
                    $stmt->execute();
                    $stmt->close();
                    
                    // Usuwanie kodu z bazy danych
                    $deleteQuery = "DELETE FROM password_reset WHERE verification_code = ?";
                    $stmt = $conn->prepare( $deleteQuery );
                    $stmt->bind_param( "s", $verificationCode );
                    $stmt->execute();
                    $stmt->close();
                    
                    $_SESSION[ 'Error' ] = 'Hasło zostało zmienione';
                    header( "Location: /" );
                    exit();
                } else {
                    $errorMessage = "Nowe hasło nie może być takie samo jak obecne.";
                    header( "Location: http://localhost/reset_password.php?code=$verificationCode" );
                }
            } else {
                $errorMessage = "Nowe hasło musi mieć co najmniej 8 znaków.";
                header( "Location: http://localhost/reset_password.php?code=$verificationCode" );
                
            }
        } else {
            $errorMessage = "Nowe hasła nie pasują do siebie.";
            header( "Location: http://localhost/reset_password.php?code=$verificationCode" );
            
        }
        
        if ( isset( $errorMessage ) ) {
            $_SESSION[ 'Error' ] = $errorMessage;
        }
    }
