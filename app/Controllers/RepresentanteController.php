<?php 

    namespace App\Controllers;
    use MF\Controller\Action;
    use MF\Model\Container;

    class RepresentanteController extends Action{

        public function adicionarRepresentante(){

            
            $representante = Container::getModel('representante');

            $representante->__set('nome', $_POST['NomeRepresentante']);
            $representante->__set('telefone', $_POST['TelefoneRepresentante']);
            $representante->__set('email', $_POST['EmailRepresentante']);
            $representante->__set('idUser', $_POST['iduser']);
            $representante->__set('idFabricante', $_POST['idFabricante']);
            
            if($representante->adicionarRepresentantes()){
                header('location: /?content=visualizar/representantes&action=1&msg=success');
            }else{
                header('location: /?content=visualizar/representantes&action=0&msg=error');

            }
        }

        public function desativar(){
            $representante = Container::getModel('representante');
            $representante->__set('id', $_GET['id']);
            $representante->desativar();

            echo 'representante desativado';
        }

        public function ativar(){
            $representante = Container::getModel('representante');
            $representante->__set('id', $_GET['id']);
            $representante->ativar();

            echo 'representante ativado';
        }
            
        public function editar(){
            $representante = Container::getModel('representante');
            $representante->__set('id',$_POST['idRepresentante']);
            $representante->__set('nome',$_POST['NomeRepresentante']);
            $representante->__set('email',$_POST['EmailRepresentante']);
            $representante->__set('telefone',$_POST['TelefoneRepresentante']);
            $representante->__set('idUser',$_POST['iduser']);

            if($representante->editar()){
                header('location: /?content=visualizar/representantes&action=3');
            }else{
                header('location: /?content=visualizar/representantes&action=2');
            }
        }
            
        

            
            

            
    }

?>