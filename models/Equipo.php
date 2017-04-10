
<?php

class Equipo{

	protected $db;

	public function __construct(){
		$this->db = SPDO::singleton();
	}

	// Set Equipo: Nuevo Equipo (puntuacion = partidosDisputados = partidosCancelados = 0) - MODULO CREAR EQUIPO
	public function setEquipo($nombre, $color, $idCapitan){
		$sql = "INSERT INTO Equipo (nombre, puntuacion, color, partidosDisputados, partidosCancelados, idCapitan) 
				VALUES ('$nombre', 0, '$color', 0, 0, '$idCapitan');";
		$query = $this->db->prepare($sql);
		$query->execute();
	}

	// Obtener un determinado equipo.
	public function getEquipo($idEquipo){
		$query = $this->db->prepare("SELECT * FROM Equipo WHERE idEquipo = '".$idEquipo."'");
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}

	// Actualizar información de un determinado equipo.
	public function updateEquipo($idEquipo,$nombre,$color){
		$sql = "UPDATE Equipo SET nombre = '".$nombre."' , color = '".$color."' WHERE idEquipo = '".$idEquipo."' ";
		$query = $this->db->prepare($sql);
		$query->execute();
	}

	//	Setear edad del equipo
	public function setMiembros($idEquipo,$edad, $nroJugadores){
		$sql = "UPDATE Equipo SET edadPromedio = '".$edad."' , nroJugadores = '".$nroJugadores."' WHERE idEquipo = '".$idEquipo."' ";
		$query = $this->db->prepare($sql);
		$query->execute();
	}

	

	// Obtener equipos de un usuario. (Como Capitán) - MODULO LISTAR EQUIPOS
	public function getEquiposJugador($idUsuario){
		$query = $this->db->prepare("SELECT * FROM Equipo WHERE Equipo.idCapitan = '".$idUsuario."'");
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}



	// Obtener equipos
	public function getEquipos(){
		$query = $this->db->prepare("SELECT * FROM Equipo");
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}

	// Obtener equipos de un usuario (Como Miembro, por lo tanto se revisa la tabla 'MiembrosEquipo'). MODULO LISTAR EQUIPOS
	public function getEquiposMiembro($idUsuario){
		$query = $this->db->prepare("SELECT * FROM Equipo 
			INNER JOIN MiembrosEquipo ON Equipo.idEquipo = MiembrosEquipo.idEquipo 
			WHERE MiembrosEquipo.idUsuario = '".$idUsuario."' AND Equipo.idCapitan != '".$idUsuario."' ");
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}

	// Obtener miembros de un determinado equipo. - MODULO MODIFICAR EQUIPO
	public function getMiembrosEquipo($idEquipo){
		$query = $this->db->prepare("SELECT DISTINCT Usuario.idUsuario, Usuario.nombre, Usuario.apellido, Usuario.fotografia, Usuario.fechaNacimiento, Usuario.mail 
			FROM Usuario 
			INNER JOIN MiembrosEquipo ON Usuario.idUsuario = MiembrosEquipo.idUsuario 
			WHERE MiembrosEquipo.idEquipo = '".$idEquipo."'");
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}

	// Obtener posibles jugadores para un equipo (contactos de un usuario que no esten en un determinado equipo) - MODULO CREAR EQUIPO
	public function getContactosEquipo($idUsuario, $idEquipo){
		$query = $this->db->prepare(
			"SELECT Usuario.idUsuario, Usuario.nombre, Usuario.apellido, Usuario.Fotografia 
			FROM Usuario 
			INNER JOIN Contacto ON Usuario.idUsuario = Contacto.idContacto 
			WHERE Contacto.idUsuario = '".$idUsuario."' AND Usuario.idUsuario NOT IN 
									(SELECT Usuario.idUsuario FROM Usuario 
										INNER JOIN MiembrosEquipo ON Usuario.idUsuario = MiembrosEquipo.idUsuario 
										WHERE MiembrosEquipo.idEquipo = '".$idEquipo."' )");
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}

	//	Verificar existencia de un miembro en un determinado equipo.
	public function verificarMiembro($idUsuario, $idEquipo){
		$query = $this->db->prepare("SELECT * FROM MiembrosEquipo WHERE idUsuario = '".$idUsuario."' AND idEquipo = '".$idEquipo."'");
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;

	}

	//	Agregar miembro a un determinado equipo.
	public function agregarMiembroEquipo($idUsuario, $idEquipo){
		$query = $this->db->prepare("INSERT INTO MiembrosEquipo (idUsuario, idEquipo) VALUES ('$idUsuario','$idEquipo');");
		$query->execute();
	}


	// Actualizar edad promedio al agregar uno o más jugadores
	public function actualizarEdadPromedio($idEquipo, $edadPromedio){
		$sql = "UPDATE Equipo SET edadPromedio = '".$edadPromedio."' WHERE idEquipo = '".$idEquipo."' ";
		$query = $this->db->prepare($sql);
		$query->execute();
	}


	// Equipos del capitan en los que no esta su contacto.
	public function getEquiposCapitan($idContacto, $idUsuario){
		$query = $this->db->prepare(
			"SELECT DISTINCT Equipo.idEquipo, Equipo.nombre 
			from MiembrosEquipo 
			INNER JOIN Equipo on MiembrosEquipo.idEquipo = Equipo.idEquipo 
			where Equipo.idCapitan = '".$idUsuario."' 
			and MiembrosEquipo.idEquipo not in 
			(SELECT MiembrosEquipo.idEquipo from MiembrosEquipo where MiembrosEquipo.idUsuario = '".$idContacto."')");
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}


	// Desafios del equipo
	public function getDesafiosEquipo($idEquipo){
		$sql = 
		"SELECT Desafio.idRecinto, Recinto.tipo FROM Equipo 
		INNER JOIN Desafio ON Equipo.idEquipo = Desafio.idEquipo 
		INNER JOIN Recinto ON Desafio.idRecinto = Recinto.idRecinto
		WHERE Desafio.idEquipo = '".$idEquipo."'";
		$query = $this->db->prepare($sql);
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}


	/* ADMIN */


		// Obtener equipos
	public function getEquiposAdmin(){
		$query = $this->db->prepare(
			"SELECT 
			Equipo.idEquipo,
			Equipo.nombre,
			Equipo.puntuacion,
			Equipo.partidosDisputados,
			Equipo.partidosCancelados,
			Usuario.nombre as nombreCap,
			Usuario.apellido as apellidoCap
			FROM Equipo
			INNER JOIN Usuario ON Usuario.idUsuario = Equipo.idCapitan"
			);
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}


	public function getDetalleEquipoAdmin($idEquipo){
		$query = $this->db->prepare(
			"SELECT 
			Equipo.idEquipo,
			Equipo.nombre,
			Equipo.puntuacion,
			Equipo.partidosDisputados,
			Equipo.partidosCancelados,
			Usuario.nombre as nombreJugador,
			Usuario.apellido as apellidoJugador,
			Usuario.fotografia,
			Usuario.estado 
			FROM Equipo
			INNER JOIN MiembrosEquipo ON MiembrosEquipo.idEquipo = Equipo.idEquipo
			INNER JOIN Usuario ON Usuario.idUsuario = MiembrosEquipo.idUsuario
			WHERE Equipo.idEquipo = '".$idEquipo."';"
			);
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}

	public function getPartidosEquipo(){
		$consulta = $this->db->prepare("SELECT nombre, count(*) as partidos FROM
			(SELECT Equipo.nombre  FROM EquiposPartido INNER JOIN Partido ON EquiposPartido.idPartido = Partido.idPartido INNER JOIN Equipo ON EquiposPartido.idEquipo = Equipo.idEquipo WHERE estado = 1  

			UNION ALL

			SELECT Equipo.nombre FROM EquiposPartido INNER JOIN Partido ON EquiposPartido.idPartido = Partido.idPartido INNER JOIN Equipo ON EquiposPartido.idEquipo2 = Equipo.idEquipo WHERE estado = 1) AS equipitos GROUP BY(nombre) ORDER BY partidos DESC
			LIMIT 0,10

			");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}

	public function getEdadesEquipo(){
		$consulta= $this->db->prepare("SELECT edadPromedio, COUNT( * ) AS cantidad
				FROM Equipo
				GROUP BY edadPromedio");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}







}


?>