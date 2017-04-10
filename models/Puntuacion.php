<?php
class Puntuacion{

	protected $db;
	public function __construct(){
		$this->db = SPDO::singleton();
	}

	public function getPuntuaciones($idUsuario){
		$consulta = $this->db->prepare(
			"SELECT Puntuacion.idRecinto, Puntuacion.idUsuario, Puntuacion.valoracion FROM Puntuacion INNER JOIN Usuario ON Puntuacion.idUsuario = Usuario.idUsuario WHERE Puntuacion.idUsuario = $idUsuario "
			);
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}


	public function getPuntuacionRecinto($idRecinto){

		$consulta = $this->db->prepare(
			'SELECT * FROM Puntuacion WHERE idRecinto = $idRecinto'
			);
		$consulta->execute;
		$resultado = $consulta->fetchAll();
		return $resultado;
	}

	public function setPuntuacion($idRecinto,$idUsuario,$valoracion){
		$consulta = $this->db->prepare("INSERT INTO Puntuacion (
				idRecinto,
				idUsuario,
				valoracion
			) VALUES(
				'$idRecinto',
				'$idUsuario',
				'$valoracion'
			)");
		$consulta->execute();
	}
	public function deletePuntuacion($idRecinto,$idUsuario){
		$consulta = $this->db->prepare("DELETE FROM Puntuacion WHERE idRecinto= '$idRecinto' AND idUsuario='$idUsuario'");
		$consulta->execute();
	}

	public function getPuntuacionTotalRecinto($idRecinto){

		$consulta = $this->db->prepare("
		SELECT AVG(valoracion) as puntuacion FROM Puntuacion WHERE idRecinto = '$idRecinto'
			");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}


}

?>