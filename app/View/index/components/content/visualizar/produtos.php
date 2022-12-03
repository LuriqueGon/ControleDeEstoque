<?php

use MF\Model\Container;

$produto = Container::getModel('produto');
$produtos = $produto->getAll();
$produtosAtivos = $produto->getAll(1);

?>

<section class="content-header">
    <h1>Produtos</h1>
    <hr style="border: 2px solid blue;">
</section>

<div class="container">
    <div class="content">
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
                                                    <th>Cód Ref</th>
                                                    <th>Nome</th>
                                                    <th>Ações</th>
                                                <?php }else{?>
                                                    <th>Cód Ref</th>
                                                    <th>Nome</th>
                                                <?php }?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($_SESSION['perm'] >= 3) { ?>
                                                <?php foreach ($produtos as $key => $prod) { ?>
                                                    <?php if ($prod['ativo'] == 1) { ?>
                                                    <tr id="produtosItem<?php echo $prod['CodRefProduto']?>">
                                                    <?php } else { ?>
                                                        <tr id="produtosItem<?php echo $prod['CodRefProduto']?>" class="inativo">
                                                    <?php } ?>
                                                        <td>
                                                            <?php if ($prod['ativo'] == 1) { ?>
                                                                <input type="checkbox" id="produtos<?php echo $prod['CodRefProduto'] ?>" value="<?php echo $prod['CodRefProduto'] ?>" onchange="atualizarAtivo(1,'<?php echo $prod['CodRefProduto'] ?>','produtos')" checked>
                                                            <?php } else { ?>
                                                                <input type="checkbox" id="produtos<?php echo $prod['CodRefProduto'] ?>" value="<?php echo $prod['CodRefProduto'] ?>" onchange="atualizarAtivo(0,'<?php echo $prod['CodRefProduto'] ?>','produtos')">
                                                            <?php } ?>
                                                        </td>
                                                        <td><?php echo $prod['CodRefProduto'] ?></td>
                                                        <td><?php echo $prod['NomeProduto'] ?></td>
                                                        <td>
                                                            <div class="ico">
                                                                <a href="/?content=editar/produto&CodRefProduto=<?php echo $prod['CodRefProduto'] ?>&NomeProduto=<?php echo $prod['NomeProduto'] ?>&" type="button"><i class="fa fa-edit"></i></a>
                                                                <?php if ($prod['ativo'] == 1) { ?>
                                                                    <a href="#" type="button" id="produtosRemover<?php echo $prod['CodRefProduto'] ?>" onclick="atualizarAtivo(1,'<?php echo $prod['CodRefProduto'] ?>', 'produtos')">
                                                                        <i class="fa fa-trash"></i>
                                                                    </a>
                                                                <?php } else { ?>
                                                                    <a href="#" class="displayNone" type="button" id="produtosRemover<?php echo $prod['CodRefProduto'] ?>" onclick="atualizarAtivo(0,'<?php echo $prod['CodRefProduto'] ?>', 'produtos')">
                                                                        <i class="fa fa-trash"></i>
                                                                    </a>
                                                                <?php }  ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            <?php }else{ ?>
                                                <?php foreach ($produtosAtivos as $key => $prod) { ?>
                                                    <tr>
                                                        <td><?php echo $prod['CodRefProduto'] ?></td>
                                                        <td><?php echo $prod['NomeProduto'] ?></td>
                                                    </tr>
                                                <?php } ?>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if ($_SESSION['perm'] >= 3) { ?>
                        <div class="box-footer clearfix no-border" style="position: absolute;right: 9rem;/* float: right; */background: white;">
                            <a href="/?content=adicionar/produto" type="button" class="btn btn-default pull-right" style="font-size: 1.2rem;"><i class="fa fa-plus"></i> Add Produtos</a>
                        </div>
                    <?php } ?>
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
                "lengthChange": true,
                "searching": true,
                "autoWidth": false,
                "ordering": true,
                "paging": true,
                "info": true,
                "buttons": ["excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
<?php }else{?>
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
<?php }?>
    

<?php
if (isset($_GET['action'])) {
    if($_GET['action'] == 0){
        $this->view->type = 'danger';
        $this->view->msg = 'O nome do produto não pode se repetir';
    }else if ($_GET['action'] == 1) {
        $this->view->type = 'success';
        $this->view->msg = 'Produto adicionado com sucesso';
    } else if ($_GET['action'] == 2) {
        $this->view->type = 'danger';
        $this->view->msg = 'Erro ao adicionar Produto';
    } else if ($_GET['action'] == 3) {
        $this->view->type = 'success';
        $this->view->msg = 'Produto Editado com sucesso';
    }
    $this->view->time = '1 second ago';
    $this->view->page = 'produtos';
    $this->loadComponent('toast');
    echo '<script>delToast()</script>';
}
?>
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