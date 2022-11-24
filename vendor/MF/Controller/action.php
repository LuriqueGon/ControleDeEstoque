<?php

    namespace MF\Controller;

    abstract class Action{

        protected $view;   

        public function __construct(){
            $this->view = new \stdClass();
        }

        protected function render($view, $layout = 'layout'){
            $this->view->page = $view;

            if(file_exists("../app/View/layouts/$layout.phtml")){
                require_once "../app/View/layouts/$layout.phtml";
            }else{
                $this->content();
            }
        }

        protected function content(){
            $atualClass =  strtolower(str_replace('Controller', '',str_replace('App\\Controllers\\', '', get_class($this)))); 
            require_once "../app/View/$atualClass/".$this->view->page.".phtml";
        }

        protected function loadComponent($component){
            $atualClass =  strtolower(str_replace('Controller', '',str_replace('App\\Controllers\\', '', get_class($this)))); 
            if(file_exists("../app/View/".$atualClass."/components/".$component.".php")){
                include "../app/View/".$atualClass."/components/".$component.".php";
            }elseif($component == 'toast'){
                include "../app/View/index/components/toast.php";
            }elseif($component == 'restrito'){
                include "../app/View/index/components/restrito.php";
            }elseif($component == 'content/'){
                include "../app/View/index/components/default.php";
            }else{
                include "../app/View/index/components/notFound.php";
            }
        }

        protected function auth(){
            session_start();

            if(!isset($_SESSION['idUsuario'])){
                header('location: /login');
            }

            
        }
    }

?>