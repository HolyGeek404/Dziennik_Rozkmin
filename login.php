<?php
    session_start();
    require_once "connect.php";

    $login = $_POST['login'];
    $pass =  $_POST['pass'];
    
    $connect = mysqli_connect($host,$db_user,$db_password,$db_name);

    $result = mysqli_query($connect,"SELECT nick,haslo FROM uzytkownicy WHERE nick='$login'");
    $row = mysqli_fetch_assoc($result);

    if($row != NULL)
    {
        $user_login = $row['nick'];
        $user_pass = $row['haslo'];
    }
    else
    {
        $_SESSION['gites'] = false;
        header("Location: index.php");
    }

    if(password_verify($pass,$user_pass))
    {
        echo "git";
    }
    else
    {
        echo "lipa";
    }
?>