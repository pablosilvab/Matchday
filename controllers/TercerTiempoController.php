<?php
	require 'models/TercerTiempo.php';
	require 'models/Partido.php';

class TercerTiempoController{


	function __construct(){
		$this->view= new View();
		$this->tercerTiempo = new TercerTiempo();
		$this->partido = new Partido();
	}

	public function index(){
		$this->view->show("");
	}

	public function ingresarTercerTiempo(){
		//obtener via post las variables del tercer tiempo
		if(!isset($_SESSION)) { 
        session_start(); 
        } 
		$hora = $_POST['hora'];
		$comentario = $_POST['comentario'];
		$cuota	=	$_POST['cuota'];
		$idLocal = $_POST['idLocal'];
		$_SESSION['idLocal'] = $idLocal;
		//obtener via SESSION
		$idPartido = $_SESSION['idPartido'];
		//Inserto el tercer tiempo
		$idTercerTiempo = $this->tercerTiempo->setTercerTiempo(
			$comentario, $cuota, $hora, $idLocal, $idPartido
			);
		//Ahora llamamos al resumenPartido
		header('Location:?controlador=Partido&accion=resumenPartido');


	}




}
?>