<?php if ($_SESSION['perm'] >= 3) { ?>
<div class="register-box container mt-5" style="width: 45% !important;">
  <div class="card card-outline">
    <div class="card-body">
      <form action="/usuarios/register" autocomplete="off" method="post" enctype="multipart/form-data">
        <div class="input-group mb-3">
          <input type="text" name="usuario" class="form-control" placeholder="Usuario" autocomplete="FALSE">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email" autocomplete="FALSE">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="senha" class="form-control" placeholder="Senha" autocomplete="FALSE">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3 perm">
          <select name="permissao" class="form-control">
            <option value="1">Vendedor</option>
            <option value="2">RH</option>
            <option value="3">Gerente</option>
            <option value="4">Admin</option>
            <option value="5">Full</option>
          </select>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <label for="inputGroupFile01" class="input-group-text">Imagem</label>
          </div>
          <div class="custom-file">
            <input type="file" name="perfil" class="custom-file-input" id="inputGroupFile01" autocomplete="FALSE">
            <label class="custom-file-label" for="inputGroupFile01">Escolha um Arquivo</label>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
          </div>
          <div class="col-6">
            <button type="reset" class="btn btn-danger btn-block hovered">Cancelar</button>
          </div>
          
        </div>
        
      </form>
    </div>
  </div>
</div>
<script type="application/javascript">
    $(document).on('change', '.custom-file-input', function (event) {
      $(this).next('.custom-file-label').html(event.target.files[0].name);
    })
</script>
<?php } else { 
    $this->loadComponent('restrito');
} 