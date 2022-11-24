<?php

use MF\Model\Container;

if ($_SESSION['perm'] >= 3) {

    $produto = Container::getModel('produto');
    $produto->__set('ref', $_GET['produtos_CodRefProduto']);
    $produtoSelect = $produto->getProdutoUsingId();

    $fabricante = Container::getModel('fabricante');
    $fabricante->__set('id', $_GET['fabricantes_idFabricante']);
    $fabricanteSelect = $fabricante->getFabricanteUsingId();
?>

    <section class="content-header">
        <h1>Editar Itens</h1>
        <hr style="border: 2px solid red;">
    </section>

    <div class="container">
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Itens</h3>
                        </div>
                        <form role="form" action="/itens/editar" method="POST">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nome do Produto</label>

                                    <select class="form-control" name="codProduto" required disabled>
                                        <option value="<?php echo $produtoSelect['CodRefProduto'] ?>"><?php echo $produtoSelect['NomeProduto'] ?></option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Fabricante</label>

                                    <select class="form-control" name="idFabricante" required disabled>
                                        <option value="<?php echo $fabricanteSelect['idFabricante'] ?>"><?php echo $fabricanteSelect['nomeFabricante'] ?></option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputCDB">Código de Barras</label>
                                    <input type="number" name="CDB" value="<?php echo $_GET['cdb'] ?>" class="form-control" id="exampleInputCDB" placeholder="1234567891011" min="1" minlength="13" step="1" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputDescricao">Descrição</label>
                                    <input type="text" name="Descricao" value="<?php echo $_GET['descricao'] ?>" class="form-control" id="exampleInputDescricao" placeholder="Descrição" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">QuantItens</label>
                                    <input type="text" name="QuantItens" value="<?php echo $_GET['quantItens'] ?>" class="form-control" id="exampleInputEmail1" placeholder="QuantItens" required>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">ValCompItens</label>
                                    <input type="text" name="ValCompItens" value="<?php echo $_GET['valCompItem'] ?>" class="form-control" id="exampleInputEmail1" placeholder="00.00" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">ValVendItens</label>
                                    <input type="text" name="ValVendItens" value="<?php echo $_GET['valVendItem'] ?>" class="form-control" id="exampleInputEmail1" placeholder="00.00" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">DataCompraItens</label>
                                    <input type="text" name="DataCompraItens" value="<?php echo $_GET['dataCompra'] ?>" class="form-control" id="exampleInputEmail1" placeholder="YYYY - MM - DD" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">DataVenci_Itens</label>
                                    <input type="text" name="DataVenci_Itens" value="<?php echo $_GET['dataVencItem'] ?>" class="form-control" id="exampleInputEmail1" placeholder="YYYY - MM - DD">
                                </div>

                                <input type="hidden" name="iduser" value="<?php echo $_SESSION['idUsuario'] ?>">
                                <input type="hidden" name="iduser" value="<?php echo $_GET['idItens'] ?>">

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Atualizar</button>
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