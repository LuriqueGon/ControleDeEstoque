<?php 

    namespace App\Controllers;
    use MF\Controller\Action;
    use MF\Model\Container;

    class FabricanteController extends Action{

        public function adicionarFabricante(){

            $fabricante = Container::getModel('fabricante');
            $fabricante->__set('nome', $_POST['NomeFabricante']);
            $fabricante->__set('cnpj', $_POST['CNPJFabricante']);
            $fabricante->__set('email', $_POST['EmailFabricante']);
            $fabricante->__set('endereco', $_POST['EnderecoFabricante']);
            $fabricante->__set('telefone', $_POST['TelefoneFabricante']);
            $fabricante->__set('idUser', $_POST['iduser']);

            

            if($fabricante->adicionarFabricantes()){

                $representante = Container::getModel('representante');
                $representante->__set('nome', $_POST['NomeRepresentante']);
                $representante->__set('telefone', $_POST['TelefoneRepresentante']);
                $representante->__set('email', $_POST['EmailRepresentante']);
                $representante->__set('idUser', $_POST['iduser']);
                $representante->__set('idFabricante', $fabricante->getId());
                
                if($representante->adicionarRepresentantes()){
                    header('location: /?content=visualizar/fabricantes&action=1&msg=sucesso');
                }else{
                    header('location: /?content=visualizar/fabricantes&action=0&msg=error');
                }
            }
        
        }

        public function desativar(){
            $fabricante = Container::getModel('fabricante');
            $fabricante->__set('id', $_GET['id']);
            $fabricante->desativar();

            echo 'fabricante desativado';
        }

        public function ativar(){
            $fabricante = Container::getModel('fabricante');
            $fabricante->__set('id', $_GET['id']);
            $fabricante->ativar();

            echo 'fabricante ativado';
        }
        
        public function editar(){
            echo '<pre>';
            var_dump($_POST);
            echo '</pre>';
        
            $fabricante = Container::getModel('fabricante');
            $fabricante->__set('id', $_POST['idFabricante']);
            $fabricante->__set('nome', $_POST['NomeFabricante']);
            $fabricante->__set('cnpj', $_POST['CNPJFabricante']);
            $fabricante->__set('email', $_POST['EmailFabricante']);
            $fabricante->__set('endereco', $_POST['EnderecoFabricante']);
            $fabricante->__set('telefone', $_POST['TelefoneFabricante']);
            $fabricante->__set('idUser', $_POST['iduser']);

            echo '<pre>';
            var_dump($fabricante);
            echo '</pre>';

            if($fabricante->editar()){
                header('location: /?content=visualizar/fabricantes');
            }

            // var_dump($fabricante);
            

        }
        
        

        
    }

?>