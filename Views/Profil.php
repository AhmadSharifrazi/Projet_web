<htlm>
<head>
  <title>Profil</title>
	<meta charset='utf-8' />
	<link rel='stylesheet' type='text/css' href='CSS/site.css' />
</head>
<body>
	<h1>Vos informations</h1>
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
    <input id="submit" type="submit" value="Enregistrer" />
  </form><br><br>
