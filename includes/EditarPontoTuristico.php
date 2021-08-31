<form method="POST" enctype="multipart/form-data">
    <h2>Endereço Do Ponto Turístico</h2>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 div_flex">
            <select name="cod_cidade" class="form-select col-lg-12 col-md-12 col-sm-12 cidade_select">
                <option selected="selected"><?= utf8_encode($objCidade->nome) ?></option>
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
    <!--</form>-->
    <!--<form method="POST" enctype="multipart/form-data">-->
    <h2>Funcionamento</h2>
    <p>*Caso o estabelecimento não funcione em algum dia da semana deixe o campo em branco, deixe o campo em branco</p>
    <?= $resultadosFuncionamento ?>
    <div class="" id="funcionamentos">
        <div class="row div-funcionamento">
            <div class="col-lg-3 col-md-3 col-sm-3">
                <select name="dia0[]" id="" multiple class="dia form-select col-lg-12 col-md-12 col-sm-12">
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
        <?= $resultadoContato ?>
        <!--<div class="row div-contato">
            <div class="col-lg-4 col-md-4 col-sm-4 div_flex">
                <select name="tipo[]" id="" class="tipo form-select col-lg-12 col-md-12 col-sm-12">
                    <option value="Instagram">Instagram</option>
                    <option value="Facebook">Facebook</option>
                    <option value="Twitter">Twitter</option>
                    <option value="Telefone">Telefone</option>
                    <option value="Email">Email</option>
                </select>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-7">
                <input name="url[]" type="url" required >
            </div>-->
        <div class="col-lg-1 col-md-1 col-sm-1">
            <button type="button" id="novo-contato">+</button>
        </div>
    </div>
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
</form>
<button class="mt-3" type="submit" id="submit-contato" name="Submit">Concluir Edição</button>