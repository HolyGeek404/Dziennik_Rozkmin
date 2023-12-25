<?php
    require_once "./connect.php";
    session_start();
    
    $img = addslashes( file_get_contents( $_FILES[ 'img' ][ 'tmp_name' ] ) );
    
    $connect = mysqli_connect( $host, $db_user, $db_password, $db_name );
    $x = $_SESSION[ 'user_id' ];
    
    mysqli_query( $connect, "UPDATE uzytkownicy SET user_img = '{$img}' WHERE Iduzytkownika='$x'" );
    
    //  header("Location: profil.php");
?>

