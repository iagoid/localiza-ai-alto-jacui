$(document).ready(function () {
    var newFuncionamentoContador = 0
    var newFuncionamento = `
    <div class="row div-funcionamento">
        <div class="col-lg-3 col-md-3 col-sm-3">
            <select name="dia0[]" multiple id="dia0" class="dia form-select col-lg-12 col-md-12 col-sm-12">
                <option value="Domingo">Domingo</option>
                <option value="Segunda">Segunda</option>
                <option value="Terça">Terça</option>
                <option value="Quarta">Quarta</option>
                <option value="Quinta">Quinta</option>
                <option value="Sexta">Sexta</option>
                <option value="Sábado">Sábado</option>
            </select>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
            <label for="inicio0">Inicio</label>
            <input name="inicio0" type="time">
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
            <label for="fim0">Fim</label>
            <input name="fim0" type="time">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1"></div>
    </div>`

    $('#novo-funcionamento').on('click', function () {
        var lastInput = $("#funcionamentos .div-funcionamento:last-child .dia")
        lastInput.prop('readonly', true);
        if (lastInput.val() != "") {
            lastInput.val().forEach(day => {
                newFuncionamento = newFuncionamento.replace(`<option value="${day}">${day}</option>`)
            });
            newFuncionamento = newFuncionamento.replaceAll(`dia${newFuncionamentoContador}`, `dia${newFuncionamentoContador+1}`)
            newFuncionamento = newFuncionamento.replaceAll(`inicio${newFuncionamentoContador}`, `inicio${newFuncionamentoContador+1}`)
            newFuncionamento = newFuncionamento.replaceAll(`fim${newFuncionamentoContador}`, `fim${newFuncionamentoContador+1}`)
            if (newFuncionamento.includes("option")) {
                $(newFuncionamento).hide().appendTo($('#funcionamentos')).show('normal');
            }
            newFuncionamentoContador++
        }

    })



    var newContatoContador = 1
    var newContato = `
        <div class="row div-contato">
            <div class="col-lg-4 col-md-4 col-sm-4 div_flex">
                <select name="tipo[]" id="" class="tipo form-select col-lg-12 col-md-12 col-sm-12">
                    <option value="Instagram">Instagram</option>
                    <option value="Facebook">Facebook</option>
                    <option value="Twitter">Twitter</option>
                    <option value="Telefone">Telefone</option>
                    <option value="Email">Email</option>
                </select>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8">
                <input name="descricao[]" type="descricao">
            </div>
        </div>`

    $('#novo-contato').on('click', function () {
        var lastInput = $("#contatos .div-contato:last-child .tipo")
        lastInput.prop('disabled', true);
        newContato = newContato.replace(`<option value="${lastInput.val()}">${lastInput.val()}</option>`)
        if (newContatoContador < 5) {
            $(newContato).hide().appendTo($('#contatos')).show('normal');
        }
        newContatoContador++
    })


    // Imagem
    $("#imagens-div").delegate(".upload_images", 'change', function () {
        changeImage(this)
    })

    function changeImage(input) {
        var reader;
        if (input.files && input.files[0]) {
            reader = new FileReader();
            $index = $(".upload_images").index(input)

            reader.onload = function (e) {
                $(".imagem_visualizador").eq($index).attr('src', e.target.result)
            }
            reader.readAsDataURL(input.files[0]);
        }
    }


    // Adiciona um novo campo de imagem
    var novaImagem = `
    <div class="row imagem">
        <div class="col-lg-7 col-md-7 col-sm-12">
            <label>Enviar imagem(ns)</label>
            <input name="imagem[]" type="file" class='upload_images' accept="image/*" multiple>
            <input name="descricao_imagem[]" type="text" placeholder="Descrição da imagem" maxlength="49" multiple>

        </div>
        <div class="col-lg-5 col-md-5 col-sm-12 div_imagem_visualizador">
            <img class="imagem_visualizador" />
        </div>
    </div>`


    $('#nova-imagem').on('click', function () {
        $(novaImagem).hide().appendTo($('#imagens-div')).show('normal');
        newContatoContador++
    })


    // Tira do read only pra enviar
    $("#submit-contato").on('click', function () {
        $("#funcionamentos .div-funcionamento .dia").prop('readonly', false);
        $("#contatos .div-contato .tipo").prop('disabled', false);
    })

})