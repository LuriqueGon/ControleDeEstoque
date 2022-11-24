<?php

use MF\Model\Container;

if ($_SESSION['perm'] >= 3) {
    $fabricante = Container::getModel('fabricante');
    $fabricantes = $fabricante->getAll(1);

?>


    <section class="content-header">
        <h1>Adicionar Representante</h1>
        <hr style="border: 2px solid green;">
    </section>

    <div class="container">
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-primary">

                        <form role="form" action="/representantes/adicionarRepresentante" method="POST">
                            <div class="box-body">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Representante</h3>
                                </div>
                                <br><br>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Empresa Representanda</label>
                                    <select class="form-control" name="idFabricante" required>
                                        <?php foreach ($fabricantes as $fabricante) { ?>
                                            <option value="<?php echo $fabricante['idFabricante'] ?>"><?php echo $fabricante['nomeFabricante'] ?></option>
                                        <?php } ?>
                                    </select>
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
<?php } else { 
    $this->loadComponent('restrito');
} 