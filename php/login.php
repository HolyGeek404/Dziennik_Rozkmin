<?php //TODO change the variables name
    session_start();
    require_once "connect.php";
    
    $login = $_POST['login'];
    $pass =  $_POST['pass'];
    
    $connect = mysqli_connect($host,$db_user,$db_password,$db_name);

    $result = mysqli_query($connect,"SELECT * FROM uzytkownicy WHERE nick='$login'");
    $row = mysqli_fetch_assoc($result);

    if($row != NULL)
    {
        $user_pass = $row['haslo'];
        if(password_verify($pass,$user_pass))
        {
            $_SESSION['user_id'] = $row['Iduzytkownika'];
            $_SESSION['user_img'] = $row['user_img'];
            $_SESSION['user_login'] = $row['nick'];
            $_SESSION['isAllGood'] = True;

            header("Location: index.php");
        }
        else
        {
            $_SESSION['isAllGood'] = False;
            header("Location: index.php");
        }
    }
    else
    {
        $_SESSION['isAllGood'] = False;
        header("Location: index.php");
    }
?>