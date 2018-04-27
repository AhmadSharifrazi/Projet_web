<?php
class SubscriptionController{

	private $_db;

	public function __construct($db){
		$this->_db = $db;
	}

	public function run(){

		$this->_db->add_member("xavierLINET", "Linet", "Xavier", "04584694684", "BE64564645", NULL, "rue des aulnois");
		require_once(CHEMIN_VUES.'Subscription.php'); 
	}
}
?>
