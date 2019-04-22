<?php
    session_start();
    require_once "connect.php";

    $temat = $_POST['temat'];
    $tresc = $_POST['tresc'];
    $id = $_SESSION['user_id'];

    if(strlen($temat) && strlen($tresc))
    {
        $polaczenie = mysqli_connect($host,$db_user,$db_password,$db_name);
        if(!$polaczenie){
            echo mysqli_connect_error();
        }
        else
        {
            mysqli_query($polaczenie,"INSERT INTO rozkminy (temat,tresc,Iduzytkownika) VALUES ('$temat','$tresc','$id')");
            header("Location:index.php");
        }
    }
    else
    {
        $_SESSION['temat'] = $temat;
        $_SESSION['tresc'] = $tresc;

        header("Location:nowa_rozkmina.php");
    }
?>