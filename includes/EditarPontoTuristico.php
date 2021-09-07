<form method="POST" enctype="multipart/form-data">
    <h2>Endereço Do Ponto Turístico</h2>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 div_flex">
            <select name="cod_cidade" class="form-select col-lg-12 col-md-12 col-sm-12 cidade_select">
                <option selected="selected" value="<?= $objEndereco->cod_cidade ?>"><?= $objCidade->nome ?></option>
                <?= $cidades_resultados ?>
            </select>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 div_flex">
            <input name="bairro" type="text" placeholder="Bairro" required maxlength="50" value="<?= $objEndereco->bairro ?>">
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <input name="rua" type="text" placeholder="Rua" required maxlength="50" value="<?= $objEndereco->rua ?>">
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <input name="numero" type="number" required placeholder="Número" min="0" max="10000" value="<?= $objEndereco->numero ?>">
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <input name="cep" type="number" placeholder="CEP" required max="99999999" value="<?= $objEndereco->cep ?>">
        </div>
    </div>

    <h2>Ponto Turístico</h2>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <input name="nome" type="text" placeholder="Nome" required value="<?= $objPontoTuristico->nome ?>">
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <input name="cap" type="number" placeholder="Capacidade de publico" required value="<?= $objPontoTuristico->cap ?>">
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <input name="obs" type="text" placeholder="Observação" maxlength="100" value="<?= $objPontoTuristico->obs ?>">
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <input name="periodo" type="text" placeholder="Período de Funcionamento" maxlength="50" required value="<?= $objPontoTuristico->periodo ?>">
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <input name="valor" type="number" step="0.01" max="1000" placeholder="Valor Ingresso" required value="<?= $objPontoTuristico->valor ?>">
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <textarea placeholder="Descrição" name="descr" required><?= $objPontoTuristico->descr ?></textarea>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <textarea placeholder="História" name="hist" required><?= $objPontoTuristico->hist ?></textarea>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <input name="latit" type="text" placeholder="Latitude (Google Maps)" max="20" required value="<?= $objPontoTuristico->latit ?>">
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <input name="longi" type="text" placeholder="Longitude (Google Maps)" max="20" required value="<?= $objPontoTuristico->longi ?>">
        </div>
    </div>

    <h2>Funcionamento</h2>
    <p>*Caso o estabelecimento não funcione em algum dia da semana deixe o campo em branco, deixe o campo em branco</p>
    <div class="" id="funcionamentos">
        <div class="row div-funcionamento">
            <div class="col-1 offset-lg-11 offset-md-11 offset-sm-11">
                <button type="button" id="novo-funcionamento">+</button>
            </div>
        </div>
        <div class="row div-funcionamento">
            <?= $resultadosFuncionamento ?>
        </div>
    </div>

    <h2>Contato</h2>
    <div id="contatos">
        <?= $resultadoContato ?>
    </div>
    <h4>Categorias</h4>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 div_flex">
            <select name="categoria[]" multiple class="form-control" id="multiselect" class="multiselect">
                <?= $categorias_resultados ?>
            </select>
        </div>
    </div>
    <h4>Images</h4>
    <div id="imagens-div">
        <div class="row row-imagem">
            <div class="col-1 offset-lg-11 offset-md-11 offset-sm-11">
                <button type="button" id="nova-imagem">+</button>
            </div>
        </div>
        <?= $resultadoImagens ?>
    </div>
    <button class="mt-3" type="submit" id="submit-contato" name="Submit">Concluir Edição</button>
</form>