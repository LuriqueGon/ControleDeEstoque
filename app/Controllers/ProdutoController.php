<?php 

    namespace App\Controllers;
    use MF\Controller\Action;
    use MF\Model\Container;

    class ProdutoController extends Action{

        public function adicionarProduto(){

            $produto = Container::getModel('produto');
            $produto->__set('nomeProduto', $_POST['nomeProduto']);
            $produto->__set('idUsuario', $_POST['idUsuario']);
            
            if($produto->adicionarProduto()){
                header('location: /?content=visualizar/produtos&action=1&msg=sucesso');
            }else{
                header('location: /?content=visualizar/produtos&action=0&msg=error');
            }
            
        }

        public function desativar(){
            $produto = Container::getModel('produto');
            $produto->__set('ref', $_GET['id']);
            $produto->desativar();
        }

        public function ativar(){
            $produto = Container::getModel('produto');
            $produto->__set('ref', $_GET['id']);
            $produto->ativar();
        }
        
        public function editar(){
            $produto = Container::getModel('produto');
            $produto->__set('ref', $_POST['CodRefProduto']);
            $produto->__set('nomeProduto', $_POST['nomeProduto']);
            $produto->__set('idUsuario', $_POST['idUsuario']);

            var_dump($produto);
            if($produto->editar()){
                header('location: /?content=visualizar/produtos&action=3');
            }else{
                header('location: /?content=visualizar/produtos&action=2');
            }

        }
        
        
    }

?>