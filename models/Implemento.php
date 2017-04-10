<?php
class Implemento{

	protected $db;
	public function __construct(){
		$this->db = SPDO::singleton();
	}

	public function getImplementosRecinto($idRecinto){
		$consulta = $this->db->prepare("
			SELECT * FROM Implemento WHERE idRecinto = '$idRecinto';
			");
		$consulta->execute();
		$resultado= $consulta->fetchAll();
		return $resultado;
	}

	public function getImplementos(){

	}
	public function setImplemento(){
	}

	public function deleteImplemento(){
	}


	public function getImplemento($idImplemento){
		$consulta = $this->db->prepare("
			SELECT * FROM Implemento WHERE idImplemento = '".$idImplemento."';
			");
		$consulta->execute();
		$resultado= $consulta->fetchAll();
		return $resultado;
	}


	public function agregarImplementoRecinto($nombre, $precio, $idRecinto){
		$consulta = $this->db->prepare(
			"INSERT INTO Implemento (
				nombre,
				precio,
				idRecinto
				)VALUES(
				'$nombre',
				'$precio',
				'$idRecinto'
				)");
		$consulta->execute();
	}

	public function eliminarImplementoRecinto($idRecinto, $idImplemento){
		$consulta = $this->db->prepare(
			"DELETE FROM Implemento WHERE idRecinto = '".$idRecinto."' AND idImplemento = '".$idImplemento."'
			");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}

	public function actualizarImplementoRecinto($idImplemento, $nombre, $precio){
		$sql = "UPDATE Implemento 
		SET 
		nombre = '".$nombre."', 
		precio = '".$precio."'
		WHERE idImplemento = '".$idImplemento."' ";
		$query = $this->db->prepare($sql);
		$query->execute();
	}


}


?>