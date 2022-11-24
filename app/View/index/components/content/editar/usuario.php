<?php if ($_SESSION['perm'] >= 3) { ?>

    <div class="register-box container mt-5" style="width: 45% !important;">
        <div class="card card-outline">
            <div class="card-body">
                <form action="/usuarios/editar" method="post" enctype="multipart/form-data">
                    <div class="input-group mb-3">
                        <input type="text" name="usuario" value="<?php echo $_GET['Username'] ?>" class="form-control" placeholder="Usuario">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" name="email" value="<?php echo $_GET['Email'] ?>" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <select name="permissao" value="<?php echo $_GET['Permissao'] ?>" class="form-control">

                            <?php if ($_GET['Permissao'] == 1) { ?>
                                <option value="1" selected>Vendedor</option>
                                <option value="2">RH</option>
                                <option value="3">Gerente</option>
                                <option value="4">Admin</option>
                                <option value="5">Full</option>
                            <?php } elseif ($_GET['Permissao'] == 2) { ?>
                                <option value="1">Vendedor</option>
                                <option value="2" selected>RH</option>
                                <option value="3">Gerente</option>
                                <option value="4">Admin</option>
                                <option value="5">Full</option>
                            <?php } elseif ($_GET['Permissao'] == 3) { ?>
                                <option value="1">Vendedor</option>
                                <option value="2">RH</option>
                                <option value="3" selected>Gerente</option>
                                <option value="4">Admin</option>
                                <option value="5">Full</option>
                            <?php } elseif ($_GET['Permissao'] == 4) { ?>
                                <option value="1">Vendedor</option>
                                <option value="2">RH</option>
                                <option value="3">Gerente</option>
                                <option value="4" selected>Admin</option>
                                <option value="5">Full</option>
                            <?php } elseif ($_GET['Permissao'] == 5) { ?>
                                <option value="1">Vendedor</option>
                                <option value="2">RH</option>
                                <option value="3">Gerente</option>
                                <option value="4">Admin</option>
                                <option value="5" selected>Full</option>
                            <?php } ?>

                        </select>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label for="inputGroupFile01" class="input-group-text">Imagem</label>
                        </div>
                        <div class="custom-file">
                            <input type="file" name="perfil" value="<?php echo $_GET['perfil'] ?>" class="custom-file-input" id="inputGroupFile01">
                            <label class="custom-file-label" for="inputGroupFile01"><?php echo empty($_GET['perfil']) ? "Escolha um Arquivo" : $_GET['perfil'] ?></label>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="hidden" name="idUser" value="<?php echo $_GET['idUser'] ?>" class="form-control" placeholder="Email">

                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-8">
                            <button type="submit" class="btn btn-primary btn-block">Atualizar</button>
                        </div>


                    </div>

                </form>
            </div>
        </div>
    </div>
    <script type="application/javascript">
        $(document).on('change', '.custom-file-input', function(event) {
            $(this).next('.custom-file-label').html(event.target.files[0].name);
        })
    </script>
<?php } else { 
    $this->loadComponent('restrito');
} 