<?php

class Login{

	protected $db;

	public function __construct(){
		$this->db = SPDO::singleton();
	}

	public function getLogin($mail){
		$query = $this->db->prepare("SELECT * FROM Usuario WHERE mail = '".$mail."'");
		$query->execute();
		$resultado = $query->fetchObject();
		return $resultado;
	}
}

?>