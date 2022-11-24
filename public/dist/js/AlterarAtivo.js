const atualizarAtivo = (ativo, ref, item) => {

    console.log(ativo, ref, item)

    if(ativo == 1){
        $.ajax({
            url: `/${item}/desativar`,
            method: 'get',
            data: {id: ref},
        }).done((res) => {
            document.querySelector(`#${item}Remover${ref}`).classList.add('displayNone')
            document.querySelector(`#${item}${ref}`).checked = false;
            document.querySelector(`#${item}${ref}`).setAttribute('onchange', `atualizarAtivo(0, ${ref}, '${item}')`)
            document.querySelector(`#${item}Item${ref}` ).classList.add('inativo')
        })
    }else{
        $.ajax({
            url: `/${item}/ativar`,
            method: 'get',
            data: {id: ref},
        }).done((res) => {
            document.querySelector(`#${item}Remover${ref}`).classList.remove('displayNone')
            document.querySelector(`#${item}${ref}`).checked = true;
            document.querySelector(`#${item}${ref}`).setAttribute('onchange', `atualizarAtivo(1, ${ref}, '${item}')`)
            document.querySelector(`#${item}Item${ref}` ).classList.remove('inativo')
        })
    }
}