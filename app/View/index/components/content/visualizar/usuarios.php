td<?php

use MF\Model\Container;

if ($_SESSION['perm'] >= 3) { 

    $user = Container::getModel('usuario');
    $usuarios = $user->getAll();


    ?>

    <section class="content-header">
        <h1>Usuarios</h1>
        <hr style="border: 2px solid blue;">
    </section>
    <div class="container">
        <section class="content">
            <div class="row">
                <div class="box box-primary">

                    <div class="box-header">
                        <h4 class="box-title"><i class="ion ion-clipboard"></i> Lista de Usuarios</h4>
                    </div>

                    <div class="box-body">
                        <ul class="todo-list">
                            
                        </ul>
                    </div>
                    <?php if ($_SESSION['perm'] >= 3) { ?>
                        <div class="box-footer clearfix no-border" style="position: absolute;right: 9rem;/* float: right; */background: white;">
                            <a href="/?content=adicionar/usuario" type="button" class="btn btn-default pull-right" style="font-size: 1.2rem;"><i class="fa fa-plus"></i> Add Usuarios</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
    </div>

    <?php
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 1) {
            $this->view->type = 'success';
            $this->view->msg = 'Usuario adicionado com sucesso';
        } else if ($_GET['action'] == 2) {
            $this->view->type = 'danger';
            $this->view->msg = 'Erro ao adicionar Usuario';
        } else if ($_GET['action'] == 3) {
            $this->view->type = 'success';
            $this->view->msg = 'Usuario editado com sucesso';
        } else if ($_GET['action'] == 4) {
            $this->view->type = 'danger';
            $this->view->msg = 'Somente JPG e PNG são aceitos';
        }
        $this->view->time = '1 second ago';
        $this->view->page = 'usuarios';
        $this->loadComponent('toast');
        echo '<script>delToast()</script>';
    }
    ?>
<?php } else { 
    $this->loadComponent('restrito');
} ?>

<div class="mainContainer">
    <div class="row">
        <div class="box box-primary m-auto">
            <div class="box-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                            <table id="example1" class="table table-dark table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Ativo</th>
                                            <th>Data de Criação</th>
                                            <th>Perfil</th>
                                            <th>Usuario</th>
                                            <th>Email</th>
                                            <th>Permissão</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($usuarios as $usuario) { ?>
                                        <?php if ($usuario['ativo'] == 1) { ?>
                                            <tr id="usuariosItem<?php echo $usuario['idUser'] ?>">
                                        <?php } else { ?>
                                            <tr id="usuariosItem<?php echo $usuario['idUser'] ?>" class="inativo">
                                        <?php } ?>
                                        <?php if ($usuario['ativo'] == 1) { ?>
                                            <td><input type="checkbox" value="<?php echo $usuario['idUser'] ?>" id="usuarios<?php echo $usuario['idUser'] ?>" onchange="atualizarAtivo(1,'<?php echo $usuario['idUser'] ?>','usuarios')" checked></td>
                                        <?php } else { ?>
                                            <td><input type="checkbox" value="<?php echo $usuario['idUser'] ?>" id="usuarios<?php echo $usuario['idUser'] ?>" onchange="atualizarAtivo(0,'<?php echo $usuario['idUser'] ?>','usuarios')"></td>
                                        <?php } ?>
                                        <td><?php echo date('d/m/Y', strtotime($usuario['DataRegistro'])) ?></td>
                                        <td class="img">
                                            <img src="/dist/img/<?php echo $usuario['perfil'] ?>">
                                        </td>
                                        <td><?php echo $usuario['Email'] ?></td>
                                        <td><?php echo $usuario['Username'] ?></td>
                                        <td><?php echo $usuario['Permissao'] ?></td>
                                        <td>

                                            <div class="ico">
                                                <a href="
                                                    /?content=editar/usuario&
                                                    idUser=<?php echo $usuario['idUser'] ?>&
                                                    Username=<?php echo $usuario['Username'] ?>&
                                                    Email=<?php echo $usuario['Email'] ?>&
                                                    perfil=<?php echo $usuario['perfil'] ?>&
                                                    Permissao=<?php echo $usuario['Permissao'] ?>
                                                    " type="button">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <?php if ($usuario['ativo'] == 1) { ?>
                                                    <a href="#" type="button" id="usuariosRemover<?php echo $usuario['idUser'] ?>" onclick="atualizarAtivo(1,'<?php echo $usuario['idUser'] ?>','usuarios')">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                <?php } else { ?>
                                                    <a href="#" class="displayNone" type="button" id="usuariosRemover<?php echo $usuario['idUser'] ?>" onclick="atualizarAtivo(0,'<?php echo $usuario['idUser'] ?>','usuarios')">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                <?php }  ?>
                                            </div>

                                        </td>
                                        </tr>
                                    <?php } ?>
                                        <br>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": false,
            "lengthChange": false,
            "searching": true,
            "autoWidth": false,
            "ordering": true,
            "paging": true,
            "info": true,
            "buttons": ["excel", "pdf", "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>