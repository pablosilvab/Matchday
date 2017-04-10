
<?php

class MiembrosEquipo{

	protected $db;

	public function __construct(){
		$this->db = SPDO::singleton();
	}



	// Obtener miembros de un determinado equipo de un determinado capitan. 
	// Obtener equipos de un usuario. (Como Capitán) - 
	public function getMiembrosEquiposJugador($idUsuario){
		$query = $this->db->prepare(
			"SELECT Miembrosequipo.idUsuario, 
			Equipo.idEquipo, 
			Equipo.nombre 
			from Miembrosequipo INNER JOIN Equipo on Equipo.idequipo = Miembrosequipo.idEquipo where Miembrosequipo.idEquipo in 
			(select idEquipo from Equipo where idCapitan='".$idUsuario."')");
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}

	// Obtener contactos que no estan en un determinado equipo
	public function getContactosNoMiembros($idEquipo, $idUsuario){
		$query = $this->db->prepare("SELECT * FROM Contacto WHERE Contacto.idUsuario='".$idUsuario."' AND Contacto.idContacto NOT IN 
			(SELECT Miembrosequipo.idUsuario FROM Miembrosequipo WHERE idEquipo= '".$idEquipo."')");
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	} 




}


?>