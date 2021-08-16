<form method="POST">
    <h2>Endereço Do Ponto Turístico</h2>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6 div_flex">
            <select name="uf" id="" class="col-lg-12 col-md-12 col-sm-12" required>
                <option value="1">UF</option>
            </select>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 div_flex">
            <select name="cod_cidade" id="" class="col-lg-12 col-md-12 col-sm-12" required>
                <option value="1">Cidade</option>
            </select>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6 div_flex">
            <input name="bairro" type="text" placeholder="Bairro" required>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <input name="rua" type="text" placeholder="Rua" required>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <input name="numero" type="number" required placeholder="Número" min="0" max="10000">
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6">
            <input name="cep" type="text" placeholder="CEP" required>
        </div>
    </div>

    <h2>Ponto Turístico</h2>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <input name="nome" type="text" placeholder="Nome" required>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <input name="cap" type="number" placeholder="Capacidade de publico" required>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12">
            <input name="obs" type="text" placeholder="Observação" maxlength="100">
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <input name="periodo" type="text" placeholder="Período de Funcionamento" maxlength="100" required>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <input name="valor" type="number" step="0.01" placeholder="Valor Ingresso" required>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <textarea placeholder="Descrição" name="descr" required></textarea>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <textarea placeholder="História" name="hist" required></textarea>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <input name="latit" type="text" placeholder="Latitude (Google Maps)" required>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <input name="longi" type="text" placeholder="Longitude (Google Maps)" required>
        </div>
    </div>

    <button type="submit">Proxima Página</button>
</form>