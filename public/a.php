<?php
    //TODO implement later 

  session_start();
  $resultArrary = $_SESSION['x'];
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
    <div id="about_user_description">
      <?php echo $resultArrary['Omnie'] ?>
     </div>
    <div id="about_user_thinks">
        <span>Moje rozkminy</span>
        <div class="think">
            <ul>
                <li>Jakas tam rozkmina</li>
                <li>Cos tam cos tam </li>
                <li>No generalnie to duzo roboty mam jeszcze</li>
                <li>Pomysly mi sie koncza</li>
            </ul>
        </div>
    </div>
</body>
</html>