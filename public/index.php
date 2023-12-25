<?php
    
    // TODO create another page for registration,
    // change the variables name,
    // create user page and options
    
    error_reporting( 0 );
    session_start();
    
    $login = $_SESSION[ 'user_login' ];
    $user_img = $_SESSION[ 'user_img' ];
    // echo date("d/m/o G:i");
?>
<!DOCTYPE html>
<html>
<head>

    <title>Rozkmina.pl</title>
    <?php include 'head.php' ?>
</head>
<body>
<?php
    if ( $_SESSION[ 'incorrectLoginOrRregistration' ] ) {
        echo "<script>error_msg();</script>";
    }
?>
<div id="content">
    <header>
        <h2>ROZKMINA.PL</h2>
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
							<a href="logout.php">Wyloguj się </a>
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

			<div id="login" >
				<form action="login.php" method="post">
					<fieldset style="width:300px;">
						<span>Login</span>
						<input type="text" name="login">
					</fieldset>
				
					<fieldset style="width:300px;">
						<span>Hasło</span>
						<input type="password" name="pass">
					</fieldset>

					<input type="submit" name=""  style="margin-top:30px;">
				</form>
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
		<div class="type_option">

			<figure >
				<img src="img/add_user.png">
				<figcaption>Rejestracja</figcaption>
			</figure>

			<div id="rejestracja">
				<form method="post" action="registry.php">
					<fieldset>
						<span>Login</span>
						<input type="text" name="login" placeholder="3 do 15 znaków">
					</fieldset>

					<fieldset>
						<span>E-mail</span>
						<input type="email" name="email">
					</fieldset>
				
					<fieldset>
						<span>Hasło</span>
						<input type="password" name="pass" placeholder="Minimum 6 znaków">
					</fieldset>

					<fieldset>
						<span>Powtórz hasło</span>
						<input type="password" name="pass_rep">
					</fieldset>
					<input type="submit" >
				</form>
			</div>
		</div><script>CutThinkContent();</script>
END;
            }
        ?>
    </div>
</body>
</html>