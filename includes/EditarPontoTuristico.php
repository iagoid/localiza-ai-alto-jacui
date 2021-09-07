<form method="POST" enctype="multipart/form-data">
    <h2>Endereço Do Ponto Turístico</h2>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 div_flex">
            <select name="cod_cidade" class="form-select col-lg-12 col-md-12 col-sm-12 cidade_select">
                <option selected="selected" value="<?= $objEndereco->cod_cidade ?>"><?= utf8_encode($objCidade->nome) ?></option>
                <?= $cidades_resultados ?>
            </select>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 div_flex">
            <input name="bairro" type="text" placeholder="Bairro" required maxlength="50" value="<?= utf8_encode($objEndereco->bairro) ?>">
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <input name="rua" type="text" placeholder="Rua" required maxlength="50" value="<?= utf8_encode($objEndereco->rua) ?>">
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
            <input name="nome" type="text" placeholder="Nome" required value="<?= utf8_encode($objPontoTuristico->nome) ?>">
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <input name="cap" type="number" placeholder="Capacidade de publico" required value="<?= $objPontoTuristico->cap ?>">
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <input name="obs" type="text" placeholder="Observação" maxlength="100" value="<?= utf8_encode($objPontoTuristico->obs) ?>">
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <input name="periodo" type="text" placeholder="Período de Funcionamento" maxlength="50" required value="<?= utf8_encode($objPontoTuristico->periodo) ?>">
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <input name="valor" type="number" step="0.01" max="1000" placeholder="Valor Ingresso" required value="<?= $objPontoTuristico->valor ?>">
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <textarea placeholder="Descrição" name="descr" required><?= utf8_encode($objPontoTuristico->descr) ?></textarea>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <textarea placeholder="História" name="hist" required><?= utf8_encode($objPontoTuristico->hist) ?></textarea>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <input name="latit" type="text" placeholder="Latitude (Google Maps)" max="20" required value="<?= $objPontoTuristico->latit ?>">
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <input name="longi" type="text" placeholder="Longitude (Google Maps)" max="20" required value="<?= $objPontoTuristico->longi ?>">
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <label>Enviar imagem(ns)</label>
            <input name="imagem" type="file" accept="image/*"><img src="<?= $objImagem->nome ?>">
        </div>
    </div>

    <h2>Funcionamento</h2>
    <p>*Caso o estabelecimento não funcione em algum dia da semana deixe o campo em branco, deixe o campo em branco</p>
    <div class="" id="funcionamentos">
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
                <option selected="selected" value="<?= $resultadosCategoriasCod ?>"><?= $resultadosCategoriasNome ?></option>
                <?= $categorias_resultados ?>
            </select>
        </div>
    </div>
    <button class="mt-3" type="submit" id="submit-contato" name="Submit">Concluir Edição</button>
</form>