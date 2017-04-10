
<?php

class Contacto{

	protected $db;

	public function __construct(){
		$this->db = SPDO::singleton();
	}

	// Obtener contactos de un usuario.
	public function getContactos($idUsuario){
		$query = $this->db->prepare(
			"SELECT 
			Usuario.idUsuario, 
			Usuario.nombre,
			Usuario.apellido, 
			Usuario.nickname, 
			Usuario.mail, 
			Usuario.fotografia, 
			Usuario.fechaNacimiento, 
			Usuario.telefono
			FROM Usuario 
			INNER JOIN Contacto ON Usuario.idUsuario = Contacto.idContacto 
			WHERE Contacto.idUsuario = '".$idUsuario."'");
		$query->execute();
		$resultado = $query->fetchAll();
		return $resultado;
	}

	public function setContacto($idUsuario, $idContacto){
		$query = $this->db->prepare("INSERT INTO Contacto (idUsuario, idContacto) VALUES ('".$idUsuario."','".$idContacto."');");
		$query->execute();
	}

	public function verificarContacto($contacto, $idUsuario){
		foreach ($contacto as $key) {
			$idContacto = $key['idUsuario'];
		}
		if ($idContacto == $idUsuario){
			return "3";
		} else {
			$query = $this->db->prepare("SELECT * FROM Contacto WHERE idUsuario = '".$idUsuario."' AND idContacto = '".$idContacto."' ;");
			$query->execute();
			$resultado = $query->fetchAll();
			if (count($resultado)!=0){
				return "2";
			} else {
				return "1";	
			}
		}
		
	}



}


?>