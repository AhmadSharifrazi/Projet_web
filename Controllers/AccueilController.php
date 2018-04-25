<?php
class AccueilController{
	
	private $_db;            #à enlever
	
	public function __construct($db){    #pareil
		$this->_db = $db;
	}
	
	public function run(){
		$place = 'Bruxelles';
		$group = 'course';
		
		#$this->_db->validate_member('depapealex@gmail.com');
		#$this->_db->add_payement("xavier@gmail.com", 2018, 150);
		#$this->_db->add_event(111, "nouveau", "2012-12-21", "2012-12-22", "Monde", "finDuMonde.html", 10, 20, 2, "fin du monde");          #pareil
		
		require_once(CHEMIN_VUES.'accueil.php');
	}
}
?>