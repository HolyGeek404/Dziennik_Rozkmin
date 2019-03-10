<?php
	error_reporting(0);
	session_start();

	if($_SESSION['gites'])
	{
		$gites = true;
		$login = $_SESSION['user_login'];
	}
	else{
		$gites = false;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Rozkmina.pl</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="css/fontello.css">
	<link rel="shortcut icon" type="image/png" href="img/favicon.png"/>
	<link href="https://fonts.googleapis.com/css?family=Hind+Madurai:600" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:900" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<script>
	function error_msg()
	{			
		var error_div = document.createElement('div');	
		$(error_div).attr('id','error_msg');
		$('body').prepend(error_div);
		$(error_div).prepend('<span>Wypełnij prawidłowo formularz</span>');
		
		setTimeout(function(){
			$(error_div).animate({right: "0px"},800);
		},800);
		setTimeout(function(){
			$(error_div).animate({right: "-350px"});
		},4500);
		setTimeout(function(){
			$(error_div).remove();
		},5000);
		// FUNKCJA KTÓRA TWORZY DIVA Z WIADOMOŚCIĄ O BŁĘDNYM 
		// ZALOGOWANIU / REJESTRACJI
	}
	</script>
</head>
<body>
<?php
if(!$gites){
	echo "<script>error_msg();</script>";
}
?>
<div id="content">
	<header>
		<h2>ROZKMINY</h2>
	</header>
	<section>
		<h1>W tym miejscu możesz podzielić się swoimi przemyśleniami</h1>
	</section>
	
	<div id="options">
		<div class="type_option">
			<figure>
				<img src='img/search.png'>
				<figcaption>Przeglądaj rozkminy</figcaption>
			</figure>
		</div>
<?php
		if(isset($login))
		{
echo<<<END
		<div class="type_option">

			<figure >  
				<img src="img/login.png">
				<figcaption>$login</figcaption>
			</figure>

			<div id="login" >
				<a href="logout.php">Wyloguj się</a>
			</div>	
		</div>			
END;
		}
		else
		{
echo<<<END
		<div class="type_option">

			<figure >  
				<img src="img/login.png">
				<figcaption>Zaloguj się</figcaption>
			</figure>

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

if(isset($login))
{
echo<<<END
		<style>
			.type_option:last-child:hover{
				height: 150px ;
			}
		</style>

		<div class="type_option">
			<figure >
				<img src="img/add_think.png">
				<figcaption>Dodaj rozkmine</figcaption>
			</figure>					
		</div>
END;
}
else
{
echo<<<END
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
		</div>
END;
}
?>	
</div>
</body>
</html>