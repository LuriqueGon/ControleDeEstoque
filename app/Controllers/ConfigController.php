<?php 

    namespace App\Controllers;
    use MF\Controller\Action;
    use MF\Model\Container;

    class ConfigController extends Action{

        public function setMeta(){
            var_dump($_GET);
            $config = Container::getModel('config');
            $config->__set('meta', $_GET['meta']);
            $config->setMeta();
        }
        
        
        public function setBase(){
            var_dump($_GET);
            $config = Container::getModel('config');
            $config->__set('base', $_GET['base']);
            $config->setBase();
        }
        
        
    }

?>