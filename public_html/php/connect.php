<?php
    function ConnectToDatabase()
    {
        $host = "db";
        $db_user = "user";
        $db_password = "password";
        $db_name = "przemyslenia";
        
        $conn = mysqli_connect( $host, $db_user, $db_password, $db_name );
        
        if ( $conn->connect_error ) {
            die( "Connection failed: " . $conn->connect_error );
        }
        return $conn;
    }
    
    function executeQuery( $conn, $query )
    {
        $result = mysqli_query( $conn, $query );
        
        if ( !$result ) {
            die( "Query failed: " . mysqli_error( $conn ) );
        }
        mysqli_close( $conn );
        
        return $result;
    }
    