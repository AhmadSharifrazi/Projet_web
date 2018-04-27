<html>
<head>
	<title>Inscription</title>
	<meta charset='utf-8' />
	<link rel='stylesheet' type='text/css' href='CSS/site.css' />
</head>
<body>
	<h1>Formulaire d'inscription</h1>
	<p>Veuillez remplir les champs suivants pour pouvoir vous inscrire</p>
	<br><br><br>
	
	<form method="POST" action="cible.php">
		<p>Nom: <input id="champs" type="text" name="lastName" /></p>
		<p>Prénom: <input id="champs" type="text" name="firstName" /></p>
		<p>Numéro de téléphone: <input id="champs" type="text" name="phone" /></p>
		<p>Email: <input id="champs" type="text" name="email" /></p>
		<p>Adresse: <input id="champs" type="text" name="adress" /></p>
		<p>Numéro de compte: <input id="champs" type="text" name="account" /></p>
		<p>Photo: <!--drag&drop--></p>
		<br>
		<input id="submit" type="submit" value="Envoyer" />
	</form><br><br>
	<p>Après l'envoi du formulaire, un responsable devra valider votre inscription. <span class="notification">Vous n'avez donc 
	pas encore accès au site</span>.</p>
</body>
</html>