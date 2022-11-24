<section class="content-header">
    <h1>Consultar Itens Vendas</h1>
    <hr style="border: 2px solid aqua;">
</section>

<div class="container">
    <div class="row">
        <div class="col-md-4 m-auto" >
            <div class="box box-primary">
                <div class="box-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Código de Barras</label>
                        <input type="text" name="cdb" class="form-control" id="cdb" placeholder="Código de Barras" required style="border: 1px solid;">
                    </div>
                    <div class="box-footer">
                        <button type="button" class="btn btn-primary" onclick="consultarItem()">Consultar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br>
    <br><br><br><br>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table id="example1" class="table table-dark table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Código de Barras</th>
                                <th style="text-align: start;">Descrição</th>
                                <th>Uni Vendidas</th>
                                <th>Uni em Estoque</th>
                                <th>Sale</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": false,
            "lengthChange": false,
            "searching": false,
            "autoWidth": false,
            "ordering": false,
            "paging": false,
            "info": false,
            "buttons": []
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });

    const consultarItem = () =>{
        const item = document.querySelector('#cdb').value
        if(item == ""){
            alert('Campo vazio')
        }else if(item.toString().length == 13){
            $.ajax({
                type: "GET",
                url: "/vendedor/vendas/consultarItem",
                data: {cdb:item},
                dataType: 'JSON',
                success: function (response) {
                    if(response){
                        inserirTable(response)
                    }else{
                        $('tbody').html('<tr class="odd"><td valign="top" colspan="5" class="dataTables_empty">Nenhum dado foi encontrado</td></tr>')
                    }
                }
            });
        }
    }

    const inserirTable = response => {
        $('tbody').html('')

        const tr = document.createElement('tr')

        const cdb = document.createElement('td')
        cdb.textContent = response.cdb

        const descricao = document.createElement('td')
        descricao.textContent = response.descricao
        descricao.style.textAlign = "start"

        const estoque = document.createElement('td')
        estoque.textContent = response.quantItens - response.quantItensVend

        const quantItensVend = document.createElement('td')
        quantItensVend.textContent = response.quantItensVend

        const valVendItem = document.createElement('td')
        valVendItem.textContent = response.valVendItem


        
        tr.appendChild(cdb)
        tr.appendChild(descricao)
        tr.appendChild(quantItensVend)
        tr.appendChild(estoque)
        tr.appendChild(valVendItem)

        document.querySelector('tbody').appendChild(tr)
    }

    document.body.addEventListener('keydown', e => {
        if(e.keyCode == 13){
            consultarItem()
        }
    })
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