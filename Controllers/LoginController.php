<?php
class LoginController {

	private $_db;

	public function __construct($db){

		$this->_db = $db;
	}

	public function run(){

		$notification='';

		# L'utilisateur s'est-il bien authentifié ?
		if (empty($_POST)) {
			# L'utilisateur doit remplir le formulaire
			$notification='Authentifiez-vous';
			#header('Location: index.php');
			die;
		}

		elseif (!$this->_db->login($_POST['pseudo'],$_POST['mdp'])) {
			# L'authentification n'est pas correcte
			$notification='Vos données d\'authentification ne sont pas correctes.';
			#header('Location: index.php');
			die;
		}

		else {
			# L'utilisateur est bien authentifié
			# Une variable de session $_SESSION['authentifie'] est créée
			$_SESSION['authentifie'] = 'autorise';
			$_SESSION['login'] = $_POST['pseudo'];
			# Redirection HTTP pour demander la page admin
			header("Location: index.php?action=Cible");
			die();
		}

		require_once(CHEMIN_VUES . 'Login.php');
	}
}
?>
