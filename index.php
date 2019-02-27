<?php
	session_start();

	if(!$_SESSION['gites'])
	{
		$gites = false;
	}
	else
	{
		$_SESSION['gites'] = true;
		$gites = true;
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
	var error_div = document.createElement('div');	
	
	function create_error_msg()
	{			
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
	echo "<script>create_error_msg();</script>";
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
			<?php
echo<<<END
				<img src="img/search.png">
				<figcaption>Dodaj rozkmine</figcaption>
END;
			?>
			</figure>
		</div>
		<div class="type_option" id="login_option" >

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
		<div class="type_option" id="registry_option">

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
	</div>
</div>
</body>
</html>

<!--	
<div id="dodaj_rozkmine">
	<a href="nowa_rozkmina.php"><i class="icon-plus"></i></a>
</div> -

->