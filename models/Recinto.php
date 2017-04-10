<?php
class Recinto{

	protected $db;
	public function __construct(){
		$this->db = SPDO::singleton();
	}

	public function getRecintos(){
		$consulta = $this->db->prepare('SELECT * FROM Recinto');
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}

	public function getRecinto($idRecinto){
		$consulta = $this->db->prepare("
			SELECT * FROM Recinto WHERE idRecinto = '".$idRecinto."' ");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;

	}
	//`idRecinto`, `nombre`, `tipo`, `superficie`, `direccion`, `numeroCanchas`, `telefono`, `fotografia`, `puntuacion`, `estado`, `idUsuario
	public function setSolicitud($nombre, $fono, $direccion, $idUsuario){
		$consulta = $this->db->prepare(
			"INSERT INTO Recinto (
				nombre,
				direccion,
				telefono,
				estado,
				idUsuario) 
				 VALUES (
				'$nombre',
				'$direccion',
				'$fono',
				'2',
				'$idUsuario'
				)");
		$consulta->execute();
	}


	public function updateRecinto($idRecinto,$nombre,$tipo,$superficie,$direccion,$numeroCanchas,$telefono,$fotografia,$puntuacion,$estado,$idUsuario){

		$consulta = $this->db->prepare(
			"UPDATE Recinto SET 
			nombre 		 = '$nombre',
			tipo 		 = '$tipo',
			superficie	 = '$superficie',
			direccion	 = '$direccion',
			numeroCanchas= '$numeroCanchas',
			telefono	 = '$telefono',
			fotografia	 = '$fotografia',
			puntuacion	 = '$puntuacion',
			estado	 	 = '$estado',
			idUsuario	 = '$idUsuario'");
		
		$consulta->execute();
	}

	public function updatePuntuacionRecinto($idRecinto, $puntuacion){
		$consulta = $this->db->prepare("
			UPDATE Recinto SET puntuacion = '$puntuacion' WHERE idRecinto = '$idRecinto';
			");
		$consulta->execute();
	}


	public function getRecintosActivos(){
		$consulta = $this->db->prepare('SELECT * FROM Recinto WHERE estado = 1');
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;	
	} 

	public function getDireccionRecinto($idRecinto){
		$consulta = $this->db->prepare("SELECT nombre, direccion FROM Recinto WHERE idRecinto = '".$idRecinto."' ");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;	
	}



	/* Admin */
	public function cambiarEstadoRecinto($idRecinto, $estado){
		$sql = "UPDATE Recinto SET 
			estado = '".$estado."'
			WHERE idRecinto = '".$idRecinto."'";
		$query = $this->db->prepare($sql);
		$query->execute();
	}

	public function actualizarRecinto($idRecinto, $nombre, $tipo, $superficie, $direccion, $telefono){
		$consulta = $this->db->prepare(
			"UPDATE Recinto SET 
			nombre 		 = '$nombre',
			tipo 		 = '$tipo',
			superficie	 = '$superficie',
			direccion	 = '$direccion',
			telefono	 = '$telefono'
			WHERE idRecinto = '$idRecinto'");
		
		$consulta->execute();
	}

	public function setRecinto($nombre,$tipo,$superficie,$direccion,$telefono,$estado, $puntuacion, $idUsuario){
		$consulta = $this->db->prepare(
			"INSERT INTO Recinto (
				nombre,
				tipo,
				superficie,
				direccion,
				telefono,
				estado,
				puntuacion,
				idUsuario) VALUES (
				'".$nombre."',
				'".$tipo."',
				'".$superficie."',
				'".$direccion."',
				'".$telefono."',
				'".$estado."',
				'".$puntuacion."',
				'".$idUsuario."');
		SELECT LAST_INSERT_ID() AS lastId;
		");
		$consulta->execute();
	}

	public function eliminarRecinto($idNuevoRecinto){
		$consulta = $this->db->prepare(
			"DELETE FROM Recinto WHERE idRecinto = '".$idNuevoRecinto."'
			");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;	
	}

	public function setFotografia($idRecinto, $imagen){
		$sql = "UPDATE Recinto SET fotografia = '".$imagen."' WHERE idRecinto = '".$idRecinto."' ";
		$query = $this->db->prepare($sql);
		$query->execute();
	}

	public function getNotificacionesRecintos($idUsuario){
		$consulta = $this->db->prepare("SELECT idRecinto FROM Recinto WHERE idUsuario != '".$idUsuario."' ");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;	
	} 

	public function getRecintosAdmin(){
		$consulta = $this->db->prepare('SELECT * FROM Recinto WHERE idUsuario = 5');
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}

	public function getRecintosNotificados(){
		$consulta = $this->db->prepare('SELECT * FROM Recinto WHERE idUsuario != 5');
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}


	public function eliminarNotificacion($idRecinto){
		$consulta = $this->db->prepare(
			"DELETE FROM Recinto WHERE idRecinto = '".$idRecinto."'
			");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}

	public function registrarNotificacion($idRecinto, $nombre, $tipo, $superficie, $direccion, $telefono,$estado, $idUsuario){
		$consulta = $this->db->prepare(
			"UPDATE Recinto SET 
			nombre 		 = '$nombre',
			tipo 		 = '$tipo',
			superficie	 = '$superficie',
			direccion	 = '$direccion',
			telefono	 = '$telefono',
			estado		 = '$estado',
			idUsuario	 = '$idUsuario'
			WHERE idRecinto = '$idRecinto'");
		
		$consulta->execute();
	}

	public function getPartidosRecinto(){
		$consulta = $this->db->prepare("
			SELECT nombre, COUNT( * ) AS cantidad
			FROM Recinto
			INNER JOIN Partido ON Recinto.idRecinto = Partido.idRecinto
			WHERE Partido.estado =2
			GROUP BY Partido.idRecinto
			ORDER BY cantidad DESC
			LIMIT 0 , 10;
			");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}

	public function getSuperficiesRecinto(){
		$consulta= $this->db->prepare("SELECT superficie, count(*) as cantidad FROM Recinto WHERE idUsuario = 5 GROUP BY superficie ORDER BY cantidad DESC LIMIT 0,10");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}
	public function getPreciosMaxRecinto(){
		$consulta= $this->db->prepare("SELECT h.precio, count(*) as cantidad FROM Recinto R1 INNER JOIN (SELECT DISTINCT h1.idRecinto, h1.precio FROM Horario h1 INNER JOIN Horario h2 ON h1.precio > h2.precio GROUP BY h1.idRecinto) as h ON R1.idRecinto = h.idRecinto 
			WHERE idUsuario = 5
			GROUP BY h.precio ORDER BY h.precio DESC 
		");
		$consulta->execute();
		$resultado= $consulta->fetchAll();
		return $resultado;
	}

	public function getPreciosMinRecinto(){
		$consulta= $this->db->prepare("SELECT h.precio, count(*) as cantidad FROM Recinto R1 INNER JOIN (SELECT DISTINCT h1.idRecinto, h1.precio FROM Horario h1 INNER JOIN Horario h2 ON h1.precio < h2.precio GROUP BY h1.idRecinto) as h ON R1.idRecinto = h.idRecinto 
			WHERE idUsuario = 5
			GROUP BY h.precio ORDER BY h.precio DESC 
		");
		$consulta->execute();
		$resultado= $consulta->fetchAll();
		return $resultado;
	}

	public function getComentariosRecinto(){
		$consulta = $this->db->prepare("SELECT nombre, count(*) AS cantidad FROM Recinto JOIN Comentario ON Recinto.idRecinto=Comentario.idRecinto GROUP BY nombre");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}

	public function getTiposRecinto(){
		$consulta = $this->db->prepare("SELECT tipo, count(*) as cantidad FROM Recinto  WHERE idUsuario = 5 GROUP BY tipo ORDER BY cantidad DESC");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}



}
?>