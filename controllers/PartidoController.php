<?php

require 'models/Partido.php';
require 'models/Usuario.php';
require 'models/Contacto.php';
require 'models/Recinto.php';
require 'models/Desafio.php';
require 'models/Equipo.php';
require 'models/TercerTiempo.php';
require 'models/Local.php';
require 'models/Horario.php';
require 'models/mail.php';
require 'models/Encuentro.php';

 
      if(!isset($_SESSION)) { 
        session_start(); 
        } 

class PartidoController{
	function __construct(){
		$this->view = new View();
		$this->Partido = new Partido();
		$this->Usuario = new Usuario();
		$this->Contacto = new Contacto();
		$this->Recinto = new Recinto();
		$this->Desafio = new Desafio();
		$this->Equipo = new Equipo();
		$this->tercerTiempo = new TercerTiempo();
		$this->local = new Local();
		$this->Horario = new Horario();
		$this->Encuentro = new Encuentro();
	}

	public function index(){
		$this->view->show("");
	}



	public function partidos(){
		$idUsuario = $_SESSION['login_user_id'];

		/*

			if ( isset($_POST['idPartido']) && isset($_POST['accion'])){
				$idPartido = $_POST['idPartido'];
	    		$accion = $_POST['accion'];
	    		if ($accion == 0){
	    			$data['accion'] = 0;
	    			$mensaje = "Tu solicitud ha sido enviada al capitán del encuentro. ";
	    			$data['mensaje'] = $mensaje;
	    		}
	    		if ($accion == 1){
	    			$data['accion'] = 1;
	    			$mensaje = "El partido ha sido cancelado y tus invitados han sido notificados vía mail.";
	    			$data['mensaje'] = $mensaje;

	    		}
	    		if ($accion == 2){
	    			$data['accion'] = 2;
	    			$mensaje = "El partido ha sido notificado a los jugadores de MatchDay. Debes estar atento a sus solicitudes";
	    			$data['mensaje'] = $mensaje;
	    		}

				$this->cambiarEstadoPartido($idPartido, $accion);

				if ($accion == 4){
					$idSolicitante = $_POST['idUsuario'];
					$respuesta = $_POST['respuesta'];
					$this->cambiarEstadoSolicitud($idPartido, $idSolicitante, $respuesta, $accion);
					$data['accion'] = 4;
	    			$mensaje = "La operación ha sido realizada con éxito. Al jugador se le notificará tu decisión.";
	    			$data['mensaje'] = $mensaje;
	    		}
			}
			*/

		// Partidos organizados por el jugador de la sesion en estado pendiente.
			/*
		$partidosPendientes = $this->Partido->getPartidosPendientes($idUsuario);
		$data['partidosPendientes'] = $partidosPendientes;*/

		$partidosUsuario = $this->Partido->getPartidosOrganizador($idUsuario);
		$data['partidosUsuario'] = $partidosUsuario;

		// Partidos del sistema donde el jugador no es el capitan ni participante ni ha enviado solicitud antes.
		$partidosSistema = $this->Partido->getPartidosSistema($idUsuario);
		$data['partidosSistema'] = $partidosSistema;

		// Partidos donde el jugador ha sido invitado
		$partidosInvitado = $this->Partido->getPartidosInvitado($idUsuario);
		$data['partidosInvitado'] = $partidosInvitado;


		$proximosPartidosUsuario = $this->Partido->getProximosPartidosUsuario($idUsuario);
		$data['proximosPartidosUsuario'] = $proximosPartidosUsuario;

		if (isset($_SESSION['accion'])){
			$data['accion'] = $_SESSION['accion'];
		}
		$_SESSION['accion'] = -1;

		$this->view->show("partidos.php",$data);
	}

	// Acciones

	public function enviarSolicitud(){
		$idPartido = $_POST['idPartido'];
	    $accion = $_POST['accion'];
	    $this->cambiarEstadoPartido($idPartido, $accion);
	    $_SESSION['accion'] = 9;	
	    header('Location:?controlador=Partido&accion=partidos');    	
	}

	public function accionCancelarPartido(){
		$idPartido = $_POST['idPartido'];
	    $accion = $_POST['accion'];
	    $this->cambiarEstadoPartido($idPartido, $accion);
	    $_SESSION['accion'] = 1;	
	    header('Location:?controlador=Partido&accion=partidos');   
	}


	public function partidoMatchday(){
		$idPartido = $_POST['idPartido'];
	    $accion = $_POST['accion'];
	    $this->cambiarEstadoPartido($idPartido, $accion);
	    $_SESSION['accion'] = 2;	
	    header('Location:?controlador=Partido&accion=partidos');    	
	}

	public function accionResponderSolicitud(){
		$idPartido = $_POST['idPartido'];
	    $accion = $_POST['accion'];
		$idSolicitante = $_POST['idUsuario'];
		$respuesta = $_POST['respuesta'];
		$this->cambiarEstadoSolicitud($idPartido, $idSolicitante, $respuesta, $accion);
		$_SESSION['accion'] = 4;
		header('Location:?controlador=Partido&accion=partidos');
	}

	public function cancelarInvitacion(){
		$idInvitado = $_POST['idUsuario'];
		$idPartido = $_POST['idPartido'];
		$estado = 2;
		$this->Partido->cambiarEstadoInvitacionPartido($idPartido, $idInvitado, $estado);
		$estadoPartido = 4;
		$this->Partido->cambiarEstado($idPartido,$estadoPartido);
		$data['invitacion'] = 0;
		$_SESSION['accion'] = 5;
		header('Location:?controlador=Partido&accion=partidos');
		//$this->view->show("indexJugador.php",$data);
	}


	public function aceptarInvitacion(){
		$idInvitado = $_POST['idUsuario'];
		$idPartido = $_POST['idPartido'];
		$estado = 1;
		$this->Partido->cambiarEstadoInvitacionPartido($idPartido, $idInvitado, $estado);
		$data['invitacion'] = 1;
		$_SESSION['accion'] = 6;
		header('Location:?controlador=Partido&accion=partidos');
		//$this->view->show("indexJugador.php",$data);
	}








	public function detallePartido(){
      $idPartido = $_GET['idPartido'];
      $partido = $this->Partido->getResumenPartido($idPartido);
      $data['partido'] = $partido;
      $data['accion'] = 0; // Solicitud
      $_SESSION['partidos'] = 0;
      $this->view->show("_detallePartido.php",$data);
    }


	public function cancelarPartido(){
      $idPartido = $_GET['idPartido']; 
      $partido = $this->Partido->getResumenPartido($idPartido);
      $data['partido'] = $partido;
      $data['accion'] = 1; // Cancelar
      $_SESSION['partidos'] = 0;
      $this->view->show("_detallePartido.php",$data);
    }

	public function notificarPartido(){
      $idPartido = $_GET['idPartido']; 
      $partido = $this->Partido->getResumenPartido($idPartido);
      $data['partido'] = $partido;
      $data['accion'] = 2; // Notificar
      $_SESSION['partidos'] = 0;
      $this->view->show("_detallePartido.php",$data);
    }


	public function resumenCapitan(){
      $idPartido = $_GET['idPartido'];
      $partido = $this->Partido->getResumenPartido($idPartido);
      $data['partido'] = $partido;
      $data['accion'] = 3; // Solicitud
      $_SESSION['partidos'] = 0;
      $this->view->show("_detallePartido.php",$data);
    }

	public function verSolicitudes(){
      $idPartido = $_GET['idPartido'];
      $partido = $this->Partido->getResumenPartido($idPartido);
      $data['partido'] = $partido;
      $data['accion'] = 4; // Solicitud
      $arrayEdades = array();
      $i = 0;
      $solicitudes = $this->Partido->obtenerSolicitudes($idPartido);
      foreach ($solicitudes as $key ) {
      	$arrayEdades[] = $this->calcularEdad($key['fechaNacimiento']);
      	$data['edadUsuario'.$key['idUsuario']] = $arrayEdades[$i];
      	$i++;
      }
      $data['solicitudes'] = $solicitudes;
      $_SESSION['partidos'] = 0;
      $this->view->show("_detallePartido.php",$data);
    }

    public function cambiarEstadoSolicitud($idPartido, $idUsuario, $respuesta, $accion){
    	if ($accion == 4){		// Rechazar la solicitud.
    		$this->Partido->cambiarEstadoSolicitud($idPartido, $idUsuario, $respuesta);
    		if ($respuesta == 1 ){ // Se acepto la solicitud, por lo tanto lo agrego a jugadores partido.
    			$estado = 1;
    			$this->Partido->agregarJugador($idPartido, $idUsuario, $estado);
    		}
    	}
    }

	public function responderInvitacion(){
      $idPartido = $_GET['idPartido'];
      $partido = $this->Partido->getResumenPartido($idPartido);
      $data['partido'] = $partido;
      $data['accion'] = 5; // Solicitud
      $_SESSION['partidos'] = 0;
      $this->view->show("_detallePartido.php",$data);
    }

    public function verResumen(){
      $idPartido = $_GET['idPartido'];
      $partido = $this->Partido->getResumenPartido($idPartido);
      $data['partido'] = $partido;
      $data['accion'] = 6; // Solicitud
      $_SESSION['partidos'] = 0;
      $this->view->show("_detallePartido.php",$data);
    }

    public function verResumenProximoPartido(){
		$idPartido = $_GET['idPartido'];
		$invitacion = $_GET['invitacion'];
	      $partido = $this->Partido->getResumenPartido($idPartido);
	      $data['partido'] = $partido;
	      $data['invitacion'] = $invitacion; // Solicitud
	      $data['accion'] = 7;
	      $_SESSION['partidos'] = 0;
	      $this->view->show("_detallePartido.php",$data);
    }


	//	Calcular edad de un usuario.
	public function calcularEdad($fecha){
		list($Y,$m,$d) = explode("-", $fecha);
		return(date("md")<$m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
	}



    // Cambiar el estado del partido dependiendo de la accion 
    public function cambiarEstadoPartido($idPartido, $accion){
    	if ($accion == 0 ){	// Solicitud partido
    		$estadoSolicitud = 2;
    		$tipoSolicitud = 0;
    		$idUsuario = $_SESSION['login_user_id'];
    		$this->Partido->agregarSolicitud($idUsuario, $idPartido, $estadoSolicitud, $tipoSolicitud);	
    	}
    	if ($accion == 1){	// Cancelar partido
    		$this->Partido->eliminarJugadoresPartido($idPartido);				// 	1. Eliminar jugadores del partido.
    		$tercerTiempo = $this->tercerTiempo->getTercerTiempo($idPartido);	
    		if (count($tercerTiempo) > 0){
    			$this->tercerTiempo->deleteTercerTiempo($idPartido);			//	2. Eliminar tercer tiempo del partido, si hay.
    		} 
    		$estado = 3;
    		$this->Partido->cambiarEstado($idPartido, $estado);					//	3. Cambiar estado en la tupla partido a cancelado (3->Cancelado)
    	}
    	if ($accion == 2){	// Notificar partido
    		$estado = 5;
    		$this->Partido->cambiarEstado($idPartido, $estado);
    	}
    }



	//Recopilar informacion del sistema
	public function partidoEquipoPropio(){
		//Datos del partido
		$idCapitan	= $_SESSION['login_user_id'];
		$fecha	=	$_POST['date'];
		$hora	=	$_POST['hora'];
		$cantidad	=	$_POST['cantidad'];
		$color	=	$_POST['color'];
		$idRecinto = $_POST['idRecinto'];
		$idHorario = $_POST['idHorario'];
		$_SESSION['idRecinto'] = $idRecinto;
		$listadoContactos= $this->Contacto->getContactos($idCapitan);
		$recinto = $this->Recinto->getRecinto($idRecinto);
		$data['fecha'] = $fecha;
		$data['hora']  = $hora;
		$data['cantidad'] = $cantidad;
		$data['color']= $color;
		$data['idHorario'] =$idHorario;
		//EquipoPropio = 2
		$data['tipoPartido'] = 2;
		$_SESSION['tipoPartido'] = 2;
		$data['recintoSeleccionado']= $recinto;
		$data['contactos']=$listadoContactos;


		$this->view->show("eleccionJugadores.php",$data);
		
	}
	public function partidoRevuelta(){
		//Datos del partido
		$idCapitan	= $_SESSION['login_user_id'];
		$fecha	=	$_POST['date'];
		$hora	=	$_POST['hora'];
		$cantidad	=	$_POST['cantidad'];
		$color	=	$_POST['color'];
		$color2 =	$_POST['color2'];
		$idRecinto = $_POST['idRecinto'];
		$idHorario = $_POST['idHorario'];
		$_SESSION['idRecinto'] = $idRecinto;
		//Contactos del jugador capitan
		$listadoContactos=$this->Contacto->getContactos($idCapitan);
		//Recinto deportivo en el cual se efectuara el partido
		$recinto = $this->Recinto->getRecinto($idRecinto);
		//Datos del partido hacia la vista
		$data['fecha'] = $fecha;
		$data['hora']  = $hora;
		$data['cantidad'] = $cantidad;
		$data['color']= $color;
		$data['color2']= $color2;
		$data['idHorario'] =$idHorario;
		//Revuelta = 1
		$data['tipoPartido'] = 1;
		$_SESSION['tipoPartido'] = 1;
		$data['recintoSeleccionado']= $recinto;
		$data['contactos']=$listadoContactos;
		$this->view->show("eleccionJugadores.php",$data);

	}
	public function partidoAB(){
		//Datos del partido
		$idCapitan	= $_SESSION['login_user_id'];
		$fecha	=	$_POST['date'];
		$hora	=	$_POST['hora'];
		$cantidad	=	$_POST['cantidad'];
		$color	=	$_POST['color'];
		$color2 =	$_POST['color2'];
		$idHorario	=	$_POST['idHorario'];
		$idRecinto = $_POST['idRecinto'];
		$_SESSION['idRecinto'] =$idRecinto;
		//Aqui guardamos el equipo del capitán
		$equipoCapitan = $_POST['equipo'];
		//Contactos del jugador capitan
		$listadoContactos=$this->Contacto->getContactos($idCapitan);
		//Recinto deportivo en el cual se efectuara el partido
		$recinto = $this->Recinto->getRecinto($idRecinto);
		//Datos del partido hacia la vista
		$data['fecha'] = $fecha;
		$data['hora']  = $hora;
		$data['cantidad'] = $cantidad;
		$data['color']= $color;
		$data['color2']= $color2;
		//Letra del equipo
		$data['equipoCapitan'] = $equipoCapitan;
		$data['idHorario']= $idHorario;
	
		$data['tipoPartido'] = 3;
		$data['recintoSeleccionado']= $recinto;
		$data['contactos']=$listadoContactos;
		//Enviamos la información a una vista intermedia que le provee al usuario la capacidad de elegir los jugadores de su equipo
		$this->view->show("eleccionJugadoresABCapitan.php",$data);

	}

	public function equipoCapitanAB(){
		//Debido a que esta funcion es ajax "Cambio a POST"
		//Contiene el arreglo de los id de los jugadores elegidos
		$jugadoresEquipoCap	= $_POST['jugadoresEquipoCap'];
		//Agregamos al equipo capitan y su equipo 
		$arregloJugadores = explode(',', $jugadoresEquipoCap);
		$_SESSION['jugadoresEquipo1'] = $arregloJugadores;
		$listadoTotalContactos=$this->Contacto->getContactos($_SESSION['login_user_id']);
		$listadoContactos;
		//realizamos una filtración de los contactos
		$num=0;
		foreach ($listadoTotalContactos AS $contacto) {
			$cont=0;
			for($i=0; $i<count($arregloJugadores); $i++){
				//Se comprueba si ya fue elegido
				if($contacto['idUsuario'] == $arregloJugadores[$i]){
					$cont++;
				}
			}
			if($cont == 0){
				$listadoContactos[$num] = $contacto;
				$num++;
			}
		}
		$recinto = $this->Recinto->getRecinto($_SESSION['idRecinto']);
		$data['recintoSeleccionado'] =$recinto;
		$data['contactos'] = $listadoContactos;
		$_SESSION['tipoPartido'] = 3;
		//vamos a la vista del otro equipo
		$this->view->show("eleccionJugadoresABOtro.php",$data);
		
	}
	public function agendarPartido(){
		//debemos identificar que tipo de partido es
		//Si es revuelta agregar color
		$idTipo =	$_SESSION['tipoPartido'];
		$idCapitan	= $_SESSION['login_user_id'];
		$fecha	=	$_SESSION['fecha'];
		$hora	=	$_SESSION['hora'];
		$cantidad	= $_SESSION['cantidad'];
		$color	=	$_SESSION['color'];
		$idRecinto = $_SESSION['idRecinto'];
		$idHorario = $_SESSION['idHorario'];
		//partido con estado agendado
		$idEstado = "1";
		//se calcula la cuota
		$horario = $this->Horario->getHorario($idHorario);

		$cuota = end($horario)['precio']/($cantidad*2);
		


		//Ingresar Partido
		$idPartido = $this->Partido->setPartido($idCapitan,$fecha, $hora, $cuota, $idTipo, $idEstado, $idRecinto, $cantidad);
		$_SESSION['idPartido'] = $idPartido;


		//Ingresar equipo del partido (Jugadores) Esto es igual en revuelta y EquipoPropio
		$data	=	json_decode($_POST['jObject'], true);
		for($i=0; $i<sizeof($data); $i++){
			$id=$data[$i];
			$this->Partido->setJugadoresPartidoPropio($idPartido, $id, "A", $color);
		}
			//Debido a que el capitan no se trae, se debe agregar.
			$this->Partido->setJugadoresPartidoPropioCapitan($idPartido, $idCapitan,"A", $color);

		//Manejo de los jugadores invitados fuera del sistema
			$idsJugadores;
			$correos = json_decode($_POST['correosInvitados'], true);
			if(!empty($correos)){
				
				for($i = 0 ; $i< count($correos) ; $i++){
					$today = date('YmdHi');
					$startDate = date('YmdHi', strtotime('2012-03-14 09:06:00'));
					$range = $today - $startDate;
					$rand = rand(0, $range);

					$password = $rand;
					$password_cifrada = password_hash($password,PASSWORD_DEFAULT); 
					$idsJugadores[$i] = $this->Usuario->crearInvitado($correos[$i], $password_cifrada);

				}

				//despues de ese for se tienen todos los id de los jugadores invitados
				for($i = 0 ; $i< count($correos) ; $i++){
					$this->Partido->setJugadoresPartidoPropio($idPartido, $idsJugadores[$i], "A", $color);
					}
			}
			if($_POST['tercer']==2){
				$this->resumenPartido();
			}
			if($_POST['tercer']==1){
				header('Location:?controlador=Local&accion=busquedaLocales');
			}

			

		}

	public function agendarPartidoRevuelta(){
		$idTipo =	$_SESSION['tipoPartido'];
		$idCapitan	= $_SESSION['login_user_id'];
		$fecha	=	$_SESSION['fecha'];
		$hora	=	$_SESSION['hora'];
		$cantidad	= $_SESSION['cantidad'];
		$color	=	$_SESSION['color'];
		$color2 = $_SESSION['color2'];
		$idRecinto = $_SESSION['idRecinto'];
		$idHorario = $_SESSION['idHorario'];
		//partido con estado agendado

		$idEstado = "1";
		$horario = $this->Horario->getHorario($idHorario);
		$cuota = end($horario)['precio']/$cantidad;
		
		//Ingresar Partido
		$idPartido = $this->Partido->setPartido($idCapitan,$fecha, $hora, $cuota, $idTipo, $idEstado, $idRecinto, $cantidad);
		$_SESSION['idPartido'] = $idPartido;


		//Ingresar equipo del partido (Jugadores) Esto es igual en revuelta y EquipoPropio
		$data	=	json_decode($_POST['jObject'], true);
		for($i=0; $i<sizeof($data); $i++){
			$id=$data[$i];
			$this->Partido->setJugadoresRevuelta($idPartido, $id, $color, $color2);
		}
			//Debido a que el capitan no se trae, se debe agregar.
			$this->Partido->setJugadoresRevueltaCapitan($idPartido, $idCapitan, $color, $color2);

		//Manejo de los jugadores invitados fuera del sistema
			$idsJugadores;
		$correos = json_decode($_POST['correosInvitados'], true);
			if(!empty($correos)){
				for($i = 0 ; $i< count($correos) ; $i++){
					$today = date('YmdHi');
					$startDate = date('YmdHi', strtotime('2012-03-14 09:06:00'));
					$range = $today - $startDate;
					$rand = rand(0, $range);

					$password = $rand;
					$password_cifrada = password_hash($password,PASSWORD_DEFAULT); 
					$idsJugadores[$i] = $this->Usuario->crearInvitado($correos[$i], $password_cifrada);

				}

				//despues de ese for se tienen todos los id de los jugadores invitados
				for($i = 0 ; $i< count($correos) ; $i++){
					$this->Partido->setJugadoresRevuelta($idPartido, $idsJugadores[$i], $color, $color2);
					}
			}
						if($_POST['tercer']==2){
				$this->resumenPartido();
			}
			if($_POST['tercer']==1){
				header('Location:?controlador=Local&accion=busquedaLocales');
			}



	}
	public function agendarPartidoAB(){
		$idTipo =	$_SESSION['tipoPartido'];
		$idCapitan	= $_SESSION['login_user_id'];
		$fecha	=	$_SESSION['fecha'];
		$hora	=	$_SESSION['hora'];
		$cantidad	= $_SESSION['cantidadTotal'];
		$color	=	$_SESSION['color'];
		$color2 = $_SESSION['color2'];
		$idRecinto = $_SESSION['idRecinto'];
		$idHorario = $_SESSION['idHorario'];
		//Jugadores del capitan
		$equipoCapitan =$_SESSION['equipoCapitan'];
		$jugadoresEquipo1 = $_SESSION['jugadoresEquipo1'];
		$jugadoresEquipo2 =json_decode($_POST['jObject'], true);
		$idEstado = "1";
		$horario = $this->Horario->getHorario($idHorario);
		$cuota = end($horario)['precio']/$cantidad;
		$idTipo=3;
		$_SESSION['tipoPartido'] = $idTipo;
		//Ingresar Partido
		$idPartido = $this->Partido->setPartido($idCapitan,$fecha, $hora, $cuota, $idTipo, $idEstado, $idRecinto, $cantidad);
		$_SESSION['idPartido'] = $idPartido;


		for($i=0; $i<sizeof($jugadoresEquipo1); $i++){
			$id=$jugadoresEquipo1[$i];
			if($equipoCapitan == "A"){
				$this->Partido->setJugadoresAB($idPartido,$id,"A",$color);
			}else{
				$this->Partido->setJugadoresAB($idPartido,$id,"B",$color2);
			}
		}

		for($i=0; $i<sizeof($jugadoresEquipo2); $i++){
			$id=$jugadoresEquipo2[$i];

			if($equipoCapitan == "A"){
				$this->Partido->setJugadoresAB($idPartido,$id,"B",$color2);
			}else{
				$this->Partido->setJugadoresAB($idPartido,$id,"A",$color);
			}
		}

			if($equipoCapitan == "A"){
				$this->Partido->setJugadoresABCapitan($idPartido,$idCapitan,"A",$color);
			}else{
				$this->Partido->setJugadoresABCapitan($idPartido,$idCapitan,"B",$color2);
			}

						if($_POST['tercer']==2){
				$this->resumenPartido();
			}
			if($_POST['tercer']==1){
				header('Location:?controlador=Local&accion=busquedaLocales');
			}




	}


	public function resumenPartido(){
		//Se debe filtrar por tipo de partido.
		$idCapitan	=	$_SESSION['login_user_id'];
		$fecha	=	$_SESSION['fecha'];
		$hora	=	$_SESSION['hora'];
		$cantidad	=	$_SESSION['cantidad'];
		$color	=	$_SESSION['color'];
		$idRecinto =	$_SESSION['idRecinto'];
		$idEstado = "1";

		//Datos del partido
		//Se deben traer 
		$data['tipoPartido'] = $_SESSION['tipoPartido'];
		$data['idCapitan']	=  $_SESSION['login_user_id'];
		$data['fecha']	=	$_SESSION['fecha'];
		$data['hora']	=	$_SESSION['hora'];
		$data['cantidad']	=	$_SESSION['cantidad'];
		$data['color']	=	$_SESSION['color'];
		//Se debe manejar la cuota con JS creo yo
		$cuota['cuota'] =	0;
		//Jugadores del partido
		$jugadoresPartido =	$this->Partido->getJugadoresPartido($_SESSION['idPartido']);
		$data['jugadores']	= $jugadoresPartido;
		//Recinto deportivo

		$recinto = $this->Recinto->getRecinto($_SESSION['idRecinto']);


		//Obtenemos el id del tercer tiempo
		$t = $this->tercerTiempo->getTercerTiempo($_SESSION['idPartido']);
		//var_dump($t);
		$partido= $this->Partido->getPartido($_SESSION['idPartido']);
		$data['partido'] = $partido;


		if(count($t) != 0){
			//pasamos el tercerTiempo
			$data['tercerTiempo'] = $t;
			$aux = end($t);
			$idLocal = $aux['idLocal'];
			$_SESSION['idTercer']= $aux['idTercerTiempo'];

			$data['local'] = $this->local->getLocal($idLocal);
		}



		$data['recinto'] = $recinto;

		//Liberamos las variables globales

		//enviamos los datos a la vista del resumen del partido
		$this->view->show("resumenPartido2.php",$data);		
	}

	public function getJugadoresPartido(){
		$idPartido = $_GET['idPartido'];
		$partido = $this->Partido->getTipoPartido($idPartido);
		foreach ($partido as $key) {
			$tipoPartido = $key['tipo'];
		}
		if ($tipoPartido == 4 ){ 	// Desafio
			// Traer equipos con sus jugadores.
			$idEquipo1 = $_SESSION['idEquipo1'];
			$idEquipo2 = $_SESSION['idEquipo2'];
			//Datos de los equipos.
			$equipo1 = $this->Equipo->getEquipo($idEquipo1);
			$data['equipo1']	= $equipo1;
			$equipo2 = $this->Equipo->getEquipo($idEquipo2);
			$data['equipo2']	= $equipo2;
			//Jugadores del equipo rival
			$jugadoresEquipo1 = $this->Equipo->getMiembrosEquipo($idEquipo1);
			$data['jugadores1']	= $jugadoresEquipo1;
			$jugadoresEquipo2 = $this->Equipo->getMiembrosEquipo($idEquipo2);
			$data['jugadores2']	= $jugadoresEquipo2;
			?>
			<?php
		} else {
			$jugadoresPartido =	$this->Partido->getJugadoresPartido($idPartido);
			$data['jugadores']	= $jugadoresPartido;
		}
		$data['tipoPartido'] = $tipoPartido;
		$this->view->show("_jugadoresPartido.php", $data);
	}


	public function estadoInvitaciones(){
		$idPartido = $_GET['idPartido'];

		$invitaciones = $this->Partido->getInvitacionesPartido($idPartido);

		$descartados = 0;
		foreach ($invitaciones as $key ) {
			$nroJugadores = $key['nroJugadores'];
			$estadoPartido  = $key['estadoPartido'];
			$tipoPartido = $key['tipoPartido'];
			if ($key['estado'] == 2){
				$descartados++;
			}
		}

		$data['invitaciones'] = $invitaciones;
		$data['idPartido'] = $idPartido;

		$data['estadoPartido'] = $estadoPartido;
		$data['tipoPartido'] = $tipoPartido;

		$data['nroJugadores'] = $nroJugadores;
		$data['descartados'] = $descartados;

		$this->view->show("_invitacionesPartido.php", $data);
	}





	public function agendarDesafio(){
		//$desafio = new Desafio();
		$idOrganizador= $_POST['idUsuario'];
		$idRival = $_POST['rival'];
		$_SESSION['idEquipo2'] = $idRival;
		$idDesafio = $_POST['desafio'];
		$idEncuentro = $_POST['idEncuentro'];

		$horarioElegido = $_POST["idHorario"];
		$horario = $this->Horario->getHorario($horarioElegido);
		$montoHorario = end($horario)['precio'];
		$montoPorEquipo = $montoHorario/2;


		$horaPartido = $_POST['hora'];
		$desafio = $this->Desafio->getDesafio($idDesafio);
		foreach ($desafio as $item) {
			$fechaPartido = $item['fechaPartido'];
			$idRecinto = $item['idRecinto'];
			$idEquipoOrganizador = $item['idEquipoOrganizador'];
			$_SESSION['idEquipo1'] = $idEquipoOrganizador;
			$equipoOrganizador = $item['nombreEquipo'];
		}

		$estado = 1; // Activo.
		$estadoDesafio = 3; // Agendado.
		$tipoPartido = 4; // Desafio.

		// Enviar datos a la BD
		$this->Desafio->cambiarEstado($idDesafio, $estadoDesafio);
		$this->Encuentro->cambiarEstadoEncuentro($idEncuentro, $estadoDesafio);


		//

		//Datos del partido
		$data['tipoPartido'] = $tipoPartido;
		$data['idCapitan']	=  $idOrganizador;
		$data['fecha']	=	$fechaPartido;
		$data['hora']	=	$horaPartido;
		$data['cantidad']	=	0;
		$data['color']	=	"Definidos por cada equipo"; // Falta traer estos datos.
		$data['cuota'] =	$montoPorEquipo;

		//Jugadores del equipo rival
		$jugadoresEquipo1 = $this->Equipo->getMiembrosEquipo($idEquipoOrganizador);
		$jugadoresEquipo2 = $this->Equipo->getMiembrosEquipo($idRival);

		$nroJugadores = count($jugadoresEquipo1) + count($jugadoresEquipo2);


		$ultimoPartido = $this->Partido->setPartidoDesafio($idOrganizador,$fechaPartido, $horaPartido, $montoPorEquipo, $tipoPartido, $estado, $idRecinto, $nroJugadores);

		foreach ($jugadoresEquipo1 as $key) {
			$idMiembroEquipo = $key['idUsuario'];
			$this->Partido->jugadoresPartidoDesdeDesafio($idMiembroEquipo, $ultimoPartido);
		}

		foreach ($jugadoresEquipo2 as $key) {
			$idMiembroEquipo = $key['idUsuario'];
			$this->Partido->jugadoresPartidoDesdeDesafio($idMiembroEquipo, $ultimoPartido);
		}

		//$ultimoPartido = ($partido)['LAST_INSERT_ID()'];

		/* NO necesario
		$partidos = $this->Partido->getPartidos();
		$ultimoPartido = end($partidos)['idPartido'];
		*/


		$this->Partido->setEquiposDesafio($ultimoPartido, $idEquipoOrganizador, $idRival);
		$data['jugadoresEquipo1'] = $jugadoresEquipo1;
		$data['jugadoresEquipo2'] = $jugadoresEquipo2;


		//Recinto deportivo
		$recinto = $this->Recinto->getRecinto($idRecinto);
		$data['recinto'] = $recinto;

		$data['idRecinto'] = $idRecinto;
		$data['idPartido'] = $ultimoPartido;





		// Enviar correo

		$data['accion'] = 3;
		$_SESSION['tipoCorreo'] = 3;
		$_SESSION['idPartido'] = $ultimoPartido;

		//$this->enviarCorreo();

		$this->view->show("resumenPartido2.php",$data);	


	}

	public function enviarInvitaciones(){

		$idPartido= $_SESSION["idPartido"];
		$idUsuario= $_SESSION['idUsuario'];
		$idRecinto= $_SESSION['idRecinto']; //Recinto seleccionado
		$cantidad = $_SESSION['cantidad'];
		$tipoPartido= $_SESSION['tipoPartido'];
		$correo=$_SESSION['login_user_email'];
        $nombreJugador= $_SESSION['login_user_name'];
    

        $recinto = $this->Recinto->getRecinto($_SESSION['idRecinto']);
		foreach ($recinto as $Recinto) {
			$imagenRecinto = $Recinto['fotografia'];
			$nombreRecinto = $Recinto['nombre'];
			$direccionRecinto = $Recinto['direccion'];
		}

$existenciaTercerTiempo=0;
//buscamos con el id del partido si tiene tercer tiempo
$tercerTiempoPartido = $this->tercerTiempo->getTercerTiempo($idPartido);
$existenciaTercerTiempo = count($tercerTiempoPartido);
$partidoSeleccionado = $this->Partido->getPartido($idPartido);


$idLocal=0;
$nombreLugar="";
$direcciontercertiempo="";

if ($existenciaTercerTiempo != 0) { // Si es 0, no hay tercer tiempo 
	$idTercer = $_SESSION['idTercerTiempo'];
	foreach ($tercerTiempoPartido as $TercerTiempo) {
	$idLocal = $TercerTiempo['idLocal'];
	}
	$localTercerTiempo = $this->local->getLocal($idLocal);
	foreach ($localTercerTiempo as $Local) {
		$nombreLugar = $Local['nombre'];
		$direcciontercertiempo = $Local['direccion'];
		$imagenLugar = $Local['fotografia'];
}

}



			foreach ($partidoSeleccionado as $Partido) {
				$dia = $Partido['fecha'];
				$newFecha = date("d-m-Y", strtotime($dia));
				$hora = $Partido['hora'];
				$cuotaTotal = $Partido['cuota']*$cantidad;
				$participantes = $cantidad;
				$cuotaPersonal = $Partido['cuota'];
				$tipoPartido = $Partido['tipo'];
			}


		$vectorEquipo =	$this->Partido->getJugadoresPartido($_SESSION['idPartido']);

$to = "partidomatchday@gmail.com";
//Para los invitados fuera del sistema
$toEstado3 = "partidomatchday@gmail.com"; 
$jugadoresInvitados;
$contadorInvitados = 0;
foreach ($vectorEquipo as $Jugador) {
				if($Jugador['estado'] != 3){
					$aux = $to;
					$to = $aux.", ".$Jugador['mail'];
				}else{
					if($Jugador['estado'] == 3){

					$jugadoresInvitados[$contadorInvitados]= $Jugador;
					$contadorInvitados++;
				}
				}	
				}
//foreach para rellenar el campo con los correos de los jugadores
//$query = "SELECT correo FROM jugador WHERE id_jugador IN (SELECT id_jugador FROM equipo where id_partido in (SELECT id_partido FROM partido))";
//echo $query;
//foreach ($query as $key) {
//$to .= ", ".$key;
//}

$dir = $direccionRecinto;
//rellenar con la direccion
$nombre = $nombreJugador;
//rellenar con nombre jugador
$fecha = $newFecha;
//fecha partido
//se mantiene el que copie
//hora partido
$monto = $cuotaTotal;
//precio original cancha
$cant = $cantidad;
//cantidad de jugadores
$pagoporpersona = $cuotaPersonal;
//monto/cancha

$subject = "Se te ha invitado a un partido";
//se debe obtener el asunto, Partido de: X deporte
$tercertiempo = $nombreLugar;
//recibir existencia de 3er tiempo
$direcciontercertiempo = $direcciontercertiempo;
//direccion tercer tiempo


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
$message .= '<div style="height:auto; width:auto;"><img src="http://maps.googleapis.com/maps/api/staticmap?center='. $dir . '&zoom=14&scale=false&size=600x300&maptype=roadmap&format=png&visual_refresh=true&markers=size:small%7Ccolor:0xff0000%7Clabel:%7C'.$dir.'" alt="Website Change Request" /></div>';
$message .= "<p>El jugador " .$nombre.  ", te ha invitado a un partido.</p>";

$message .= "<div class='datagrid'>";
$message .= "<table>";
$message .= "<tr>";
$message .= "<th>Direccion:</th>";
$message .= "<td>".$dir."</td>";
$message .= "</tr>";
$message .= "<tr>";
$message .= "<th>Fecha:</th>";
$message .= "<td>".$fecha."</td>";
$message .= "</tr>";
$message .= "<tr>";
$message .= "<th>Hora: :</th>";
$message .= "<td>".$hora."</td>";
$message .= "</tr>";
$message .= "<tr>";
$message .= "<th>Monto total a pagar:</th>";
$message .= "<td>".$monto."</td>";
$message .= "</tr>";
$message .= "<tr>";
$message .= "<th>Monto a Pagar por persona:</th>";
$message .= "<td>".$pagoporpersona."</td>";
$message .= "</tr>";

//Por tipo de partido
//Revuelta
if($tipoPartido==1){
$message .= "<tr>";
$message .= "<th>Tipo de Partido:</th>";
$message .= "<td>Revuelta</td>";
$message .= "</tr>";
$message .= "<tr>";
$message .= "<th>Colores a llevar:</th>";
$message .= "<td>".$_SESSION['color']." , ".$_SESSION['color2']."</td>";
$message .= "</tr>";

}
//Equipo Propio
if($tipoPartido==2){
$message .= "<tr>";
$message .= "<th>Tipo de Partido:</th>";
$message .= "<td>Equipo Propio</td>";
$message .= "</tr>";
$message .= "<tr>";
$message .= "<th>Color de Camiseta:</th>";
$message .= "<td>".$_SESSION['color']."</td>";
$message .= "</tr>";

	
}
//A vs B
if($tipoPartido==3){
$message .= "<tr>";
$message .= "<th>Tipo de partido:</th>";
$message .= "<td>A v/s B</td>";
$message .= "</tr>";

if($_SESSION['equipoCapitan'] == "A"){
	$message .= "<tr>";
	$message .= "<th>Equipo A:</th>";
	$message .= "<td>".$_SESSION['color']."</td>";
	$message .= "</tr>";

	$message .= "<tr>";
	$message .= "<th>Equipo B:</th>";
	$message .= "<td>".$_SESSION['color2']."</td>";
	$message .= "</tr>";	
}else{
	$message .= "<tr>";
	$message .= "<th>Equipo A:</th>";
	$message .= "<td>".$_SESSION['color2']."</td>";
	$message .= "</tr>";

	$message .= "<tr>";
	$message .= "<th>Equipo B:</th>";
	$message .= "<td>".$_SESSION['color']."</td>";
	$message .= "</tr>";

}
//Jugadores
foreach ($vectorEquipo as $jugador) {
	# code...

	$message .= "<tr>";
	$message .= "<th>".$jugador['nickname']." :</th>";
	$message .= "<td>".$jugador['equipo']."</td>";
	$message .= "</tr>";
}

}
if($tipoPartido==4){
$message .= "<tr>";
$message .= "<th>Monto a Pagar por persona:</th>";
$message .= "<td>".$pagoporpersona."</td>";
$message .= "</tr>";
	
}
$message .= "</table>";
$message .= "</div>";






if($existenciaTercerTiempo!=0){
$message .= "<p>Tambien se te ha invitado a un evento post partido!</p>";
	$message .= "Este tercer tiempo sera en: " .$nombreLugar. " mapa de referencia:";
$message .= '<div style="height:auto; width:auto;"><img src="http://maps.googleapis.com/maps/api/staticmap?center='. $direcciontercertiempo . ',Chillan&zoom=14&scale=false&size=600x300&maptype=roadmap&format=png&visual_refresh=true&markers=size:small%7Ccolor:0xff0000%7Clabel:%7C'.$direcciontercertiempo.' Chillan, Chile" alt="Website Change Request" /></div>';
}
$message .= "<center><b><p>© 2016. MatchDay.</p></b></center>";
$message .= "</body>";
$message .= "</html>";



// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <partidomatchday@gmail.com>' . "\r\n"; //
$headers .= 'Cc: partidomatchday@gmail.com' . "\r\n"; // 


			//Le paso el mensaje, la lista de correos para los jugadores del sistema
			send($message,$to,$subject);
			//Correos para jugadores fuera de sistema
			for ($i=0; $i < count($jugadoresInvitados) ; $i++) { 
				$aux=$message;
			
			//$aux .= "<h4>Para responder esta invitación, ingresa a MatchDay desde <a href='http://parra.chillan.ubiobio.cl:8070/pnsilva/Matchday?controlador=Invitado&accion=invitacionPartido&token=".$jugadoresInvitados[$i]['password']."'>aquí</a></h4>";
			$aux .= "<h4>Para responder esta invitación, ingresa a MatchDay desde <a href='http://localhost/Matchday/?controlador=Invitado&accion=invitacionPartido&token=".$jugadoresInvitados[$i]['password']."'>aquí</a></h4>";
			send($aux, $jugadoresInvitados[$i]['mail'], $subject);

			}

 //Email response
 		unset($_SESSION['tipoPartido']);
		unset($_SESSION['fecha']);
		unset($_SESSION['hora']);
		unset($_SESSION['cantidad']);
		unset($_SESSION['color']);
		unset($_SESSION['idRecinto']);
		unset($_SESSION['tipoPartido']);
		unset($_SESSION['idPartido']);
		unset($_SESSION['idTercer']);
  

	}









	public function enviarCorreo(){

		// Enviar correo al capitan del equipo que creó el desafío
		if ($_SESSION['tipoCorreo'] == 3){

			//echo $_SESSION['tipoCorreo'];

			$idPartido = $_SESSION['idPartido'];

			//echo $idPartido;

			$partido = $this->Partido->getPartido($idPartido);

			foreach ($partido as $key ) {
				$fecha = $key['fecha'];
				$hora = $key['hora'];
				$cuota = $key['cuota'];
				$idRecinto = $key['idRecinto'];
			}

			$recinto = $this->Recinto->getRecinto($idRecinto);

			foreach ($recinto as $key ) {
				$nombreRecinto = $key['nombre'];
				$direccionRecinto = $key['direccion'];
				$fotografiaRecinto = $key['fotografia'];
			}


			$equipos = $this->Partido->getEquiposPartido($idPartido);
			//var_dump($equipos);

			foreach ($equipos as $key ) {
				$idEquipo1 = $key['idEquipo'];
				$idEquipo2 = $key['idEquipo2'];
			}

			$equipo1 = $this->Equipo->getEquipo($idEquipo1);

			foreach ($equipo1 as $key) {
				$nombreEquipo1 = $key['nombre'];
				$idCapitanEquipo1 = $key['idCapitan'];
			}

			$equipo2 = $this->Equipo->getEquipo($idEquipo2);

			foreach ($equipo2 as $key) {
				$nombreEquipo2 = $key['nombre'];
				$idCapitanEquipo2 = $key['idCapitan'];
			}


			$miembros1 = $this->Equipo->getMiembrosEquipo($idEquipo1);
			$miembros2 = $this->Equipo->getMiembrosEquipo($idEquipo2);


			$to = "partidomatchday@gmail.com";

			foreach ($miembros1 as $key ) {
				$aux = $to;
				$to = $aux.",".$key['mail'];
			}


			foreach ($miembros2 as $key ) {
				$aux = $to;
				$to = $aux.",".$key['mail'];
			}

			//$to = $mail."";



			$dir = $direccionRecinto;

			$subject = "Desafio agendado!";



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
			$message .= "<h4>Se ha agendado un desafío: ".$nombreEquipo1. " V/S ".$nombreEquipo2." </h4>";

			$message .= "<div class='datagrid'>";
			$message .= "<table>";
			$message .= "<tr>";
			$message .= "<th>Equipos:</th>";
			$message .= "<td>".$nombreEquipo1." vs ".$nombreEquipo2."</td>";
			$message .= "</tr>";
			$message .= "<tr>";
			$message .= "<th>Fecha:</th>";
			$message .= "<td>".$fecha."</td>";
			$message .= "</tr>";
			$message .= "<tr>";
			$message .= "<th>Hora:</th>";
			$message .= "<td>".$hora."</td>";
			$message .= "</tr>";
			$message .= "<tr>";
			$message .= "<th>Recinto:</th>";
			$message .= "<td>".$nombreRecinto."</td>";
			$message .= "</tr>";

			$message .= "<tr>";
			$message .= "<th>Cuota:</th>";
			$message .= "<td>$ ".$cuota." por equipo</td>";
			$message .= "</tr>";

			$message .= "</table>";
			$message .= "</div>";

			$message .= '<div style="height:auto; width:auto;"><img src="http://maps.googleapis.com/maps/api/staticmap?center='. $dir . '&zoom=14&scale=false&size=600x300&maptype=roadmap&format=png&visual_refresh=true&markers=size:small%7Ccolor:0xff0000%7Clabel:%7C'.$dir.'" /></div>';		
			$message .= "<center><b><a href='http://maps.google.com/?q=".$dir."'><h4>¿Cómo llegar?</h4></a></b></center>";

			$message .= "<center><b><p>© 2016. MatchDay.</p></b></center>";
			$message .= "</body>";
			$message .= "</html>";



			// Always set content-type when sending HTML email
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

			// More headers
			$headers .= 'From: <partidomatchday@gmail.com>' . "\r\n"; //
			$headers .= 'Cc: pablonicolassilvabravo@gmail.com' . "\r\n"; // 

			//Le paso el mensaje, la lista de correos
			send($message,$to,$subject);


	 		unset($_SESSION['idPartido']);
			unset($_SESSION['tipoCorreo']);




		}




	}






public function getGraficosPartidos(){

	$horas = $this->Partido->getHorasPartido();
	$data['hora'] = $horas;

	$estados = $this->Partido->getEstadosPartido();
	$data['estado'] = $estados;

	$dias = $this->Partido->getDiasPartido();
	$data['dia'] = $dias;

	$this->view->show('_adminGraficosPartidos.php',$data);
}

public function calendarioAdmin(){

	$partidos = $this->Partido->getPartidosCalendario();
	$data['partidosSistema'] = $partidos;
	$this->view->show('adminCalendario.php',$data);
}
}
?>