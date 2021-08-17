<form method="POST">
    <h2>Funcionamento</h2>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 ">
            <label for="dia">Dia de Funcionamento</label>
            <div class="div_flex">
                <select name="dia" class="col-lg-12 col-md-12 col-sm-12" required>
                    <option value="Domingo">Domingo</option>
                    <option value="Segunda-Feira">Segunda-Feira</option>
                    <option value="Terça-Feira">Terça-Feira</option>
                    <option value="Quarta-Feira">Quarta-Feira</option>
                    <option value="Quinta-Feira">Quinta-Feira</option>
                    <option value="Sexta-Feira">Sexta-Feira</option>
                    <option value="Sábado">Sábado</option>
                </select>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
            <label for="inicio">Inicio</label>
            <input name="inicio" type="date" required>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
            <label for="inicio">Fim</label>
            <input name="fim" type="date" placeholder="URL" required>
        </div>
    </div>

    <h2>Contato</h2>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 div_flex">
            <select name="tipo1" id="" class="col-lg-12 col-md-12 col-sm-12" required>
                <option value="Instagram">Instagram</option>
                <option value="Facebook">Facebook</option>
                <option value="Twitter">Twitter</option>
                <option value="Telefone">Telefone</option>
                <option value="Email">Email</option>
            </select>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8">
            <input name="url1" type="text" placeholder="URL" required>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-4 col-md-4 col-sm-4 div_flex">
            <select name="tipo2" id="" class="col-lg-12 col-md-12 col-sm-12" required>
                <option value="Instagram">Instagram</option>
                <option value="Facebook">Facebook</option>
                <option value="Twitter">Twitter</option>
                <option value="Telefone">Telefone</option>
                <option value="Email">Email</option>
            </select>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8">
            <input name="url2" type="text" placeholder="URL" required>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-4 col-md-4 col-sm-4 div_flex">
            <select name="tipo3" id="" class="col-lg-12 col-md-12 col-sm-12" required>
                <option value="Instagram">Instagram</option>
                <option value="Facebook">Facebook</option>
                <option value="Twitter">Twitter</option>
                <option value="Telefone">Telefone</option>
                <option value="Email">Email</option>
            </select>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8">
            <input name="url3" type="text" placeholder="URL" required>
        </div>
    </div>

    <h4>Categorias</h4>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 div_flex">
            <select multiple class="form-control" id="multiselect" class="multiselect">
                <?= $categorias_resultados ?>
            </select>
        </div>
    </div>


    <button class="mt-3" type="submit">Proxima Página</button>
</form>