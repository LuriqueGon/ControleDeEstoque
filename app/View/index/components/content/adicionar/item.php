<?php

use MF\Model\Container;

if ($_SESSION['perm'] >= 3) {
    $produto = Container::getModel('produto');
    $produtos = $produto->getAll(1);

    $fabricante = Container::getModel('fabricante');
    $fabricantes = $fabricante->getAll(1);
?>

    <section class="content-header">
        <h1>Adicionar Itens</h1>
        <hr style="border: 2px solid green;">
    </section>

    <div class="container">
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Itens</h3>
                        </div>
                        <form role="form" action="/itens/adicionarItem" method="POST">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nome do Produto</label>

                                    <select class="form-control" name="codProduto" required>
                                        <?php foreach ($produtos as $produto) { ?>
                                            <option value="<?php echo $produto['CodRefProduto'] ?>"><?php echo $produto['NomeProduto'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Fabricante</label>

                                    <select class="form-control" name="idFabricante" required>
                                        <?php foreach ($fabricantes as $fabricante) { ?>
                                            <option value="<?php echo $fabricante['idFabricante'] ?>"><?php echo $fabricante['nomeFabricante'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputCDB">Código de Barras</label>
                                    <input type="number" name="CDB" class="form-control" id="exampleInputCDB" placeholder="1234567891011" min="1" minlength="13" step="1" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputDescricao">Descrição</label>
                                    <input type="text" name="Descricao" class="form-control" id="exampleInputDescricao" placeholder="Descrição" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">QuantItens</label>
                                    <input type="text" name="QuantItens" class="form-control" id="exampleInputEmail1" placeholder="QuantItens" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">ValCompItens</label>
                                    <input type="text" name="ValCompItens" class="form-control" id="exampleInputEmail1" placeholder="00.00" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">ValVendItens</label>
                                    <input type="text" name="ValVendItens" class="form-control" id="exampleInputEmail1" placeholder="00.00" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">DataCompraItens</label>
                                    <input type="text" name="DataCompraItens" class="form-control" id="exampleInputEmail1" placeholder="YYYY - MM - DD" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">DataVenci_Itens</label>
                                    <input type="text" name="DataVenci_Itens" class="form-control" id="exampleInputEmail1" placeholder="YYYY - MM - DD">
                                </div>

                                <input type="hidden" name="iduser" value="<?php echo $_SESSION['idUsuario'] ?>">

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary" value="Cadastrar">Cadastrar</button>
                                    <button type="reset" class="btn btn-danger">Cancelar</button>
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