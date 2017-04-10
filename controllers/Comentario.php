<?php
class Comentario{

	protected $db;
	public function __construct(){
		$this->db = SPDO::singleton();
	}

	public function getComentariosRecinto($idRecinto){
		$consulta = $this->db->prepare('
			SELECT * FROM Comentario WHERE idRecinto = $idRecinto
		');
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
				) 
			");
		$consulta->execute();

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