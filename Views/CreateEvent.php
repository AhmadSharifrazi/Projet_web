<html>
<head>
	<title>CreerEvenement</title>
	<meta charset='utf-8' />
	<link rel='stylesheet' type='text/css' href='Views/CSS/site.css' />
</head>
<body>
	<h3>Veuillez renseigner les champs suivants pour créer un événement:</h3>
	<br><br><br>
	
	<form method="POST" action="CreateEvent.php">
		<p>Titre: <input id="champs" type="text" name="title" /></p>
		<p>Date de début: <input id="champs" type="text" name="start" /></p>
		<p>Date de fin: <input id="champs" type="text" name="end" /></p>
		<p>Lieu: <input id="champs" type="text" name="place" /></p>
		<p>Coût approximatif: <input id="champs" type="text" name="cost" /></p>
		<p>Description: <input id="champs" type="text" name="description" /></p>
		<p>URL: <input id="champs" type="text" name="url" /></p>
		<br>
		<input id="submit" type="submit" value="Envoyer" />
	</form>
</body>
</html>