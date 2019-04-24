<?php
    session_start();
    require_once "connect.php"; 

    $connect = mysqli_connect($host,$db_user,$db_password,$db_name);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="../img/favicon.png"/>
    <title>Document</title>
</head>
<body>
    <?php
    	echo '<img src="data:image/jpeg;base64,'.base64_encode($_SESSION['user_img']).'"/>';
    ?>
    <form method="post" enctype="multipart/form-data" action="change_img.php">
        <input type="file" name="img">
        <input type="submit">
    </form>
</body>
</html>