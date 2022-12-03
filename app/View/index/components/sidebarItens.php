<nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">Controle de Estoque</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-barcode"></i>
                        <p>
                            Produtos
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/?content=visualizar/produtos" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Produtos</p>
                            </a>
                        </li>
                        <?php if($_SESSION['perm'] >= 3){?>
                            <li class="nav-item">
                                <a href="/?content=adicionar/produto" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Adicionar Produto</p>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-capsules"></i>
                        <p>
                            Itens
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/?content=visualizar/itens" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Itens</p>
                            </a>
                        </li>
                        <?php if($_SESSION['perm'] >= 3){?>
                            <li class="nav-item">
                                <a href="/?content=adicionar/item" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Adicionar Item</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="/?content=adicionar/itensEstoque" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Adicionar Itens ao Estoque</p>
                                </a>
                            </li>

                            

                        <?php } ?>
                        
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-truck-fast"></i>
                        <p>
                            Fabricantes
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/?content=visualizar/fabricantes" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Fabricantes</p>
                            </a>
                        </li>
                        <?php if($_SESSION['perm'] >= 3){?>
                            <li class="nav-item">
                                <a href="/?content=adicionar/fabricante" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Adicionar Fabricante</p>
                                </a>
                            </li>

                        <?php } ?>

                        
                        
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-cart-shopping"></i>
                        <p>
                            Representantes
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/?content=visualizar/representantes" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Representantes</p>
                            </a>
                        </li>
                        <?php if($_SESSION['perm'] >= 3){?>

                            <li class="nav-item">
                                <a href="/?content=adicionar/representante" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Adicionar Representante</p>
                                </a>
                            </li>
                        <?php } ?>
                        
                    </ul>
                </li>
                <?php if($_SESSION['perm'] >= 2){?>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fa-regular fa-user"></i>
                            <p>
                                Usuarios
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/?content=visualizar/usuarios" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Exibir Usuarios</p>
                                </a>
                            </li>
                            <?php if($_SESSION['perm'] >= 3){?>
                            <li class="nav-item">
                                <a href="/?content=adicionar/usuario" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Cadastrar Usuario</p>
                                </a>
                            </li>
                            <?php }?>
                                                       
                            
                        </ul>
                    </li>
                <?php }?>
                <li class="nav-header">Controle de Vendas</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-brands fa-sellcast"></i>
                        <p>
                            Vendas
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/?content=visualizar/consultarItem" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Consultar Item</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/vendedor/vendas" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Vender Itens</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/?content=adicionar/debitarVendaItem" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Debitar Venda Item</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="/?content=visualizar/historicoVendas" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Historico de Vendas</p>
                            </a>
                        </li>
                        
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-users"></i>
                        <p>
                            Clientes
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/?content=adicionar/cliente" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cadastrar Clientes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/?content=visualizar/allCLientes" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Todos Clientes</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="/?content=visualizar/comprasRecentes" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Compras Recentes</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/?content=visualizar/allCLientesToday" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Clientes do Dia</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/?content=visualizar/historicoClientes" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Historicos Clientes</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">Controle de Configurações</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fa-solid fa-bell"></i>
                        <p>
                            Config
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/?content=visualizar/allConfigs" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Configurações</p>
                            </a>
                        </li>
                        <?php if($_SESSION['perm'] >= 3){ ?>
                            <li class="nav-item">
                                <a href="/?content=visualizar/vendasMetas" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Metas de vendas</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/?content=visualizar/pagamentos" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Pagamentos</p>
                                </a>
                            </li>
                            
                        <?php }?>
                    </ul>
                </li>
            </ul>
        </nav>