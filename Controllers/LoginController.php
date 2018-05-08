<?php
class LoginController {

	private $_db;

	public function __construct($db){

		$this->_db = $db;
	}

	public function run(){

		$notification='';

	/*	if (!empty($_SESSION['authentifie'])) {
			header("Location: index.php?action=admin"); # redirection HTTP vers l'action login      pense que c'est pas nécessaire
			die();
		}	*/
		# L'utilisateur s'est-il bien authentifié ?
		if (empty($_POST)) {
			# L'utilisateur doit remplir le formulaire
			$notification='Authentifiez-vous';
			header('Location: index.php');
			die;
		}

		elseif (!$this->_db->login(htmlspecialchars($_POST['pseudo']),htmlspecialchars($_POST['password']))) {
			# L'authentification n'est pas correcte
			$notification='Vos données d\'authentification ne sont pas correctes.';
			header('Location: index.php');
			die;
		}

		else {
			# L'utilisateur est bien authentifié
			# Une variable de session $_SESSION['authentifie'] est créée
			$_SESSION['role'] = $this->_db->get_Responsability_level(htmlspecialchars($_POST['pseudo']));
			$_SESSION['login'] = $_POST['pseudo'];
			# Redirection HTTP pour demander la page admin
			//header("Location: index.php?action=Login");                        comprends pas à quoi ca sert
			//die();
		}

		require_once(CHEMIN_VUES . 'Login.php');
	}
}
?>
