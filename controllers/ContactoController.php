<?php

require 'models/Contacto.php';
require 'models/Usuario.php';
require 'models/Equipo.php';
require 'models/MiembrosEquipo.php';

session_start();

class ContactoController{

	function __construct(){
		$this->view = new View();
		$this->Contacto = new Contacto();
		$this->Usuario = new Usuario();
		$this->Equipo = new Equipo();
	}

	public function index(){
		$this->view->show("");
	}

	// Entregar lista de contactos de un usuario. Si agrega un contacto, tambien lo hace mediante esta funcion. - MODULO LISTAR CONTACTOS
	public function listaContactos(){
		$idUsuario = $_SESSION['login_user_id'];
		$contactos = new Contacto();
		$equipos = new Equipo();
		$miembrosEquipo = new MiembrosEquipo();
		
		$listaContactos = $contactos->getContactos($idUsuario);
		$arrayEdades = array();
		$i = 0;
		foreach ($listaContactos as $contacto) {
			$arrayEdades[] = $this->calcularEdad($contacto['fechaNacimiento']);
			$data['edadContacto'.$contacto['idUsuario']] = $arrayEdades[$i];
			$i++;
		}

		$data['listaContactos'] = $listaContactos;			// Listar contactos del usuario
		$listaEquipos = $equipos->getEquiposJugador($idUsuario);
		$data['listaEquipos'] = $listaEquipos;				// Listar equipos del usuario (para que un contacto sea agregado a uno de ellos)
		$listaMiembrosEquiposJugador = $miembrosEquipo->getMiembrosEquiposJugador($idUsuario);
		$data['listaMiembrosEquiposJugador'] = $listaMiembrosEquiposJugador;	// Miembros de los equipos de los cuales el jugador es el capitan.

		if (isset($_SESSION['accion'])){
			$data['accion'] = $_SESSION['accion'];
		}
		$_SESSION['accion'] = 0;

		$this->view->show('listaContactos.php',$data); 
	}

	public function agregarContacto(){
		$idUsuario = $_SESSION['login_user_id'];
		$idContacto = $_POST['idJugador'];
		$this->Contacto->setContacto($idUsuario,$idContacto);
		$_SESSION['accion'] = 1;
		header('Location: ?controlador=Contacto&accion=listaContactos');
	}

	public function nuevoMiembro(){
        $equipo = new Equipo();
        $idContacto = $_GET['idContacto'];
        $idUsuario = $_SESSION['login_user_id'];
        $equiposContacto = $equipo->getEquiposCapitan($idContacto, $idUsuario); // Equipos en los que podria estar el contacto.
        $data['equipos'] = $equiposContacto;
        $_SESSION['idNuevoMiembro'] = $idContacto;
        $this->view->show("_nuevoMiembro.php", $data);
	}

	//	Agregar contacto a un equipo (desde la lista de contactos)	- MODULO AGREGAR CONTACTO. MODAL
	public function agregarMiembro(){
		$equipo = new Equipo();
		$idContacto = $_SESSION['idNuevoMiembro'];
		$idEquipo = $_POST["equipo"];
		$equipo->agregarMiembroEquipo($idContacto,$idEquipo);

		$_SESSION['accion'] = 2;
		header('Location: ?controlador=Contacto&accion=listaContactos');
	}

	//	Calcular edad de un usuario.
	public function calcularEdad($fecha){
		list($Y,$m,$d) = explode("-", $fecha);
		return(date("md")<$m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
	}

	// Equipos del capitan
    public function equiposCapitan(){
    	if(!isset($_SESSION)) { 
        	session_start(); 
        } 
        $equipos = new Equipo();
      	$idUsuario = $_SESSION['login_user_id'];
      	$listaEquipos = $equipos->getEquiposJugador($idUsuario);
		$data['listaEquipos'] = $listaEquipos;		
      	//mostrar vista parcial con los implementos (dataTable)
      	$this->view->show("agregarJugador.php", $data);
    }




}


?>