<html>
<head>
	<title>Inscription</title>
	<meta charset='utf-8' />
	<link rel='stylesheet' type='text/css' href='Views/CSS/site.css' />
</head>
<body>

	<p>Voici l'adresse pour voir les photos des événements passés: <a href="https://www.google.com/intl/fr_ALL/drive/"> Google Drive </a> </p>
	<p>Voici la liste des évenements:</p>

	<?php/* if(!empty($_POST['select_events'])){ ?>
	<table id="tableBalises">
				<thead>
					<tr>
						<th>Email</th>
						<th>Prénom</th>
						<th>Nom</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($tabEvents as $i => $event) { ?>
					<tr>
					<td><span class="html"><?php echo $event->html_titre() # Protection anti XSS à l'affichage ?></span></td>
					<td><?php echo $event->html_() # Protection anti XSS à l'affichage ?></td>
					<td><?php echo $event->html_last_name() ?></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
	<?php 	}
	#else{echo $notification ;}
*/	?>


</body>
</html>
