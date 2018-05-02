<html>
<head>
	<title>Inscription</title>
	<meta charset='utf-8' />
	<link rel='stylesheet' type='text/css' href='Views/CSS/site.css' />
</head>
<body>

	<p>Voici le membre que vous venez d'inscrire: .</p>
	<p></p>
	<p>Voici la liste des évenements:</p>



	<table id="tableBalises">
				<thead>
					<tr>
						<th>Email</th>
						<th>Prénom</th>
						<th>Nom</th>
						<th>Téléphone</th>
						<th>Adresse</th>
						<th>Compte</th>
						<th>Photo</th>
						<th>Validé</th>
						<th>Entraînement</th>
						<th>Responsabilités</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($tabMembers as $i => $member) { ?>
					<tr>
					<td><span class="html"><?php echo $member->html_email() # Protection anti XSS à l'affichage ?></span></td>
					<td><?php echo $member->html_first_name() # Protection anti XSS à l'affichage ?></td>
					<td><?php echo $member->html_last_name() ?></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
</body>
</html>
