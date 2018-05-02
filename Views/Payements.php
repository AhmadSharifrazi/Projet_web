<html>
<head>
	<title>Cotisations / Gestion</title>
	<meta charset='utf-8' />
	<link rel='stylesheet' type='text/css' href='CSS/site.css' />
</head>
<body>
	<h1></h1>
	<p></p>
	<br><br><br>

	<form method="POST" action="index.php?action=Payements">
		<p>Débuter une nouvelle année de cotisation: <input id="champs" type="text" name="newYearPayement" placeholder="Montant"/><input id="submit" type="submit" value="Commencer" /></p>
		<p>Ajouter un payement de cotisation: <input id="champs" type="text" name="newMemberInOrder" placeholder="Email" /><input id="champs" type="text" name="amount_payed" placeholder="Montant"/><input id="champs" type="submit" value="Ajouter" /></p>
		<p>Valider une inscription: <input id="champs" type="text" name="newMember" placeholder="Email"/><input id="champs" type="submit" value="Valider" /></p>
		<p>Modifier la responsabilité d'un utilisateur: <input id="champs" type="text" name="newResponsability" placeholder="Email" />
		<input id="champs" type="text" name="newUserResponsability" placeholder="Nouvelle responsabilité" /><input id="submit" type="submit" value="Modifier" /></p>
		<br>
	</form><br><br>

	<form method="POST" action="index.php?action=Cible">
		<p>Voir la liste des membres qui ne sont pas en ordre: <input id="champs" type="submit" name="members_not_in_order" value="Afficher"/></p> 
	</form>
</body>
</html>
