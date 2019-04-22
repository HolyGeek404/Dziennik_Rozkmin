<?php
    session_start();
    require_once "connect.php"; 

    $connect = mysqli_connect($host,$db_user,$db_password,$db_name);
    $x = $_SESSION['user_id'];
    $a = mysqli_query($connect,"SELECT user_img FROM uzytkownicy WHERE Iduzytkownika='$x'");
    $z = mysqli_fetch_assoc($a);
    $_SESSION['z'] = $z['user_img'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
    	echo '<img src="data:image/jpeg;base64,'.base64_encode( $z['user_img'] ).'"/>';
    ?>
    <form method="post" enctype="multipart/form-data" action="change_img.php">
        <input type="file" name="img">
        <input type="submit">
    </form>
</body>
</html>