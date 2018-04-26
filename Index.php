<?php
	define('CHEMIN_VUES', 'Views/');	
	define('DEV1', 'Xavier Linet');
	define('DEV2', 'Ahmad Sharifrazi');
	define('NUM_TEL', '8844230');
	define('EMAIL', 'mlqkjsfdm@gmail.com');
	
	# Require automatisé des classes de la couche modèle 
	function chargerClasse($classe) {
		require_once 'models/' . $classe . '.class.php';
	}
	spl_autoload_register('chargerClasse'); 
	
	#connexion à la db
	$db = Db::getInstance();
	
	# Ecrire ici le header de toutes pages HTML
	require_once(CHEMIN_VUES.'Header.php');
	
	
	require_once('Controllers/AccueilController.php');
	$controller = new AccueilController($db);   #faudra enlever le paramètre, ne sert que pour les tests.
	$controller->run();
	
	require_once(CHEMIN_VUES.'Footer.php');
?>