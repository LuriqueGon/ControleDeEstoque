<?php 

    namespace App\Controllers;
    use MF\Controller\Action;
    use MF\Model\Container;

    class ItemController extends Action{

        public function adicionarItem(){

            echo '<pre>';
            var_dump($_POST);
            echo '</pre>';

            $item = Container::getModel('item');

            $item->__set('codProduto', $_POST['codProduto']);
            $item->__set('idFabricante', $_POST['idFabricante']);
            $item->__set('CDB', $_POST['CDB']);
            $item->__set('Descricao', $_POST['Descricao']);
            $item->__set('QuantItens', $_POST['QuantItens']);
            $item->__set('ValCompItens', $_POST['ValCompItens']);
            $item->__set('ValVendItens', $_POST['ValVendItens']);
            $item->__set('DataCompraItens', $_POST['DataCompraItens']);
            $item->__set('DataVenci_Itens', $_POST['DataVenci_Itens']);
            $item->__set('iduser', $_POST['iduser']);

            if($item->adicionarItem()){
                header('location: /?content=visualizar/itens&action=1&msg=sucesso');
            }else{
                header('location: /?content=visualizar/itens&action=0&msg=error');
            }
           
            
        }

        public function desativar(){
            $item = Container::getModel('item');
            $item->__set('cdb', $_GET['id']);
            $item->desativar();

            echo 'Item desativado';
        }

        public function ativar(){
            $item = Container::getModel('item');
            $item->__set('cdb', $_GET['id']);
            $item->ativar();

            echo 'Item ativado';
        }

        public function editar(){
            $item = Container::getModel('item');
            $item->__set('CDB', $_POST['CDB']);
            $item->__set('Descricao', $_POST['Descricao']);
            $item->__set('QuantItens', $_POST['QuantItens']);
            $item->__set('ValCompItens', $_POST['ValCompItens']);
            $item->__set('ValVendItens', $_POST['ValVendItens']);
            $item->__set('DataCompraItens', $_POST['DataCompraItens']);
            $item->__set('DataVenci_Itens', $_POST['DataVenci_Itens']);
            $item->__set('iduser', $_POST['iduser']);

            if($item->editar()){
                header('location: /?content=visualizar/itens&action=3');
            }else{
                header('location: /?content=visualizar/itens&action=2');
            }

        }

        public function adicionarEstoque(){
            
            $item = Container::getModel('item');
            $item->__set('CDB', $_POST['cdb']);
            $item->__set('QuantItens', $_POST['quantItens']);
            $item->__set('DataCompraItens', str_replace('/','-',date('Y/m/d')));
            $item->adicionarEstoque();

            header('location: /?content=visualizar/itensDetails&action=1');
        }
        
    }
