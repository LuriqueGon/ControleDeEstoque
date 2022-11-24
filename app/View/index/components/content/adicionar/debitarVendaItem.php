<?php

use MF\Model\Container;

    $item = Container::getModel('item');
    $itens = $item->getAll(1);

?>
<section class="content-header">
    <h1>Debitar Itens Vendas</h1>
    <hr style="border: 2px solid aqua;">
</section>
<div class="container">
    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="box box-primary">

                    <form role="form" action="/vendedor/vendas/debitarItem" method="POST">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Item </label>
                                <select class="form-control" name="cdb" required>
                                    <?php foreach ($itens as $item) { ?>
                                        <option value="<?php echo $item['cdb'] ?>">
                                            <?php echo $item['descricao'] ?> | <?php echo $item['quantItens'] -  $item['quantItensVend']?> Uni Em estoque
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Quantidade</label>
                                <input type="text" name="quantidade" class="form-control" placeholder="Quantidade" required style="border: 1px solid;">
                            </div>

                            <input type="hidden" name="iduser" value="<?php echo $_SESSION['idUsuario'] ?>">

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Cadastrar</button>
                                <button type="reset" class="btn btn-danger">Cancelar</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>'
    </section>
</div>
<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == 1) {
        $this->view->type = 'success';
        $this->view->msg = 'Item debitado com sucesso';
    } else if ($_GET['action'] == 2) {
        $this->view->type = 'danger';
        $this->view->msg = 'Você colocou um numero maior para debitar, do que possui em estoque';
    }else if ($_GET['action'] == 3) {
        $this->view->type = 'danger';
        $this->view->msg = 'Erro ao debitar Item';
    }
    $this->view->time = '1 second ago';
    $this->view->typePage = 'adicionar';
    $this->view->page = 'debitarVendaItem';
    $this->loadComponent('toast');
    echo '<script>delToast()</script>';
}
?>