<?php

use MF\Model\Container;


?>


<section class="content-header">
    <h1>Cadastrar Cliente</h1>
    <hr style="border: 2px solid green;">
</section>

<div class="container">
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">

                    <form role="form" action="/clientes/cadastrarCliente" method="POST">
                        <div class="box-body">
                            <div class="box-header with-border">
                                <h3 class="box-title">Cliente</h3>
                            </div>
                            <br><br>
                            <div class="form-group">
                                <label for="exampleInputEmail1">CPF</label>
                                <input type="text" name="CPF" class="form-control" id="exampleInputEmail1" placeholder="CPF" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Telefone</label>
                                <input type="text" name="Telefone" class="form-control" id="exampleInputEmail1" placeholder="Telefone" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nome</label>
                                <input type="text" name="Nome" class="form-control" id="exampleInputEmail1" placeholder="Nome" required>
                            </div>
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
