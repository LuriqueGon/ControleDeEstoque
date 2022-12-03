<?php

    use MF\Model\Container;

    $config = Container::getModel('config');
    $base = $config->getBase();
    $meta = $config->getMeta();
?>

<section class="content-header text-center">
    <h1>Todos as Configs</h1>
    <hr style="border: 2px solid blue;">
</section>
<div class="mainContainer">
    <div class="row">
        <div class="box box-primary m-auto">
            <div class="box-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                            <table id="example1" class="table table-dark table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Meta de Vendas</th>
                                            <td><button data-toggle="modal" data-target="#modal" style="background: transparent;color: white;border: 1px solid white;box-shadow: .1rem .3rem .5rem black;opacity: .8;text-transform: uppercase;">Setar Meta</button></td>
                                            <td><?php echo $meta ?></td>
                                        </tr>
                                        <tr>
                                            <th>Estoque Minimo</th>
                                            <td><button data-toggle="modal" data-target="#modal2" style="background: transparent;color: white;border: 1px solid white;box-shadow: .1rem .3rem .5rem black;opacity: .8;text-transform: uppercase;">Setar Base</button></td>
                                            <td><?php echo $base ?></td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Setar Meta<span class="userId"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Valor da Meta</label>
            <input type="number" name="meta" id="meta" class="form-control" id="exampleInputEmail1" placeholder="meta" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="setMeta()">Setar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="modal2" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Setar Base <span id="userId"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Valor da base</label>
            <input type="text" name="base" id="base" class="form-control" id="exampleInputEmail1" placeholder="base" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="setBase()">Setar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>

<script>
    const setMeta = () => {
        let meta = $('#meta').val()
        if(Number(meta) && meta != ""){
            $.ajax({
            type: "get",
            url: "/setarMeta",
            data: {meta:meta},
            success: (res) =>{
                console.log(res)
                alert("Base inserida com sucesso");
                location.reload()
            }
            })
        }
    }
    const setBase = () => {
        let base = $('#base').val()
        if(Number(base) && base != ""){
            $.ajax({
            type: "get",
            url: "/setarBase",
            data: {base:base},
            success: (res) =>{
                console.log(res)
                alert("Base inserida com sucesso");
                location.reload()
            }
            })
        }
    }
    
</script>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == 1) {
        $this->view->type = 'success';
        $this->view->msg = 'Cliente adicionado com sucesso';
    }
    $this->view->time = '1 second ago';
    $this->view->page = 'allClientes';
    $this->loadComponent('toast');
    echo '<script>delToast()</script>';
}
?>