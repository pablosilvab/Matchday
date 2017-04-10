<?php

require 'models/Usuario.php';
require 'models/Partido.php';


session_start();

class InvitadoController{

	function __construct(){
		$this->view = new View();
		$this->Usuario = new Usuario();
		$this->Partido = new Partido();
	}

	public function index(){
		$this->view->show("");
	}


	// Desplegar formulario de registro para invitado. Opción Registrarse.
	public function invitacionPartido(){
		$token = $_GET['token']; 	
		$invitado = $this->Usuario->getInvitado($token);
		$data['invitado'] = $invitado;

		$this->view->show('formularioInvitado.php',$data);
	}


	// Registrar usuario en la base de datos. 
	public function acceder(){
		$nombre = $_POST['nombre'];
		$apellido= $_POST['apellido'];
		$nickname= $_POST['nickname'];
		$fechaNacimiento= $_POST['date'];
		//echo $fechaNacimiento;
		$mail= $_POST['mail'];
		$telefono= $_POST['telefono'];
		$password = $_POST['password'];
		$password_cifrada = password_hash($password,PASSWORD_DEFAULT); 
		/* Coste de la función por defecto: 10
			password_hash($password,PASSWORD_DEFAULT,array("cost")=>12);
			http://php.net/manual/es/faq.passwords.php
		*/
		//echo $password_cifrada;
		$sexo= $_POST['sexo'];
		//$fotografia = "no";


		$idUsuario = $_POST['idInvitado'];
		$estado = 1;

		//echo $idUsuario." ".$nombre." ".$apellido." ".$nickname." ".$fechaNacimiento." ".$mail." ".$telefono." ".$password_cifrada." ".$sexo;

		$this->Usuario->setInvitado($idUsuario,$nombre,$apellido,$nickname, $mail, $sexo, $password_cifrada, $telefono, $fechaNacimiento, $estado);


		$subirImagen = $this->guardarImagen($idUsuario);
		$mensaje = 0;
		if ($subirImagen == 0 ){	// hubo un error
			$data['error'] = 0;
			//$this->Usuario->eliminarUsuario($idUsuarioNuevo);
			//$this->view->show('formularioRegistro.php', $data);
		} else {	// todo ok, iniciar sesión
			//$data['idInvitado'] = $idUsuario;
			$this->view->show('loginInvitado.php');
		}
	

		
		
	}





	// Subir imagen 
	private function guardarImagen($idUsuario){
		$target_dir = "assets/images/usuarios/";
		$target_file = $target_dir.basename($_FILES["imagen"]["name"]);
		//echo $target_file;
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Asignar nuevo nombre: idUsuario.extensionFotografia
		$newName = $idUsuario.".".$imageFileType;
		$newDir = $target_dir.$newName;
		// Chequear si es o no una imagen
		if(isset($_POST["submit"])) {
		    $check = getimagesize($_FILES["imagen"]["tmp_name"]);
		    if($check !== false){
		        $uploadOk = 1;
				$message = "Archivo es una imagen - " . $check["mime"] . ".";;
		    } else {
		        $message = "Archivo no es una imagen.";
		        $uploadOk = 0;
		    }
		}
		/*/ Chequear si el archivo existe o no (no deberia)
		if (file_exists($target_file)) {
		    $message = "Lo sentimos pero esta imagen ya existe.";
		    $uploadOk = 0;
		}*/
		// Chequear el tamaño de la imagen. 
		if ($_FILES["imagen"]["size"] > 5000000) {
		    $message = "Lo sentimos, pero el archivo es muy grande.";
		    $uploadOk = 0;
		}
		// Chequear extension
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG"
		&& $imageFileType != "GIF") {
		    $message = "Lo sentimos , solo archivos con JPG, JPEG, PNG & GIF son permitidos.";
		    $uploadOk = 0;
		}
		// Chequear la variable $uploadOk = 0
		if ($uploadOk == 0) {
		    $message =  "Lo sentimos, tu archivo no se puede subir.";
		// OK, Intenta subir imagen.
		} else {
		    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $newDir)) {
		    	$this->Usuario->setFotografia($idUsuario,$newName);
		    	return 1;
		    	//echo "ok";
		    } else {
		        $message = "Lo sentimos, hubo un error al subir el archivo."; // No debiese entrar aqui.
		        return 0;
		    }
		}		
	}











}


?>


