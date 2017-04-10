<?php
class Local{

	protected $db;
	public function __construct(){
		$this->db = SPDO::singleton();
	}

	public function getLocales(){
		$consulta = $this->db->prepare('SELECT * FROM Local');
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}
	public function getLocalesBusqueda(){
		$consulta = $this->db->prepare('SELECT * FROM Local WHERE estado=1');
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;
	}


	public function getLocal($idLocal){
		$consulta = $this->db->prepare("
			SELECT * FROM Local WHERE idLocal = '$idLocal';
			");
		$consulta->execute();
		$resultado=$consulta->fetchAll();
		return $resultado;
	}

	public function getDireccionLocal($idLocal){
		$consulta = $this->db->prepare("SELECT nombre, direccion FROM Local WHERE idLocal = '".$idLocal."' ");
		$consulta->execute();
		$resultado = $consulta->fetchAll();
		return $resultado;	
	}




	/* Admin */
	public function cambiarEstadoLocal($idLocal, $estado){
		$sql = "UPDATE Local SET 
		estado = '".$estado."'
		WHERE idLocal = '".$idLocal."'";
		$query = $this->db->prepare($sql);
		$query->execute();
	}

	public function actualizarLocal($idLocal, $nombre, $descripcion,$direccion){
		$consulta = $this->db->prepare(
			"UPDATE Local SET 
			nombre 		 = '$nombre',
			descripcion  = '$descripcion',
			direccion	 = '$direccion'
			WHERE idLocal = '$idLocal'");
		
		$consulta->execute();
	}

	public function setLocal($nombre,$descripcion,$direccion,$estado){
		$consulta = $this->db->prepare(
			"INSERT INTO Local (
			nombre,
			descripcion,
			direccion,
			estado) VALUES (
			'".$nombre."',
			'".$descripcion."',
			'".$direccion."',
			'".$estado."')");
		$consulta->execute();
	}


	public function setFotografia($idLocal, $imagen){
		$sql = "UPDATE Local SET fotografia = '".$imagen."' WHERE idLocal = '".$idLocal."' ";
		$query = $this->db->prepare($sql);
		$query->execute();
	}



}
?>