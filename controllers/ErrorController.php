<?php



session_start();

class ErrorController{
	function __construct(){
		$this->view = new View();
	}

	public function index(){
		$this->view->show("");
	}

	public function error(){
		$this->view->show("error.php");
	}
		public function errorC(){
		$this->view->show("errorC.php");
	}




}

?>