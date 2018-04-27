<?php
class Db{

	private static $instance = null;
	private $_db;

	private function __construct(){
		try{
			$this->_db = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8','root','');
			$this->_db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e){
			die('Erreur de connexion à la base de données : '.$e->getMessage());
		}
	}

	public static function getInstance(){
        if (is_null(self::$instance)) {
            self::$instance = new Db();
        }
        return self::$instance;
    }

	public function select_members(){   			#pour test
		$query = 'SELECT * FROM members';
		$ps = $this->_db->prepare($query);
		$ps->execute();
		$row = $ps->fetch();
	#	return new Member(row->email, row->last_name, row->first_name, row->phone_number, row->adress, row->account_number, row->profile_picture, row->validated, row->training_no, row->responsability_level);
	}

	 #fonctionne mais serait mieux avec un seul paramètre, le mail, '.$this->_db->quote(':email').'  juste changer l'appel
	public function add_payement($email, $year, $amount_payed){
		$query = 'INSERT INTO payements(email, year, amount_payed)
		VALUES(:email, :year, :amount_payed)';
		$ps = $this->_db->prepare($query);

		// On lie les variables définie au-dessus au paramètres de la requête préparée
		$ps->bindValue(':email', $email, PDO::PARAM_STR);
		$ps->bindValue(':year', $year, PDO::PARAM_INT);
		$ps->bindValue(':amount_payed', $amount_payed, PDO::PARAM_INT);
		//On exécute la requête
		$ps->execute();
	}

	#fonctionne  VALUES('.$this->_db->quote(':title').', '.$this->_db->quote(':starting_date'). ', '.$this->_db->quote(':ending_date'). ', '.$this->_db->quote(':place').',
	#'.$this->_db->quote(':url').', :approximative_cost, :registered_number, :interested_number, '.$this->_db->quote(':description').')';
	public function add_event($title, $starting_date, $ending_date, $place, $url, $approximative_cost, $registered_number, $interested_number, $description){
		$query = 'INSERT INTO events(title, starting_date, ending_date, place, url, approximative_cost, registered_number, interested_number, description)
		VALUES (:title, :starting_date, :ending_date, :place, :url, :approximative_cost, :registered_number, :interested_number, :description)';
		$ps = $this->_db->prepare($query);

		// On lie les variables définie au-dessus au paramètres de la requête préparée
		$ps->bindValue(':title', $title, PDO::PARAM_STR);
		$ps->bindValue(':starting_date', $starting_date, PDO::PARAM_STR);
		$ps->bindValue(':ending_date', $ending_date, PDO::PARAM_STR);
		$ps->bindValue(':place', $place, PDO::PARAM_STR);
		$ps->bindValue(':url', $url, PDO::PARAM_STR);
		$ps->bindValue(':approximative_cost', $approximative_cost, PDO::PARAM_INT);
		$ps->bindValue(':registered_number', $registered_number, PDO::PARAM_INT);
		$ps->bindValue(':interested_number', $interested_number, PDO::PARAM_INT);
		$ps->bindValue(':description', $description, PDO::PARAM_STR);
		//On exécute la requête
		$ps->execute();
	}

	#fonctionne mais ajouter les $this->_db->quote()
	public function add_workout_plan($workout_name, $starting_date, $ending_date){
		$query = 'INSERT INTO workout_plan(workout_name, starting_date, ending_date)
		VALUES(:workout_name, :starting_date, :ending_date)';
		$ps = $this->_db->prepare($query);
		$ps->bindValue(':workout_name', $workout_name, PDO::PARAM_STR);
		$ps->bindValue(':starting_date', $starting_date, PDO::PARAM_STR);
		$ps->bindValue(':ending_date', $ending_date, PDO::PARAM_STR);
		$ps->execute();
	}

	#fonctionne mais ajouter '.$this->_db->quote()
	public function validate_member($email){
		//if()
		$query = 'UPDATE members SET validated = true WHERE email = :email';
		$ps = $this->_db->prepare($query);
		$ps->bindValue(':email', $email, PDO::PARAM_STR);
		$ps->execute();
	}

	#fonctionne mais ajouter '.$this->_db->quote()
	public function add_member($email, $last_name, $first_name, $phone_number, $account_number, $profil_picture, $adress) {
		$query = 'INSERT INTO members (email, last_name, first_name, phone_number, account_number, profil_picture, adress)
		VALUES (:email,:last_name, :first_name, :phone_number, :account_number, :profil_picture, :adress)';
		$ps = $this->_db->prepare($query);

		// On lie les variables définie au-dessus au paramètres de la requête préparée
		$ps->bindValue(':email', $email, PDO::PARAM_STR);
		$ps->bindValue(':last_name', $last_name, PDO::PARAM_STR);
		$ps->bindValue(':first_name', $first_name, PDO::PARAM_STR);
		$ps->bindValue(':phone_number', $phone_number, PDO::PARAM_STR);
		$ps->bindValue(':account_number', $account_number, PDO::PARAM_STR);
		$ps->bindValue(':profil_picture', $profil_picture, PDO::PARAM_STR);
		$ps->bindValue(':adress', $adress, PDO::PARAM_STR);

		//On exécute la requête
		$ps->execute();
	}
}

?>
