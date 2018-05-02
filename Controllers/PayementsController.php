<?php
class PayementsController{

	private $_db;

	public function __construct($db){
		$this->_db = $db;
	}

	public function run(){

		if(!empty($_POST['newMember'])) {
			$this->_db->validate_member($_POST['newMember']);
			$message = 'Le membre ' . $_POST['newMember'] . 'a bien été validé' ;    #pense pas qu'il faille faire comme ça
		}

		if(!empty($_POST['newYearPayement'])){
			$this->_db->NewYearPayement($_POST['newYearPayement']);
		}

		if(!empty($_POST['newMemberInOrder']) && !empty($_POST['amount_payed'])){
			$this->_db->add_payement($_POST['newMemberInOrder'], $_POST['amount_payed']);
		}

		if(!empty($_POST['newResponsability']) && !empty($_POST['newUserResponsability'])){
			$this->_db->modify_responsability($_POST['newResponsability'], $_POST['newUserResponsability']);
		}

		if(!empty($_POST['members_not_in_order'])){
			$this->_db->members_not_in_order();
		}

		require_once(CHEMIN_VUES.'Payements.php');

	}
}
?>
