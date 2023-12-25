<?php
    session_start();
    
    require_once "connect.php";
    $id = $_SESSION[ 'user_id' ];
    $conn = connectToDatabase();
    
    $query = "SELECT uzytkownicy.Iduzytkownika,
       uzytkownicy.nick,
       uzytkownicy.user_img,
       uzytkownicy.email,
       uzytkownicy.Data_dolaczenia,
       uzytkownicy.Omnie
       FROM uzytkownicy
       WHERE uzytkownicy.Iduzytkownika = '$id'";
    
    $QueryResult = executeQuery( $conn, $query );
    $resultArrary = mysqli_fetch_assoc( $QueryResult );
    $user_img = $resultArrary[ 'user_img' ];
    
    $query = "SELECT temat, idrozkminy
        FROM rozkminy
        WHERE Iduzytkownika = '$id'";
    
    $QueryResult = executeQuery( $conn, $query );
    $NumberOfRows = $QueryResult->num_rows;
    closeConnection( $conn );

?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Rozkmina.pl - profil użytkownika</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <link href="https://fonts.googleapis.com/css?family=Hind+Madurai:600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:900" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="img/favicon.png"/>
    <script src="../JQuery.js"></script>
    <script>
        function ChangeCurrentViewToOptions() {
            $("#about_user_content").load("a.html");
        }
    </script>

</head>
<body>
<div id="container">
    <div id="content">
        <div id="user">
            <?php
                if ( !$user_img ) {
                    echo '<img src="img/chevy.jpg">';
                } else {
                    echo '<img src="data:image/jpeg;base64,' . base64_encode( $user_img ) . '">';
                }
            ?>
            <div id="user_info">
                <p>Nick: <?php echo $resultArrary[ 'nick' ] ?></p>
                <p>E-mail: <?php echo $resultArrary[ 'email' ] ?></p>
                <p>Data stworzenia konta: <?php echo $resultArrary[ 'Data_dolaczenia' ] ?></p>
            </div>
        </div>
        <div id="about_user">
            <div class="user_profile_info" id="current_user_profile_info">O mnie</div>
            <div class="user_profile_info">Ustawienia</div>
            <div class="user_profile_info">Inni użytkownicy</div>

            <div id="about_user_content">
                <div id="about_user_description">
                    <?php echo $resultArrary[ 'Omnie' ] ?>
                </div>
                <div id="about_user_thinks">
                    <span>Moje rozkminy</span>
                    <div class="think">
                        <ul>
                            <?php
                                for ( $i = 1; $i <= $NumberOfRows; $i++ ) {
                                    $resultThinksArrary = mysqli_fetch_assoc( $QueryResult );
                                    echo "<li>{$resultThinksArrary['temat']}</li>";
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <script>ChangeCurrentViewToOptions();</script> -->
</body>
</html>