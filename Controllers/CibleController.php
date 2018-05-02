<?php
class CibleController{

	private $_db;

	public function __construct($db){
		$this->_db = $db;
	}

	public function run(){

		#je sais pas où mettre cet appel de méthode, mais elle marche. J'aimerais ne pas avoir à demander le numéro de l'event
		if(!empty($_POST['event_no']) && !empty($_POST['newDescription'])){
			$this->_db->modify_event($_POST['event_no'], $_POST['newDescription']);
		}

		if(!empty($_POST['email']) && !empty($_POST['event_no'])){
			$this->_db->has_payed_event($_POST['email'], $_POST['event_no']);   #fonctionne aussi   mais mieux sans event_no
		}

	 $tabMembers = $this->_db->members_not_in_order();


		/*
		#$photo=$_FILE['photo'];
		$notification='';

		if ($this->_db->insert_member('qsdfqsfd@gmail.com', 'Xavier', 'Linet', '5616546', 'je t\'emmerde', 'fdqs', 0, 1, 'member', 'rue des machins'))
			{
				$notification='Ajout bien fait';
			} else {
				$notification='Erreur à l\'ajout';
			}	*/

		require_once(CHEMIN_VUES.'cible.php');
	}
}
?>
