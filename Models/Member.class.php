<?php
class Member{
	
	private $_email;   
	private $_last_name;   
	private $_first_name;   
	private $_phone_number;
	private $_adress;
	private $_account_number;
	private $_profil_picture;
	private $_validated;
	private $_training_no;    
	private $_responsability_level;     

	public function __construct($email, $last_name, $first_name, $phone_number, $adress, $account_number, $profil_picture){
		$this->_email = $email;
		$this->_last_name = $last_name;
		$this->_first_name = $first_name;
		$this->_phone_number = $phone_number;
		$this->_adress = $adress;
		$this->_account_number = $account_number;
		$this->_profil_picture = $profil_picture;
		$this->_validated = false;
		$this->_training_no = 1;
		$this->_responsability_level = "member";
	}
	
	public function email(){
		return $this->_email;
	}
	
	public function html_email(){
		return htmlspecialchars($this->_email);
	}
	
	public function last_name(){			#A quoi ça sert si htmlspecialchars ?
		return $this->_last_name;
	}
	
	public function html_last_name(){
		return htmlspecialchars($this->_last_name);
	}
	
	public function first_name(){
		return $this->_first_name;
	}
	
	public function html_first_name(){
		return htmlspecialchars($this->_first_name);
	}
	
	public function phone_number(){
		return $this->_phone_number;
	}
	
	public function html_phone_number(){
		return htmlspecialchars($this->_phone_number);
	}
	
	public function adress(){
		return $this->_adress;
	}
	
	public function html_adress(){
		return htmlspecialchars($this->_adress);
	}
	
	public function account_number(){
		return $this->_account_number;
	}
	
	public function html_account_number(){
		return htmlspecialchars($this->_account_number);
	}
	
	public function profil_picture(){
		return $this->_profil_picture;
	}
	
	public function html_profil_picture(){
		return htmlspecialchars($this->_profil_picture);
	}
	
	public function validated(){
		return $this->_validated;
	}
	
	public function training_no(){
		return $this->_training_no;
	}
	
	public function responsability_level(){
		return $this->_responsability_level;
	}
}
?>