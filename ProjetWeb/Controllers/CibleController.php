<?php
class CibleController{

	private $_db;

	public function __construct($db){
		$this->_db = $db;
	}

	public function run(){

		 $email = $_POST['Email'];
		#$this->_db->add_workout_plan('endurance', '2018-02-25', '2018-02-26');
		/*$this->_db->add_member($_POST['email'], $_POST['last_name'], $_POST['first_name'], $_POST['phone_number'],
		$_POST['account_number'], $_POST['profil_picture'], $_POST['adress']));
		$this->_db->validate_member('schellensval@hotmail.com');
		/*$tabMembers = $this->_db->select_members();*/
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
