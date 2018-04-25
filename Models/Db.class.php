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


	public function add_payement($email, $year, $amount_payed){   #même problème que add_event, mauvais nombre de paramètres ?
		$query = 'INSERT INTO payements(email, year, amount_payed)
		VALUES('.$this->_db->quote(':email').', :year, :amount_payed)';
		$ps = $this->_db->prepare($query);

		// On lie les variables définie au-dessus au paramètres de la requête préparée
		$ps->bindValue(':email', $email, PDO::PARAM_STR);
		$ps->bindValue(':year', $year, PDO::PARAM_INT);
		$ps->bindValue(':amount_payed', $amount_payed, PDO::PARAM_INT);
		//On exécute la requête
		$ps->execute();
	}

	#interested_number ou interest_count ?  Ne marche pas encore
	public function add_event($event_no, $title, $starting_date, $ending_date, $place, $url, $approximative_cost, $registered_number, $interested_number, $description){
		$query = 'INSERT INTO events(event_no, title, starting_date, ending_date, place, url, approximative_cost, registered_number, interested_number, description)
		VALUES(:event_no, '.$this->_db->quote(':title').', '.$this->_db->quote(':starting_date'). ', '.$this->_db->quote(':ending_date'). ', '.$this->_db->quote(':place').',
		'.$this->_db->quote(':url').', :approximative_cost, :registered_number, :interested_number, '.$this->_db->quote(':description').')';
		$ps = $this->_db->prepare($query);

		// On lie les variables définie au-dessus au paramètres de la requête préparée
		$ps->bindValue(':event_no', $event_no, PDO::PARAM_INT);
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

	public function add_workout_plan(){
		$query = 'INSERT INTO plan_entrainements(num) VALUES('.$this->_db->quote($plan).')';
		$this->_db->prepare($query)->execute();
	}

	public function validate_member($email){
		$query = 'UPDATE membres SET validated = true WHERE email = ' . $email .'';
		$ps = $this->_db->prepare($query);
		$ps->bindValue('email', $email, PDO::PARAM_STR);
		$ps->execute();
	}

	public function add_member($email, $last_name, $first_name, $phone_number, $account_number, $profil_picture, $validated, $training_no, $responsability_level, $adress) {
		# Solution d'INSERT avec prepared statement
		$query = 'INSERT INTO members (email, last_name, first_name, phone_number, account_number, profil_picture, validated, training_no, responsability_level, adress)
		VALUES (:email,:last_name, :first_name, :phone_number, :account_number, :profil_picture, false, 1, member, :adress)';
		$ps = $this->_db->prepare($query);

		// On lie les variables définie au-dessus au paramètres de la requête préparée
		$ps->bindValue(':email', $email, PDO::PARAM_STR);
		$ps->bindValue(':last_name', $lastName, PDO::PARAM_STR);
		$ps->bindValue(':first_name', $firstName, PDO::PARAM_STR);
		$ps->bindValue(':phone_number', $phone, PDO::PARAM_STR);
		$ps->bindValue(':account_number', $account, PDO::PARAM_STR);
		$ps->bindValue(':profil_picture', $photo, PDO::PARAM_STR);
		$ps->bindValue(':validated', false, PDO::PARAM_STR);
		$ps->bindValue(':training_no', 1, PDO::PARAM_STR);
		$ps->bindValue(':responsability_level', members, PDO::PARAM_STR);

		//On exécute la requête
		$ps->execute();
	}
}

?>
