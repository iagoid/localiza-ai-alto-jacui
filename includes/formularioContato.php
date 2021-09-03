<form method="POST" enctype="multipart/form-data">
    <h2>Funcionamento</h2>
    <p>*Caso o estabelecimento não funcione em algum dia da semana deixe o campo em branco, deixe o campo em branco</p>
    <div class="" id="funcionamentos">
        <div class="row div-funcionamento">
            <div class="col-lg-3 col-md-3 col-sm-3">
                <select name="dia0[]" id="" required multiple class="dia form-select col-lg-12 col-md-12 col-sm-12">
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
            <div class="col-lg-1 col-md-1 col-sm-1">
                <button type="button" id="novo-funcionamento">+</button>
            </div>
        </div>
    </div>


    <h2>Contato</h2>
    <div id="contatos">
        <div class="row div-contato">
            <div class="col-lg-4 col-md-4 col-sm-4 div_flex">
                <select name="tipo[]" id="" required class="tipo form-select col-lg-12 col-md-12 col-sm-12">
                    <option value="Instagram">Instagram</option>
                    <option value="Facebook">Facebook</option>
                    <option value="Twitter">Twitter</option>
                    <option value="Telefone">Telefone</option>
                    <option value="Email">Email</option>
                </select>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-7">
                <input name="descricao" type="text" required>
            </div>
            <div class="col-lg-1 col-md-1 col-sm-1">
                <button type="button" id="novo-contato">+</button>
            </div>
        </div>
    </div>
    <h4>Categorias</h4>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 div_flex">
            <select name="categoria[]" multiple required class="form-control" id="multiselect" class="multiselect">
                <?= $categorias_resultados ?>
            </select>
        </div>
    </div>


    <button class="mt-3" id="submit-contato" name="Submit">Concluir Cadastro</button>
</form>