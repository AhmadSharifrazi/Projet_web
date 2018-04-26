<?php
class Db{
	
	private static $instance = null;
	private $_db;
	
	private function __construct(){
		try{
			$this->_db = new PDO('mysql:host=localhost;dbname=test_projet;charset=utf8','root','');
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
	
	public function select_members(){   <--pour test-->
		$query = 'SELECT * FROM MEMBERS';
		$result = this->_db->query($query);
		$array = array();
		
		if ($result->rowcount() == 0){
			
		}
		else{ 
			while($row = $result->fetch()){
				$array[] = new Member(row->$event_no, row->$title, row->$starting_date, row->$ending_date, row->$place, row->$url, row->$approximative_cost, row->registered_number, 
				row->interested_number, $row->description);
			}
		}
	}
	
	public function add_payement(){
		$query = 'INSERT INTO cotisations(annee) VALUES('.$this->_db->quote($annee).')';
		$this->_db->prepare($query)->execute();
	}
	
	public function add_event(){
		$query = 'INSERT INTO evenements(num_event) VALUES('.$this->_db->quote($num_event).')';
		$this->_db->prepare($query)->execute();
	}
	
	public function add_workout_plan(){
		$query = 'INSERT INTO plan_entrainements(num) VALUES('.$this->_db->quote($plan).')';
		$this->_db->prepare($query)->execute();
	}
	
	public function validate_subscribe(){
		$query = 'UPDATE membres SET valide_par_responsable = true WHERE matricule = ' $matricule;
		$this->_db->prepare($query)->execute();
	}
	
	public function subscribe_member(){
		$query = 'INSERT INTO membres(nom) VALUES('.$this->_db->quote($nom).')';
		$this->_db->prepare($query)->execute();
	}
}

?>