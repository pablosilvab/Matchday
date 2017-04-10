<?php

require 'models/Usuario.php';
require 'models/Contacto.php';
session_start();

class UsuarioController{

	function __construct(){
		$this->view = new View();
		$this->Usuario = new Usuario();
	}

	public function index(){
		$this->view->show("");
	}

	// Entregar lista de usuarios del sistema.
	public function gestionUsuarios(){
		$usuarios = new Usuario();
		$listaUsuarios = $usuarios->getUsuarios();
		$data['listaUsuarios'] = $listaUsuarios;
		$this->view->show('gestionUsuarios.php',$data); // Prueba parcial.
	}

	public function getUsuario(){
		$idUsuario= $_POST['idUsuario'];
		$usuarios = new Usuario();
		$usuario = $usuarios->getUsuario($idUsuario);
		return $usuario;
	}

	// Desplegar formulario de registro. Opción Registrarse.
	public function formularioRegistro(){
		$this->view->show('formularioRegistro.php');
	}


	public function pruebaCrearUsuario(){
		$this->view->show('pruebaCrearUsuario.php');
	}

	public function formularioRegistro2(){
		$this->view->show('testform.php');
	}

	// Registrar usuario en la base de datos. 
	public function registrarUsuario(){

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
		$usuarios = $this->Usuario->getUsuarios();
		$idUsuario = end($usuarios)['idUsuario'];



		$validarCampos = $this->validarCampos($nombre, $apellido, $nickname, $password);

		if (strlen($validarCampos) > 0){
			// Volver al formulario
			$data['nombre'] = $nombre;
			$data['apellido'] = $apellido;
			$data['nickname'] = $nickname;
			$data['fechaNacimiento'] = $fechaNacimiento;
			$data['mail'] = $mail;
			$data['telefono'] = $telefono;
			$data['sexo'] = $sexo;
			//echo $vars['sexo'];
			$data['msg'] = $_SESSION['msg'];
			$data['error'] = 2;
			$data['divs'] = $validarCampos;
			$this->view->show('formularioRegistro.php', $data);
		} else {

			$this->Usuario->setUsuario($nombre,$apellido,$nickname, $mail, $sexo, $password_cifrada, $telefono, $fechaNacimiento,1,1);

			$usuarios = $this->Usuario->getUsuarios();
			$idUsuarioNuevo = end($usuarios)['idUsuario'];

			if ($idUsuario == $idUsuarioNuevo){
				$data['error'] = 1;
				$this->view->show('formularioRegistro.php', $data);
			} else {

				$subirImagen = $this->guardarImagen($idUsuarioNuevo);
				$mensaje = 0;
				if ($subirImagen == 0 ){	// hubo un error
					$data['error'] = 0;
					$this->Usuario->eliminarUsuario($idUsuarioNuevo);
					$this->view->show('formularioRegistro.php', $data);
				} else {	// todo ok
					$usuarioNuevo = $this->Usuario->getUsuario($idUsuarioNuevo);
					$data['nuevoUsuario'] = $usuarioNuevo;
					header('Location: ?controlador=Index&accion=inicio');
					//$this->view->show('inicio.php', $data);
				}
			}
		}



		/*
		$this->Usuario->setUsuario($nombre,$apellido,$nickname, $mail, $sexo, $password_cifrada, $telefono, $fechaNacimiento,1,1);

		$usuarios = $this->Usuario->getUsuarios();
		$idUsuarioNuevo = end($usuarios)['idUsuario'];

		if ($idUsuario == $idUsuarioNuevo){
			$data['error'] = 1;
			//$this->Usuario->eliminarUsuario($idUsuario);
			$this->view->show('formularioRegistro.php', $data);
		} else {

			$subirImagen = $this->guardarImagen($idUsuarioNuevo);
			$mensaje = 0;
			if ($subirImagen == 0 ){	// hubo un error
				$data['error'] = 0;
				$this->Usuario->eliminarUsuario($idUsuarioNuevo);
				$this->view->show('formularioRegistro.php', $data);
			} else {	// todo ok
				$usuarioNuevo = $this->Usuario->getUsuario($idUsuarioNuevo);
				$data['nuevoUsuario'] = $usuarioNuevo;
				header('Location: ?controlador=Index&accion=inicio');
				//$this->view->show('inicio.php', $data);
			}
		}
		*/

		
		
	}


	private function validarCampos($nombre, $apellido, $nickname, $password){
		$respuesta = "";

		$trimNombre = trim($nombre);
		$trimApellido = trim($apellido);
		$trimNickname = trim($nickname);
		$trimPassword = trim($password);
		$mensaje="";

		if (empty($trimNombre)){
			$respuesta = $respuesta."0,";
			$mensaje= $mensaje."* No se permite un nombre con caracteres vacíos.<br>";
		}

		if (empty($trimApellido)){
			$respuesta = $respuesta."1,";
			$mensaje= $mensaje."* No se permite un apellido con caracteres vacíos.<br>";
		}

		if (empty($trimNickname)){
			$respuesta = $respuesta."2,";
			$mensaje= $mensaje."* No se permite un nickname con caracteres vacíos.<br>";
		}

		if (empty($trimPassword)){
			$respuesta = $respuesta."3,";
			$mensaje= $mensaje."* No se permite un password con caracteres vacíos.<br>";
		}
		if (strlen($password)<5){
			$respuesta = $respuesta."4,";
			$mensaje= $mensaje."* Tu contraseña debe tener más de 5 caracteres.<br>";
		}
		$_SESSION['msg'] = $mensaje;
		return $respuesta;
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
		    return 0;	
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





 	// Busqueda de un usuario mediante nickname.  Opción Agregar Contacto
 	public function busquedaJugador(){
 		$usuario = new Usuario();
 		$contacto = new Contacto(); 
 		$idUsuario = $_SESSION['login_user_id'];
 		$nickname = $_POST['search'];
 		$data['search'] = $nickname;
 		$nuevoContacto = $usuario->buscarJugador($nickname);
 		if (!count($nuevoContacto)==0){
	  		$consulta = $contacto->verificarContacto($nuevoContacto, $idUsuario);
	  		if ($consulta == "3"){
	  			$data['respuesta']= 3; // Es el mismo
	  		}
	  		if ($consulta == "2"){ // Es true, el contacto ya lo tiene.
	  			$data['respuesta']= 2;
	  		}
	  		if ($consulta == "1"){
	  			$data['respuesta']= 1; // No lo tiene
	  		}
	  		
 		}
  		$data['usuarios']=$nuevoContacto;
 		$this->view->show('busquedaJugador.php',$data);
 	}


 	// Mostrar perfil del usuario.  Opcion Perfil
	public function perfilUsuario(){
		$usuario = new Usuario();
		$idUsuario = $_SESSION['login_user_id'];
		$perfilUsuario = $usuario->getUsuario($idUsuario);
		$data['perfilUsuario'] = $perfilUsuario;
		/*
		foreach ($perfilUsuario as $key ) {
			$fechaNacimiento = $key['fechaNacimiento'];
		}
		$edad = $this->calcularEdad($fechaNacimiento);
		$data['edadUsuario'] = $edad;
		*/

		if (isset($_SESSION['accion'])){
			if ($_SESSION['accion'] == 1){
			$data['accion'] = $_SESSION['accion'];
		}
		}

		$_SESSION['accion'] = 0;

		$this->view->show('perfilUsuario.php',$data);
	}

	//	Calcular edad de un usuario.
	public function calcularEdad($fecha){
		list($Y,$m,$d) = explode("-", $fecha);
		return(date("md")<$m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
	}

	// Calcular promedio de edad de un array
	public function calcularPromedio($array){
		return round(array_sum($array)/count($array));
	}

	// Mostrar formulario para modificar perfil. Opcion Mi información
	public function modificarPerfil(){
		$usuario = new Usuario();
		$idUsuario = $_SESSION['login_user_id'];
		$modificarPerfil = $usuario->getUsuario($idUsuario);
		$data['modificarPerfil'] = $modificarPerfil;
		if (isset($_SESSION['accion'])){
			$data['accion'] = $_SESSION['accion'];
		}
		$_SESSION['accion'] = 0;
		$this->view->show('modificarPerfil.php',$data);
 	}

 	// Actualizar información del usuario en la BD
 	public function actualizarInformacion(){
 		$idUsuario = $_SESSION['login_user_id'];
 		$nombre = $_POST['nombre'];
 		$apellido = $_POST['apellido'];
 		$nickname= $_POST['nickname'];
		$mail= $_POST['mail'];
		$telefono= $_POST['telefono'];
		$this->Usuario->updateUsuario($idUsuario, $nombre, $apellido, $nickname,$mail,$telefono);

		$subirImagen = $this->guardarImagen($idUsuario);
		$_SESSION['accion'] = 1;
		header('Location: ?controlador=Usuario&accion=perfilUsuario');
 	}

 	// Desplegar calendario de partidos activos. Opción Mi Calendario
 	public function verCalendario(){
 		$this->view->show('verCalendario.php');
 	}










    /*    MODULO DE ADMINISTRACION  */
    public function adminJugadores(){
      $jugadores = $this->Usuario->getUsuariosAdmin();
      $data['jugadores'] = $jugadores;
      $arrayEdades = array(); 
      $i = 0;
      foreach ($jugadores as $key ) {
      	$fechaNacimiento = $key['fechaNacimiento'];
      	$arrayEdades[$i] = $this->calcularEdad($fechaNacimiento);
      	$i++;
      }
      $data['edades'] = $arrayEdades;
      if (isset($_SESSION['accionAdmin'])){
			$data['accionAdmin'] = $_SESSION['accionAdmin'];
		}
		$_SESSION['accionAdmin'] = 0;
      $this->view->show('adminJugadores.php',$data);
    }

    public function cambiarEstado(){
    	$idJugador = $_POST['idJugador'];
    	$estado = $_POST['estado'];
    	$this->Usuario->cambiarEstadoJugador($idJugador, $estado);
    	if ($estado == 1){
    		$_SESSION['accionAdmin'] = 2;
    	}
    	if ($estado == 2){
    		$_SESSION['accionAdmin'] = 1;
    	}
    	header('Location: ?controlador=Usuario&accion=adminJugadores');
    }


	public function detalleJugador(){
		$idJugador = $_GET['idJugador'];
		$jugador = $this->Usuario->getUsuario($idJugador);
		foreach ($jugador as $key ) {
			$fechaNac = $key['fechaNacimiento'];
		}
		$data['edadJugador'] = $this->calcularEdad($fechaNac);
		$data['jugador'] = $jugador;
	    $this->view->show("_adminInfoJugador.php", $data);
	}

	public function getGraficosJugadores(){
		$cantidadPorSexo = $this->Usuario->getCantidadPorSexo();
		$data['sexo'] = $cantidadPorSexo;

		$edades = $this->Usuario->getEdades();
		$data['edad'] = $edades;

		$comentarios = $this->Usuario->getComentariosUsuario();
		$data['comentario'] = $comentarios;

		$topTen = $this->Usuario->getTopTenJugadoresPartidos();
		$data['topTen'] = $topTen;

	

		$this->view->show("_adminGraficosJugadores.php", $data);
	}
	public function existeCorreo(){
		$mail = $_GET['mail'];

		$resultado = $this->Usuario->existeCorreo($mail);
		echo $resultado;
	}


}


?>