<?php

require 'models/Local.php';
session_start();


class LocalController{

	function __construct(){
		$this->view = new View();
		$this->local = new Local();
	}

	public function index(){
		$this->view->show("");
	}

	public function busquedaLocales(){

		//Cuando se realice la busqueda
		if(isset($_POST['search'])){
			$search = $_POST['search'];
			$data['search'] = $search;
		}
		$listadoLocales = $this->local->getLocalesBusqueda();
		//listado de locales
		$data['locales'] = $listadoLocales;


		$this->view->show("locales.php",$data);
	}

    public function verMapaLocal(){
      $idLocal = $_GET['idLocal'];
      $local = new Local();
      $mapaLocal = $local->getDireccionLocal($idLocal);
      $data['mapa'] = $mapaLocal;
      //mostrar vista parcial con los implementos (dataTable)
      $this->view->show("_mapa.php", $data);
    }


    /*    MODULO DE ADMINISTRACION  */
    public function adminLocales(){
      $locales = $this->local->getLocales();
      $data['locales'] = $locales;
      if (isset($_SESSION['localAdmin'])){
        $data['localAdmin'] = $_SESSION['localAdmin'];
      }
      $_SESSION['localAdmin'] = 0;
      $this->view->show('adminLocales.php',$data);
    }


    public function cambiarEstadoLocal(){
      $idLocal = $_POST['idLocal'];
      $estado = $_POST['estado'];
      $this->local->cambiarEstadoLocal($idLocal, $estado);
      if ($estado == 1){
        $_SESSION['localAdmin'] = 2;
      }
      if ($estado == 2){
        $_SESSION['localAdmin'] = 1;
      }
      header('Location: ?controlador=Local&accion=adminLocales');
    }

    public function editarLocal(){
      $idLocal = $_GET['idLocal'];
      $local = $this->local->getLocal($idLocal);
      $data['local'] = $local;
      $this->view->show("_adminEditarLocal.php", $data);
    }


    public function updateLocal(){
      $idLocal = $_POST['idLocal'];
      $nombre = $_POST['nombre'];
      $descripcion = $_POST['descripcion'];
      $direccion = $_POST['direccion'];
      $this->local->actualizarLocal($idLocal, $nombre, $descripcion,$direccion);
      $subirImagen = $this->guardarImagen($idLocal);
      $_SESSION['localAdmin'] = 3;
      header('Location: ?controlador=Local&accion=adminLocales');
    }

    public function agregarLocal(){
      $nombre = $_POST['nombre'];
      $descripcion = $_POST['descripcion'];
      $direccion = $_POST['direccion'];
      $estado = $_POST['estado'];


      $this->local->setLocal($nombre,$descripcion,$direccion,$estado);

      $locales = $this->local->getLocales();
      $idNuevoLocal = end($locales)['idLocal'];


      $subirImagen = $this->guardarImagen($idNuevoLocal);

      if ($subirImagen == 0 ){  // hubo un error
        $data['error'] = 0;
        //$this->Recinto->eliminarRecinto($idNuevoRecinto);
        $this->view->show('adminLocales.php', $data);
      } else {  // todo ok
        $_SESSION['localAdmin'] = 4;
        header('Location: ?controlador=Local&accion=adminLocales');
        //$this->view->show('inicio.php', $data);
      }
    }


  private function guardarImagen($idNuevoLocal){
    $target_dir = "assets/images/locales/";
    $target_file = $target_dir.basename($_FILES["imagen"]["name"]);
    //echo $target_file;
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Asignar nuevo nombre: idUsuario.extensionFotografia
    $newName = $idNuevoLocal.".".$imageFileType;
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
          $this->local->setFotografia($idNuevoLocal,$newName);
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