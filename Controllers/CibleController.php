<?php
class CibleController{
	
	private $_db;
	
	public function __construct($db){
		$this->_db = $db;
	}
	
	public function run(){
	
		$this->_db->add_member($_POST['email'], $_POST['last_name'], $_POST['first_name'], $_POST['phone_number'], $_POST['account_number'], $_POST['profil_picture'], $validated, $training_no, $responsability_level, $adress));
		/*$tabMembers = $this->_db->select_members();*/
		$nomFamille=$_POST['lastName'];
		/*$firstName=$_POST['firstName'];
		$phone=$_POST['phone'];
		$email=$_POST['email'];
		$adress=$_POST['adress'];
		$account=$_POST['account'];
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

