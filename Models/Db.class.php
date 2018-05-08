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


	public function members_not_in_order(){
		$query1 = 'SELECT max(year) FROM subscriptions';
		$ps1 = $this->_db->prepare($query1);
		$ps1->execute();
		$row = $ps1->fetch();
		$currentYear = $row[0];

		$query2 = 'SELECT members.email FROM members WHERE members.email NOT IN (SELECT email FROM payements WHERE year = :currentYear)';
		$ps2 = $this->_db->prepare($query2);
		$ps2->bindValue(':currentYear', $currentYear, PDO::PARAM_INT);
		$ps2->execute();
		#if($ps2->rowcount() == 0) return 0;
		$tableau = array();

		# Parcours de l'ensemble des résultats
		# Construction d'un tableau d'objet(s) de la classe Member
		while ($row = $ps2->fetch()) {
			$tableau[] = new Member($row[0]);
		}
		return $tableau;
	}


	public function select_events(){
		$query = 'SELECT * FROM events';
		$ps = $this->_db->prepare($query);
		$ps->execute();

		$tableau = array();

		while ($row = $ps->fetch()){
			$tableau[] = new Event($row[0], $row[1], $row[2]);
		}
		return $tableau;
	}


#fonctionne
	public function login($email, $psw){
		$query1 = 'SELECT validated FROM members WHERE email = :email';
		$ps1 = $this->_db->prepare($query1);
		$ps1->bindValue(':email', $email, PDO::PARAM_STR);
		$ps1->execute();
		$validated = $ps1->fetch();
		if($validated[0] == 0) return false;

		$query2 = 'SELECT password FROM members WHERE email = :email';
		$ps2 = $this->_db->prepare($query2);
		$ps2->bindValue(':email', $email, PDO::PARAM_STR);
		$ps2->execute();
		$row = $ps2->fetch();
		$hash = $row[0];

		return password_verify($psw, $hash);
	}


	public function get_Responsability_level($email){
		$query = 'SELECT responsability_level FROM members WHERE email = :email';
		$ps = $this->_db->prepare($query);
		$ps->bindValue(':email', $email, PDO::PARAM_STR);
		$ps->execute();
		$responsability_level = $ps->fetch();
		return $responsability_level;
	}


	#fonctionne
	public function add_event($title, $starting_date, $ending_date, $place, $url, $approximative_cost, $description){
		$query = 'INSERT INTO events(title, starting_date, ending_date, place, url, approximative_cost, description)
		VALUES(:title, :starting_date, :ending_date, :place, :url, :approximative_cost, :description)';
		$ps = $this->_db->prepare($query);

		// On lie les variables définie au-dessus au paramètres de la requête préparée
		$ps->bindValue(':title', $title, PDO::PARAM_STR);
		$ps->bindValue(':starting_date', $starting_date, PDO::PARAM_STR);
		$ps->bindValue(':ending_date', $ending_date, PDO::PARAM_STR);
		$ps->bindValue(':place', $place, PDO::PARAM_STR);
		$ps->bindValue(':url', $url, PDO::PARAM_STR);
		$ps->bindValue(':approximative_cost', $approximative_cost, PDO::PARAM_INT);
		$ps->bindValue(':description', $description, PDO::PARAM_STR);
		//On exécute la requête
		$ps->execute();
	}


	#fonctionne
	public function add_workout_plan($workout_name, $starting_date, $ending_date){
		$query = 'INSERT INTO workout_plan(workout_name, starting_date, ending_date)
		VALUES(:workout_name, :starting_date, :ending_date)';
		$ps = $this->_db->prepare($query);

		// On lie les variables définie au-dessus au paramètres de la requête préparée
		$ps->bindValue(':workout_name', $workout_name, PDO::PARAM_STR);
		$ps->bindValue(':starting_date', $starting_date, PDO::PARAM_STR);
		$ps->bindValue(':ending_date', $ending_date, PDO::PARAM_STR);
		//On exécute la requête
		$ps->execute();
	}


	#pourrait dire que le membre est déjà validé
	public function validate_member($email){
		$query = 'UPDATE members SET validated = true WHERE email = :email';
		$ps = $this->_db->prepare($query);
		$ps->bindValue(':email', $email, PDO::PARAM_STR);
		$ps->execute();
		try {
			$row = $ps->fetch();
		}
		catch(PDOException $e){
 			return 'Cette adresse email n\'est pas dans la base de données';
		}
	}


	#fonctionne
	public function add_member($email, $psw, $last_name, $first_name, $phone_number, $account_number, $profil_picture, $adress) {
		$query = 'INSERT INTO members (email, password, last_name, first_name, phone_number, account_number, profil_picture, adress)
		VALUES (:email,:password, :last_name, :first_name, :phone_number, :account_number, :profil_picture, :adress)';
		$ps = $this->_db->prepare($query);

		// On lie les variables définie au-dessus au paramètres de la requête préparée
		$ps->bindValue(':email', $email, PDO::PARAM_STR);
		$ps->bindValue(':password', password_hash($psw, PASSWORD_BCRYPT), PDO::PARAM_STR);
		$ps->bindValue(':last_name', $last_name, PDO::PARAM_STR);
		$ps->bindValue(':first_name', $first_name, PDO::PARAM_STR);
		$ps->bindValue(':phone_number', $phone_number, PDO::PARAM_STR);
		$ps->bindValue(':account_number', $account_number, PDO::PARAM_STR);
		$ps->bindValue(':profil_picture', $profil_picture, PDO::PARAM_STR);
		$ps->bindValue(':adress', $adress, PDO::PARAM_STR);
		//On exécute la requête
		$ps->execute();
	}


	#doit envoyer un mail + demander si sûr, si >999 affiche une erreur, si pas chiffre affiche une erreur
	public function NewYearPayement($cost){
		try{
			$query='INSERT INTO subscriptions(amount) VALUES(:cost)';
			$ps = $this->_db->prepare($query);

			// On lie les variables définie au-dessus au paramètres de la requête préparée
			$ps->bindValue(':cost', $cost, PDO::PARAM_STR);
			//On exécute la requête
			$ps->execute();
		}
		catch(PDOException $e){
			return 'Le montant indiqué n\'est pas valide';
		}
	}


	//si email pas dans les membres affiche une erreur, si montant >999 affiche une erreur
	public function add_payement($email, $amount){
		$query1 = 'SELECT email FROM members WHERE email = :email';
		$ps1 = $this->_db->prepare($query1);
		$ps1->bindValue(':email', $email, PDO::PARAM_STR);
		$ps1->execute();
		$row = $ps1->fetch();
		if ($row == null) return 'Cette adresse email n\'est pas dans la base de données';

		$query2='SELECT max(year) FROM subscriptions';
		$ps2 = $this->_db->prepare($query2);
		$ps2->execute();
		$row = $ps2->fetch();
		$currentYear = $row[0];

		$query3='INSERT INTO payements(email, year, amount_payed) VALUES (:email, :currentYear, :amount)';
		$ps3 = $this->_db->prepare($query3);

		// On lie les variables définie au-dessus au paramètres de la requête préparée
		$ps3->bindValue(':email', $email, PDO::PARAM_STR);
		$ps3->bindValue(':currentYear', $currentYear, PDO::PARAM_INT);
		$ps3->bindValue(':amount', $amount, PDO::PARAM_STR);
		//On exécute la requête
		$ps3->execute();
	}


	public function modify_responsability($email, $newResponsability){
		$query = 'UPDATE members SET responsability_level = :newResponsability WHERE email = :email';
		$ps = $this->_db->prepare($query);

		// On lie les variables définie au-dessus au paramètres de la requête préparée
		$ps->bindValue(':newResponsability', $newResponsability, PDO::PARAM_STR);
		$ps->bindValue(':email', $email, PDO::PARAM_STR);
		//On exécute la requête
		$ps->execute();
	}


	public function modify_event($event_no, $newDescription){
		$query = 'UPDATE events SET description = :newDescription WHERE event_no = :event_no';
		$ps = $this->_db->prepare($query);

		// On lie les variables définie au-dessus au paramètres de la requête préparée
		$ps->bindValue(':event_no', $event_no, PDO::PARAM_INT);
		$ps->bindValue(':newDescription', $newDescription, PDO::PARAM_STR);
		//On exécute la requête
		$ps->execute();
	}


	public function has_payed_event($email, $event_no){
		$query = 'UPDATE registered_people SET has_payed = 1 WHERE email = :email AND event_no = :event_no';
		$ps = $this->_db->prepare($query);

		// On lie les variables définie au-dessus au paramètres de la requête préparée
		$ps->bindValue(':email', $email, PDO::PARAM_STR);
		$ps->bindValue(':event_no', $event_no, PDO::PARAM_INT);
		//On exécute la requête
		$ps->execute();
	}
}

?>
