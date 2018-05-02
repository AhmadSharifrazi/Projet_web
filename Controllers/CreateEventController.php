<?php
class CreateEventController{

	private $_db;

	public function __construct($db){
			$this->_db = $db;
	}

	public function run(){

			if(!empty($_POST['title'])){
				$this->_db->add_event($_POST['title'], $_POST['start'], $_POST['end'], $_POST['place'], $_POST['url'], $_POST['cost'], $_POST['description']);
			}

			require_once(CHEMIN_VUES.'CreateEvent.php');

	}
}
?>
