<?php
class PayementsController{

	private $_db;

	public function __construct($db){
		$this->_db = $db;
	}

	public function run(){

		$this->_db->validate_member('xavier@gmail.com');
		#$this->_db->add_payement('xavier@gmail.com', '2018', '150');

		require_once(CHEMIN_VUES.'Payements.php');

	}
}
?>
