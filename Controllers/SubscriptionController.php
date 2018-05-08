<?php
class SubscriptionController{

	private $_db;

	public function __construct($db){
		$this->_db = $db;
	}

	public function run(){

		if(!empty($_POST['email']) && !empty($_POST['psw']) && !empty($_POST['last_name']) && !empty($_POST['first_name'])) {
			$this->_db->add_member(htmlspecialchars($_POST['email']), htmlspecialchars($_POST['psw']), htmlspecialchars($_POST['last_name']), htmlspecialchars($_POST['first_name']),
			htmlspecialchars($_POST['phone']), htmlspecialchars($_POST['account']), htmlspecialchars($_POST['profil_picture']), htmlspecialchars($_POST['adress']));
		}

		require_once(CHEMIN_VUES.'Subscription.php');
	}
}
?>
