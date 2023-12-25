<?php //TODO change the variables name
    session_start();
    //TODO OGARNĄC OT
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
            $_SESSION[ 'incorrectLoginOrRregistration' ] = FALSE;
            
            header( "Location: index.php" );
        } else {
            $_SESSION[ 'incorrectLoginOrRregistration' ] = TRUE;
            header( "Location: index.php" );
        }
    } else {
        $_SESSION[ 'incorrectLoginOrRregistration' ] = TRUE;
        header( "Location: index.php" );
    }
?>