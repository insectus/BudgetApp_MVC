<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="pl">
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Aplikacja do zarządzania finansami osobistymi</title>
		<meta name="description" content="Zapanuj nad swoimi finansami"/>
		<meta name="keywords" content="budżet, finanse, oszczędzanie, pieniądze, wydatki, przychody, szczęście"/>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="main.css">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&amp;subset=latin-ext" rel="stylesheet">
	</head>
	
	<body>
		<header>
			<nav class="navbar navbar-dark bg-budget navbar-expand-lg">
			<a class="navbar-brand" href="index.php">
			<img src="img/currency.png" width="30" height="30" class="d-inline-block mr-1 align-bottom" alt="">Twój budżet</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
			<span class="navbar-toggler-icon"/>
			</button>
				
			<div class="collapse navbar-collapse" id="mainmenu">				
				<ul class="navbar-nav mr-auto">											
					<?php
						if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
						{
							echo
							'<li class="nav-item active">
								<a class="nav-link" href="index.php"> Start </a>
							</li>
							
							<li class="nav-item">
								<a class="nav-link" href="incomes.php" > Przychody </a>
							</li>
						
							<li class="nav-item">
								<a class="nav-link" href="expense.php" > Wydatki </a>
							</li>
							
							<li class="nav-item">
								<a class="nav-link" href="balance.php" > Bilans </a>
							</li>
							';
						}
					?>
				</ul>					
					<?php
						if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
						{
							echo
							'<div class="navbar-nav">
								<a class="nav-link" href="logout.php">Wyloguj się!</a>
							</div>';
						}
					?>			
				</div>				
			</nav>
		</header>
		
		<main>
			<div id="welcomePage">
				<section class="budget">
					<div class="container-fluid">											
					<?php
						if ((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
						{
							echo'<header>
									<h1>Witaj '.$_SESSION['username'].'!</h1>
									<p>Ta aplikacja ma za zadanie pomóc Ci w zarządzaniu Twoim budżetem.</p>
								</header>
								
								<p>Co chcesz zrobić?</p>
								<p>Jeżeli chcesz dodać wydatek przejdż do zakładki: <a href="expense.php" class="tilelink" title="Wydatki!">Wydatki</a></p>
								<br>
								<p>Jeżeli chcesz dodać przychód przejdż do zakładki: <a href="incomes.php" class="tilelink" title="Przychody!">Przychody</a></p>								
								<br>
								<p>Jeżeli chcesz sprawdzić stan Twoich finansów skorzystaj z narzędia: <a href="balance.php" class="tilelink" title="Bilans!">Bilans</a></p>								
								<br>';
						}else{
							echo'<header>
									<h1>Witaj drogi użytkowniku!</h1>
									<p>Ta aplikacja ma za zadanie pomóc Ci w zarządzaniu Twoim budżetem.</p>
								</header>
								
								<p>Jeżeli nie założyłeś jeszcze konta przejdź do strony:</p>
								<a href="register.php" class="tilelink" title="Rejestracja!">Rejestracja</a>
								<br>
								<p>Jeżeli masz już konto to przejdź do strony logowania:	
								<br><br>
								<a href="login_page.php" class="tilelink" title="Logowanie!">Logowanie</a>
								<br>
								by móc w pełni korzystać z funkcjonalności aplikacji.</p>
								</div>';}
						?>					
				</section>
				
			</div>
			
		</main>
		
		<footer class="navbar-text fixed-bottom text-center bg-dark">
			Aplikacja budżetowa &copy; Wszelkie prawa zastrzeżone
		</footer>
		
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"/>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"/>
		<script src="js/bootstrap.min.js"/>
	</body>
</html>