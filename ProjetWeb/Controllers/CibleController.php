<?php
class CibleController{

	private $_db;

	public function __construct($db){
		$this->_db = $db;
	}

	public function run(){
		#fonctionne plus qu'à vérifier que le newMember est bien dans la table et le mettre dans le PayementsController
		#$this->_db->validate_member($_POST['newMember']);
		#$this->_db->add_payement($_POST['newMemberInOrder']);   #A vérifier
		#$this->_db->add_workout_plan($_POST['endurance'], $_POST['2018-02-25'], $_POST['2018-02-26']);
		$this->_db->add_member($_POST['email'], $_POST['last_name'], $_POST['first_name'], $_POST['phone'], $_POST['account'], $_POST['profil_picture'], $_POST['adress']);

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
