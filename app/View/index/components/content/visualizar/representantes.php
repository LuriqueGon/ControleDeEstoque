<?php

use MF\Model\Container;

$representante = Container::getModel('Representante');
$representantes = $representante->getAll();
$representantesAtivos = $representante->getAll(1);

?>

<section class="content-header">
    <h1>Representantes</h1>
    <hr style="border: 2px solid blue;">
</section>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == 1) {
        $this->view->type = 'success';
        $this->view->msg = 'Representante adicionado com sucesso';
    }else if($_GET['action'] == 2){
        $this->view->type = 'danger';
        $this->view->msg = 'Erro ao adicionar Representante';
    }else if($_GET['action'] == 3){
        $this->view->type = 'success';
        $this->view->msg = 'Representante editado com sucesso';
    }
    $this->view->time = '1 second ago';
    $this->view->page = 'representantes';
    $this->loadComponent('toast');
    echo '<script>delToast()</script>';
}
?>

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
                                            <?php if ($_SESSION['perm'] >= 3) { ?>
                                                <th>Ativo</th>
                                                <th>Fabricante</th>
                                                <th>Representante</th>
                                                <th>Email Representante</th>
                                                <th>Telefone Representante</th>
                                                <th>Ações</th>
                                            <?php }else{ ?>
                                                <th>Fabricante</th>
                                                <th>Representante</th>
                                                <th>Email Representante</th>
                                                <th>Telefone Representante</th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if ($_SESSION['perm'] >= 3) { ?>
                                        <?php foreach ($representantes as $representante) { ?>
                                            <?php if ($representante['ativo'] == 1) { ?>
                                                <tr id="representantesItem<?php echo $representante['idRepresentante']?>">
                                            <?php }else{ ?>
                                                <tr id="representantesItem<?php echo $representante['idRepresentante']?>" class="inativo">
                                            <?php } ?>
                                                <?php if ($representante['ativo'] == 1) { ?>
                                                    <td><input type="checkbox" id="representantes<?php echo $representante['idRepresentante'] ?>" onchange="atualizarAtivo(1,'<?php echo $representante['idRepresentante'] ?>','representantes')" checked></td>
                                                <?php } else { ?>
                                                    <td><input type="checkbox" id="representantes<?php echo $representante['idRepresentante'] ?>" onchange="atualizarAtivo(0,'<?php echo $representante['idRepresentante'] ?>','representantes')"></td>
                                                <?php } ?>
                                                    <td><?php echo $representante['nomeFabricante'] ?></td>
                                                    <td><?php echo $representante['nomeRepresentante'] ?></td>
                                                    <td><?php echo $representante['emailRepresentante'] ?></td>
                                                    <td><?php echo $representante['telefoneRepresentante'] ?></td>
                                                </abbr>

                                                    <td class="tools right ml-3">

                                                        <a href="/?content=editar/representante&idRepresentante=<?php echo $representante['idRepresentante'] ?>&nomeRepresentante=<?php echo $representante['nomeRepresentante'] ?>&telefoneRepresentante=<?php echo $representante['emailRepresentante'] ?>&emailRepresentante=<?php echo $representante['telefoneRepresentante'] ?>&fabricantes_idFabricante= <?php echo $representante['fabricantes_idFabricante'] ?>&usuarios_idUser= <?php echo $_SESSION['idUsuario'] ?>&" type="button"><i class="fa fa-edit"></i></a>

                                                        <?php if ($representante['ativo'] == 1) { ?><a href="#" type="button" id="representantesRemover<?php echo $representante['idRepresentante'] ?>" onclick="atualizarAtivo(1,'<?php echo $representante['idRepresentante'] ?>','representantes')">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        <?php } else { ?>
                                                            <a href="#" class="displayNone" type="button" id="representantesRemover<?php echo $representante['idRepresentante'] ?>" onclick="atualizarAtivo(0,'<?php echo $representante['idRepresentante'] ?>','representantes')">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        <?php }  ?>

                                                    </td>
                                            </tr>   
                                            <br>
                                        <?php } ?>
                                    <?php }else{ ?>
                                        <?php foreach ($representantesAtivos as $representante) { ?>
                                            <tr>
                                                <td><?php echo $representante['nomeFabricante'] ?></td>
                                                <td><?php echo $representante['nomeRepresentante'] ?></td>
                                                <td><?php echo $representante['emailRepresentante'] ?></td>
                                                <td><?php echo $representante['telefoneRepresentante'] ?></td>
                                            </tr>   
                                            <br>
                                        <?php } ?>
                                    <?php } ?>
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


<?php if ($_SESSION['perm'] >= 3) { ?>
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
<?php }else{ ?>
    <script>
    $(function() {
        $("#example1").DataTable({
            "responsive": false,
            "lengthChange": false,
            "searching": false,
            "autoWidth": false,
            "ordering": false,
            "paging": false,
            "info": false,
            "buttons": []
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
<?php } ?>

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