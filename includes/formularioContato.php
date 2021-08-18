<form method="POST">
    <h2>Funcionamento</h2>
    <p>*Caso o estabelecimento não funcione em algum dia da semana deixe o campo em branco, deixe o campo em branco</p>
    <div class="row div-funcionamento">
        <div class="col-lg-2 col-md-2 col-sm-6">
            <label for="inicio-segunda">Inicio Segunda</label>
            <input name="inicio-segunda" type="time">
        </div>
        <div class="col-lg-2 col-md-2 col-sm-6">
            <label for="fim-segunda">Fim Segunda</label>
            <input name="fim-segunda" type="time">
        </div>
        <div class="col-lg-2 col-md-2 col-sm-6">
            <label for="inicio-terca">Inicio Terça</label>
            <input name="inicio-terca" type="time">
        </div>
        <div class="col-lg-2 col-md-2 col-sm-6">
            <label for="fim-terca">Fim Terça</label>
            <input name="fim-terca" type="time">
        </div>
        <div class="col-lg-2 col-md-2 col-sm-6">
            <label for="inicio-quarta">Inicio Quarta</label>
            <input name="inicio-quarta" type="time">
        </div>
        <div class="col-lg-2 col-md-2 col-sm-6">
            <label for="fim-quarta">Fim Quarta</label>
            <input name="fim-quarta" type="time">
        </div>
    </div>
    <div class="row div-funcionamento">
        <div class="col-lg-3 col-md-3 col-sm-6">
            <label for="inicio-quinta">Inicio Quinta</label>
            <input name="inicio-quinta" type="time">
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6">
            <label for="fim-quinta">Fim Quinta</label>
            <input name="fim-quinta" type="time">
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6">
            <label for="inicio-sexta">Inicio Sexta</label>
            <input name="inicio-sexta" type="time">
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6">
            <label for="fim-sexta">Fim Sexta</label>
            <input name="fim-sexta" type="time">
        </div>
    </div>

    <div class="row div-funcionamento">
        <div class="col-lg-3 col-md-3 col-sm-3">
            <label for="inicio-sabado">Inicio Sábado</label>
            <input name="inicio-sabado" type="time">
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3">
            <label for="fim-sabado">Fim Sábado</label>
            <input name="fim-sabado" type="time">
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3">
            <label for="inicio-domingo">Inicio Domingo</label>
            <input name="inicio-domingo" type="time">
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3">
            <label for="fim-domingo">Fim Domingo</label>
            <input name="fim-domingo" type="time">
        </div>
    </div>

    <h2>Contato</h2>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 div_flex">
            <select name="tipo1" id="" class="col-lg-12 col-md-12 col-sm-12">
                <option value="Instagram">Instagram</option>
                <option value="Facebook">Facebook</option>
                <option value="Twitter">Twitter</option>
                <option value="Telefone">Telefone</option>
                <option value="Email">Email</option>
            </select>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-8">
            <input name="url1" type="text" required>
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