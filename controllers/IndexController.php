<?php

require 'models/Recinto.php';
require 'models/Comentario.php';
require 'models/Usuario.php';
require 'models/Desafio.php';

class IndexController  {
	
	function __construct()
    {
        //Creamos una instancia de nuestro mini motor de plantillas
        $this->view = new View();
        $this->Recinto = new Recinto();
        $this->Comentario = new Comentario();
        $this->Usuario = new Usuario();
        $this->Desafio = new Desafio();
    }
 
    public function index()
    {
        //La pagina de inicio
        if(!isset($_SESSION)) { 
        session_start(); 
        } 
        if(!isset($_SESSION['login_user_id'])){
            $this->view->show("index.php");
        }else{
             $this->view->show("indexJugador.php");
        }
    }
    public function inicio(){
        $this->view->show("inicio.php");
    }

    public function indexJugador(){
        $this->view->show("indexJugador.php");
    }

    public function indexAdmin(){
        $recintos = count($this->Recinto->getRecintos());
        $comentarios = count($this->Comentario->getComentarios());
        $usuarios = count($this->Usuario->getUsuarios());
        $desafios = count($this->Desafio->getDesafiosIndex());
        $data['recintos'] = $recintos;
        $data['comentarios'] = $comentarios;
        $data['usuarios'] = $usuarios;
        $data['desafios'] = $desafios;
        $this->view->show("indexAdmin.php",$data);
    }
}

?>