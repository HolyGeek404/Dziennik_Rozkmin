<?php
    require_once "connect.php";
    
    function QueryUserProfile( $id, $conn )
    {
        $query = "SELECT uzytkownicy.Iduzytkownika,
       uzytkownicy.nick,
       uzytkownicy.user_img,
       uzytkownicy.email,
       uzytkownicy.Data_dolaczenia,
       uzytkownicy.Omnie
       FROM uzytkownicy
       WHERE uzytkownicy.Iduzytkownika = '$id'";
        
        return executeQuery( $conn, $query );
    }
    
    function User_object( $object, $id, $conn )
    {
        $resultArrary = mysqli_fetch_assoc( QueryUserProfile( $id, $conn ) );
        return $resultArrary[ $object ];
    }
    
    function UserThink( $id, $conn )
    {
        $query = "SELECT temat, idrozkminy
        FROM rozkminy
        WHERE Iduzytkownika = '$id'";
        
        return executeQuery( $conn, $query );
    }

