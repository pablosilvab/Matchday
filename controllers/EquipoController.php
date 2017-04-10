<?php

require 'models/Equipo.php';
require 'models/Contacto.php';
require 'models/Usuario.php';
require 'models/Desafio.php';

session_start();

class EquipoController{
	function __construct(){
		$this->view = new View();
		$this->Equipo = new Equipo();
		$this->Contacto = new Contacto();
		$this->Desafio = new Desafio();
		$this->Usuario = new Usuario();
	}

	public function index(){
		$this->view->show("");
	}

	// Entregar lista de equipos de un usuario. Si agrega un equipo, termina en esta funcion
	public function listaEquipos(){
		$idUsuario = $_SESSION['login_user_id'];
		$equipos = new Equipo();
		$contactos = new Contacto();
		$listaContactos = $contactos->getContactos($idUsuario);				// Contactos del usuario, para crear su nuevo equipo.
		$data['listaContactos'] = $listaContactos;
		$listaEquipos = $equipos->getEquiposJugador($idUsuario); 			// Equipos en los que el jugador es el capitan.
		$data['listaEquipos'] = $listaEquipos;
		foreach ($listaEquipos as $key ) {
			$idEquipo = $key['idEquipo'];
			$listaMiembrosEquipo = $equipos->getMiembrosEquipo($idEquipo); 	// Jugadores de un determinado equipo.
			$data['listaMiembrosEquipo'.$idEquipo]= $listaMiembrosEquipo;
		}
		$listaEquiposMiembro = $equipos->getEquiposMiembro($idUsuario);		// Equipos en los que el jugador es solo un miembro (no capitán).
		$data['listaEquiposMiembro'] = $listaEquiposMiembro;
		foreach ($listaEquiposMiembro as $key ) {
			$idEquipo = $key['idEquipo'];
			$listaMiembrosEquipo = $equipos->getMiembrosEquipo($idEquipo); 		// Jugadores de un determinado equipo.
			$data['listaMiembrosEquipo'.$idEquipo]= $listaMiembrosEquipo;
		}
		if (isset($_SESSION['accion'])){
			$data['accion'] = $_SESSION['accion'];
		}
		$_SESSION['accion'] = 0;
		$this->view->show('listaEquipos.php',$data);
	}

	// Entregar datos del equipo, y además los contactos del usuario.	
	public function gestionarEquipo(){
		$equipo = new Equipo();
		$idUsuario = $_SESSION['login_user_id'];
		$idEquipo = $_POST['idEquipo'];
		$data['equipo'] = $equipo->getEquipo($idEquipo);
		$listaMiembrosEquipo = $equipo->getMiembrosEquipo($idEquipo); 		// Contactos que ya están en el equipo.
		$data['listaMiembrosEquipo']= $listaMiembrosEquipo;
		$listaContactos = $equipo->getContactosEquipo($idUsuario,$idEquipo);				// Contactos que no estan en el equipo
		$data['listaContactos']= $listaContactos;

		// Desafios del equipo 
		$listaDesafios = $this->Equipo->getDesafiosEquipo($idEquipo);
		$data['listaDesafios'] = $listaDesafios;
		$this->view->show('gestionarEquipo.php',$data);
	}

	//	Actualizar información del equipo (nombre, color, jugadores)
	public function updateEquipo(){
		$nombre = $_POST["nombre"];
		$color = $_POST["color"];
		$idEquipo =  $_SESSION['idEquipo'];
		$this->Equipo->updateEquipo($idEquipo,$nombre,$color);
		$edades = 0; 
		// Suma de edad de miembros del equipo
		$miembrosEquipo = $this->Equipo->getMiembrosEquipo($idEquipo);
		$cont = 0;
		foreach ($miembrosEquipo as $key ) {
			$edades = $edades + $this->calcularEdad($key['fechaNacimiento']);
			$cont++;
		}


		if (isset($_POST["arrayContactos"])){
			$miembros = $_POST["arrayContactos"];
			for ($i=0; $i<count($miembros) ; $i++) {
				$idMiembro = $miembros[$i];
				$resultado = $this->Equipo->verificarMiembro($idMiembro,$idEquipo);
				$respuesta = count($resultado);
				$fechaNacimiento = end($this->Usuario->getFechaNac($idMiembro))['fechaNacimiento'];
				$edades =  $edades + $this->calcularEdad($fechaNacimiento);
				if ($respuesta == 0){
					$cont++;
					$this->Equipo->agregarMiembroEquipo($idMiembro,$idEquipo);

				}
			}
			$edadPromedio = $edades/$cont;
			$this->Equipo->actualizarEdadPromedio($idEquipo, $edadPromedio);
		}
		$_SESSION['accion'] = 2;
		header('Location: ?controlador=Equipo&accion=listaEquipos');
	}

	//	Desplegar formulario para crear el equipo (nombre, color, jugadores)
	public function crearEquipo(){
		$equipo = new Equipo();
		$usuario = new Usuario();
		$nombre = $_POST["nombre"];
		$color = $_POST["color"];
		$idUsuario = $_SESSION['login_user_id'];
		$this->Equipo->setEquipo($nombre,$color,$idUsuario);
		$miembros = $_POST["arrayContactos"];
		//var_dump($miembros);
		$equipos = $this->Equipo->getEquipos();
		$idEquipo = end($equipos)['idEquipo'];
		$arrayEdades = array(); 
		for ($i=0; $i<count($miembros) ; $i++) {
			$idMiembro = $miembros[$i];
			$fechaNac = $usuario->getFechaNac($idMiembro);
			foreach ($fechaNac as $fecha) {
				$fechaNacimiento = $fecha['fechaNacimiento'];
				//echo $fechaNacimiento."<br>";
			}
			$arrayEdades[$i] = $this->calcularEdad($fechaNacimiento);
			//echo "Miembro: ".$miembros[$i];
			$equipo->agregarMiembroEquipo($idMiembro,$idEquipo);
		}

		$edadPromedio = $this->calcularPromedio($arrayEdades);
		$nroJugadores = count($miembros);
		$this->Equipo->setMiembros($idEquipo,$edadPromedio, $nroJugadores);
		$equipo->agregarMiembroEquipo($idUsuario,$idEquipo);
		$_SESSION['accion'] = 1;
		header('Location: ?controlador=Equipo&accion=listaEquipos');
	}


	//	Calcular edad de un usuario.
	public function calcularEdad($fecha){
		list($Y,$m,$d) = explode("-", $fecha);
		return(date("md")<$m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
	}

	// Calcular promedio de edad de un array
	public function calcularPromedio($array){
		return round(array_sum($array)/count($array));
	}
	
    /*    MODULO DE ADMINISTRACION  */
    public function adminEquipos(){
      $equipos = $this->Equipo->getEquiposAdmin();

      $data['equipos'] = $equipos;
      $this->view->show('adminEquipos.php',$data);
    }

	public function detalleEquipo(){
		$idEquipo = $_GET['idEquipo'];
		$equipo = $this->Equipo->getDetalleEquipoAdmin($idEquipo);

		$data['equipo'] = $equipo;
	    $this->view->show("_adminInfoEquipo.php", $data);
	}

	public function getGraficosEquipos(){

		$partidosEquipo = $this->Equipo->getPartidosEquipo();
		$data['partidos'] = $partidosEquipo;

		$edadPromedio = $this->Equipo->getEdadesEquipo();
		$data['edad'] = $edadPromedio;


		$this->view->show("_adminGraficosEquipos.php", $data);
	}


}

?>