<body>
	<nav>
		<ul>
			<li id="connection"><a href="index.php?action=Subscription">S'inscrire</a></li>
			<li id="connection">

			<form method="POST" action="index.php?action=Login">
				<p>Se connecter:</p>
				<input type="text" name="pseudo" placeholder="Email" />
				<input type="password" name="password" method ="POST" width=25 placeholder="Mot de passe"/>
				<input type="submit" value="Se connecter" />
			</form>
			</li>
		</ul>
	</nav>
	<h1>Bienvenue</h1>
	<div>
		<p id='accueil'>Cher internaute, te voilà  sur le site du groupe <?php echo $group ?> de la ville <?php echo $place?>.</p>
		<p>Nous organisons des entraînements, compétitions et événements tels que les voyages de groupe, dîners...</p>
		<p>Ce site est réservé aux membres: nous vous invitons à poursuivre votre navigations en vous connectant si vous
		êtes un membre du groupe en ordre. Si il s'agit de votre première visite, vous devez vous inscrire pour accéder
		aux fonctionnalités du site</p>
	</div>
	<div id='photo'>
		<img id='photo' src="Views/Images/photoAccueil.JPG" alt='photo de groupe'>
	</div>
	<br><br><br><br>

</body>
</html>
