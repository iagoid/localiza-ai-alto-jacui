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
use \App\Entity\PontosDaCategoria;
use \App\Entity\CidadeDoPonto;

$busca = filter_input(INPUT_GET, 'busca', FILTER_SANITIZE_STRING);

/*$filtroCategorias = filter_input(INPUT_GET, 'filtroCategoria', FILTER_SANITIZE_STRING);
$joinCategorias = PontosDaCategoria::pontosDaCategoria("cod_cat = " . $filtroCategorias, null, null, 1);

$filtroCidades = filter_input(INPUT_GET, 'filtroCidade', FILTER_SANITIZE_STRING);*/

$condicoes = [
    strlen($busca) ? 'nome LIKE "%'.str_replace(' ', '%', $busca)  .'%"' : null,
    //strlen($joinCategorias) ? ''
];

$where = implode(' AND ', $condicoes);

$pontosTuristicos = PontoTuristico::getPontoTuristicos($where);
$cidades = Cidade::getcidades();
$categorias = Categoria::getcategorias();


$categorias_resultados = '';
foreach ($categorias as $categoria) {
    $categorias_resultados .= '<option value="' . $categoria->cod . '">' . $categoria->nome . '</option>';
}


$cidades_resultados = '';
foreach ($cidades as $cidade) {
    $cidades_resultados .= '<option value="' . $cidade->nome . '">' . $cidade->nome . '</option>';
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

                    <div class="col-lg-12">
                        <div class="pagination__number blog__pagination">
                            <a href="#">1</a>
                            <a href="#">2</a>
                            <a href="#">Next <span class="arrow_right"></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="blog__sidebar">
                    <div class="blog__sidebar__search">
                        <h4>Buscar por nome</h4>
                        <form method="get">
                            <input type="text" name="busca" placeholder="Buscar" value="<?=$busca?>">
                            <button type="submit">Buscar</button>
                        </form>
                    </div>
                    <form method="get">
                    <div class="blog__sidebar__categories">
                        <div class="mt-3"><h4>Filtrar por Categorias</h4>
                            <select class="form-control" type="submit" name="filtroCategoria" value="<?=$filtroCategorias?>">
                                <option value="">Selecione uma Opção</option>
                            <?= $categorias_resultados ?>
                        </select></div>
                        <div class="mt-3"><h4>Filtrar por Cidades</h4>
                            <select class="form-control" type="submit" name="filtroCidade" value="<?=$filtroCidades?>">
                                <option value="">Selecione uma Opção</option>
                        
                            <?= $cidades_resultados ?>
                        </select></div>
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