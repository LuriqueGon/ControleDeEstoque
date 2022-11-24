<?php

use MF\Model\Container;

$historico = Container::getModel('historico');
$cpf = $historico->getCpf();
?>
<div class="container">
    <main class="historicoMain">
        <table id="example1" class="table table-dark table-bordered table-striped">
            <thead>
                <tr>
                    <th>CPF</th>
                    <th>Historico</th>
                </tr>
            </thead>
            <tbody>
                <?php
    
                foreach ($cpf as $key => $item) { ?>
                    <tr>
                        <td class="t CPF"><strong><?php echo $item['cpf'] ?></strong></td>
                        <td>
    
                            <table id="example2" class="table table-dark table-bordered text-light">
                                <thead>
                                    <tr>
                                        <th>Nº</th>
                                        <th style="border-bottom:0 ;">Produtos</th>
                                        <th>Total</th>
                                        <th>Data</th>
                                        <th>Vend - Id</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $historico->__set('cpf', $item['cpf']);
                                    $itens = $historico->getItemHistorico();
    
                                    foreach ($itens as $key => $item) { ?>
                                        <tr>
    
                                            <td style="border-right: 0;"><?php echo $item['id'] ?></td>
                                            <td class="produtos">
                                                <table id="example3" class="table table-light table-bordered table-striped text-dark">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th class=" cdb">Código de Barras</th>
                                                            <th class=" desc">Descrição</th>
                                                            <th class=" subTotal">Sub-Total</th>
                                                            
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
    
    
                                                        for ($i = 0; $i < count($item['produtos']); $i++) { ?>
    
                                                            <?php
                                                                // echo '<pre>';
                                                                // var_dump($item);
                                                                // echo '</pre>';
                                                            ?>
    
                                                            <tr>
    
                                                                <td class=" cdb"><?php echo $item['produtos'][$i]['cdb'] ?></td>
                                                                <td class=" desc"><?php echo $item['produtos'][$i]['quantidade']?> Uni <?php echo $item['produtos'][$i]['descricao'] ?></td>
                                                                <!-- <td class=" valor">R$ <?php echo number_format($item['produtos'][$i]['valVendItem'], 2, ',', '.') ?></td> -->
                                                                <td class=" subTotal">R$ <?php echo number_format($item['produtos'][$i]['valVendItem'] * $item['produtos'][$i]['quantidade'], 2, ',', '.') ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </td>
                                            <td>R$ <?php echo number_format($item['valorPago'], 2, ',', '.') ?></td>
                                            <td class="dataCompra"><?php echo $item['ultima_compra'] ?></td>
                                            <td class=""><strong><?php echo strtoupper($item['Username']) ?> - <?php echo $item['idUser'] ?></strong></td>
                                        </tr>
                                    <?php } ?>
    
    
                                </tbody>
                            </table>
    
                        </td>
                    </tr>
    
                <?php } ?>
    
    
            </tbody>
        </table>
    </main>
</div>
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": false,
            "lengthChange": true,
            "searching": true,
            "autoWidth": false,
            "ordering": true,
            "paging": true,
            "info": true,
            "buttons": ["excel"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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