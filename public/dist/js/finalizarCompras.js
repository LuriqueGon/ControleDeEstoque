const finalizarCompras = () => {
    $('.modal').addClass('FinalizarVendas');
    setDate();
}

const mudarModal = () => {
    $('.modal').toggleClass('FinalizarVendas')
    cancelAll()
}

const MetodoDePagamento = (item) => {
    switch (item.value) {
        case '01':
            pagamento('fieldLineDinheiro')
            $('#metodoPagamento').text('Dinheiro')
            break;
        case '02':
            pagamento('Cartao')
            $('#metodoPagamento').text('Cartão')
            break;
        case '03':
            pagamento('Pix')
            $('#metodoPagamento').text('Pix')
            break;
        default:
            cancelAll()
            break
    }
    
}

const pagamento = (tipo) => {
    cancelAll()

    if(tipo != "Cartao"){
        $(`.${tipo}`).removeClass('fieldDisable')
    }
    
    $('.FimDaCompra').removeClass('fieldDisable')

    if(tipo != "fieldLineDinheiro"){
        $('#PagoPrint').text($('#ValorTotalPrint').text())

    }
}

const FinalizarVendasPrint = () => {

    if(validarVendas()){
        switch ($('#selectMDP').val()) {
            
            case '01':
                finalizar('dinheiro')
                break;
            
            case '02':
                finalizar('cartao')
                break;
            case '03':
                finalizar('pix')
                break;
            default:
                cancelAll()
                break
        }
    }
    
}
    
const finalizar = (tipo) => {

    if(tipo == 'dinheiro'){

        if($('#ValorPagoPrint').val() == "" || $('#ValorPagoPrint').val() < 0){
            alert('Valor pago é inferior ao valor total \n \n SUGESTÂO : finalize a compra com o valor faltante no cartão')
            return false
        }    
    
        
    }

    let date = getDate()

    alert('Compra Finalizada')
    print()
    location.href = `/vendedor/vendas/finalizarCompras?MDP=${$('#metodoPagamento').text()}&date=${date[2]}/${date[1]}/${date[0]} ${date[3]}:${date[4]}:${date[5]}&cpf=${$('#CPFPrint').val()}&valorPago=${Number($('#ValorTotalPrint').text().replace(',','.')).toFixed(2)}`

    
}


const validarVendas = () => {
    if($('#selectMDP').val() != "" ){
        if(Number($('#ValorTotalPrint').text().toString().replace(',','.')) > 0){
            return true
        }else{
            if(Number($('#ValorTotalPrint').text().toString().replace('.','').replace(',','.'))){
                return true
            }else{
                alert('Compras não foram efetuadas, adicione um item para continuar!!')
                cancelAll();
                mudarModal();
                return false
            }
        }
    }else{
        alert('Selecione o metodo de pagamento');
        return false
    }
}

const calcularTroco = (item) => {
    let valorPago = item.value
    let valorTotal = Number($('#ValorTotalPrint').text().replace(',','.')).toFixed(2)

    $('#PagoPrint').text(valorPago)
    $('#TrocoPrint').text((valorPago - valorTotal).toFixed(2).toString().replace('.',','))
    $('#TrocoPrintValue').text((valorPago - valorTotal).toFixed(2).toString().replace('.',','))
}

const cancelAll = () => {

    $('.fieldLineDinheiro').addClass('fieldDisable')
    $('.Pix').addClass('fieldDisable')
    $('.FimDaCompra').addClass('fieldDisable')
    $('#PagoPrint').text('00,00')
}

const atualizarCPF = () => {

    if($('#CPFPrint').val().length >= 11){

        let bloco1 = $('#CPFPrint').val().slice(0,3)
        let bloco2 = $('#CPFPrint').val().slice(3,6)
        let bloco3 = $('#CPFPrint').val().slice(6,9)
        let bloco4 = $('#CPFPrint').val().slice(9,11)

        let cpf = `${bloco1}.${bloco2}.${bloco3}-${bloco4}`

        $('#CpfAlterar').text(cpf)
    }
}

const setDate = () => {

    let data = new Date();
    let dia = data.getDate()
    let mes = data.getMonth() + 1
    let ano = data.getFullYear()
    let hora = data.getHours()
    let minutos = data.getMinutes()

    
    date = [
        dia.toString().length < 2 ? `0${dia}` : dia, 
        mes.toString().length < 2 ? `0${mes}` : mes, 
        ano.toString().length < 2 ? `0${ano}` : ano, 
        hora.toString().length < 2 ? `0${hora}` : hora, 
        minutos.toString().length < 2 ? `0${minutos}` : minutos
    ]

    $('#DataPrint').text(`${date[0]}/${date[1]}/${date[2]}`)
    $('#HoraPrint').text(`${date[3]}:${date[4]}`)

    return true

}

const getDate = () => {
    let data = new Date();
    let hora = data.getHours()
    let minutos = data.getMinutes()
    let seconds = data.getSeconds()

    
    date = [
        data.getDate(),
        data.getMonth() + 1, 
        data.getFullYear(), hora.toString().length < 2 ? `0${hora}` : hora, 
        minutos.toString().length < 2 ? `0${minutos}` : minutos,
        seconds.toString().length < 2 ? `0${seconds}` : seconds
    ]

    return date;
}