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
		$query = 'SELECT first_name, last_name, members.email FROM members, payements WHERE members.email = payements.email AND payements.amount_payed IS NULL ';
		$ps = $this->_db->prepare($query);
		$ps->execute();
	 	#$ps = $this->_db->query($query);
		#if($ps->rowcount() == 0) $notification = "Tous le monde est en ordre de paiement";

		$tableau = array();
		# Parcours de l'ensemble des résultats
		# Construction d'un tableau d'objet(s) de la classe Livre
		# Si le tableau est vide, on ne rentre pas dans le while
		while ($row = $ps->fetch()) {
			var_dump($row);
			$tableau[] = new Member($row->first_name, $row->last_name, $row->email);
		}
		# Pour debug : affichage du tableau à renvoyer
	  #var_dump($tableau);
		return $tableau;

	}

	public function select_events(){

		$query = 'SELECT * FROM events'.
		$ps = $this->_db->prepare($query);
		$ps->execute();

		$tableau = array();

		while ($row->fetch()){
			$tableau[] = new Event($row->titre, $row->starting_date, $row->description);
		}
		return $tableau;
	}


	public function login($email, $mdp){
		$query = 'SELECT mot_de_passe FROM members WHERE email = :email';
		$ps = $this->_db->prepare($query);
		$ps->bindValue(':email', $email, PDO::PARAM_STR);
		$ps->execute();

		#$ps->fetch()
		var_dump($ps->fetch()->mot_de_passe);
		if($ps->rowcount() == 0) return false;
		#$hash = $ps->fetch()->mot_de_passe;
		#var_dump($hash);
		#return password_verify($mdp, $hash);
		return $mdp = $hash;
	}

	#fonctionne
	public function add_event($title, $starting_date, $ending_date, $place, $url, $approximative_cost, $description){
		$query = 'INSERT INTO events(title, starting_date, ending_date, place, url, approximative_cost, description)
		VALUES(:title, :starting_date, :ending_date, :place,	:url, :approximative_cost, :description)';
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

	#fonctionne et appelle la même page (plus qu'à afficher un message)
	public function validate_member($email){
		//if()
		$query = 'UPDATE members SET validated = true WHERE email = :email';
		$ps = $this->_db->prepare($query);
		$ps->bindValue(':email', $email, PDO::PARAM_STR);
		$ps->execute();
	}

	#fonctionne
	public function add_member($email, $mdp, $last_name, $first_name, $phone_number, $account_number, $profil_picture, $adress) {
		$query = 'INSERT INTO members (email, mot_de_passe, last_name, first_name, phone_number, account_number, profil_picture, adress)
		VALUES (:email,:mdp, :last_name, :first_name, :phone_number, :account_number, :profil_picture, :adress)';
		$ps = $this->_db->prepare($query);

		// On lie les variables définie au-dessus au paramètres de la requête préparée
		$ps->bindValue(':email', $email, PDO::PARAM_STR);
		$ps->bindValue(':mdp', $mdp, PDO::PARAM_STR);
		$ps->bindValue(':last_name', $last_name, PDO::PARAM_STR);
		$ps->bindValue(':first_name', $first_name, PDO::PARAM_STR);
		$ps->bindValue(':phone_number', $phone_number, PDO::PARAM_STR);
		$ps->bindValue(':account_number', $account_number, PDO::PARAM_STR);
		$ps->bindValue(':profil_picture', $profil_picture, PDO::PARAM_STR);
		$ps->bindValue(':adress', $adress, PDO::PARAM_STR);
		//On exécute la requête
		$ps->execute();
	}

	#doit envoyer un mail il me semble   + demander si sûr
	public function NewYearPayement($cost){
		$query='INSERT INTO subscriptions(amount) VALUES(:cost)';
		$ps = $this->_db->prepare($query);

		// On lie les variables définie au-dessus au paramètres de la requête préparée
		$ps->bindValue(':cost', $cost, PDO::PARAM_STR);
		//On exécute la requête
		$ps->execute();
	}

	public function add_payement($email, $amount){
		$query1='SELECT max(year) FROM subscriptions';
		$ps1 = $this->_db->prepare($query1);
		$ps1->execute();
		$row = $ps1->fetch();
		$currentYear = $row[0];

		$query2='INSERT INTO payements(email, year, amount_payed) VALUES (:email, :currentYear, :amount)';
		$ps2 = $this->_db->prepare($query2);

		// On lie les variables définie au-dessus au paramètres de la requête préparée
		$ps2->bindValue(':email', $email, PDO::PARAM_STR);
		$ps2->bindValue(':currentYear', $currentYear, PDO::PARAM_INT);
		$ps2->bindValue(':amount', $amount, PDO::PARAM_STR);
		//On exécute la requête
		$ps2->execute();
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
