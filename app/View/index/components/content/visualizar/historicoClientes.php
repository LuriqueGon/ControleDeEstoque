<?php

use MF\Model\Container;
$cpf = '12345678910';

if(!isset($_GET['cpf'])){?>
    <script>alert("Por não informar o cpf, o padrão do sistema foi adotado como : <?php echo $cpf ?> \n\n Para ter acesso ao historico pelo cpf, vá até a sessão Clientes-Todos Cliente, e clique em visualizar Historico!!! \n\n Cado contrario informe pelo URL do sistema, adicionando \n\t\t '| &cpf=12345678910 |' \n Após o fim da url!! \n \n OBS: SEM ESPAÇO NA URL")</script>
<?php }

$historico = Container::getModel('historico');
$cpf = isset($_GET['cpf']) ? $_GET['cpf'] : $cpf;
?>

<section class="content-header text-center">
    <h1>Historico dos Clientes </h1>
    <hr style="border: 2px solid blue;">
</section>
<div class="box-footer clearfix no-border">
    <a href="/?content=visualizar/allCLientes" type="button" class="btn btn-success pull-right" style="font-size: 1.2rem; margin-left: 2rem;"><i class="fa-regular fa-hand-point-left"></i> Voltar Clientes</a>
</div>
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
                                            <th>CPF</th>
                                            <th>Total</th>
                                            <th>Pagamento</th>
                                            <th>Data</th>
                                            <th>Informações Compra</th>

                                        </tr>
                                    </thead>
                                    <tbody style="font-size: .8rem;">
                                                <?php
                                                $historico->__set('cpf', $cpf);
                                                $itens = $historico->getItemHistorico();

                                                foreach ($itens as $key => $item) { ?>
                                                    <tr>

                                                    <td class="CPF tdItem"><?php echo $item['cpf'] ?></td>
                                                    <td class=" tdItem">R$ <?php echo number_format($item['valorPago'], 2, ',', '.') ?></td>
                                                    <td class=" tdItem"><?php echo $item['MDP'] ?></td>
                                                    <td class="dataCompra tdItem"><?php echo $item['ultima_compra'] ?></td>
                                                    <td>
                                                        <table id="example2" class="table table-light table-bordered text-dark">
                                                            <thead class="thead-dark">
                                                                <tr>
                                                                    <th>Cód Barras</th>
                                                                    <th style="text-align: start;">Desc</th>
                                                                    <th>Valor U</th>
                                                                    <th>Quant</th>
                                                                    <th>Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody style="font-size: .8rem;">
                                                                <?php for ($i = 0; $i < count($item['produtos']); $i++) { ?>
                                                                    <tr>
                                                                        <td><?php echo $item['produtos'][$i]['cdb'] ?></td>
                                                                        <td style="text-align: start;"><?php echo $item['produtos'][$i]['descricao'] ?></td>
                                                                        <td>R$ <?php echo number_format($item['produtos'][$i]['valVendItem'], 2, ',', '.') ?></td>
                                                                        <td><?php echo $item['produtos'][$i]['quantidade'] ?></td>
                                                                        <td>R$ <?php echo number_format(($item['produtos'][$i]['valVendItem'] * $item['produtos'][$i]['quantidade']), 2, ',', '.') ?></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                    </tr>
                                                <?php } ?>
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


<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": true,
            "searching": true,
            "autoWidth": false,
            "ordering": true,
            "paging": true,
            "info": true,
            "buttons": ["pdf", "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>
<script src="/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="/plugins/jszip/jszip.min.js"></script>
<script src="/plugins/pdfmake/pdfmake.min.js"></script>
<script src="/plugins/pdfmake/vfs_fonts.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script>
    const atualizarCPF = () => {

        let cpf = document.querySelectorAll('.CPF')

        cpf.forEach((item, ind) => {
            let bloco1 = item.textContent.slice(0, 3)
            let bloco2 = item.textContent.slice(3, 6)
            let bloco3 = item.textContent.slice(6, 9)
            let bloco4 = item.textContent.slice(9, 11)

            let cpf = `${bloco1}.${bloco2}.${bloco3}-${bloco4}`

            document.querySelectorAll('.CPF')[ind].innerHTML = `<strong>${cpf}</strong> `

        });


    }

    const atualizarData = () => {
        let datas = document.querySelectorAll('.dataCompra')

        datas.forEach((item, ind) => {
            let data = new Date(item.textContent)

            let day = data.getDate()
            let mouth = data.getMonth() + 1
            let year = data.getFullYear()
            let hour = data.getHours()
            let minute = data.getMinutes()

            day = day.toString().length < 2 ? `0${day}` : day
            mouth = mouth.toString().length < 2 ? `0${mouth}` : mouth
            year = year.toString().length < 2 ? `0${year}` : year
            hour = hour.toString().length < 2 ? `0${hour}` : hour
            minute = minute.toString().length < 2 ? `0${minute}` : minute

            let dataformatada = `${day}/${mouth}/${year}`
            let horaFormatada = `${hour} : ${minute}`
            document.querySelectorAll('.dataCompra')[ind].innerHTML = `Data : ${dataformatada}<br>Hora : ${horaFormatada}`

        });
    }

    atualizarCPF()
    atualizarData()
</script>

<?php
if (isset($_GET['action'])) {
    if ($_GET['action'] == 1) {
        $this->view->type = 'success';
        $this->view->msg = 'Item adicionado ao Estoque com sucesso';
    }
    $this->view->time = '1 second ago';
    $this->view->page = 'itensDetails';
    $this->loadComponent('toast');
    echo '<script>delToast()</script>';
}
?>