<?php

use MF\Model\Container;

$fabricante = Container::getModel('fabricante');
$fabricantes = $fabricante->getAll();
$fabricantesAtivos = $fabricante->getAll(1);

?>

<section class="content-header">
    <h1>Fabricantes</h1>
    <hr style="border: 2px solid blue;">
</section>
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
                                                <th>CNPJ</th>
                                                <th>Nome</th>
                                                <th>Telefone</th>
                                                <th>Email</th>
                                                <th>Ações</th>
                                            <?php } else { ?>
                                                <th>CNPJ</th>
                                                <th>Nome</th>
                                                <th>Telefone</th>
                                                <th>Email</th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($_SESSION['perm'] >= 3) { ?>
                                            <?php foreach ($fabricantes as $fabricante) { ?>
                                                <?php if ($fabricante['ativo'] == 1) { ?>
                                                    <tr id="fabricantesItem<?php echo $fabricante['idFabricante']?>">
                                                <?php }else{ ?>
                                                    <tr id="fabricantesItem<?php echo $fabricante['idFabricante']?>" class="inativo">
                                                <?php } ?>
                                                
                                                <?php if ($fabricante['ativo'] == 1) { ?>
                                                    <td><input type="checkbox" id="fabricantes<?php echo $fabricante['idFabricante'] ?>" onchange="atualizarAtivo(1,'<?php echo $fabricante['idFabricante'] ?>','fabricantes')" checked></td>
                                                <?php } else { ?>
                                                    <td><input type="checkbox" id="fabricantes<?php echo $fabricante['idFabricante'] ?>" onchange="atualizarAtivo(0,'<?php echo $fabricante['idFabricante'] ?>','fabricantes')"></td>
                                                <?php } ?>
                                                    <td><?php echo $fabricante['CNPJFabricante'] ?></td>
                                                    <td><?php echo $fabricante['nomeFabricante'] ?></td>
                                                    <td><?php echo $fabricante['TelefoneFabricante'] ?></td>
                                                    <td><?php echo $fabricante['EmailFabricante'] ?></td>

                                                <td>

                                                    <div class="ico">
                                                        <a href="/?content=editar/fabricante&id=<?php echo $fabricante['idFabricante'] ?>&nomeFabricante=<?php echo $fabricante['nomeFabricante'] ?>&CNPJFabricante=<?php echo $fabricante['CNPJFabricante'] ?>&EmailFabricante=<?php echo $fabricante['EmailFabricante'] ?>&TelefoneFabricante=<?php echo $fabricante['TelefoneFabricante'] ?>&enderecoFabricante=<?php echo $fabricante['enderecoFabricante'] ?>" type="button"><i class="fa fa-edit"></i>
                                                        </a>
                                                        <?php if ($fabricante['ativo'] == 1) { ?>
                                                            <a href="#" type="button" id="fabricantesRemover<?php echo $fabricante['idFabricante'] ?>" onclick="atualizarAtivo(1,'<?php echo $fabricante['idFabricante'] ?>','fabricantes')"><i class="fa fa-trash"></i>
                                                            </a>
                                                        <?php } else { ?>
                                                            <a href="#" class="displayNone" type="button" id="fabricantesRemover<?php echo $fabricante['idFabricante'] ?>" onclick="atualizarAtivo(0,'<?php echo $fabricante['idFabricante'] ?>','fabricantes')">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        <?php } ?>
                                                    </div>
                                                </td>
                                            </tr>
                                            <br>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php foreach ($fabricantesAtivos as $fabricante) { ?>
                                                <tr>
                                                    <td><?php echo $fabricante['CNPJFabricante'] ?></td>
                                                    <td><?php echo $fabricante['nomeFabricante'] ?></td>
                                                    <td><?php echo $fabricante['TelefoneFabricante'] ?></td>
                                                    <td><?php echo $fabricante['EmailFabricante'] ?></td>
                                                </tr>
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
<?php } else { ?>
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


<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == 1) {
        $this->view->type = 'success';
        $this->view->msg = 'Fabricante adicionado com sucesso';
    } else if ($_GET['action'] == 2) {
        $this->view->type = 'danger';
        $this->view->msg = 'Erro ao adicionar Fabricante';
    }
    $this->view->time = '1 second ago';
    $this->view->page = 'fabricantes';
    $this->loadComponent('toast');
    echo '<script>delToast()</script>';
}
?>