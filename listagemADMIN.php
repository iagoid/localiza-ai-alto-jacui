<?php
require_once 'App/Entity/PontoTuristico.php';
require_once 'App/Entity/CategoriaPontoTuristico.php';
require_once 'App/Entity/Imagem.php';
require_once 'App/Entity/JoinsSql.php';
require_once 'App/Session/Login.php';

use \App\Entity\PontoTuristico;
use \App\Entity\Imagem;
use \App\Entity\PontosCadPT;
use \App\Session\Login;

Login::requireLogin();

$title = "LISTA ADMIN";

///////////////////////////// Paginação /////////////////////////////
$itemsPorPagina = 9;
$pagina = isset($_GET['page']) && intval($_GET['page'])  ? intval($_GET['page']) : 1;

function paginacao($quantidadePontosTuristicos)
{
    $GLOBALS['quantidadePontosTuristicos'] = $quantidadePontosTuristicos;
    $itemsPorPagina = $GLOBALS['itemsPorPagina'];
    $pagina = $GLOBALS['pagina'];
    $offset = (($itemsPorPagina) > ($quantidadePontosTuristicos % $itemsPorPagina)) ? ($itemsPorPagina * ($pagina - 1)) : $quantidadePontosTuristicos % $itemsPorPagina;
    $paginacaoScript = $itemsPorPagina . ' OFFSET ' . $offset;
    return $paginacaoScript;
}

//////////////////////////////////////////////////////////////////

$busca = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_STRING);

$pontosTuristicos = null;
$whereBusca = null;
if (isset($_GET['busca'])) {
    $whereBusca = "nome LIKE '%" . $_GET['busca'] . "%'";
    $qtd = PontoTuristico::getPontoTuristicos($whereBusca, "ponto_turistico.cod DESC");
    $paginacaoScript = paginacao(sizeof($qtd));
    $qtd = PontoTuristico::getPontoTuristicos($whereBusca, "ponto_turistico.cod DESC", $paginacaoScript);
} else {
    $where = null;
    $qtd = PontosCadPT::pontosCadPT($where, "ponto_turistico.cod DESC");
    $paginacaoScript = paginacao(sizeof($qtd));
    $pontosTuristicos = PontosCadPT::pontosCadPT($where, "ponto_turistico.cod DESC", $paginacaoScript);
}

$ponto_resultados = '<h2 class="sem_resultados">Nenhum resultado encontrado</h2>';
if ($pontosTuristicos) {
    $ponto_resultados = "";
    foreach ($pontosTuristicos as $ponto) {
        $imagem = Imagem::getImagens("cod_pt = " . $ponto->cod, null, null, 1);
        $nomeImagem = $imagem ? $imagem[0]->nome : "image-not-found.jpg";

        $ponto_resultados .= '
        <div class="col-lg-4 col-md-4">
            <div class="blog__item">
                <div class="blog__item__pic">
                    <img src="img/imagens_pt/' . $nomeImagem . '" alt="">
                </div>
                <div class="blog__item__text ponto_name">
                    <h5><a href="ponto-turistico.php?cod=' . $ponto->cod . '">' . utf8_encode($ponto->nome) . '</a></h5>
                </div>
                <div class="blog__item__text admin">
                    <a class="edit"  href="editar.php?cod=' . $ponto->cod . '"><i class="fa fa-edit"></i> Editar</a>
                    <a class="delete" href="excluir.php?cod=' . $ponto->cod . '"><i class="fa fa-edit"></i> Excluir</a>
                </div>
            </div>
        </div>
            ';
    }
}


$pagina_argumento = "";
if ($busca) {
    $pagina_argumento .= "&busca=" . $busca;
}

$anterior = $pagina - 1;
$pagina_anterior = "";
if ($anterior >= 1) {
    $pagina_anterior = '<a href="?page=' . $anterior . $pagina_argumento . '">' . $anterior . '</a>';
}

$pagina_atual = '<a class="active" href="?page=' . $pagina . $pagina_argumento . '">' . $pagina . '</a>';

$proxima = $pagina  + 1;
$pagina_proxima = '';
if ($proxima * $itemsPorPagina - $itemsPorPagina < $quantidadePontosTuristicos) {
    $pagina_proxima = $proxima ? '<a href="?page=' . $proxima . $pagina_argumento . '">' . $proxima . '</a>' : '';
}


$paginacao_resultados = '
        <div class="col-lg-12">
        <div class="pagination__number">'
    . $pagina_anterior
    . $pagina_atual
    . $pagina_proxima .
    '</div>
    </div>
    ';

// Alertas 
$deletadoAlerta = '';
if (isset($_GET['deletado'])) {
    $deletadoAlerta = '<div class="alert alert-success" role="alert">
    Ponto deletado com sucesso.
  </div>';
}

include __DIR__ . '/includes/header.php';
?>

<!-- Blog Section Begin -->
<section class="blog spad">
    <div class="container">
        <?= $deletadoAlerta ?>
        <div class="col-lg-1 col-md-1">
        </div>
        <div class="col-lg-10 col-md-10">
            <div class="blog__sidebar">
                <div class="blog__sidebar__search">
                    <form method="get">
                        <input type="text" name="busca" placeholder="Buscar" value="<?= $busca ?>">
                        <button type="submit">Buscar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">

                <div class="row">

                    <?= $ponto_resultados ?>

                    <?= $paginacao_resultados ?>


                </div>
            </div>

        </div>
    </div>
</section>
<!-- Blog Section End -->

<?php
include __DIR__ . '/includes/footer.php';
?>