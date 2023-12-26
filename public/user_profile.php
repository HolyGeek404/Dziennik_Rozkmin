<?php
    require_once( './php/download_user_profile.php' );
    require_once( './php/connect.php' );
    require_once( './php/session.php' );
    require_once( './php/change_user_data.php' );
    
    $id = $_SESSION[ 'user_id' ];
    QueryUserProfile( $id, ConnectToDatabase() );
    
    if ( isset( $_POST[ 'sendmail' ] ) ) {
        $email = filter_input( INPUT_POST, 'email', FILTER_VALIDATE_EMAIL );
        
        if ( empty( $email ) ) {
            $_SESSION[ 'email' ] = $_POST[ 'email' ];
            header( 'Location: index.php' );
        } else {
            // Przekieruj dane do pliku odpowiedzialnego za wysyłanie maila
            $_SESSION[ 'email' ] = $email;
            $_SESSION[ 'subject' ] = $_POST[ 'subject' ];
            $_SESSION[ 'message' ] = $_POST[ 'message' ];
            header( "Location: ./php/send_mail.php" );
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Rozkmina.pl - profil użytkownika</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <link rel="stylesheet" type="text/css" href="css/profile.css">
    <link rel="shortcut icon" type="image/png" href="./img/favicon.png"/>
    <link href="https://fonts.googleapis.com/css?family=Hind+Madurai:600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:900" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>
<body>
<a href="/">
    <button>Powrót</button>
</a>
<div>
    <?php
        if ( isset( $_SESSION[ 'mail_result' ] ) ) {
            echo '<p>' . $_SESSION[ 'mail_result' ] . '</p>';
            unset( $_SESSION[ 'mail_result' ] );
        }
    ?></div>
<div id="container">
    <div id="content">
        <div id="user">
            <?php
                
                $userImg = User_object( 'user_img', $id, ConnectToDatabase() );
                
                if ( !$userImg ) {
                    echo '<img src="../img/login.png">';
                } else {
                    echo '<img src="data:image/jpeg;base64,' . base64_encode( $userImg ) . '">';
                }
            ?>
            <div id="user_info">
                <p>Nick: <?php echo User_object( 'nick', $id, ConnectToDatabase() ) ?></p>
                <p>E-mail: <?php echo User_object( 'email', $id, ConnectToDatabase() ) ?></p>
                <p>Data stworzenia
                    konta: <?php echo User_object( 'Data_dolaczenia', $id, ConnectToDatabase() ) ?></p>
            </div>
        </div>
        <div class="about_user">
            <div class="user_profile_info current_user_profile_info" onclick="showTab('about_user_description')">O
                mnie
            </div>
            <div class="user_profile_info" onclick="showTab('about_user_settings')">Ustawienia</div>
            <!--            <div class="user_profile_info" onclick="showTab('about_user_friends')">Przyjaciele</div>-->

            <div id="about_user_description" class="about_user_content" style="display: block;">
                <div class="about_user_description">
                    <?php echo User_object( 'Omnie', $id, ConnectToDatabase() ); ?>
                </div>
                <button id="editAboutMeBtn">Edytuj informacje o sobie</button>
                <form id="aboutMeForm" method="post" action="php/change_user_data.php" style="display: none;">
                    <textarea id="aboutMe" name="aboutMe"
                              rows="4"
                              cols="95"><?php echo User_object( 'Omnie', $id, ConnectToDatabase() ); ?></textarea>
                    <input type="hidden" name="action" value="updateAboutMe">
                    <input type="submit" value="Zapisz zmiany">
                </form>
                <div class="about_user_thinks">
                    <span>Moje rozkminy</span>
                    <div class="think">
                        <ul>
                            <?php
                                $resultThinksArrary = UserThink( $id, ConnectToDatabase() );
                                
                                while ( $row = mysqli_fetch_assoc( $resultThinksArrary ) ) {
                                    $idrozkminy = $row[ 'idrozkminy' ];
                                    $temat = $row[ 'temat' ];
                                    
                                    echo "<li><a href='tresc_rozkminy.php?Idrozkminy=$idrozkminy'>$temat</a></li>";
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="about_user_settings" class="about_user_content" style="display: none;">
                <div class="about_user_thinks">
                    <div class="changeImg">
                        <span>Zmiana avatara</span>
                        <form method="post" enctype="multipart/form-data" action="php/change_user_data.php"
                              style="margin: 20px; color: #0089a4">
                            <input type="hidden" name="action" value="changeImg">
                            <input type="file" name="img">
                            <input type="submit" value="Zmień obraz">
                        </form>
                    </div>
                    <div class="changePass">
                        <span>Zmiana hasła</span>
                        <form id="changePasswordForm" method="post" action="php/change_user_data.php"
                              style="margin: 20px; color: #0089a4">
                            <label for="currentPassword">Obecne Hasło:</label>
                            <input type="password" id="currentPassword" name="currentPassword" required>

                            <br>

                            <label for="newPassword">Nowe Hasło:</label>
                            <input type="password" id="newPassword" name="newPassword" required>

                            <br>

                            <label for="confirmNewPassword">Potwierdź Nowe Hasło:</label>
                            <input type="password" id="confirmNewPassword" name="confirmNewPassword" required>
                            <span id="passwordError" class="error"></span>

                            <br>
                            <input type="hidden" name="action" value="changePasswordForm">
                            <input type="submit" value="Zmień Hasło">
                        </form>
                        <div id="error_message"></div>
                    </div>
                    <div class="changeNick">
                        <span>Zmiana nicku</span>
                        <form method="post" enctype="multipart/form-data" action="php/change_user_data.php">
                        <textarea id="aboutMe" name="nick" required
                                  rows="1"
                                  cols="50"><?php echo User_object( 'nick', $id, ConnectToDatabase() ); ?></textarea>
                            <br>
                            <input type="hidden" name="action" value="changeNick">
                            <input type="submit" value="Zapisz zmiany">
                        </form>
                    </div>
                </div>
            </div>
            <div id="about_user_friends" class="about_user_content" style="display: none;">

                </form>
            </div>
        </div>
    </div>
</div>
<script src="js/popup.js"></script>
<?php
    
    if ( isset( $_SESSION[ 'Error' ] ) ) {
        echo "<script>displayErrorMessage('{$_SESSION['Error']}');</script>";
        unset( $_SESSION[ 'Error' ] );
    }
?>
<script src="js/profile_think.js"></script>
</body>
</html>
    