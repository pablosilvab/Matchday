<?php
class TercerTiempo{

	protected $db;
	public function __construct(){
		$this->db = SPDO::singleton();
	}

	public function getTercerTiempo($idPartido){
		$consulta = $this->db->prepare("
			SELECT * FROM TercerTiempo WHERE idPartido = '".$idPartido."';
			");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}

	public function setTercerTiempo($comentario, $cuota,$hora, $idLocal, $idPartido){
		$consulta = $this->db->prepare("
			INSERT INTO TercerTiempo (
				comentario,
				cuota,
				hora,
				idLocal,
				idPartido)
				VALUES(
				'$comentario',
				'$hora',
				'$cuota',
				'$idLocal',
				'$idPartido'
				);
				SELECT LAST_INSERT_ID() AS lastId;
			");
		$consulta->execute();
		$resultado = $this->db->lastInsertId();
		return $resultado;
	}

	public function getIdTercerTiempo($idPartido){
		$consulta=$this->db->prepare("SELECT idTercerTiempo FROM TercerTiempo WHERE idPartido='$idPartido';");
		$consulta->execute();
		$resultado= $consulta->fetchAll();
		return $resultado;
	}

	public function deleteTercerTiempo($idPartido){
		$sql = "DELETE FROM TercerTiempo WHERE idPartido = '".$idPartido."';";
		$query = $this->db->prepare($sql);
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}





}
?>