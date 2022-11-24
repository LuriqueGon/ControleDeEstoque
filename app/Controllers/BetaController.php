<?php 

    namespace App\Controllers;
    use MF\Controller\Action;
    use MF\Model\Container;

    class BetaController extends Action{

        public function testar(){
            $this->render('teste', 'teste');
        }
        
    }

?>