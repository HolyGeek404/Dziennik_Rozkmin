<?php
    session_start();
    require_once "./connect.php";
    
    $temat = $_POST[ 'temat' ];
    $tresc = $_POST[ 'tresc' ];
    $id = $_SESSION[ 'user_id' ];
    
    if ( strlen( $temat ) && strlen( $tresc ) ) {
        $conn = connectToDatabase();
        if ( !$conn ) {
            echo mysqli_connect_error();
        } else {
            mysqli_query( $conn, "INSERT INTO rozkminy (temat,tresc,Iduzytkownika) VALUES ('$temat','$tresc','$id')" );
            header( "Location:index.php" );
        }
    } else {
        $_SESSION[ 'temat' ] = $temat;
        $_SESSION[ 'tresc' ] = $tresc;
        
        header( "Location:nowa_rozkmina.php" );
    }
?>