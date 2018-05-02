<?php
class SubscriptionController{

	private $_db;

	public function __construct($db){
		$this->_db = $db;
	}

	public function run(){

		if(!empty($_POST['email']) && !empty($_POST['mdp']) && !empty($_POST['last_name']) && !empty($_POST['first_name'])) {
			$this->_db->add_member($_POST['email'], $_POST['mdp'], $_POST['last_name'], $_POST['first_name'], $_POST['phone'], $_POST['account'], $_POST['profil_picture'], $_POST['adress']);
		}

		require_once(CHEMIN_VUES.'Subscription.php');
	}
}
?>
