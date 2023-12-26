<?php
    error_reporting( 0 );
    session_start();
    
    $login = $_SESSION[ 'user_login' ];
    $user_img = $_SESSION[ 'user_img' ];
?>
<!DOCTYPE html>
<html>
<head>

    <title>Rozkmina.pl</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/fontello/fontello.css">
    <link rel="shortcut icon" type="image/png" href="./img/favicon.png"/>
    <link href="https://fonts.googleapis.com/css?family=Hind+Madurai:600" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:900" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <title>Document</title>
</head>
<body>

<div id="content">
    <header>
        <h2><a href="/">ROZKMINA.PL</a></h2>
    </header>
    <section>
        <h1>w tym miejscu możesz podzielić się swoimi przemyśleniami</h1>
    </section>

    <div id="options">
        <a href="rozkminy.php">
            <div class="type_option">
                <figure>
                    <img src='img/search.png'>
                    <figcaption>Przeglądaj rozkminy</figcaption>
                </figure>
            </div>
        </a>
        <?php
            if ( $login ) {
                echo <<<END
			<div class="type_option">
	
				<figure >
END;
                if ( $user_img ) {
                    echo '<img src="data:image/jpeg;base64,' . base64_encode( $user_img ) . '">';
                } else {
                    echo '<img src="img/login.png">';
                }
                echo <<<END
					<figcaption>$login</figcaption>
				</figure>
				<div id="login" >
					<div style="width:280px; height:60px; margin:auto; padding-top:10px;">
						<div class="user_options">
							<a href="user_profile.php">Mój profil</a>
						</div>
						<div class="user_options">
							<a href="php/logout.php">Wyloguj się </a>
						</div>
					</div>
				</div>
			</div>
END;
            } else {
                echo <<<END
		<div class="type_option">

			<figure >
				<img src="img/login.png">
				<figcaption>Zaloguj się</figcaption>
			</figure>

			<style>
				#login
				{
					width: 290px;
					height: 200px;
				}
				.type_option:hover{
					height: 350px;
				}
			</style>

            <div id="login">
                <form action="php/login.php" method="post">
                    <fieldset style="width:300px;">
                        <span>Login</span>
                        <input type="text" name="login">
                    </fieldset>
            
                    <fieldset style="width:300px;">
                        <span>Hasło</span>
                        <input type="password" name="pass">
                    </fieldset>
                    <input type="submit" value="Login" style="margin-top:30px;">
                </form>
                <button id="forgotPasswordBtn">Forgot Password?</button>
            </div>
                <div id="overlay"></div>
            
            <div id="forgotPasswordPopup">
                <h2>Przypomnienie hasła</h2>
                <p>Wprowadź swój adres email w celu otrzymania nowego hasła</p>
                <form action="php/forgot_password.php" method="post">
                    <label for="email">Email:</label>
                    <input type="email" name="email" required>
                    <br>
                    <input type="submit" value="Wyślij">
                </form>
                <button id="closePopupBtn">zamknij</button>
            </div>
		</div>
END;
            }
        ?>
        
        <?php
            if ( $login ) {
                echo <<<END
		<style>
			.type_option:last-child:hover{
				height: 150px ;
			}
		</style>

		<div class="type_option">
				<figure>
					<a href="nowa_rozkmina.php">
						<img src="img/add_think.png">
						<figcaption>Dodaj rozkmine</figcaption>
					</a>
				</figure>
		</div>

END;
            } else {
                echo <<<END
		<div class="type_options">

			<a href="/registration.php">
                <figure>
                    <img src="img/add_user.png">
                    <figcaption>Rejestracja</figcaption>
                </figure>
            </a>
			</div>
END;
            }
        ?>
    </div>
    <script src="js/popup.js"></script>
    <?php
        
        if ( isset( $_SESSION[ 'Error' ] ) ) {
            echo "<script>displayErrorMessage('{$_SESSION['Error']}');</script>";
            unset( $_SESSION[ 'Error' ] );
        }
    ?>
</body>
</html>