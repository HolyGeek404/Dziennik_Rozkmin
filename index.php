<!DOCTYPE html>
<html>
<head>
	<title>Dziennik Rozkmin</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="css/fontello.css">
	<link rel="shortcut icon" type="image/png" href="img/favicon.png"/>
	<link href="https://fonts.googleapis.com/css?family=Hind+Madurai:600" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:900" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
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
				<img src="img/add_think.png">
				<figcaption>Dodaj rozkmine</figcaption>
			</figure>
		</div>
		<div class="type_option" id="login_option" >

			<figure >  
				<img src="img/login.png">
				<figcaption>Zaloguj się</figcaption>
			</figure>

			<div id="login" >
				<form action="" method="post">
					<fieldset style="width:300px;">
						<span>Login</span>
						<input type="text" name="">
					</fieldset>
				
					<fieldset style="width:300px;">
						<span>Hasło</span>
						<input type="password" name="">
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
				<form>
					<fieldset>
						<span>Login</span>
						<input type="text" name="" >
					</fieldset>

					<fieldset>
						<span>E-mail</span>
						<input type="email" name="">
					</fieldset>
				
					<fieldset>
						<span>Hasło</span>
						<input type="password" name="">
					</fieldset>

					<fieldset>
						<span>Powtórz hasło</span>
						<input type="password" name="">
					</fieldset>	
					<input type="submit" name="">				
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