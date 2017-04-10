<?php
require 'models/Recinto.php';
require 'models/Comentario.php';
require 'models/Puntuacion.php';
require 'models/Partido.php';
require 'models/Horario.php';
require 'models/Implemento.php';
require 'models/Contacto.php';

session_start();

class RecintoController{

	function __construct(){
        $this->view = new View();
        $this->Recinto = new Recinto();
        $this->Horario = new Horario();
        $this->Implemento = new Implemento();
        $this->Contacto = new Contacto();
    }

    public function index()
    {
        $this->view->show("");
    }

    //Busqueda recintos sin registrar
    public function busquedaRecintos(){

            if(isset($_POST['tipo'])){
	          $tipo = $_POST['tipo'];
             }else{
                $tipo=0;
             }
        
    	//Si es la busqueda sin sesion
    	$recinto = new Recinto();
    	$comentario = new Comentario();
      $puntuacion = new Puntuacion();
      $partido =  new Partido();
      if(!isset($_SESSION)) { 
        session_start(); 
        } 
    	if(!isset($_SESSION['login_user_id'])){
    		if (isset($_POST['search'])) {
                      $search = $_POST['search'];
                      $data['search']=$search;

            }
    		$listadoRecintos = $recinto->getRecintos();
    		$data['recintos'] = $listadoRecintos;

    		$this->view->show("recintos.php",$data);

    	}else{
            if(!isset($_SESSION)) 
            { 
             session_start(); 
            } 
           $idUsuario = $_SESSION['login_user_id'];
            //Si es la busqueda con sesion
                          if (isset($_POST['search'])) {
                          $search = $_POST['search'];
                          $data['search']=$search;

                       $listadoContactos= $this->Contacto->getContactos($_SESSION['login_user_id']);
                       $numeroContactos=count($listadoContactos);
                       $data['numeroContactos'] = $numeroContactos;
                          $listadoPuntuacion = $puntuacion->getPuntuaciones($idUsuario);
                          $listadoPartidos = $partido->getPartidosUsuario($idUsuario);
                          $data['partidos'] = $listadoPartidos;
                          $data['puntuaciones'] = $listadoPuntuacion;

            }

    		$listadoRecintos = $recinto->getRecintos();
    		$data['recintos'] = $listadoRecintos;
    		$this->view->show("recintos.php",$data);

    	
    	}
    }

    public function notificarRecinto(){
      $data['a']=0;
      if(!empty($_GET['a'])){
        if($_GET['a']==1){
          $data['a']=1;
        }
      }
      $this->view->show("notificarRecinto.php",$data);
    }

    public function ingresarRecinto(){
      $recinto = new Recinto();
      $nombre = $_POST['nombre'];
      $fono = $_POST['fono'];
      $direccion = $_POST['direccion'];
      $idUsuario = $_POST['idUsuario'];

      $recinto->setSolicitud($nombre, $fono, $direccion, $idUsuario);
      
      header('Location: ?controlador=Recinto&accion=notificarRecinto&a=1');
    }

    public function horariosRecinto(){
      //Id del recinto tomada desde la variable global

      $idRecinto = $_GET['id'];
      $horarios = $this->Horario->getHorariosRecinto($idRecinto);
      $data['horarios'] = $horarios;
      //mostrar vista parcial con los horarios (dataTable)
      $this->view->show("_horarios.php",$data);
    }

    public function implementosRecinto(){
      //Id del recinto desde la variable global
      if(!isset($_SESSION)) { 
        session_start(); 
        } 
      $idRecinto = $_GET['id'];
      $implementos = $this->Implemento->getImplementosRecinto($idRecinto);
      $data['implementos'] = $implementos;
      //mostrar vista parcial con los implementos (dataTable)
      $this->view->show("_implementos.php", $data);
    }


    public function verMapaRecinto(){
      $idRecinto = $_GET['idRecinto'];
      $recinto = new Recinto();
      $mapaRecinto = $recinto->getDireccionRecinto($idRecinto);
      $data['mapa'] = $mapaRecinto;
      //mostrar vista parcial con los implementos (dataTable)
      $this->view->show("_mapa.php", $data);
    }

    public function getHorarios(){
      $idRecinto = $_GET['id'];
      $form = $_GET['form'];
      $data['horarios'] = $this->Horario->getHorariosRecinto($idRecinto);
      $data['form'] = $form;
      $this->view->show("_horarios.php", $data);
    }


    public function pruebaRecintos(){
      $recintos = $this->Recinto->getRecintos();
      $data['recintos'] = $recintos;
      $this->view->show('pruebaRecintos.php',$data);
    }




    /*    MODULO DE ADMINISTRACION  */
    public function adminRecintos(){
      $recintos = $this->Recinto->getRecintosAdmin();
      $data['recintos'] = $recintos;
      if (isset($_SESSION['recintoAdmin'])){
        $data['recintoAdmin'] = $_SESSION['recintoAdmin'];
        if ($_SESSION['recintoAdmin'] == 5 || $_SESSION['recintoAdmin'] == 6){
          $data['horarioRecinto'] = $_SESSION['horarioRecinto'];
        }
        if ($_SESSION['recintoAdmin'] == 8 || $_SESSION['recintoAdmin'] == 9){
          $data['implementoRecinto'] = $_SESSION['implementoRecinto'];
        }
      }
      $_SESSION['recintoAdmin'] = 0;
      $this->view->show('adminRecintos.php',$data);
    }


    public function cambiarEstadoRecinto(){
      $idRecinto = $_POST['idRecinto'];
      $estado = $_POST['estado'];
      $this->Recinto->cambiarEstadoRecinto($idRecinto, $estado);
      if ($estado == 1){
        $_SESSION['recintoAdmin'] = 2;
      }
      if ($estado == 2){
        $_SESSION['recintoAdmin'] = 1;
      }
      header('Location: ?controlador=Recinto&accion=adminRecintos');
    }

    public function editarRecinto(){
      $idRecinto = $_GET['idRecinto'];
      $recinto = $this->Recinto->getRecinto($idRecinto);
      $data['recinto'] = $recinto;
      $this->view->show("_adminEditarRecinto.php", $data);
    }


   

    public function updateRecinto(){
      $idRecinto = $_POST['idRecinto'];
      $nombre = $_POST['nombre'];
      $tipo = $_POST['tipo'];
      $superficie = $_POST['superficie'];
      $direccion = $_POST['direccion'];
      $telefono = $_POST['telefono'];
      $this->Recinto->actualizarRecinto($idRecinto, $nombre, $tipo, $superficie, $direccion, $telefono);

      $subirImagen = $this->guardarImagen($idRecinto);
      
      $_SESSION['recintoAdmin'] = 3;
      header('Location: ?controlador=Recinto&accion=adminRecintos');
    }

    public function agregarRecinto(){
      $nombre = $_POST['nombre'];
      $tipo = $_POST['tipo'];
      $superficie = $_POST['superficie'];
      $direccion = $_POST['direccion'];
      $telefono = $_POST['telefono'];
      $estado = 4;
      $puntuacion = 0;
      $idUsuario = $_SESSION['login_user_id'];

      $this->Recinto->setRecinto($nombre,$tipo,$superficie,$direccion,$telefono,$estado, $puntuacion, $idUsuario);

      $recintos = $this->Recinto->getRecintos();
      $idNuevoRecinto = end($recintos)['idRecinto'];


      $subirImagen = $this->guardarImagen($idNuevoRecinto);

      if ($subirImagen == 0 ){  // hubo un error
        $data['error'] = 0;
        $this->Recinto->eliminarRecinto($idNuevoRecinto);
        $this->view->show('adminRecintos.php', $data);
      } else {  // todo ok
         $_SESSION['recintoAdmin'] = 4;  //Esto lo debo agregar en el modal del archivo al cual lo enviare.
        //$data['idRecinto'] = $idNuevoRecinto;
        //$this->view->show('adminRecintos.php', $data);
        header('Location: ?controlador=Recinto&accion=adminRecintos');
      }
    }


  private function guardarImagen($idNuevoRecinto){
    $target_dir = "assets/images/recintos/";
    $target_file = $target_dir.basename($_FILES["imagen"]["name"]);
    //echo $target_file;
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Asignar nuevo nombre: idUsuario.extensionFotografia
    $newName = $idNuevoRecinto.".".$imageFileType;
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
          $this->Recinto->setFotografia($idNuevoRecinto,$newName);
          return 1;
          //echo "ok";
        } else {
            $message = "Lo sentimos, hubo un error al subir el archivo."; // No debiese entrar aqui.
            return 0;
        }
    }   
  }


  public function verImplementos(){
    $idRecinto = $_GET['idRecinto'];
    $implementos = $this->Implemento->getImplementosRecinto($idRecinto);
    $data['implementos'] = $implementos;
    $data['idRecinto'] = $idRecinto;
    $this->view->show("_adminVerImplementos.php", $data);
  }

  public function verHorarios(){
    $idRecinto = $_GET['idRecinto'];
    $horarios = $this->Horario->getHorariosRecinto($idRecinto);;
    $data['horarios'] = $horarios;
    $data['idRecinto'] = $idRecinto;
    $this->view->show("_adminVerHorarios.php", $data);
  }

  public function agregarHorario(){
    $idRecinto = $_POST['idRecinto'];
    $nombre = $_POST['nombre'];
    $horaInicio = $_POST['horaInicio'];
    $horaFin = $_POST['horaFin'];
    $listaDias = $_POST['listaDias'];
    $dias = implode(",", $listaDias);
    $precio = $_POST['precio'];
    $this->Horario->setHorarioRecinto($horaInicio, $horaFin, $nombre, $dias, $precio, $idRecinto);

    $estadoRecinto = end($this->Recinto->getRecinto($idRecinto))['estado'];
    if ($estadoRecinto == 4){
      $estado = 1;
      $this->Recinto->cambiarEstadoRecinto($idRecinto, $estado);
    }
    
    $_SESSION['recintoAdmin'] = 5;
    $_SESSION['horarioRecinto'] = $idRecinto;
    header('Location: ?controlador=Recinto&accion=adminRecintos');
  }


  public function eliminarHorario(){
    $idRecinto = $_POST['idRecinto'];
    $idHorario = $_POST['idHorario'];
    $this->Horario->eliminarHorarioRecinto($idRecinto, $idHorario);
    $horariosRecinto = $this->Horario->getHorariosRecinto($idRecinto);
    if (empty($horariosRecinto)){
      $estado = 2;
      $this->Recinto->cambiarEstadoRecinto($idRecinto, $estado);
    }
    $_SESSION['recintoAdmin'] = 6;
    $_SESSION['horarioRecinto'] = $idRecinto;
    header('Location: ?controlador=Recinto&accion=adminRecintos');
  }

  public function editarHorario(){
    $idHorario = $_GET['idHorario'];
    $horario = $this->Horario->getHorario($idHorario);
    $data['horario'] = $horario;
    $this->view->show("_adminEditarHorario.php", $data);
  }

  public function actualizarHorario(){
    $idHorario = $_POST['idHorario'];
    $nombre = $_POST['nombre'];
    $horaInicio = $_POST['horaInicio'];
    $horaFin = $_POST['horaFin'];
    $listaDias = $_POST['listaDias'];
    $dias = implode(",", $listaDias);
    $precio = $_POST['precio'];
    $this->Horario->actualizarHorarioRecinto($idHorario, $horaInicio, $horaFin, $nombre, $dias, $precio);
    $_SESSION['recintoAdmin'] = 7;
    //$_SESSION['horarioRecinto'] = $idRecinto;
    header('Location: ?controlador=Recinto&accion=adminRecintos');
  }


  public function agregarImplemento(){
    $idRecinto = $_POST['idRecinto'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $this->Implemento->agregarImplementoRecinto($nombre, $precio, $idRecinto);
    $_SESSION['recintoAdmin'] = 8;
    $_SESSION['implementoRecinto'] = $idRecinto;
    header('Location: ?controlador=Recinto&accion=adminRecintos');
  }

  public function eliminarImplemento(){
    $idRecinto = $_POST['idRecinto'];
    $idImplemento = $_POST['idImplemento'];
    $this->Implemento->eliminarImplementoRecinto($idRecinto, $idImplemento);
    $_SESSION['recintoAdmin'] = 9;
    $_SESSION['implementoRecinto'] = $idRecinto;
    header('Location: ?controlador=Recinto&accion=adminRecintos');
  }

  public function editarImplemento(){
    $idImplemento = $_GET['idImplemento'];
    $implemento = $this->Implemento->getImplemento($idImplemento);
    $data['implemento'] = $implemento;
    $this->view->show("_adminEditarImplemento.php", $data);
  }

  public function actualizarImplementoRecinto(){
    $idImplemento = $_POST['idImplemento'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $this->Implemento->actualizarImplementoRecinto($idImplemento, $nombre, $precio);
    $_SESSION['recintoAdmin'] = 10;
    //$_SESSION['horarioRecinto'] = $idRecinto;
    header('Location: ?controlador=Recinto&accion=adminRecintos');
  }

  public function recintosNotificados(){
      $recintos = $this->Recinto->getRecintosNotificados();
      $data['recintos'] = $recintos;
      if (isset($_SESSION['notiAdmin'])){
        $data['notiAdmin'] = $_SESSION['notiAdmin'];
      }
      $_SESSION['notiAdmin'] = 0;
      $this->view->show('adminNotificaciones.php',$data);
  }

  public function eliminarNotificacion(){
    $idRecinto = $_POST['idRecinto'];
    $this->Recinto->eliminarNotificacion($idRecinto);
    $_SESSION['notiAdmin'] = 1;
    header('Location: ?controlador=Recinto&accion=recintosNotificados');
  }

    public function activarNotificacion(){
      $idRecinto = $_GET['idRecinto'];
      $recinto = $this->Recinto->getRecinto($idRecinto);
      $data['recinto'] = $recinto;
      $this->view->show("_adminActivarNotificacion.php", $data);
    }

    public function registrarNotificacion(){
      $idRecinto = $_POST['idRecinto'];
      $nombre = $_POST['nombre'];
      $tipo = $_POST['tipo'];
      $superficie = $_POST['superficie'];
      $direccion = $_POST['direccion'];
      $telefono = $_POST['telefono'];
      $estado = 4;
      $idUsuario = $_POST['idUsuario'];
      $this->Recinto->registrarNotificacion($idRecinto, $nombre, $tipo, $superficie, $direccion, $telefono,$estado, $idUsuario);
      $subirImagen = $this->guardarImagen($idRecinto);
      $_SESSION['notiAdmin'] = 2;
      header('Location: ?controlador=Recinto&accion=recintosNotificados');
    }

    public function getGraficosRecintos(){

      $partidosRecinto = $this->Recinto->getPartidosRecinto();
      $data['partidos'] = $partidosRecinto;

      $superficie = $this->Recinto->getSuperficiesRecinto();
      $data['superficie'] = $superficie;

      $precio = $this->Recinto->getPreciosMaxRecinto();
      $data['precio'] = $precio;

      $precioMin = $this->Recinto->getPreciosMinRecinto();
      $data['precioMin'] = $precioMin;

      $comentarios = $this->Recinto->getComentariosRecinto();
      $data['comentario'] = $comentarios;

      $tipos= $this->Recinto->getTiposRecinto();
      $data['tipo'] = $tipos;


      $this->view->show("_adminGraficosRecintos.php", $data);
     }



}
?>