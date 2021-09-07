<?php
require_once 'App/Entity/PontoTuristico.php';
require_once 'App/Session/Login.php';

use \App\Entity\PontoTuristico;
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

$resultado = '<h2>Deseja mesmo excluir o ponto ' . utf8_encode($objPontoTuristico->nome) . '?</h2>';

if (isset($_POST['Submit'])) {
    $objPontoTuristico->excluir();
    $url =  str_replace("excluir", "listagemADMIN?deletado=true", $_SERVER['REQUEST_URI']);
    header('Location: ' . $url);
}

include __DIR__ . '/includes/header.php';
?>


<section class="history spad">
    <div class="container">
        <div class="col-lg-12 offset-lg-12 col-md-12 col-sm-12">
            <div class="delete__form">
                <?= $resultado ?>
                <form action="" method="post">
                    <button type="Submit" name="Submit" class="btn btn-danger">Sim</button>
                    <a href="listagemADMIN.php" id="nao-excluir" class="btn btn-success">Não</a>
                </form>
            </div>
        </div>
    </div>
</section>



<?php
include __DIR__ . '/includes/footer.php';
?>