<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8" >
		<title>Runsmart</title>
		<link rel="stylesheet" type="text/css" href="views/css/site.css" media="all" >
		<link rel="stylesheet" type="text/css" href="views/css/modele01.css" media="screen" >
	</head>
	<body>
		<header>
			<h1 id="header">
				<a href="index.php?action=Login">
				<img id="logo" src="views/images/course.png" alt="course">
				</a>
				Runsmart
			</h1>
			<nav>
				<ul>

					<?php if($_SESSION != null){  ?>
							<li id="nav"><a href="index.php?action=CreateEvent">Créer un événement</a></li>
							<?php /*if(!strcmp($_SESSION['role'], 'member')){*/ ?>
							<li id="nav"><a href="index.php?action=Payements">Cotisations / Gestion</a></li> <?php/* }*/?>
							<li id="nav"><form method="post" action="index.php?action=Logout"> </li>
									<li id="nav" ><input type="submit" value="Se déconnecter" />	</li>												<!--a arranger-->
							</form>
					<?php } ?>
				</ul>
			</nav>
		</header>
