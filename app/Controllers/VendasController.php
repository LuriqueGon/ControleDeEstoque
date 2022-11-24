<?php 

    namespace App\Controllers;
    use MF\Controller\Action;
    use MF\Model\Container;

    class VendasController extends Action{

        public function iniciarVendas(){
            $this->render('vendas', 'layout3');
        }
        
        public function consultarItem(){

            $item = Container::getModel('item');
            $item->__set('CDB', $_GET['cdb']);
            
            echo json_encode($item->consultarItem());
        }
        
        public function debitarItem(){
            echo '<pre>';
            var_dump($_POST);
            echo '</pre>';

            $item = Container::getModel('item');
            $item->__set('CDB', $_POST['cdb']);
            if($item->getQuantItem() >= $_POST['quantidade']){
                $item->__set('QuantItens', $_POST['quantidade']);
                if($item->debitarItem()){
                    header('location: /?content=adicionar/debitarVendaItem&action=1');
                }else{
                    header('location: /?content=adicionar/debitarVendaItem&action=3');
                }
            }else{
                header('location: /?content=adicionar/debitarVendaItem&action=2');
            }
        }

        public function addItemVendas(){
            $_POST['quant'] = empty($_POST['quant']) ? 1 : $_POST['quant'];

            $vendas = Container::getModel('vendas');
            $vendas->__set('cdb', $_POST['cdb']);
            $vendas->__set('quantidade', $_POST['quant']);

            if($vendas->insertVendas()){
                header('location: /vendedor/vendas?action=1&cdb='.$_POST['cdb'].'&quant='.$_POST['quant']);
            }else{
                header('location: /vendedor/vendas?action=2');
            }

        }

        public function finalizarVendas(){

            $cliente = Container::getModel('cliente');
            $cliente->__set('cpf',$_GET['cpf']);
            if($cliente->cadastrarCliente()){
                $cliente->__set('primeira_compra',$_GET['date']);
                $cliente->__set('ultima_compra',$_GET['date']);
                $cliente->adicionarCompra();
            }

            $venda = Container::getModel('vendas');
            $vendas = serialize($venda->getAll());
            $itensVendidoss = $venda->getAll();

            $historico = Container::getModel('historico');
            $historico->__set('date',$_GET['date']);
            $historico->__set('produtos',$vendas);
            $historico->__set('valorPago',$_GET['valorPago']);
            $historico->__set('MDP',$_GET['MDP']);
            $historico->__set('cpf',$_GET['cpf']);
            $historico->adicionarHistorico();

            foreach ($itensVendidoss as $itemVendudo) {
                $item = Container::getModel('item');

                $item->__set('CDB',$itemVendudo['cdb']);
                $item->__set('QuantItens',$itemVendudo['quantidade']);
                $item->removerEstoque();
            }

            $user = Container::getModel('usuario');
            $user->__set('id', $_SESSION['idUsuario']);
            $user->setVendas();

            if($venda->apagarVendas()){
                header('location: /vendedor/vendas?action=5');
            }else{
                header('location: /vendedor/vendas?action=6');
            }
        }
        
        
    }

?>