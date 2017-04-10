<?php
class Partido{

	protected $db;
	public function __construct(){
		$this->db = SPDO::singleton();
	}

	public function getPartidos(){
		$consulta = $this->db->prepare("
			SELECT * FROM Partido;
			");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}

	public function getPartido($idPartido){
		$consulta = $this->db->prepare("
			SELECT * FROM Partido WHERE idPartido = '$idPartido';
			");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;


	}

	//PARTIDOS JUGADOS DEL USUARIO
	public function getPartidosUsuario($idUsuario){
		$consulta = $this->db->prepare("SELECT JugadoresPartido.idPartido, Partido.idRecinto FROM JugadoresPartido INNER JOIN Partido on JugadoresPartido.idPartido = Partido.idPartido WHERE Partido.estado = 2 AND JugadoresPartido.idUsuario = '$idUsuario'");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}

	public function setJugadoresPartidoPropio($idPartido, $idUsuario, $equipo, $color){
		$consulta = $this->db->prepare("
			INSERT INTO JugadoresPartido (
				idPartido, idUsuario, equipo, color1, estado) 
				VALUES
				('$idPartido',
				'$idUsuario',
				'$equipo',
				'$color',
				'0'
				);
			");
		$consulta->execute();
	}

	public function setJugadoresRevuelta($idPartido, $idUsuario, $color, $color2){
		$consulta = $this->db->prepare("
			INSERT INTO JugadoresPartido (
				idPartido, idUsuario, color1, color2, estado) 
				VALUES
				('$idPartido',
				'$idUsuario',
				'$color',
				'$color2',
				'0'
				);
			");
		$consulta->execute();
	}
	public function setJugadoresAB($idPartido, $idUsuario, $equipo, $color){
		$consulta = $this->db->prepare("
			INSERT INTO JugadoresPartido 
			(idPartido, 
			 idUsuario, 
			 equipo, 
			 color1, 
			 estado)
			VALUES(
			'$idPartido',
			'$idUsuario',
			'$equipo',
			'".$color."',
			'0'
			);
			");
		$consulta->execute();
	}



	public function setJugadoresPartidoPropioCapitan($idPartido, $idUsuario, $equipo, $color){
		$consulta = $this->db->prepare("
			INSERT INTO JugadoresPartido (
				idPartido, idUsuario, equipo, color1, estado) 
				VALUES
				('$idPartido',
				'$idUsuario',
				'$equipo',
				'$color',
				'1'
				);
			");
		$consulta->execute();
	}

	public function setJugadoresRevueltaCapitan($idPartido, $idUsuario, $color, $color2){
		$consulta = $this->db->prepare("
			INSERT INTO JugadoresPartido (
				idPartido, idUsuario, color1, color2, estado) 
				VALUES
				('$idPartido',
				'$idUsuario',
				'$color',
				'$color2',
				'1'
				);
			");
		$consulta->execute();
	}
	public function setJugadoresABCapitan($idPartido, $idUsuario, $equipo, $color){
		$consulta = $this->db->prepare("
			INSERT INTO JugadoresPartido 
			(idPartido, 
			 idUsuario, 
			 equipo, 
			 color1, 
			 estado)
			VALUES(
			'$idPartido',
			'$idUsuario',
			'$equipo',
			'".$color."',
			'1'
			);
			");
		$consulta->execute();
	}



	public function setPartido($idOrganizador,$fecha, $hora, $cuota, $tipo, $estado, $idRecinto, $cantidad){
		$consulta= $this->db->prepare("
			INSERT INTO Partido (
				idOrganizador,
				fecha,
				hora,
				cuota,
				tipo,
				estado,
				idRecinto,
				nroJugadores
				)
			VALUES(
				'$idOrganizador',
				'$fecha',
				'$hora',
				'$cuota',
				'$tipo',
				'$estado',
				'$idRecinto',
				'$cantidad'
				);
			SELECT LAST_INSERT_ID() AS lastId;
				");
		$consulta->execute();
		$resultado= $this->db->lastInsertId();

		return $resultado;
	}

	public function getJugadoresPartido($idPartido){
		$consulta = $this->db->prepare(
			"SELECT Usuario.nombre,
			 Usuario.apellido, 
			 Usuario.nickname, 
			 Usuario.fotografia, 
			 Usuario.mail,
			 JugadoresPartido.equipo,
			 JugadoresPartido.color1,
			 JugadoresPartido.color2,
			 Usuario.estado,
			 Usuario.password

			FROM JugadoresPartido 
			INNER JOIN Usuario on JugadoresPartido.idUsuario = Usuario.idUsuario 
			WHERE idPartido='$idPartido'");
		$consulta->execute();
		$resultado=$consulta->fetchAll();
		return $resultado;
	}

	public function getTipoPartido($idPartido){
		$consulta = $this->db->prepare(
			"SELECT tipo
			FROM Partido
			WHERE idPartido='$idPartido'");
		$consulta->execute();
		$resultado=$consulta->fetchAll();
		return $resultado;
	}

	public function setPartidoDesafio($idOrganizador,$fecha, $hora, $cuota, $tipo, $estado, $idRecinto, $nroJugadores){
		$consulta= $this->db->prepare(
			"INSERT INTO Partido (
				idOrganizador,
				fecha,
				hora,
				cuota,
				tipo,
				estado,
				idRecinto,
				nroJugadores)
			VALUES(
				'$idOrganizador',
				(STR_TO_DATE('".$fecha."', '%d-%m-%Y')),
				'$hora',
				'$cuota',
				'$tipo',
				'$estado',
				'$idRecinto',
				'$nroJugadores'
				);
			SELECT LAST_INSERT_ID() AS lastId;
				");
		$consulta->execute();
		$resultado= $this->db->lastInsertId();

		return $resultado;
	}

	public function setEquiposDesafio($ultimoPartido, $idEquipoOrganizador, $idRival){
		$consulta= $this->db->prepare(
			"INSERT INTO EquiposPartido (
				idPartido,
				idEquipo,
				idEquipo2)
			VALUES(
				'$ultimoPartido',
				'$idEquipoOrganizador',
				'$idRival'
				);
			SELECT LAST_INSERT_ID() AS lastId;
				");
		$consulta->execute();
		$resultado= $this->db->lastInsertId();

		return $resultado;
	}


	public function getPartidosPendientes($idUsuario){
		$consulta = $this->db->prepare(
			"SELECT 
			Usuario.nombre as nombreCap, 
			Usuario.apellido as apellidoCap, 
			Partido.idPartido, 
			DATE_FORMAT(Partido.fecha,'%d-%m-%Y') as fechaPartido, 
			DATE_FORMAT(Partido.hora,'%l:%i %p') as horaPartido,
			Recinto.nombre 
			FROM Partido 
			JOIN Recinto ON Partido.idRecinto = Recinto.idRecinto
			JOIN Usuario ON Partido.idOrganizador = Usuario.idUsuario
			WHERE Partido.estado=4
			AND Partido.idOrganizador = '".$idUsuario."'");
		$consulta->execute();
		$resultado=$consulta->fetchAll();
		return $resultado;
	}


	public function getPartidosOrganizador($idUsuario){
		$consulta = $this->db->prepare(
			"SELECT 
			Usuario.nombre as nombreCap, 
			Usuario.apellido as apellidoCap, 
			Partido.idPartido, 
			Partido.estado,
			Partido.tipo as tipoPartido,
			Partido.fecha as fechaPartido, 
			DATE_FORMAT(Partido.hora,'%l:%i %p') as horaPartido,
			Recinto.nombre 
			FROM Partido 
			JOIN Recinto ON Partido.idRecinto = Recinto.idRecinto
			JOIN Usuario ON Partido.idOrganizador = Usuario.idUsuario
			WHERE Partido.idOrganizador = '".$idUsuario."'
			AND Partido.estado != 2 AND Partido.estado !=3 ");
		$consulta->execute();
		$resultado=$consulta->fetchAll();
		return $resultado;
	}


	public function getPartidosSistema($idUsuario){
		$consulta = $this->db->prepare(
			"SELECT DISTINCT 
			Usuario.nombre as nombreCap, 
			Usuario.apellido as apellidoCap,
			Partido.idPartido as idPartido1, 
			DATE_FORMAT(Partido.fecha,'%d-%m-%Y') as fechaPartido, 
			DATE_FORMAT(Partido.hora,'%l:%i %p') as horaPartido,
			Recinto.nombre,
            (SELECT SolicitudParticipacion.estado FROM SolicitudParticipacion 
            LEFT OUTER JOIN Usuario ON Usuario.idUsuario = SolicitudParticipacion.idUsuarioSolicitante
            WHERE Usuario.idUsuario = '".$idUsuario."' AND SolicitudParticipacion.idPartido = idPartido1) as estadoSolicitud
			FROM Partido 
			JOIN Recinto ON Partido.idRecinto = Recinto.idRecinto
			JOIN Usuario ON Partido.idOrganizador = Usuario.idUsuario
			WHERE Partido.estado=5 AND Partido.idOrganizador != '".$idUsuario."'
			");
		$consulta->execute();
		$resultado=$consulta->fetchAll();
		return $resultado;
	}

	public function getResumenPartido($idPartido){
		$sql = "SELECT 
		Partido.idPartido,
		Partido.idOrganizador,
		DATE_FORMAT(Partido.fecha,'%d-%m-%Y') as fechaPartido, 
		DATE_FORMAT(Partido.hora,'%l:%i %p') as horaPartido,
		Partido.cuota,
		Partido.tipo as tipoPartido,
		Recinto.tipo, 
		Partido.estado,
		Partido.idRecinto,
		Recinto.nombre,
		Recinto.fotografia,
		Usuario.nombre as nombreCap,
		Usuario.apellido as apellidoCap
		FROM Partido
		JOIN Recinto ON Partido.idRecinto = Recinto.idRecinto
		JOIN Usuario ON Partido.idOrganizador = Usuario.idUsuario
		WHERE idPartido = '".$idPartido."';";
		$consulta = $this->db->prepare($sql);
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;		
	}


	public function eliminarJugadoresPartido($idPartido){
		$sql = "DELETE FROM JugadoresPartido WHERE idPartido = '".$idPartido."';";
		$query = $this->db->prepare($sql);
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}

	public function cambiarEstado($idPartido, $estado){
		$sql = "UPDATE Partido SET estado = '".$estado."' WHERE idPartido = '".$idPartido."' ;";
		$query = $this->db->prepare($sql);
		$query->execute();
	}

	public function agregarSolicitud($idUsuario, $idPartido, $estadoSolicitud, $tipoSolicitud){
		$sql = 
		"INSERT INTO SolicitudParticipacion (idUsuarioSolicitante, idPartido, estado, tipo) 
		VALUES ('".$idUsuario."','".$idPartido."','".$estadoSolicitud."','".$tipoSolicitud."');
		";
		$query = $this->db->prepare($sql);
		$query->execute();
	}


	public function obtenerSolicitudes($idPartido){
		$sql = "SELECT 
		Usuario.idUsuario, 
		Usuario.nombre,
		Usuario.apellido,
		Usuario.fechaNacimiento,
		Usuario.telefono,
		SolicitudParticipacion.estado
		FROM Usuario
		JOIN SolicitudParticipacion ON Usuario.idUsuario = SolicitudParticipacion.idUsuarioSolicitante
		WHERE SolicitudParticipacion.idPartido = '".$idPartido."' 
		AND SolicitudParticipacion.estado != 3 ;";
		$consulta = $this->db->prepare($sql);
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;	
	}

	public function cambiarEstadoSolicitud($idPartido, $idUsuario, $respuesta){
		$sql = "UPDATE SolicitudParticipacion SET estado = '".$respuesta."' 
		WHERE idPartido = '".$idPartido."' AND idUsuarioSolicitante = '".$idUsuario."' ;";
		$query = $this->db->prepare($sql);
		$query->execute();
	}

	public function agregarJugador($idPartido, $idUsuario, $estado){
		$sql = 
		"INSERT INTO JugadoresPartido (idPartido, idUsuario, estado) 
		VALUES ('".$idPartido."','".$idUsuario."','".$estado."');
		";
		$query = $this->db->prepare($sql);
		$query->execute();
	}


	public function jugadoresPartidoDesdeDesafio($idUsuario, $idPartido){
		$sql = 
		"INSERT INTO JugadoresPartido (idPartido, idUsuario, estado) 
		VALUES ('".$idPartido."','".$idUsuario."','1');
		";
		$query = $this->db->prepare($sql);
		$query->execute();
	}







	public function getHorasPartido(){
		$consulta = $this->db->prepare("SELECT hora, COUNT(*) AS cantidad
					FROM Partido
					GROUP BY hora
					ORDER BY hora");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}

	public function getEstadosPartido(){
		$consulta = $this->db->prepare("SELECT estado, count(*) as cantidad FROM Partido 
				WHERE estado = 1 or estado = 2 or estado = 3
				group by estado 
			");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}
	public function getDiasPartido(){
		$consulta = $this->db->prepare("SELECT CONCAT(ELT(WEEKDAY(fecha) + 1, 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo')) AS dia, count(*) as cantidad FROM Partido WHERE estado = 2  GROUP BY dia");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}

	public function getEquiposPartido($idPartido){
		$consulta = $this->db->prepare("SELECT * FROM EquiposPartido WHERE idPartido = '".$idPartido."' ;");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}


	public function getInvitacionesPartido($idPartido){
		$consulta = $this->db->prepare(
			"SELECT 
			Usuario.nombre,
			Usuario.apellido,
			Usuario.fotografia,
			Usuario.estado as estadoJugador,
			Partido.nroJugadores,
			Partido.estado as estadoPartido,
			Partido.tipo as tipoPartido,
			JugadoresPartido.estado 
			FROM Partido 
			INNER JOIN JugadoresPartido ON Partido.idPartido = JugadoresPartido.idPartido 
			INNER JOIN Usuario ON JugadoresPartido.idUsuario = Usuario.idUsuario
			WHERE Partido.idPartido = '".$idPartido."' 
			ORDER BY JugadoresPartido.estado ;"
			);
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}


	public function getPartidoInvitado($idUsuario){
		$consulta = $this->db->prepare(
			"SELECT * FROM Partido 
			INNER JOIN JugadoresPartido 
			ON Partido.idPartido = JugadoresPartido.idPartido 
			WHERE JugadoresPartido.idUsuario = '".$idUsuario."';");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}

	public function cambiarEstadoInvitacionPartido($idPartido, $idInvitado, $estado){
		$sql = "UPDATE JugadoresPartido SET estado = '".$estado."' 
		WHERE idPartido = '".$idPartido."' AND idUsuario = '".$idInvitado."';";
		$query = $this->db->prepare($sql);
		$query->execute();
	}



	public function getPartidosInvitado($idUsuario){
		$consulta = $this->db->prepare(
			"SELECT 
			Usuario.nombre as nombreCap, 
			Usuario.apellido as apellidoCap, 
			Partido.fecha, 
			DATE_FORMAT(Partido.hora,'%l:%i %p') as horaPartido,
			Partido.cuota, 
			Recinto.nombre as nombreRecinto, 
			Partido.idPartido,
			JugadoresPartido.estado as estadoInvitacion,
			Partido.estado as estadoPartido
			FROM Partido
			INNER JOIN JugadoresPartido ON Partido.idPartido = JugadoresPartido.idPartido
			INNER JOIN Usuario ON Partido.idOrganizador = Usuario.idUsuario
			INNER JOIN Recinto ON Recinto.idRecinto = Partido.idRecinto
			WHERE (JugadoresPartido.idUsuario = '".$idUsuario."') 
			AND (Partido.estado = 1 OR  Partido.estado = 4 OR Partido.estado = 5)
			AND (Partido.idOrganizador != '".$idUsuario."');");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}

	public function getProximosPartidosUsuario($idUsuario){
		$consulta = $this->db->prepare(
			"SELECT 
			Partido.fecha, 
			DATE_FORMAT(Partido.hora,'%l:%i %p') as horaPartido,
			Recinto.nombre as nombreRecinto, 
			Recinto.tipo as tipoRecinto,
			Partido.idPartido,
			JugadoresPartido.estado as estadoInvitacion,
			Partido.estado as estadoPartido
			FROM Partido
			INNER JOIN JugadoresPartido ON Partido.idPartido = JugadoresPartido.idPartido
			INNER JOIN Recinto ON Recinto.idRecinto = Partido.idRecinto
			WHERE (JugadoresPartido.idUsuario = '".$idUsuario."') 
			AND (Partido.estado = 1 OR Partido.estado = 4 OR Partido.estado = 5)
			AND (JugadoresPartido.estado !=2);");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}

	public function getPartidosCalendario(){
		$consulta = $this->db->prepare("
			SELECT Partido.estado, Partido.fecha as fecha, Recinto.tipo as tipo 
FROM Partido
INNER JOIN Recinto ON Partido.idRecinto = Recinto.idRecinto
			");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;

	}

}
?>