<?php if ($_SESSION['perm'] >= 3) { ?>

    <section class="content-header">
        <h1>Editar Fabricantes</h1>
        <hr style="border: 2px solid red;">
    </section>

    <section class="content">
        <div class="container">

            <div class="row">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Fabricante</h3>
                        </div>
                        <form role="form" action="/fabricantes/editar" method="POST">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nome da Empresa</label>
                                    <input type="text" name="NomeFabricante" value="<?php echo $_GET['nomeFabricante'] ?>" class="form-control" id="exampleInputEmail1" placeholder="Nome Fabricante" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">CNPJ</label>
                                    <input type="text" name="CNPJFabricante" value="<?php echo $_GET['CNPJFabricante'] ?>" class="form-control" id="exampleInputEmail1" placeholder="CNPJ" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">E-mail</label>
                                    <input type="text" name="EmailFabricante" value="<?php echo $_GET['EmailFabricante'] ?>" class="form-control" id="exampleInputEmail1" placeholder="E-mail" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Endereco</label>
                                    <input type="text" name="EnderecoFabricante" value="<?php echo $_GET['enderecoFabricante'] ?>" class="form-control" id="exampleInputEmail1" placeholder="Endereço" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Telefone</label>
                                    <input type="text" name="TelefoneFabricante" value="<?php echo $_GET['TelefoneFabricante'] ?>" class="form-control" id="exampleInputEmail1" placeholder="Telefone" required>
                                </div>


                                <input type="hidden" name="iduser" value="<?php echo $_SESSION['idUsuario'] ?>">
                                <input type="hidden" name="idFabricante" value="<?php echo $_GET['id'] ?>">

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Atualizar</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php } else { 
    $this->loadComponent('restrito');
} 