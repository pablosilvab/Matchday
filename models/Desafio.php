
<?php

class Desafio{

	protected $db;

	public function __construct(){
		$this->db = SPDO::singleton();
	}

	// Creacion de un desafio
	public function setDesafio($fechaPartido, $limInf, $limSup, $comentario, $idEquipo, $recinto, $estado){
		$sql = "INSERT INTO Desafio (fecha, limInferior, limSuperior, comentario, idEquipo, idRecinto, estado) 
				VALUES ( (STR_TO_DATE('".$fechaPartido."', '%d-%m-%Y')) , '$limInf',' $limSup', '$comentario', '$idEquipo' ,'$recinto', '$estado');";
				
		$query = $this->db->prepare($sql);
		$query->execute();
	}

	// Obtener un determinado desafio.
	public function getDesafio($idDesafio){
		$query = $this->db->prepare(
			"SELECT Desafio.idDesafio,
			(DATE_FORMAT(Desafio.fecha,'%d-%m-%Y')) as fechaPartido , 
			Recinto.idRecinto, Recinto.fotografia as fotoRecinto, 
			Recinto.nombre as nombreRecinto, 
			Recinto.tipo as tipoPartido, 
			Desafio.comentario, 
			Desafio.idEquipo, 
			Desafio.estado as estadoDesafio,
			Equipo.idEquipo as idEquipoOrganizador, 
			Equipo.idCapitan, 
			Equipo.nombre as nombreEquipo,
			Equipo.color as colorEquipo,
			Usuario.nombre, 
			Usuario.apellido 
			FROM Desafio 
			INNER JOIN Recinto ON Desafio.idRecinto = Recinto.idRecinto  
			INNER JOIN Equipo ON Desafio.idEquipo = Equipo.idEquipo 
			INNER JOIN Usuario ON Usuario.idUsuario = Equipo.idCapitan 
			WHERE Desafio.idDesafio = '".$idDesafio."'
			");
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}


	// Obtener los desafios de los equipos de un usuario.
	public function getDesafios($idUsuario){
		$sql = "SELECT Desafio.idDesafio, 
			(DATE_FORMAT(Desafio.fecha,'%d-%m-%Y')) as fechaPartido , 
			Recinto.nombre as nombreRecinto, 
			Recinto.tipo as tipoPartido, 
			Desafio.comentario,
			Desafio.estado as estadoDesafio, 
			Equipo.nombre as nombreEquipo, 
			Equipo.idEquipo
			FROM Desafio
			INNER JOIN Recinto ON Desafio.idRecinto = Recinto.idRecinto  
			INNER JOIN Equipo ON Desafio.idEquipo = Equipo.idEquipo 
			WHERE Equipo.idCapitan = '".$idUsuario."' 
			AND Desafio.estado != 3 AND Desafio.estado != 4";
		$query = $this->db->prepare($sql);
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}

	// Vestibulo
	public function getDesafiosSistema($idUsuario, $limInf, $limSup){
		$sql = "SELECT Desafio.idDesafio, 
			Desafio.fecha, 
			Desafio.comentario, 
			Desafio.idEquipo, 
			Desafio.estado,
			Equipo.nombre as nombreEquipo, 
			Equipo.puntuacion, 
			Usuario.nombre, 
			Usuario.Apellido 
			FROM Desafio 
			INNER JOIN Equipo ON Desafio.idEquipo = Equipo.idEquipo 
			INNER JOIN Usuario ON Usuario.idUsuario = Equipo.idCapitan 
			WHERE Equipo.idCapitan != '".$idUsuario."' 
			AND Desafio.limInferior >= '".$limInf."' 
			AND Desafio.limSuperior <= '".$limSup."'
			AND Desafio.estado != 3 AND Desafio.estado != 4
			 ";
		$query = $this->db->prepare($sql);
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}



	public function cambiarEstado($idDesafio, $estado){
		$sql = "UPDATE Desafio SET estado = '".$estado."' WHERE idDesafio = '".$idDesafio."' ;";
		$query = $this->db->prepare($sql);
		$query->execute();
	}


	public function getHistorialDesafios($idUsuario){
		$query = $this->db->prepare
		("SELECT Desafio.idDesafio, 
			(DATE_FORMAT(Desafio.fecha,'%d-%m-%Y')) as fechaPartido ,
			Recinto.nombre as nombreRecinto, 
			Recinto.tipo as tipoPartido, 
			Equipo.nombre as equipo1, 
			Encuentro.idEncuentro,
			(select nombre from Equipo where idEquipo = Encuentro.idEquipo) as equipo2
			FROM Desafio
			INNER JOIN Encuentro ON Desafio.idDesafio = Encuentro.idDesafio
			INNER JOIN Recinto ON Desafio.idRecinto = Recinto.idRecinto  
			INNER JOIN Equipo ON Desafio.idEquipo = Equipo.idEquipo 
			WHERE Equipo.idCapitan = '".$idUsuario."' 
			AND Desafio.estado = 3");
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}

	/* Admin */
	public function getDesafiosAdmin(){
		$sql = 
		"SELECT 
		Desafio.idDesafio,
		Desafio.comentario,
		Desafio.estado,
		Equipo.idEquipo,
		Equipo.nombre as nombreEquipo,
		Recinto.nombre as nombreRecinto
		FROM Desafio 
		INNER JOIN Equipo ON Desafio.idEquipo = Equipo.idEquipo
		INNER JOIN Recinto ON Desafio.idRecinto = Recinto.idRecinto";
		$query = $this->db->prepare($sql);
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}



	// Obtener los desafios de los equipos de un usuario.
	public function getDesafiosIndex(){
		$sql = "SELECT * FROM Desafio";
		$query = $this->db->prepare($sql);
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}



}


?>