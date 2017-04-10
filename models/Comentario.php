<?php
class Comentario{

	protected $db;
	public function __construct(){
		$this->db = SPDO::singleton();
	}

	public function getComentariosRecinto($idRecinto){
		$consulta = $this->db->prepare("
						SELECT Comentario.idComentario, Comentario.idRecinto, Comentario.contenido, Comentario.fecha, Comentario.hora, concat(Usuario.nombre,' ',Usuario.apellido) as nombre, concat('assets/images/usuarios/',Usuario.fotografia) as fotografia 
			FROM Comentario INNER JOIN Usuario on Comentario.idUsuario = Usuario.idUsuario WHERE Comentario.idRecinto = '".$idRecinto."' ORDER BY Comentario.idComentario DESC 
		");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}

	public function getComentarios(){
		$consulta = $this->db->prepare('
			SELECT Comentario.idRecinto, Comentario.contenido, Comentario.fecha, Comentario.hora, Usuario.nombre, Usuario.apellido, Usuario.fotografia 
			FROM Comentario INNER JOIN Usuario on Comentario.idUsuario = Usuario.idUsuario ORDER BY idComentario DESC
		');
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}

	public function setComentario($idRecinto, $idUsuario, $contenido){

		$consulta = $this->db->prepare("
			INSERT INTO Comentario (
				idRecinto,
				idUsuario,
				contenido,
				fecha,
				hora
				)VALUES(
				'$idRecinto',
				'$idUsuario',
				'$contenido',
				CURRENT_DATE,
				CURRENT_TIME
				);
				SELECT LAST_INSERT_ID() AS lastId;
			");
		$consulta->execute();
		$resultado = $this->db->lastInsertId();

		$consulta = $this->db->prepare("SELECT Comentario.idComentario, Comentario.idRecinto, Comentario.contenido, Comentario.fecha, Comentario.hora, concat(Usuario.nombre,' ',Usuario.apellido) as nombre, concat('assets/images/usuarios/',Usuario.fotografia) as fotografia 
			FROM Comentario INNER JOIN Usuario on Comentario.idUsuario = Usuario.idUsuario WHERE Comentario.idComentario = '".$resultado."'");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;

	}

	public function deleteComentario($idRecinto, $idUsuario){
		$consulta = $this->db->prepare('
			DELETE FROM Comentario WHERE idRecinto = $idRecinto AND idUsuario = $idUsuario
			');
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}

	/* Modulo de administración */
	public function getComentariosAdmin(){
		$consulta = $this->db->prepare(
			"SELECT 
			Comentario.idComentario, 
			Comentario.idRecinto, 
			Comentario.contenido, 
			(DATE_FORMAT(Comentario.fecha,'%d-%m-%Y')) as fecha , 
			Comentario.hora, 
			Recinto.nombre as nombreRecinto,
			Usuario.nombre,
			Usuario.apellido, 
			Usuario.fotografia 
			FROM Comentario 
			INNER JOIN Usuario on Comentario.idUsuario = Usuario.idUsuario
			INNER JOIN Recinto on Comentario.idRecinto = Recinto.idRecinto
		");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}


	public function eliminarComentario($idComentario){
		$consulta = $this->db->prepare(
			"DELETE FROM Comentario WHERE idComentario = '".$idComentario."'
			");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}



}
?>