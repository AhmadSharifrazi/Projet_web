<?php
class CibleModel{
	
	
	public function addMember($requete){
	$requete='INSERT INTO members(email, last_name, first_name, phone_number, account_number, profil_picture, validated, training_no, responsability_level) 
		VALUES(:email,:lastName,:firstName,:phone,:account,:photo,false,1,member)'   
		$requete = $Db->prepare($requete);  
		// On lie les variables définie au-dessus au paramètres de la requête préparée
		$requete->bindValue(':email', $email, PDO::PARAM_STR); 
		$requete->bindValue(':last_name', $lastName, PDO::PARAM_STR);
		$requete->bindValue(':first_name', $firstName, PDO::PARAM_STR);
		$requete->bindValue(':phone_number', $phone, PDO::PARAM_STR);
		$requete->bindValue(':account_number', $account, PDO::PARAM_STR);
		$requete->bindValue(':profil_picture', $photo, PDO::PARAM_STR);
		$requete->bindValue(':validated', false, PDO::PARAM_STR);
		$requete->bindValue(':training_no', 1, PDO::PARAM_STR);
		$requete->bindValue(':responsability_level', members, PDO::PARAM_STR);
		//On exécute la requête
		$requete->execute();
	}
}
?>
 <!--suite à regarder
<?php


function gestion_evenement()
{
parent::Model();
}

function creation()
{
//if(isset $_POST['titre']){
$data=array(
'TITRE'=>$_POST['titre'],
'DESCRIPTION'=>$_POST['description'],
'LIEU'=>$_POST['lieu'],
'DATEEVENEMENT'=>$_POST['date'],
'HEUREEVENEMENT'=>$_POST['heure'],
'MDPEVENEMENT'=>$_POST['password'],
);
$this->mlr3->insert('EVENEMENT',$data);
//mlr3 est le nom de la db
//et evenement une de ses tables
//$this->load->view->('echec');
//}
$this->load->view->('echec'); 
}
}	
?>-->