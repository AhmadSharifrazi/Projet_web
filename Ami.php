<?php
class Ami{
	
	private $_no;
	private $_nom;
	
	private function __construct(){
		$this->no = 1;
		$this->nom = 'blabla';
	}
	
	private function __construct($_no, $_nom){
		$this->no = $_no;
		$this->nom = $_nom;		
	}
	
	
}
?>