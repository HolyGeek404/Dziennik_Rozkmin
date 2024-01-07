<?php
    session_start();
    setcookie( session_name(), '', 100 );
    session_destroy();
    session_start();
    
    header( "Location: /" );
?>