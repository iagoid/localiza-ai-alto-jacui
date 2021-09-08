<?php
require_once 'App/Entity/PontoTuristico.php';
require_once 'App/Entity/Funcionamento.php';
require_once 'App/Entity/Contato.php';
require_once 'App/Entity/CategoriaPontoTuristico.php';
require_once 'App/Entity/Imagem.php';
require_once 'App/Session/Login.php';

use \App\Entity\PontoTuristico;
use \App\Entity\Funcionamento;
use \App\Entity\Contato;
use \App\Entity\CategoriaPontoTuristico;
use \App\Entity\Imagem;
use \App\Session\Login;

Login::requireLogin();

$title = "ADMIN EXCLUIR";

if (!isset($_GET['cod']) or !is_numeric($_GET['cod'])) {
    header('location: listagemADMIN.php?status=error');
    exit;
}

$objPontoTuristico = PontoTuristico::getPontoTuristico($_GET['cod']);

if (!$objPontoTuristico instanceof PontoTuristico) {
    header('location: listagem.php?status=error');
    exit;
}

$resultado = '<h2>Deseja mesmo excluir o ponto ' . $objPontoTuristico->nome . '?</h2>';

if (isset($_POST['Submit'])) {
    $objPontoTuristico->excluir();
    Funcionamento::excluirFuncionamentoDoPontoTuristico($objPontoTuristico->cod);
    Contato::excluirContatoDoPontoTuristico($objPontoTuristico->cod);
    CategoriaPontoTuristico::excluirTodasCategoriasDoPonto($objPontoTuristico->cod);
    Imagem::excluirIamgensDoPontoTuristico($objPontoTuristico->cod);
    $url =  str_replace("excluir", "listagemADMIN?deletado=true", $_SERVER['REQUEST_URI']);
    header('Location: ' . $url);
}

include __DIR__ . '/includes/header.php';
?>


<section class="history spad">
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="delete__form col-lg-6">
            <?= $resultado ?>
            <div class="col-lg-12 mt-4">
                <form action="" method="post">
                    <button type="Submit" name="Submit" class="btn btn-danger">Sim</button>
                    <a href="listagemADMIN" id="nao-excluir" class="btn btn-success">Não</a>
                </form>
            </div>
        </div>
        <div class="col-lg-3"></div>
    </div>
</section>



<?php
include __DIR__ . '/includes/footer.php';
?>