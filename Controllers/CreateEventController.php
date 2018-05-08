<?php
class CreateEventController{

	private $_db;

	public function __construct($db){
			$this->_db = $db;
	}

	public function run(){

			if(!empty($_POST['title'])){
				$this->_db->add_event(htmlspecialchars($_POST['title']), htmlspecialchars($_POST['start']), htmlspecialchars($_POST['end']), htmlspecialchars($_POST['place']), htmlspecialchars($_POST['url']),
				htmlspecialchars($_POST['cost']), htmlspecialchars($_POST['description']));
			}

			require_once(CHEMIN_VUES.'CreateEvent.php');

	}
}
?>
