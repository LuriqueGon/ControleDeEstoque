<?php 

    namespace App\Controllers;
    use MF\Controller\Action;
    use MF\Model\Container;

    class ClienteController extends Action{

        public function AddTelefone(){
            var_dump($_GET);

            $cliente = Container::getModel('cliente');
            $cliente->__set('id', $_GET['id']);
            $cliente->__set('telefone', $_GET['telefone']);

            $cliente->setTelefone();
        }
        
        public function AddNome(){

            $cliente = Container::getModel('cliente');
            $cliente->__set('id', $_GET['id']);
            $cliente->__set('nome', $_GET['nome']);
            var_dump($_GET);

            $cliente->setNome();
        }
        public function cadastrarCliente(){
            var_dump($_POST);

            $cliente = Container::getModel('cliente');
            $cliente->__set('cpf', $_POST['CPF']);
            $cliente->__set('nome', $_POST['Nome']);
            $cliente->__set('telefone', $_POST['Telefone']);
            if($cliente->cadastrarCliente()){
                header('location: /?content=visualizar/allCLientes&action=1');
            }
        }
    }

?>