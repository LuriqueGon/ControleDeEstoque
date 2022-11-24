<?php

use MF\Model\Container;

if ($_SESSION['perm'] >= 3) {

    $fabricante = Container::getModel('fabricante');
    $fabricante->__set('id', $_GET['fabricantes_idFabricante']);
    $fabricanteSelect = $fabricante->getFabricanteUsingId();

?>


    <section class="content-header">
        <h1>Editar Representante</h1>
        <hr style="border: 2px solid red;">
    </section>

    <div class="container">
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-primary">

                        <form role="form" action="/representantes/editar" method="POST">
                            <div class="box-body">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Representante</h3>
                                </div>
                                <br><br>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Empresa Representanda</label>
                                    <select class="form-control" name="idFabricante" required disabled>
                                        <option value="<?php echo $fabricanteSelect['idFabricante'] ?>"><?php echo $fabricanteSelect['nomeFabricante'] ?></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nome</label>
                                    <input type="text" name="NomeRepresentante" value="<?php echo $_GET['nomeRepresentante'] ?>" class="form-control" id="exampleInputEmail1" placeholder="Nome do Representante" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Telefone</label>
                                    <input type="text" name="TelefoneRepresentante" value="<?php echo $_GET['telefoneRepresentante'] ?>" class="form-control" id="exampleInputEmail1" placeholder="Telefone" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">E-mail</label>
                                    <input type="text" name="EmailRepresentante" value="<?php echo $_GET['emailRepresentante'] ?>" class="form-control" id="exampleInputEmail1" placeholder="E-mail " required>
                                </div>


                                <input type="hidden" name="iduser" value="<?php echo $_SESSION['idUsuario'] ?>">
                                <input type="hidden" name="idRepresentante" value="<?php echo $_GET['idRepresentante'] ?>">

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Atualizar</button>
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