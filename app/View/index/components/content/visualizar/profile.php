<?php

    use MF\Model\Container;
    $user = Container::getModel('usuario');
    $user->__set('username',$_SESSION['usuario']);
    $informacoes = $user->getThis();

    // var_dump($informacoes);

?>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="/dist/img/<?php echo $_SESSION['perfil']?>" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center"><?php echo $_SESSION['usuario'] ?></h3>

                        <p class="text-muted text-center">Permissão Nivel <?php echo $_SESSION['perm'] ?></p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Vendas: </b> <a class="float-right"><?php echo $informacoes['quantVendas'] ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Registro: </b> <a class="float-right"><?php echo date('d/m/Y', strtotime($informacoes['DataRegistro'])) ?></a>
                            </li>
                            <li class="list-group-item">
                                <b>Email: </b> <a class="float-right"><?php echo $informacoes['Email'] ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="settings">
                                <form class="form-horizontal" action="/usuarios/editar/profile" method="POST">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Novo Nome</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="nome"value="<?php echo $informacoes['Username'] ?>" class="form-control" id="inputName" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Novo Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" name="email" value="<?php echo $informacoes['Email'] ?>" class="form-control" id="inputEmail" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName2" class="col-sm-2 col-form-label">Nova Senha</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="senha" class="form-control" id="inputName2" placeholder="Senha">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">Editar </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>