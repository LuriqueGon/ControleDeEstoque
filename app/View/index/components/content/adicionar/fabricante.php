<?php if($_SESSION['perm']>=3){?>
    <section class="content-header">
        <h1>Adicionar Fabricantes</h1>
        <hr style="border: 2px solid green;">
    </section>

    <section class="content">
        <div class="container">

            <div class="row">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Fabricante</h3>
                        </div>
                        <form role="form" action="/fabricantes/adicionarFabricante" method="POST">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nome da Empresa</label>
                                    <input type="text" name="NomeFabricante" class="form-control" id="exampleInputEmail1" placeholder="Nome Fabricante" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">CNPJ</label>
                                    <input type="text" name="CNPJFabricante" class="form-control" id="exampleInputEmail1" placeholder="CNPJ" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">E-mail</label>
                                    <input type="text" name="EmailFabricante" class="form-control" id="exampleInputEmail1" placeholder="E-mail" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Endereco</label>
                                    <input type="text" name="EnderecoFabricante" class="form-control" id="exampleInputEmail1" placeholder="Endereço" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Telefone</label>
                                    <input type="text" name="TelefoneFabricante" class="form-control" id="exampleInputEmail1" placeholder="Telefone" required>
                                </div>
                                <hr />
                                <div class="box-header with-border">
                                    <h3 class="box-title">Representante</h3>
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nome</label>
                                    <input type="text" name="NomeRepresentante" class="form-control" id="exampleInputEmail1" placeholder="Nome do Representante" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Telefone</label>
                                    <input type="text" name="TelefoneRepresentante" class="form-control" id="exampleInputEmail1" placeholder="Telefone" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">E-mail</label>
                                    <input type="text" name="EmailRepresentante" class="form-control" id="exampleInputEmail1" placeholder="E-mail " required>
                                </div>


                                <input type="hidden" name="iduser" value="<?php echo $_SESSION['idUsuario'] ?>" required>

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary" value="Cadastrar">Cadastrar</button>
                                    <a class="btn btn-danger" href="../../views/prod">Cancelar</a>
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