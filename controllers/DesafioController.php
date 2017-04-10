<?php

require 'models/Equipo.php';
require 'models/Desafio.php';
require 'models/Usuario.php';
require 'models/Encuentro.php';
require 'models/Recinto.php';
require 'models/Horario.php';
require 'models/mail.php';

session_start();

class DesafioController{
	function __construct(){
		$this->view = new View();
		$this->Desafio = new Desafio();
		$this->Encuentro = new Encuentro();
		$this->Equipo = new Equipo();
		$this->Usuario = new Usuario();
		$this->Recinto = new Recinto();
		$this->Horario = new Horario();
	}

	public function index(){
		$this->view->show("");
	}

	// Entregar lista de desafios realizados por el equipo.
	public function listaDesafios(){
		$idUsuario = $_SESSION['login_user_id'];
		$listaEquipos = $this->Equipo->getEquiposJugador($idUsuario); 			// Equipos en los que el jugador es el capitan.
		$data['listaEquipos'] = $listaEquipos;
		
		$listaDesafios = $this->Desafio->getDesafios($idUsuario);					// Desafios de los equipos del usuario
		$data['listaDesafios'] = $listaDesafios;

		$historialDesafios =  $this->Desafio->getHistorialDesafios($idUsuario);
		$data['historialDesafios'] = $historialDesafios;

		$nroEncuentros = 0;
		foreach ($listaDesafios as $desafio) {
			$idDesafio = $desafio['idDesafio'];
			//$detalleDesafio = $desafios->getDesafio($idDesafio);
			//$data['detalleDesafio'.$idDesafio] = $detalleDesafio;
			//var_dump($detalleDesafio);
			$listaEncuentros = $this->Encuentro->getEncuentros($idDesafio);		// Encuentros de los desafios hechos por el jugador de la sesión.
			if (!empty($listaEncuentros)){
				$data['listaEncuentros'.$idDesafio] = $listaEncuentros;
				$nroEncuentros++;
			} else {
				$data['listaEncuentros'.$idDesafio] = 0;
			}
			
		}
		$listaSolicitudes = $this->Encuentro->getSolicitudes($idUsuario);	// Lista de solicitudes realizadas por el jugador.
		$data['listaSolicitudes'] = $listaSolicitudes;
		$data['nroEncuentros'] = $nroEncuentros;
		$listaRecintos = $this->Recinto->getRecintosActivos();
		$data['listaRecintos'] = $listaRecintos;
		//$listaDesafiosSistema = $desafios->getDesafiosSistema($idUsuario);	// Desafios de los equipos del usuario
		//$data['listaDesafiosSistema'] = $listaDesafiosSistema;

		if (isset($_SESSION['accion'])){
			$data['accion'] = $_SESSION['accion'];
		}
		$_SESSION['accion'] = 0;
		$this->view->show('desafios.php',$data);
	}


	//	Crear un desafio
	public function crearDesafio(){
		$recinto = $_POST["recinto"];
		$fechaPartido = $_POST["date"]."";
		$idEquipo = $_POST["equipo"];
		$rangoEdad = $_POST["edad"];
		if ($rangoEdad == Null){
			$limInf = 18;
			$limSup = 60;
		} else {
			$edades = explode(",",$rangoEdad);
			$limInf = $edades[0];
			$limSup = $edades[1];
		}
		$comentario = $_POST["comentario"];
		//echo "Inferior: ".$limInf." Superior: ".$limSup;
		$this->Desafio->setDesafio($fechaPartido, $limInf, $limSup, $comentario, $idEquipo, $recinto, "0");
		$_SESSION['accion'] = 1;

		$_SESSION['tipoCorreo'] = 1;

		// Datos del desafio.
		$_SESSION['idRecinto'] = $recinto;
		$_SESSION['idEquipo'] = $idEquipo;
		$_SESSION['fecha'] = $fechaPartido;
		$_SESSION['comentario'] = $comentario;
		$_SESSION['limInf'] = $limInf;
		$_SESSION['limSup'] = $limSup;

		//$this->enviarCorreo();

		//echo '<script type="text/javascript">window.location =?controlador=Desafio&accion=listaDesafios</script>';


		header('Location: ?controlador=Desafio&accion=listaDesafios');
	}


	// Ver vestibulo de partidos
	public function verVestibuloDesafios(){
		$idUsuario = $_SESSION['login_user_id'];
		$idEquipoJugador = $_POST["equipo"];
		$_SESSION['equipoSeleccionado'] = $idEquipoJugador;
		$rangoEdad = $_POST["edad"];
		if ($rangoEdad == Null){
			$limInf = 18;
			$limSup = 60;
		} else {
			$edades = explode(",",$rangoEdad);
			$limInf = $edades[0];
			$limSup = $edades[1];
		}

		$desafiosSistema = $this->Desafio->getDesafiosSistema($idUsuario, $limInf, $limSup);	// equipos con desafios donde el usuario no es capitan
		$miembrosEquipo = $this->Equipo->getMiembrosEquipo($idEquipoJugador);	// miembros del equipo que eligio el usuario
		//$auxDesafio = array();
		$auxDesafiosSistema = 0;
		$auxEncuentros = 0;
		foreach ($desafiosSistema as $key) {
			$idEquipo = $key['idEquipo'];
			$cont = 0;
			foreach ($miembrosEquipo as $usuario) {
				$idUsuario = $usuario['idUsuario'];
				$respuesta = $this->Equipo->verificarMiembro($idUsuario, $idEquipo);
				if (count($respuesta)>0){	// El miembro pertenece al equipo que tiene un desafio, donde el jugador no es capitan
					$cont++;
				}
			}
			if ($cont==0){
				//$auxDesafio[$aux] = $key['idDesafio'];
				$idDesafio = $key['idDesafio'];
				$desafioDisponible = $this->Desafio->getDesafio($idDesafio);
				//$data['listaDesafiosSistema'.$aux] = $desafioDisponible;
				$encuentroAcordado = $this->Encuentro->verificarEncuentro($idEquipoJugador, $idDesafio);
				if (!empty($encuentroAcordado)){
					$auxEncuentros++;
					$data['encuentroAcordado'.$auxEncuentros] = $encuentroAcordado;
				} else {
					$auxDesafiosSistema++;
					$data['listaDesafiosSistema'.$auxDesafiosSistema] = $desafioDisponible;
				}
			}
		}
		$nroDesafios = $auxDesafiosSistema;
		//$data['idEquipo'] = $idEquipoJugador;
		$data['nroDesafios'] =$nroDesafios;
		$this->view->show('vestibuloDesafios.php',$data);

	}


    public function detalleDesafio(){
      /*if(!isset($_SESSION)) { 
        session_start(); 
        } */
      $idDesafio = $_GET['idDesafio']; // POST o algo
      $desafio = $this->Desafio->getDesafio($idDesafio);
      $data['desafio'] = $desafio;
      $data['equipoSeleccionado'] = $_SESSION['equipoSeleccionado'];

      


      $this->view->show("_detalleDesafio.php", $data);
    }


    public function agendarPartido(){
      /*if(!isset($_SESSION)) { 
        session_start(); 
        } */
        $idEncuentro = $_GET['idEncuentro'];
        $encuentro = $this->Encuentro->getEncuentro($idEncuentro);
        foreach ($encuentro as $key ) {
        	$idRecinto = $key['idRecinto'];
        }
        $horarios = $this->Horario->getHorariosRecinto($idRecinto);
        $data['horarios'] = $horarios;
        $data['encuentro'] = $encuentro;
        $this->view->show("_agendarDesafio.php", $data);



    }

    public function verRespuestas(){
      /*if(!isset($_SESSION)) { 
        session_start(); 
        } */
        $idDesafio = $_GET['idDesafio'];
        $desafio = $this->Desafio->getDesafio($idDesafio);
        $data['desafio'] = $desafio;
        $listaEncuentros = $this->Encuentro->getEncuentros($idDesafio);
        $data['listaEncuentros'] = $listaEncuentros;
        $this->view->show("_verRespuestas.php", $data);
    }



	// Set Encuentro
	public function setEncuentro(){

		$idDesafio = $_POST['desafio'];
		$idEquipo = $_POST['equipo'];
		$estado = 1;
		$respuesta = $_POST["comentario"];


		//echo "desafio: ".$idDesafio." equipo: ".$idEquipo." estado: ".$estado;
		$this->Encuentro->setEncuentro($idDesafio, $idEquipo, $respuesta, $estado); // Se inserta en la base de datos
		$this->Desafio->cambiarEstado($idDesafio, $estado);
		$_SESSION['accion'] = 2;				// Se cambia el estado del desafio (sin respuestas->con respuestas)

		$_SESSION['tipoCorreo'] = 2;


		// Datos del desafio 
		
		$encuentros =$this->Encuentro->getEncuentrosSistema();

		$encuentro = end($encuentros);

		$idEncuentro = $encuentro['idEncuentro'];

		$_SESSION['idEncuentro'] = $idEncuentro;

		$_SESSION['idDesafio'] = $idDesafio;
		//$_SESSION['idEquipo'] = $idEquipo;

		//$this->enviarCorreo();
		header('Location: ?controlador=Desafio&accion=listaDesafios');
	}


	// Se acepto una solicitud de este desafio, por lo tanto se registra que el desafio será jugado y las demas solicitudes se rechazan.
	public function aceptarEncuentro(){
		$idDesafio = $_POST['idDesafio'];
		$idEquipo = $_POST['idEquipo'];
		$idEncuentro = $_POST['idEncuentro'];
		$estado = 2;
		$this->Desafio->cambiarEstado($idDesafio, $estado);
		$this->Encuentro->cambiarEstado($idDesafio, $estado);
		$this->Encuentro->eliminarEncuentros($idDesafio, $idEquipo);
		$_SESSION['accion'] = 3;
		header('Location: ?controlador=Desafio&accion=listaDesafios');
	}

	// Se elimina una tupla de la tabla encuentro.
	public function cancelarEncuentro(){
		$idEncuentro = $_POST['idEncuentro'];
		$idDesafio = $_POST['idDesafio'];
		//echo $idEncuentro;
		//$idEquipo = $_POST['idEquipo'];
		$this->Encuentro->cancelarEncuentro($idEncuentro);
		$estado = 0;
		$this->Desafio->cambiarEstado($idDesafio, $estado);
		//echo "encuentro: ".$idEncuentro." equipo: ".$idEquipo;
		$_SESSION['accion'] = 4;
		header('Location: ?controlador=Desafio&accion=listaDesafios');
	}


	public function detalleEncuentro(){
		$idEncuentro = $_GET['idEncuentro'];
		$encuentro = $this->Encuentro->getEncuentro($idEncuentro);
		$estadoEncuentro = end($encuentro)['estadoSolicitud'];
		if ($estadoEncuentro == 3){
			// Necesito traer los jugadores
			$idDesafio = end($encuentro)['idDesafio'];
			$desafio = $this->Desafio->getDesafio($idDesafio);
			$equipo1 = $this->Equipo->getMiembrosEquipo(end($desafio)['idEquipo']);
			$equipo2=  $this->Equipo->getMiembrosEquipo(end($encuentro)['idEquipo']);
			$data['equipo1'] = $equipo1;
			$data['equipo2'] = $equipo2;
		}
		$data['encuentro'] = $encuentro;
	    //$data['equipoSeleccionado'] = $_SESSION['equipoSeleccionado'];
	    $data['accion'] = 1;


	    $this->view->show("_detalleEncuentro.php", $data);
	}

	public function resumenDesafio(){
		$idEncuentro = $_GET['idEncuentro'];
		$encuentro = $this->Encuentro->getEncuentro($idEncuentro);
		$data['encuentro'] = $encuentro;
	    //$data['equipoSeleccionado'] = $_SESSION['equipoSeleccionado'];
	    $data['accion'] = 2;
	    $this->view->show("_resumenDesafio.php", $data);
	}

	public function cargarHorario(){
		$idHorario = $_GET['idHorario'];
		$horario = $this->Horario->getHorario($idHorario);
	}



	public function enviarCorreo(){

		//echo "tipo correo: ".$_SESSION['tipoCorreo'];
		// Enviar correo a los miembros del equipo que creó el desafío
		if ($_SESSION['tipoCorreo'] == 1){
			//$idDesafio = $_SESSION['idDesafio'];
			$idRecinto = $_SESSION['idRecinto'];
			$idEquipo = $_SESSION['idEquipo'];
			$fecha = $_SESSION['fecha'];
			$comentario = $_SESSION['comentario'];
			$limInf = $_SESSION['limInf'];
			$limSup = $_SESSION['limSup'];




			$recinto = $this->Recinto->getRecinto($idRecinto);

			foreach ($recinto as $key) {
				$fotoRecinto = $key['fotografia'];
				$direccionRecinto = $key['direccion'];
				$nombreRecinto = $key['nombre'];
				$tipoRecinto = $key['tipo'];
			}

			$equipo = $this->Equipo->getEquipo($idEquipo);

			foreach ($equipo as $key) {
				$nombreEquipo = $key['nombre'];
				$idCapitan = $key['idCapitan'];
			}

			$capitan = $this->Usuario->getUsuario($idCapitan);

			foreach ($capitan as $key ) {
				$nombreCap = $key['nombre'];
				$apellidoCap = $key['apellido'];
			}


			$miembros = $this->Equipo->getMiembrosEquipo($idEquipo);

			$to = "partidomatchday@gmail.com";

			$arrayMiembros = array(); 
			$i = 0;
			foreach ($miembros as $key ) {
				$aux = $to;
				$to = $aux.",".$key['mail'];
				$arrayMiembros[$i] = $key['nombre']." ".$key['apellido'];
				$i++;
			}

			/*
			foreach ($arrayMiembros as $key => $value ) {
				echo $value;
			}*/


			$miembro = "";
			foreach ($arrayMiembros as $key => $value ) {
				$miembro = $miembro."".$value." <br>";
			}
			//var_dump($arrayMiembros);



			$dir = $direccionRecinto;

			$subject = "Desafio Matchday ".$nombreEquipo." - ".$tipoRecinto;


			$message = "<html>";
			$message .= "<head>";
			$message .= '<meta charset="UTF-8">';
			$message .= "<title>HTML email</title>";
			$message .= "<style>
			.datagrid table { border-collapse: collapse; text-align: left; width: 100%; } 
			.datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; border: 1px solid #006699; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }
			.datagrid table td, 
			.datagrid table th { padding: 3px 10px; }
			.datagrid table th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; color:#FFFFFF; font-size: 12px; font-weight: bold; border-left: 1px solid #0070A8; } 
			.datagrid table th:first-child { border: none; }
			.datagrid table td { color: #00496B; border-left: 1px solid #E1EEF4;font-size: 12px;font-weight: normal; }
			.datagrid table .alt td { background: #E1EEF4; color: #00496B; }
			.datagrid table td:first-child { border-left: none; }
			.datagrid table tr:last-child td { border-bottom: none; }
			</style>";
			$message .= "</head>";
			$message .= "<body>";
			$message .= "<h4>".$nombreCap." ".$apellidoCap.", capitán de tu equipo " .$nombreEquipo.  ", ha creado un desafío.</h4>";
			

			$message .= "<div class='datagrid'>";
			$message .= "<table>";
			$message .= "<tr>";
			$message .= "<th>Recinto:</th>";
			$message .= "<td>".$nombreRecinto."</td>";
			$message .= "</tr>";
			$message .= "<tr>";
			$message .= "<th>Dirección:</th>";
			$message .= "<td>".$direccionRecinto."</td>";
			$message .= "</tr>";
			$message .= "<tr>";
			$message .= "<th>Fecha:</th>";
			$message .= "<td>".$fecha."</td>";
			$message .= "</tr>";
			$message .= "<tr>";
			$message .= "<th>Jugadores:</th>";
			$message .= "<td>";
			$message .= $miembro."</td>";
			$message .= "</tr>";
			$message .= "</table>";
			$message .= "</div>";

			$message .= "<p>El desafío podrá ser visto por jugadores de entre ".$limInf." y ".$limSup." años.</p>";

			$message .= '<div style="height:auto; width:auto;"><center><img src="assets/images/logoCorreo.png" alt="Website Change Request" /></center></div>';
			$message .= "<center><b><p>© 2016. MatchDay.</p></b></center>";
			$message .= "</body>";
			$message .= "</html>";


			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			// More headers
			$headers .= 'From: <partidomatchday@gmail.com>' . "\r\n"; //
			$headers .= 'Cc: partidomatchday@gmail.com' . "\r\n"; // 

			//Le paso el mensaje, la lista de correos
			send($message,$to, $subject);

	 		unset($_SESSION['idRecinto']);
			unset($_SESSION['idEquipo']);
			unset($_SESSION['fecha']);
			unset($_SESSION['comentario']);
			unset($_SESSION['limInf']);
			unset($_SESSION['limSup']);
			//unset($_SESSION['tipoCorreo']);



		}


		// Enviar correo al capitan del equipo que creó el desafío
		if ($_SESSION['tipoCorreo'] == 2){

			//echo $_SESSION['tipoCorreo'];

			$idDesafio = $_SESSION['idDesafio'];
			$idEncuentro = $_SESSION['idEncuentro'];


			$encuentro = $this->Encuentro->getEncuentro($idEncuentro);
			//var_dump($encuentro);

			foreach ($encuentro as $key ) {
				$idEquipoRival = $key['idEquipo1'];
				$respuestaRival = $key['respuesta'];
			}

			$equipoRival = $this->Equipo->getEquipo($idEquipoRival);

			foreach ($equipoRival as $key) {
				$nombreEquipoRival = $key['nombre'];
				$idCapitanRival = $key['idCapitan'];
			}


			$capitanRival = $this->Usuario->getUsuario($idCapitanRival);


			foreach ($capitanRival as $key) {
				$nombreCapRival = $key['nombre'];
				$apellidoCapRival = $key['apellido'];
			}




			$desafio = $this->Desafio->getDesafio($idDesafio);

			foreach ($desafio as $key ) {
				$fecha = $key['fechaPartido'];
				$idEquipo = $key['idEquipo'];
				$idRecinto = $key['idRecinto'];
				$comentario = $key['comentario'];
			}


			$recinto = $this->Recinto->getRecinto($idRecinto);

			foreach ($recinto as $key) {
				$fotoRecinto = $key['fotografia'];
				$direccionRecinto = $key['direccion'];
				$nombreRecinto = $key['nombre'];
			}

			$equipo = $this->Equipo->getEquipo($idEquipo);

			foreach ($equipo as $key) {
				$nombreEquipo = $key['nombre'];
				$idCapitan = $key['idCapitan'];
			}

			$destinatario = $this->Usuario->getUsuario($idCapitan);


			foreach ($destinatario as $key) {
				$mail = $key['mail'];
			}


			//$miembros = $this->Equipo->getMiembrosEquipo($idEquipo);

			$to = $mail."";



			$dir = $direccionRecinto;

			$subject = "Respuesta desafio";



			$message = "<html>";
			$message .= "<head>";
			$message .= "<meta charset='utf-8'>";
			$message .= "<title>HTML email</title>";
			$message .= "<style>
			.datagrid table { border-collapse: collapse; text-align: left; width: 100%; } 
			.datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; border: 1px solid #006699; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }
			.datagrid table td, 
			.datagrid table th { padding: 3px 10px; }
			.datagrid table th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; color:#FFFFFF; font-size: 12px; font-weight: bold; border-left: 1px solid #0070A8; } 
			.datagrid table th:first-child { border: none; }
			.datagrid table td { color: #00496B; border-left: 1px solid #E1EEF4;font-size: 12px;font-weight: normal; }
			.datagrid table .alt td { background: #E1EEF4; color: #00496B; }
			.datagrid table td:first-child { border-left: none; }
			.datagrid table tr:last-child td { border-bottom: none; }
			</style>";
			$message .= "</head>";
			$message .= "<body>";
			$message .= '<div style="height:auto; width:auto;"><center><img src="assets/images/logoCorreo.png" alt="Website Change Request" /></center></div>';
			$message .= "<h4>El siguiente desafio de tu equipo " .$nombreEquipo. " tiene una nueva respuesta.</h4>";

			$message .= "<div class='datagrid'>";
			$message .= "<table>";
			$message .= "<tr>";
			$message .= "<th>Equipo:</th>";
			$message .= "<td>".$nombreEquipo."</td>";
			$message .= "</tr>";
			$message .= "<tr>";
			$message .= "<th>Fecha:</th>";
			$message .= "<td>".$fecha."</td>";
			$message .= "</tr>";
			$message .= "<tr>";
			$message .= "<th>Recinto:</th>";
			$message .= "<td>".$nombreRecinto."</td>";
			$message .= "</tr>";
			$message .= "<tr>";
			$message .= "<th>Comentario:</th>";
			$message .= "<td>".$comentario."</td>";
			$message .= "</tr>";

			$message .= "<tr>";
			$message .= "<th>Equipo desafiante:</th>";
			$message .= "<td>".$nombreEquipoRival."</td>";
			$message .= "</tr>";
			$message .= "<tr>";
			$message .= "<th>Capitán del equipo rival:</th>";
			$message .= "<td>".$nombreCapRival." ".$apellidoCapRival."</td>";
			$message .= "</tr>";
			$message .= "<tr>";
			$message .= "<th>Comentario de ".$nombreCapRival.":</th>";
			$message .= "<td>".$respuestaRival."</td>";
			$message .= "</tr>";
			$message .= "</table>";
			$message .= "</div>";

			$message .= "<h4>Para responder esta solicitud, ingresa a MatchDay desde  
			<a href='http://localhost/Matchday/'>aquí</a>
			</h4>";


			$message .= "<center><b><p>© 2016. MatchDay.</p></b></center>";
			$message .= "</body>";
			$message .= "</html>";


			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			// More headers
			$headers .= 'From: <partidomatchday@gmail.com>' . "\r\n"; //
			$headers .= 'Cc: partidomatchday@gmail.com' . "\r\n"; // 

			//Le paso el mensaje, la lista de correos
			send($message,$to,$subject);

	 		unset($_SESSION['idDesafio']);
			unset($_SESSION['idEncuentro']);
			unset($_SESSION['tipoCorreo']);




		}




	}













    /*    MODULO DE ADMINISTRACION  */
    public function adminDesafios(){
      $desafios = $this->Desafio->getDesafiosAdmin();
      $data['desafios'] = $desafios;
      $this->view->show('adminDesafios.php',$data);
    }

    public function detalleDesafioAdmin(){
    	$idDesafio = $_GET['idDesafio'];
    	$estado = $_GET['estado'];
    	$data['idDesafio'] = $idDesafio;
    	$data['estado'] = $estado;
    	$desafio = $this->Desafio->getDesafio($idDesafio);
    	$data['desafio'] = $desafio;
    	if ($estado == 3){
    		$encuentro = $this->Encuentro->getEncuentroAcordado($idDesafio);
    		$data['encuentro'] = $encuentro;
    	}
	    $this->view->show("_adminDetalleDesafio.php", $data);
    }





}

?>