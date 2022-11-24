<?php

use MF\Model\Container;

$item = Container::getModel('item');
$itensAtivos = $item->getAll(1);
$totalVendas = 0;
$totalLucro = 0;
?>

<section class="content-header text-center">
    <h1>Itens Detalhados</h1>
    <hr style="border: 2px solid black;">
</section>
<div class="box-footer clearfix no-border">
    <a href="/?content=visualizar/itens" type="button" class="btn btn-success pull-right" style="font-size: 1.2rem; margin-left: 2rem;"><i class="fa-regular fa-hand-point-left"></i> Voltar Itens</a>
</div>
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
                                            <th>Código de Barras</th>
                                            <th style="text-align: start;">Descrição</th>
                                            <th>Uni Compradas</th>
                                            <th>Uni Vendidas</th>
                                            <th>Uni em Estoque</th>
                                            <th>Buy</th>
                                            <th>Sale</th>
                                            <th>Lucro</th>
                                            <th>Comprado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($itensAtivos as $item) { ?>
                                            <?php
                                                $lucro = ($item['quantItensVend'] * $item['valVendItem']) - ($item['quantItens'] * $item['valCompItem']);
                                                
                                                $totalVendas += $item['quantItensVend'] * $item['valVendItem'];                                        
                                                
                                                $lucroValue = $lucro>0 ? $lucro : 0;
                                                $totalLucro += $lucro;


                                            ?>
                                            <tr>
                                                <td style="font-weight: bold;"><?php echo $item['cdb'] ?></td>
                                                <td style="text-align: start; font-size: .6rem;"><?php echo $item['descricao'] ?></td>
                                                <td><?php echo $item['quantItens'] ?></td>
                                                <td><?php echo $item['quantItensVend'] ?></td>
                                                <td><?php echo $item['quantItens']  - $item['quantItensVend'] ?></td>
                                                <td>R$ <?php echo number_format($item['valCompItem'], 2, ',', '.') ?></td>
                                                <td>R$ <?php echo number_format($item['valVendItem'], 2, ',', '.') ?></td>
                                                <td>R$ <?php echo number_format($lucro, 2, ',', '.') ?></td>

                                                <td><?php echo date('d/m/Y', strtotime($item['dataCompra']))?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                                <div class="totais">
                                    <div class="totalVendidos">Total Vendas: R$ <?php echo number_format($totalVendas,2,',','.') ?></div>
                                    <div class="totalLucro">
                                        <?php if($totalLucro < 0){ echo "Prejuizo"; }else{ echo "Lucro";} ?>
                                         Total: R$ <?php echo number_format($totalLucro,2,',','.') ?>
                                    </div>
                                </div>
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
            "responsive": true,
            "lengthChange": true,
            "searching": true,
            "autoWidth": false,
            "ordering": false,
            "paging": false,
            "info": false,
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


<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == 1) {
        $this->view->type = 'success';
        $this->view->msg = 'Item adicionado ao Estoque com sucesso';
    }
    $this->view->time = '1 second ago';
    $this->view->page = 'itensDetails';
    $this->loadComponent('toast');
    echo '<script>delToast()</script>';
}
?>