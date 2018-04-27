<?php
class CreateEventController{

	private $_db;

	public function __construct($db){
			$this->_db = $db;
	}

	public function run(){

			#$this->_db->add_event("nouveau", "2012-12-21", NULL, "Monde", "finDuMonde.html", 10, NULL, NULL, "fin du monde");
			#$this->_db->add_workout_plan("sprint", "2018-12-06", NULL);
			require_once(CHEMIN_VUES.'CreateEvent.php');

	}
}
?>
