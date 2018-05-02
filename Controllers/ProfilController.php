<?php
 class ProfilController{

   public function __construct($db){
     		$this->_db = $db;
   }

   public function run(){

     require_once(CHEMIN_VUES.'Profil.php');
   }
 }
?>
