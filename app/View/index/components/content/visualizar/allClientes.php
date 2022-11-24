<?php

    use MF\Model\Container;

    $clienteModel = Container::getModel('cliente');
    $clientes = $clienteModel->getAll();
?>

<section class="content-header text-center">
    <h1>Todos os Clientes</h1>
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
                                            <th>Index</th>
                                            <th>CPF</th>
                                            <th>Telefone</th>
                                            <th>Nome</th>
                                            <th>Primeira Compra</th>
                                            <th>Ultima Compra</th>
                                            <th>Total de Compras</th>
                                            <th>Historico</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <?php foreach($clientes as $key => $cliente){?>
                                            <tr>
                                                <td><?php echo $key+1 ?></td>
                                                <td><?php echo $clienteModel->formataCPF($cliente['cpf'])?></td>
                                                <td class="telefone"><?php echo empty($cliente['telefone']) ? '<button onclick="adicionarTelefone('.$cliente['id'].')" data-toggle="modal" data-target="#modal" style="background: transparent;color: white;border: 1px solid white;box-shadow: .1rem .3rem .5rem black;opacity: .8;text-transform: uppercase;">Cadastrar Telefone</button>' : $cliente['telefone']?></td>
                                                <td class="nome"><?php echo empty($cliente['nome']) ? '<button onclick="adicionarNome('.$cliente['id'].')" data-toggle="modal" data-target="#modal2" style="background: transparent;color: white;border: 1px solid white;box-shadow: .1rem .3rem .5rem black;opacity: .8;text-transform: uppercase;">Cadastrar Nome</button>' : $cliente['nome']?></td>
                                                
                                                <td><?php echo date('d/m/Y', strtotime($cliente['primeira_compra']))?></td>
                                                <td><?php echo date('d/m/Y', strtotime($cliente['ultima_compra']))?></td>
                                                <td><?php echo $cliente['totalCompras']?></td>
                                                <td class="telefone"><button onclick="location.href = '/?content=visualizar/historicoClientes&cpf=<?php echo $cliente['cpf'] ?>'" style="background: transparent;color: white;border: 1px solid white;box-shadow: .1rem .3rem .5rem black;opacity: .8;text-transform: uppercase;">Mostrar Historico</button></td>
                                            </tr>
                                        <?php }?>
                                    </tbody>
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
        <h5 class="modal-title">Adicionar telefone do usuario <span class="userId"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Telefone do CLiente</label>
            <input type="text" name="telefone" id="telefone" class="form-control" id="exampleInputEmail1" placeholder="Telefone" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="addTel()">Adicionar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="modal2" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Adicionar Nome do Cliente <span id="userId"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="exampleInputEmail1">Nome do CLiente</label>
            <input type="text" name="nome" id="nome" class="form-control" id="exampleInputEmail1" placeholder="Nome" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="addNome()">Adicionar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>


<script>

    const formatarTelefone = () => {
        let telefone = document.querySelectorAll('.telefone')

        telefone.forEach((e,i) => {
            telefone = e.textContent
            if(Number(telefone)){
                let ddd = telefone.slice(0,2)
                let pre 
                let pos
                if(telefone.length == 11){
                    pre = telefone.slice(2,7)
                    pos = telefone.slice(7,11)
                }else{
                    pre = telefone.slice(2,6)
                    pos = telefone.slice(6,10)
                }
    
                let telefoneFormatado = `(${ddd}) ${pre}-${pos}`
                document.querySelectorAll('.telefone')[i].textContent=telefoneFormatado
            }
        });
    }

    const adicionarTelefone = id => {
        $('.userId').text(id)
    }

    const adicionarNome = id => {
        $('#userId').text(id)
    }

    

    const addTel = () => {
        id = $('.userId').text()
        telefone = $('#telefone').val()

        $.ajax({
            type: "GET",
            url: "/clientes/addTelefone",
            data: {id:id, telefone:telefone},
        }).done(response=>{
            location.reload();
        })
    }

    const addNome = () => {
        id = $('#userId').text()
        nome = $('#nome').val()

        $.ajax({
            type: "GET",
            url: "/clientes/addNome",
            data: {id:id, nome:nome},
        }).done(response=>{
            location.reload();
        })
    }

    

    formatarTelefone()



    $(function() {
        $("#example1").DataTable({
            "responsive": false,
            "lengthChange": true,
            "searching": true,
            "autoWidth": false,
            "ordering": true,
            "paging": true,
            "info": false,
            "buttons": []
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
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