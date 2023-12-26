<?php
    session_start();
    require_once 'connect.php';
    
    $conn = connectToDatabase();
    
    $activationCode = isset( $_GET[ 'code' ] ) ? $_GET[ 'code' ] : '';
    
    if ( empty( $activationCode ) ) {
        $_SESSION[ 'Error' ] = "Brak kodu aktywacyjnego.";
        header( "Location: /" );
        exit();
    }
    
    $query = "SELECT * FROM uzytkownicy WHERE kod_aktywacyjny = '$activationCode'";
    $QueryResult = executeQuery( $conn, $query );
    $row = mysqli_fetch_assoc( $QueryResult );
    
    if ( $row ) {
        $userId = $row[ 'Iduzytkownika' ];
        
        mysqli_query( connectToDatabase(), "UPDATE uzytkownicy SET aktywowany = 1 WHERE Iduzytkownika = $userId" );
        
        $_SESSION[ 'Error' ] = "Konto zostało pomyślnie aktywowane. Możesz się teraz zalogować.";
    } else {
        $_SESSION[ 'Error' ] = "Błąd aktywacji konta. Nieprawidłowy kod aktywacyjny.";
    }
    header( "Location: /" );
    exit();
