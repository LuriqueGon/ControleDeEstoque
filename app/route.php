<?php

namespace App; 
use MF\Init\Bootstrap; 

    class Route extends Bootstrap{

        protected function initRoutes(){
            // INDEX
            $routes['home'] = array(
                'route' => '/',
                'controller' => 'IndexController',
                'action' => 'index'
            );  
            
            // AUTH
            $routes['login'] = array(
                'route' => '/login',
                'controller' => 'AuthController',
                'action' => 'login'
            );   
            $routes['sessao'] = array(
                'route' => '/sessao',
                'controller' => 'AuthController',
                'action' => 'sessao'
            );      
            $routes['forgotPassword'] = array(
                'route' => '/forgotPassword',
                'controller' => 'AuthController',
                'action' => 'forgotPassword'
            );      
            $routes['sair'] = array(
                'route' => '/sair',
                'controller' => 'AuthController',
                'action' => 'sair'
            );      

            // PRODUTO
            $routes['adicionarProduto'] = array(
                'route' => '/produtos/adicionarProduto',
                'controller' => 'ProdutoController',
                'action' => 'adicionarProduto'
            );      
            $routes['desativarProduto'] = array(
                'route' => '/produtos/desativar',
                'controller' => 'ProdutoController',
                'action' => 'desativar'
            );      
            $routes['ativarProduto'] = array(
                'route' => '/produtos/ativar',
                'controller' => 'ProdutoController',
                'action' => 'ativar'
            ); 
            $routes['editarProduto'] = array(
                'route' => '/produtos/editar',
                'controller' => 'ProdutoController',
                'action' => 'editar'
            ); 
            
            // ITEM
            $routes['adicionarItem'] = array(
                'route' => '/itens/adicionarItem',
                'controller' => 'ItemController',
                'action' => 'adicionarItem'
            );   
            $routes['desativarItem'] = array(
                'route' => '/itens/desativar',
                'controller' => 'ItemController',
                'action' => 'desativar'
            );      
            $routes['ativarItem'] = array(
                'route' => '/itens/ativar',
                'controller' => 'ItemController',
                'action' => 'ativar'
            );  
            $routes['editarItem'] = array(
                'route' => '/itens/editar',
                'controller' => 'ItemController',
                'action' => 'editar'
            );  
            $routes['additensestoque'] = array(
                'route' => '/itens/adicionarItensEstoque',
                'controller' => 'ItemController',
                'action' => 'adicionarEstoque'
            );  
            
            
            // FABRICANTE
            $routes['adicionarFabricante'] = array(
                'route' => '/fabricantes/adicionarFabricante',
                'controller' => 'FabricanteController',
                'action' => 'adicionarFabricante'
            ); 
            $routes['desativarFabricante'] = array(
                'route' => '/fabricantes/desativar',
                'controller' => 'FabricanteController',
                'action' => 'desativar'
            );      
            $routes['ativarFabricante'] = array(
                'route' => '/fabricantes/ativar',
                'controller' => 'FabricanteController',
                'action' => 'ativar'
            );  
            $routes['editarFabricante'] = array(
                'route' => '/fabricantes/editar',
                'controller' => 'FabricanteController',
                'action' => 'editar'
            );  
            

            // REPRESENTATE
            $routes['adicionarRepresentante'] = array(
                'route' => '/representantes/adicionarRepresentante',
                'controller' => 'RepresentanteController',
                'action' => 'adicionarRepresentante'
            ); 
            $routes['desativarRepresentante'] = array(
                'route' => '/representantes/desativar',
                'controller' => 'RepresentanteController',
                'action' => 'desativar'
            );      
            $routes['ativarRepresentante'] = array(
                'route' => '/representantes/ativar',
                'controller' => 'RepresentanteController',
                'action' => 'ativar'
            );  
            $routes['editarRepresentante'] = array(
                'route' => '/representantes/editar',
                'controller' => 'RepresentanteController',
                'action' => 'editar'
            );  

            // USUARIO

            $routes['register'] = array(
                'route' => '/usuarios/register',
                'controller' => 'UsuarioController',
                'action' => 'register'
            );  
            $routes['desativarUsuario'] = array(
                'route' => '/usuarios/desativar',
                'controller' => 'UsuarioController',
                'action' => 'desativar'
            );      
            $routes['ativarUsuario'] = array(
                'route' => '/usuarios/ativar',
                'controller' => 'UsuarioController',
                'action' => 'ativar'
            ); 
            $routes['editarUsuario'] = array(
                'route' => '/usuarios/editar',
                'controller' => 'UsuarioController',
                'action' => 'editar'
            ); 
            $routes['AutoEditarConta'] = array(
                'route' => '/usuarios/editar/profile',
                'controller' => 'UsuarioController',
                'action' => 'editarMinhaConta'
            ); 


            // VENDAS
            $routes['iniciarVendas'] = array(
                'route' => '/vendedor/vendas',
                'controller' => 'VendasController',
                'action' => 'iniciarVendas'
            ); 
            $routes['consultarVendas'] = array(
                'route' => '/vendedor/vendas/consultarItem',
                'controller' => 'VendasController',
                'action' => 'consultarItem'
            ); 
            $routes['debitarVendas'] = array(
                'route' => '/vendedor/vendas/debitarItem',
                'controller' => 'VendasController',
                'action' => 'debitarItem'
            ); 
            $routes['addItem Vendas'] = array(
                'route' => '/vendedor/vendas/addItem',
                'controller' => 'VendasController',
                'action' => 'addItemVendas'
            ); 
            $routes['Finalizar Vendas'] = array(
                'route' => '/vendedor/vendas/finalizarCompras',
                'controller' => 'VendasController',
                'action' => 'FinalizarVendas'
            ); 
            
            

            // CLIENTE
            $routes['AddTelefone'] = array(
                'route' => '/clientes/addTelefone',
                'controller' => 'ClienteController',
                'action' => 'AddTelefone'
            ); 
            $routes['AddNome'] = array(
                'route' => '/clientes/addNome',
                'controller' => 'ClienteController',
                'action' => 'AddNome'
            ); 
            $routes['cadastrarCliente'] = array(
                'route' => '/clientes/cadastrarCliente',
                'controller' => 'ClienteController',
                'action' => 'cadastrarCliente'
            ); 
            


            

            // TESTE ROUTE
            $routes['beta'] = array(
                'route' => '/teste',
                'controller' => 'BetaController',
                'action' => 'testar'
            ); 
            $routes['meta'] = array(
                'route' => '/setarMeta',
                'controller' => 'ConfigController',
                'action' => 'setMeta'
            ); 
            $routes['base'] = array(
                'route' => '/setarBase',
                'controller' => 'ConfigController',
                'action' => 'setBase'
            ); 
            
            

            
            
            
            $this->setRoutes($routes);
        }

        
    }

?>