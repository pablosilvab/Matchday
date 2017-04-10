<?php
class Horario{
	protected $db;
	public function __construct(){
		$this->db = SPDO::singleton();
	}

	public function getHorariosRecinto($idRecinto){
		$consulta = $this->db->prepare("
			SELECT idHorario, DATE_FORMAT(horaInicio,'%l:%i %p') as horaInicio, DATE_FORMAT(horaFin,'%l:%i %p') as horaFin, horaInicio as HI, horaFin as HF, nombre, dias, precio, idRecinto FROM Horario WHERE idRecinto = '$idRecinto';
			");
		$consulta->execute();
		$resultado	=	$consulta->fetchAll();
		return $resultado;
	}

	public function getHorario($idHorario){
		$consulta = $this->db->prepare("SELECT * FROM Horario WHERE idHorario = '$idHorario' ;");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}

	public function setHorarioRecinto($horaInicio, $horaFin, $nombre, $dias, $precio, $idRecinto){
		$consulta = $this->db->prepare(
			"INSERT INTO Horario (
				horaInicio,
				horaFin,
				nombre,
				dias,
				precio,
				idRecinto
				)VALUES(
				'$horaInicio',
				'$horaFin',
				'$nombre',
				'$dias',
				'$precio',
				'$idRecinto'
				)");
		$consulta->execute();
	}

	public function eliminarHorarioRecinto($idRecinto, $idHorario){
		$consulta = $this->db->prepare(
			"DELETE FROM Horario WHERE idRecinto = '".$idRecinto."' AND idHorario = '".$idHorario."'
			");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}

	public function actualizarHorarioRecinto($idHorario, $horaInicio, $horaFin, $nombre, $dias, $precio){
		$sql = "UPDATE Horario 
		SET 
		horaInicio = '".$horaInicio."',
		horaFin = '".$horaFin."', 
		nombre = '".$nombre."', 
		dias = '".$dias."', 
		precio = '".$precio."'
		WHERE idHorario = '".$idHorario."' ";
		$query = $this->db->prepare($sql);
		$query->execute();
	}

}
?>