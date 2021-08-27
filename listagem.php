<?php
require_once 'App/Entity/PontoTuristico.php';
require_once 'App/Entity/Categoria.php';
require_once 'App/Entity/CategoriaPontoTuristico.php';
require_once 'App/Entity/Cidade.php';
require_once 'App/Entity/Imagem.php';
require_once 'App/Entity/Endereco.php';
require_once 'App/Entity/JoinsSql.php';

use \App\Entity\PontoTuristico;
use \App\Entity\Categoria;
use \App\Entity\Cidade;
use \App\Entity\Imagem;
use \App\Entity\CategoriasDoPonto;
use \App\Entity\CidadeDoPonto;
use \App\Entity\PontosCadPT;

///////////////////////////// Paginação /////////////////////////////
$itemsPorPagina = 1;
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
$codCategoria = isset($_GET['filtroCategoria']) ? $_GET['filtroCategoria'] : null;
$codCidade = isset($_GET['filtroCidade']) ? $_GET['filtroCidade'] : null;

$pontosTuristicos = null;
$whereBusca = null;
if (isset($_GET['busca'])) {
    $whereBusca = "nome LIKE '%" . $_GET['busca'] . "%'";
    $qtd = PontoTuristico::getPontoTuristicos($whereBusca, "ponto_turistico.cod DESC");
    $paginacaoScript = paginacao(sizeof($qtd));
    $qtd = PontoTuristico::getPontoTuristicos($whereBusca, "ponto_turistico.cod DESC", $paginacaoScript);
} else {
    $where = null;
    if ($codCategoria && $codCidade) {
        $where = "cod_cat = " . $codCategoria . " AND cod_cidade = " . $codCidade;
    } else if ($codCategoria) {
        $where = "cod_cat = " . $codCategoria;
    } else if ($codCidade) {
        $where = "cod_cidade = " . $codCidade;
    }
    $qtd = PontosCadPT::pontosCadPT($where, "ponto_turistico.cod DESC");
    $paginacaoScript = paginacao(sizeof($qtd));
    $pontosTuristicos = PontosCadPT::pontosCadPT($where, "ponto_turistico.cod DESC", $paginacaoScript);
}

$cidades = Cidade::getcidades();
$categorias = Categoria::getcategorias();


$categorias_resultados = '';
foreach ($categorias as $categoria) {
    if ($codCategoria == $categoria->cod) {
        $categorias_resultados .= '<option selected value="' . $categoria->cod . '">' . $categoria->nome . '</option>';
    } else {
        $categorias_resultados .= '<option value="' . $categoria->cod . '">' . $categoria->nome . '</option>';
    }
}


$cidades_resultados = '';
foreach ($cidades as $cidade) {
    if ($codCidade == $cidade->cod) {
        $cidades_resultados .= '<option selected value="' . $cidade->cod . '">' . $cidade->nome . '</option>';
    } else {
        $cidades_resultados .= '<option value="' . $cidade->cod . '">' . $cidade->nome . '</option>';
    }
}

$ponto_resultados = '';
foreach ($pontosTuristicos as $ponto) {
    $categoriaPontoTuristico = CategoriasDoPonto::categoriasDoPonto("cod_pt = " . $ponto->cod, null, null, 1);
    $categoriaNome = $categoriaPontoTuristico ? '<div class="tag">' . $categoriaPontoTuristico[0]->nome . '</div>' : "";

    $cidadePontoTuristico = CidadeDoPonto::cidadeDoPonto("ponto_turistico.cod = " . $ponto->cod, null, null, 1);
    $cidadeNome = $cidadePontoTuristico ?  $cidadePontoTuristico[0]->nome : 'Não Informada';

    $imagem = Imagem::getImagens("cod_pt = " . $ponto->cod, null, null, 1);
    $nomeImagem = $imagem ? $imagem[0]->nome : "image-not-found.jpg";

    $ponto_resultados .= '
        <div class="col-lg-6 col-md-6">
        <div class="blog__item">
            <div class="blog__item__pic">
                <img src="img/imagens_pt/' . $nomeImagem . '" alt="">
                ' . $categoriaNome . '
            </div>
            <div class="blog__item__text">
                <p><i class="fa fa-map-o"></i>' .  $cidadeNome . '</p>
                <h5><a href="ponto-turistico.php?cod=' . $ponto->cod . '">' . $ponto->nome . '</a></h5>
            </div>
        </div>
    </div>
        ';
}

$pagina_argumento = "";
if ($busca) {
    $pagina_argumento .= "&busca=" . $busca;
}
if ($codCategoria) {
    $pagina_argumento .= "&filtroCategoria=" . $codCategoria;
}
if ($codCidade) {
    $pagina_argumento .= "&filtroCidade=" . $codCidade;
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



include __DIR__ . '/includes/header.php';
?>
<!-- Breadcrumb Begin -->
<div class="breadcrumb-option set-bg" data-setbg="img/breadcrumb-bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h1>Our Blog</h1>
                    <div class="breadcrumb__links">
                        <a href="./index.php">Home</a>
                        <span>Blog</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Blog Section Begin -->
<section class="blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8">

                <div class="row">

                    <?= $ponto_resultados ?>

                    <?= $paginacao_resultados ?>


                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="blog__sidebar">
                    <div class="blog__sidebar__search">
                        <h4>Buscar por nome</h4>
                        <form method="get">
                            <input type="text" name="busca" placeholder="Buscar" value="<?= $busca ?>">
                            <button type="submit">Buscar</button>
                        </form>
                    </div>
                    <form method="get">
                        <div class="blog__sidebar__categories">
                            <div class="mt-3">
                                <h4>Filtrar por Categorias</h4>
                                <select class="form-control" type="submit" name="filtroCategoria" value="<?= $filtroCategorias ?>">
                                    <option value="">Selecione uma Opção</option>
                                    <?= $categorias_resultados ?>
                                </select>
                            </div>
                            <div class="mt-3">
                                <h4>Filtrar por Cidades</h4>
                                <select class="form-control" type="submit" name="filtroCidade" value="<?= $filtroCidades ?>">
                                    <option value="">Selecione uma Opção</option>

                                    <?= $cidades_resultados ?>
                                </select>
                            </div>
                        </div>
                        <button class="form-control" type="submit">Filtrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Section End -->

<?php
include __DIR__ . '/includes/footer.php';
?>