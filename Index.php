<?php
	session_start();


	define('CHEMIN_VUES', 'Views/');
	define('CHEMIN_CONTROLEURS','Controllers/');
	define('DEV1', 'Xavier Linet');
	define('DEV2', 'Ahmad Sharifrazi');
	define('NUM_TEL', '8844230');
	define('EMAIL', 'mqsdf.com');
	define('SESSION_ID',session_id());

	# Require automatisé des classes de la couche modèle
	function chargerClasse($classe) {
		require_once 'models/' . $classe . '.class.php';
	}
	spl_autoload_register('chargerClasse');


	#connexion à la db
	$db = Db::getInstance();


	# Pour le header : admin ou login selon que la variable de session 'authentifie' existe ou pas
	if (empty($_SESSION['authentifie'])){
		$actionloginadmin='login';
		$libelleloginadmin='Login';
	} else {
		$actionloginadmin='admin';
		$libelleloginadmin='Zone Admin';
	}


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
		case 'Login':
			require_once(CHEMIN_CONTROLEURS.'LoginController.php');
			$controller = new LoginController($db);
			break;

		default: # Par défaut, le contrôleur de l'accueil est sélectionné
			require_once(CHEMIN_CONTROLEURS.'LoginController.php');
			$controller = new LoginController($db);
			break;
	}
	# Exécution du contrôleur correspondant à l'action demandée
	$controller->run();

	require_once(CHEMIN_VUES.'Footer.php');
?>
