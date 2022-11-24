<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="/" class="brand-link">
        <img src="dist/img/marketplace.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Controle de Estoque</span>
    </a>

    <div class="sidebar">
        <a href="/?content=visualizar/profile">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="dist/img/<?php echo $_SESSION['perfil'] ?>" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="/?content=visualizar/profile" class="d-block" data-permission="<?php echo $_SESSION['perm'] ?>"><?php echo ucfirst($_SESSION['usuario']) ?></a>
                </div>
            </div>
        </a>

        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        <?php $this->loadComponent('sidebarItens'); ?>
    </div>
</aside>