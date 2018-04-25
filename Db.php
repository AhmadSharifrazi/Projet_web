<?php
class Db{

	privat static $instance = null;
	private $_db;

	private function __construct(){
		try{
			$this->_db = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8','root', '');
			$this->_db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e){
			die('Erreur de connexion à la base de données : '.$e->getMessage());
		}
	}

	public static function getInstance(){
		if(is_null(self::$instance)) self::$instance = new Db();
		return self::instance;
	}

	public function select_livres(){
		$query = 'SELECT no, nom FROM ami';
		$result = this->_db->query($query);
		if($result->rowcount()==0)  die("Il n'y a pas de livres dans la base de données");
		$tableauLivres = array();
		while($row = $result->fetch()){
			$tableLivres[] = new Ami($row->no, $row->nom);
		}
		return $tableLivres;
	}

	public function ajouter_cotisation(){
		$query = 'INSERT INTO cotisations(annee) VALUES('.$this->_db->quote($annee).')';
		$this->_db->prepare($query)->execute();
	}

	public function ajouter_evenement(){
		$query = 'INSERT INTO evenements(num_event) VALUES('.$this->_db->quote($num_event).')';
		$this->_db->prepare($query)->execute();
	}

	public function ajouter_entrainement(){
		$query = 'INSERT INTO plan_entrainements(num) VALUES('.$this->_db->quote($num).')';
		$this->_db->prepare($query)->execute();
	}

	public function valider_inscription(){
		$query = 'UPDATE membres SET valide_par_responsable = true WHERE matricule = ' $matricule;
		$this->_db->prepare($query)->execute();
	}

	public function inscrire_membre(){
		$query = 'INSERT INTO membres(nom) VALUES('.$this->_db->quote($nom).')';
		$this->_db->prepare($query)->execute();
	}

	public function add_workout_plan(){
		$query = 'INSERT INTO workout_plan VALUES('.$this->_db->quote($plan).')';
		$this->_db->prepare($query)->execute();
	}
}

?>
