<?php if ($_SESSION['perm'] >= 3) { ?>

    <section class="content-header">
        <h1>Editar Produtos</h1>
        <hr style="border: 2px solid red;">
    </section>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Produto</h3>
                    </div>
                    <form role="form" action="/produtos/editar" method="POST">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome do Produto</label>
                                <input type="text" name="nomeProduto" value="<?php echo $_GET['NomeProduto'] ?>" class="form-control" id="exampleInputEmail1" placeholder="Nome Produto" required>
                            </div>
                            <input type="hidden" name="idUsuario" value="<?php echo $_SESSION['idUsuario'] ?>">
                            <input type="hidden" name="CodRefProduto" value="<?php echo $_GET['CodRefProduto'] ?>">

                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">Atualizar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } else { 
    $this->loadComponent('restrito');
} 