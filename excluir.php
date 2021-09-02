<?php
require_once 'App/Entity/PontoTuristico.php';
require_once 'App/Entity/Endereco.php';
require_once 'App/Entity/Cidade.php';
require_once 'App/Entity/Imagem.php';
require_once 'App/Entity/JoinsSql.php';
require_once 'App/Entity/Categoria.php';
require_once 'App/Entity/CategoriaPontoTuristico.php';
require_once 'App/Entity/Funcionamento.php';
require_once 'App/Entity/Contato.php';
require_once 'App/Entity/ContatoPontoTuristico.php';

use \App\Entity\PontoTuristico;
use \App\Entity\Endereco;
use \App\Entity\Cidade;
use \App\Entity\Imagem;
use \App\Entity\EnderecoDoPonto;
use \App\Entity\Categoria;
use \App\Entity\CategoriaPontoTuristico;
use \App\Entity\Funcionamento;
use \App\Entity\Contato;
use \App\Entity\ContatoPontoTuristico;
use \App\Entity\ContatoDoPonto;
use \App\Entity\CategoriasDoPonto;

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
                    <a href="listagemADMIN.php" class="btn btn-success">Não</a>
                </form>
            </div>
        </div>
    </div>
</section>



<?php
include __DIR__ . '/includes/footer.php';
?>