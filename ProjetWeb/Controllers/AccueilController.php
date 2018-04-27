<?php
class AccueilController{

	public function __construct(){

	}

	public function run(){
		$place = 'Bruxelles';
		$group = 'course';

		require_once(CHEMIN_VUES.'accueil.php');
	}
}
?>
