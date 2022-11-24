<?php 

    namespace App\Controllers;
    use MF\Controller\Action;

    class IndexController extends Action{

        public function index(){
            $this->auth();
            $this->render('index', 'layout2');

        }


        
        
    }

?>