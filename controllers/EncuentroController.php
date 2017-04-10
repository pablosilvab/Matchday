<?php

require 'models/Encuentro.php';
require 'models/Desafio.php';

session_start();

class EncuentroController{
	function __construct(){
		$this->view = new View();
		$this->Encuentro = new Encuentro();
	}

	public function index(){
		$this->view->show("");
	}








}

?>