<?php

require 'models/Comentario.php';

session_start();

class ComentarioController{
		function __construct(){
        $this->view = new View();
        $this->Comentario = new Comentario();
    }

    public function index(){
    	$this->view->show("");
    }

    public function getComentarios(){
    		$idRecinto = $_GET['idRecinto'];
    		$comentario = new Comentario();
    		$listadoComentarios = $comentario->getComentarios();
            //var_dump($listadoComentarios);
    		$data['comentarios']= $listadoComentarios;
            var_dump($data['comentarios']);
    	    return $data;
    }
    public function getComentariosRecinto(){
            $idRecinto = $_GET['idRecinto'];
            $listadoComentarios = $this->Comentario->getComentariosRecinto($idRecinto);


            echo json_encode($listadoComentarios);

           
    }


    public function setComentario(){

        $contenido   =   $_POST['contenido'];
        $idRecinto = $_GET['idRecinto'];
        if(!isset($_SESSION)){
            session_start();
        }
        $idUsuario = $_SESSION['login_user_id'];


        $comentario = $this->Comentario->setComentario($idRecinto, $idUsuario, $contenido);

        echo json_encode($comentario);

        
        
    }

        public function mostrarComentarios(){
            $idRecinto = $_GET['idRecinto'];
            $data['idRecinto'] = $idRecinto;
            $this->view->show("_comentarios.php", $data);
        }
        public function mostrarComentariosLectura(){
            $idRecinto = $_GET['idRecinto'];
            $data['idRecinto'] = $idRecinto;
            $this->view->show("_comentariosLectura.php", $data);
        }


    /*    MODULO DE ADMINISTRACION  */
    public function adminComentarios(){
        $comentarios = $this->Comentario->getComentariosAdmin();
        $data['comentarios'] = $comentarios;
        if (isset($_SESSION['adminComentarios'])){
            $data['adminComentarios'] = $_SESSION['adminComentarios'];
        }
        $_SESSION['adminComentarios'] = 0;
        $this->view->show('adminComentarios.php',$data);
    }

    public function eliminarComentario(){
        $idComentario = $_POST['idComentario'];
        $this->Comentario->eliminarComentario($idComentario);
        $_SESSION['adminComentarios'] = 1;
        header('Location: ?controlador=Comentario&accion=adminComentarios');
    }
    }

?>