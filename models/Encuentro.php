
<?php

class Encuentro{

	protected $db;

	public function __construct(){
		$this->db = SPDO::singleton();
	}

	//	Obtener respuestas de un desafio
	public function getEncuentrosSistema(){
		$sql = "SELECT *
			FROM Encuentro 
			";
		$query = $this->db->prepare($sql);
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}

	//	Obtener respuestas de un desafio
	public function getEncuentros($idDesafio){
		$sql = "SELECT DISTINCT
		Desafio.idDesafio,
		Desafio.estado,
		Desafio.fecha as fechaPartido,
		Desafio.comentario, 
		Encuentro.idEncuentro,
		Encuentro.estadoSolicitud,
		Equipo.idEquipo , 
		Encuentro.idDesafio,  
		Recinto.nombre as nombreRecinto, 
		Recinto.fotografia as fotoRecinto,
		Recinto.tipo as tipoPartido, 
		Equipo.nombre as nombreEquipo, 
		Usuario.nombre as nombreCap, 
		Usuario.apellido as apellidoCap, 
		Usuario.fotografia, 
		Equipo.puntuacion, 
		Equipo.edadPromedio 
			FROM Encuentro 
			INNER JOIN Desafio on Encuentro.idDesafio = Desafio.idDesafio 
			INNER JOIN Recinto on Desafio.idRecinto = Recinto.idRecinto
			INNER JOIN Equipo on Equipo.idEquipo = Encuentro.idEquipo 
			INNER JOIN Usuario on Equipo.idCapitan = Usuario.idUsuario
			WHERE Encuentro.idDesafio = '".$idDesafio."' ";
		$query = $this->db->prepare($sql);
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}




	// Obtener los desafios de un equipo
	public function getRespuestas($idDesafio){
		$query = $this->db->prepare("SELECT Encuentro.estadoSolicitud as estadoSolicitud 
			FROM Desafio 
			INNER JOIN Encuentro ON Desafio.idDesafio = Encuentro.idDesafio
			WHERE Desafio.idDesafio = '".$idDesafio."'");
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}

	// Guardar el desafio realizado por un equipo (En el vestibulo)
	public function setEncuentro($idDesafio, $idEquipo, $respuesta, $estado){
		$sql = "INSERT INTO Encuentro (idDesafio, idEquipo, respuesta, estadoSolicitud) 
			VALUES ('".$idDesafio."', '".$idEquipo."' , '".$respuesta."', '".$estado."');";
		$query = $this->db->prepare($sql);
		$query->execute();
	}

	// Verificar la existencia de un encuentro
	public function verificarEncuentro($idEquipo, $idDesafio){
		$sql = "SELECT * FROM Encuentro WHERE idEquipo = '".$idEquipo."' AND idDesafio = '".$idDesafio."'";
		$query = $this->db->prepare($sql);
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}

	public function eliminarEncuentros($idDesafio, $idEquipo){
		$sql = "DELETE FROM Encuentro WHERE idDesafio = '".$idDesafio."' and idEquipo != '".$idEquipo."';";
		$query = $this->db->prepare($sql);
		$query->execute();
	}


	public function cambiarEstado($idDesafio, $estado){
		$sql = "UPDATE Encuentro SET estadoSolicitud = '".$estado."' WHERE idDesafio = '".$idDesafio."' ;";
		$query = $this->db->prepare($sql);
		$query->execute();
	}

	public function cambiarEstadoEncuentro($idEncuentro, $estadoDesafio){
		$sql = "UPDATE Encuentro SET estadoSolicitud = '".$estadoDesafio."' WHERE idEncuentro = '".$idEncuentro."' ;";
		$query = $this->db->prepare($sql);
		$query->execute();
	}

	public function getSolicitudes($idUsuario){
		$sql = "SELECT Encuentro.idEncuentro, Encuentro.idDesafio, 
			(DATE_FORMAT(Desafio.fecha,'%d-%m-%Y')) as fechaPartido , 
			Recinto.nombre as nombreRecinto,
			Recinto.tipo as tipoPartido, Equipo.nombre as equipo1, 
			(select nombre from Equipo where idEquipo = Desafio.idEquipo) as equipo2, 
			Encuentro.estadoSolicitud 
			from Encuentro 
			INNER JOIN Desafio on Encuentro.idDesafio = Desafio.idDesafio 
			INNER JOIN Recinto on Recinto.idRecinto = Desafio.idRecinto 
			INNER JOIN Equipo on Encuentro.idEquipo = Equipo.idEquipo 
			WHERE Equipo.idCapitan= '".$idUsuario."' ;";
		$query = $this->db->prepare($sql);
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}

	public function getEncuentro($idEncuentro){
		$sql = "SELECT Encuentro.idEncuentro, 
		Encuentro.idDesafio, 
		Encuentro.respuesta,
		Encuentro.idEquipo as idEquipo1,
		(DATE_FORMAT(Desafio.fecha,'%d-%m-%Y')) as fechaPartido , 
		Desafio.comentario,
		Recinto.idRecinto,
		Recinto.tipo as tipoPartido,
		Recinto.fotografia as fotoRecinto, 
		Recinto.nombre as nombreRecinto, 
		Equipo.idEquipo,
		Equipo.nombre as equipo1,
		(select idEquipo from Equipo where idEquipo = Desafio.idEquipo) as idEquipo2,
		(select nombre from Equipo where idEquipo = Desafio.idEquipo) as equipo2,
		(select idCapitan from Equipo where idEquipo = Desafio.idEquipo) as idOrganizador, 
		Encuentro.estadoSolicitud 
		from Encuentro 
		INNER JOIN Desafio on Encuentro.idDesafio = Desafio.idDesafio 
		INNER JOIN Recinto on Desafio.idRecinto = Recinto.idRecinto
		INNER JOIN Equipo on Encuentro.idEquipo = Equipo.idEquipo WHERE Encuentro.idEncuentro= '".$idEncuentro."';";
		//echo $sql;
		$query = $this->db->prepare($sql);
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}


	public function getEncuentroAcordado($idDesafio){
		$sql = "SELECT 
		Equipo.idEquipo as idRival ,
		Equipo.nombre as nombreEquipo2,
		Encuentro.respuesta
		from Encuentro 
		INNER JOIN Desafio on Encuentro.idDesafio = Desafio.idDesafio 
		INNER JOIN Equipo on Encuentro.idEquipo = Equipo.idEquipo WHERE Encuentro.idDesafio= '".$idDesafio."';";
		//echo $sql;
		$query = $this->db->prepare($sql);
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}


	public function cancelarEncuentro($idEncuentro){
		$sql = 
			"DELETE FROM Encuentro WHERE idEncuentro = '".$idEncuentro."';";
		$query = $this->db->prepare($sql);
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}


}


?>