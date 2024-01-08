<?php
    require_once "connect.php";
    require_once "session.php";
    
    $conn = connectToDatabase();
    
    if ( $_SERVER[ "REQUEST_METHOD" ] == "POST" ) {
        if ( isset( $_POST[ 'action' ] ) ) {
            $action = $_POST[ 'action' ];
            switch ( $action ) {
                case 'changeImg':
                    changeImg( $conn );
                    break;
                case 'changePasswordForm':
                    changePassword( $conn );
                    break;
                case 'updateAboutMe':
                    updateAboutMe( $conn );
                    break;
                case 'changeNick':
                    changeNick( $conn );
                    break;
            }
        }
    }


    function changeImg($conn): void
    {
        if ($_FILES['img']['tmp_name'] != null)
        {
            $img = addslashes(file_get_contents($_FILES['img']['tmp_name']));

            $x = $_SESSION['user_id'];

            $query = "UPDATE uzytkownicy SET user_img = ? WHERE Iduzytkownika=?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("si", $img, $x);
            $stmt->execute();
            $stmt->close();

            $_SESSION['Error'] = 'Avatar został zmieniony';
        }
        else{
            $_SESSION['Error'] = 'Nie załadowano żadnego zdjęcia.';
        }
        header("Location: ../user_profile.php");
    }
    
    function changePassword( $conn ): void
    {
        $currentPassword = $_POST[ 'currentPassword' ];
        $newPassword = $_POST[ 'newPassword' ];
        $confirmNewPassword = $_POST[ 'confirmNewPassword' ];
        
        $x = $_SESSION[ 'user_id' ];
        
        $query = "SELECT haslo FROM uzytkownicy WHERE Iduzytkownika=?";
        $stmt = $conn->prepare( $query );
        $stmt->bind_param( "i", $x );
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $hashedPassword = $row[ 'haslo' ];
        $stmt->close();
        
        if ( password_verify( $currentPassword, $hashedPassword ) ) {
            if ( $newPassword === $confirmNewPassword ) {
                if ( strlen( $newPassword ) >= 8 ) {
                    if ( $newPassword !== $currentPassword ) {
                        $hashedNewPassword = password_hash( $newPassword, PASSWORD_DEFAULT );
                        
                        $updateQuery = "UPDATE uzytkownicy SET haslo = ? WHERE Iduzytkownika=?";
                        $stmt = $conn->prepare( $updateQuery );
                        $stmt->bind_param( "si", $hashedNewPassword, $x );
                        $stmt->execute();
                        $stmt->close();
                        
                        $_SESSION[ 'Error' ] = 'Hasło zostało zmienione';
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
            $_SESSION[ 'Error' ] = $errorMessage;
            header( "Location: ../user_profile.php" );
        }
    }

    function updateAboutMe($conn): void
    {
        $newAboutMe = $_POST[ 'aboutMe' ];
        $userId = $_SESSION[ 'user_id' ];
        
        $query = "UPDATE uzytkownicy SET Omnie=? WHERE Iduzytkownika=?";
        $stmt = $conn->prepare( $query );
        $stmt->bind_param( "si", $newAboutMe, $userId );
        $stmt->execute();
        $stmt->close();
        
        $_SESSION[ 'Error' ] = 'Opis został zmieniony';
        header( 'Location: ../user_profile.php' );
    }

    function changeNick($conn): void
    {
        $nick = $_POST[ 'nick' ];
        $userId = $_SESSION[ 'user_id' ];
        
        if ( strlen( $nick ) < 3 ) {
            $_SESSION[ 'Error' ] = 'Nick musi mieć co najmniej 3 znaki.';
            header( 'Location: ../user_profile.php' );
            exit();
        }
        
        $query = "UPDATE uzytkownicy SET nick=? WHERE Iduzytkownika=?";
        $stmt = $conn->prepare( $query );
        $stmt->bind_param( "si", $nick, $userId );
        $stmt->execute();
        $stmt->close();
        
        $_SESSION[ 'Error' ] = 'Nick został zmieniony';
        header( 'Location: ../user_profile.php' );
    }