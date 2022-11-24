<?php

use MF\Model\Container;

if ($_SESSION['perm'] >= 3) {
    $item = Container::getModel('item');
    $itens = $item->getAll(1);
    
?>

    <section class="content-header">
        <h1>Adicionar Itens no Estoque</h1>
        <hr style="border: 2px solid aqua;">
    </section>

    <div class="container">
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <form role="form" action="/itens/adicionarItensEstoque" method="POST">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nome do Produto</label>

                                    <select class="form-control" name="cdb" required>
                                        <?php foreach ($itens as $item) { ?>
                                            <option value="<?php echo $item['cdb'] ?>"><?php echo $item['descricao'] ?> || <?php echo $item['quantItens'] - $item['quantItensVend'] ?> Em estoque</option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Quantidade+</label>
                                    <input type="number" name="quantItens" class="form-control" id="exampleInputEmail1" placeholder="Quantidade +" required>
                                </div>
                                <input type="hidden" name="iduser" value="<?php echo $_SESSION['idUsuario'] ?>">

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Adicionar</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php } else { 
    $this->loadComponent('restrito');
} 