<?php
	define('CHEMIN_VUES', 'Views/');
	define('CHEMIN_CONTROLEURS','Controllers/');
	define('DEV1', 'Xavier Linet');
	define('DEV2', 'Ahmad Sharifrazi');
	define('NUM_TEL', '8844230');
	define('EMAIL', 'mlqkjsfdm@gmail.com');

	# Require automatisé des classes de la couche modèle
	/*function chargerClasse($classe) {
		require_once 'models/' . $classe . '.class.php';
	}
	spl_autoload_register('chargerClasse'); */

	 require_once 'models/Db.class.php';         // # à supprimer plus tard

	#connexion à la db
	$db = Db::getInstance();

	# Ecrire ici le header de toutes pages HTML
	require_once(CHEMIN_VUES.'Header.php');

	# Tester si une variable GET 'action' est précisée dans l'URL index.php?action=...
	$action = (isset($_GET['action'])) ? $_GET['action'] : 'default';
	# Quelle action est demandée dans l'URL ?
	switch($action) {
		case 'CreateEvent':
			require_once(CHEMIN_CONTROLEURS.'CreateEventController.php');
			$controller = new CreateEventController($db);
			break;
		case 'Payements':
			require_once(CHEMIN_CONTROLEURS.'PayementsController.php');
			$controller = new PayementsController($db);
			break;
		case 'Subscription':
			require_once(CHEMIN_CONTROLEURS.'SubscriptionController.php');
			$controller = new SubscriptionController($db);
			break;
		case 'Cible':
			require_once(CHEMIN_CONTROLEURS.'CibleController.php');
			$controller = new CibleController($db);
			break;

		default: # Par défaut, le contrôleur de l'accueil est sélectionné
			require_once(CHEMIN_CONTROLEURS.'AccueilController.php');
			$controller = new AccueilController($db);                                       //paramètre à supprimer, juste pour les tests
			break;
	}
	# Exécution du contrôleur correspondant à l'action demandée
	$controller->run();

	require_once(CHEMIN_VUES.'Footer.php');
?>
