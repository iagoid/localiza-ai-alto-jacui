<?php
require_once 'App/Entity/PontoTuristico.php';
require_once 'App/Entity/Categoria.php';
require_once 'App/Entity/CategoriaPontoTuristico.php';
require_once 'App/Entity/Cidade.php';
require_once 'App/Entity/Imagem.php';
require_once 'App/Entity/Endereco.php';

use \App\Entity\PontoTuristico;
use \App\Entity\Categoria;
use \App\Entity\CategoriaPontoTuristico;
use \App\Entity\Cidade;
use \App\Entity\Imagem;
use \App\Entity\Endereco;

session_start();

$pontosTuristicos = PontoTuristico::getPontoTuristicos();
$categorias = Categoria::getcategorias();
$cidades = Cidade::getcidades();

$categorias_resultados = '';
foreach ($categorias as $categoria) {
    $categorias_resultados .= '<li><a href="' . $categoria->cod . '">' . $categoria->nome . '</a></li>';
}


$cidades_resultados = '';
foreach ($cidades as $cidade) {
    $cidades_resultados .= '<li><a href="' . $cidade->nome . '">' . $cidade->nome . '</a></li>';
}

$ponto_resultados = '';
foreach ($pontosTuristicos as $ponto) {
    $imagem = Imagem::getImagens("cod_pt = " . $ponto->cod, null, null, 1);
    $categoriaPontoTuristico = CategoriaPontoTuristico::getcategoriasporntoturistico("cod_pt = " . $ponto->cod, null, null, 1);
    $enderecoPontoTuristico = Endereco::getEnderecos("cod = " . $ponto->cod_end, null, null, 1);

    $cidadeNome = "";
    if ($enderecoPontoTuristico) {
        $cidade = Cidade::getcidades("cod = " . $enderecoPontoTuristico[0]->cod_cidade, null, null, 1);
        $cidadeNome = $cidade ? $cidade[0]->nome : "";
    }

    $categoriaNome = "";
    if ($categoriaPontoTuristico) {
        $categoria = Categoria::getcategorias("cod = " . $categoriaPontoTuristico[0]->cod_cat, null, null, 1);
        $categoriaNome = $categoria ? $categoria[0]->nome : "";
    }
    $nomeImagem = $imagem ? $imagem[0]->nome : "image-not-found.jpg";

    $ponto_resultados .= '
        <div class="col-lg-6 col-md-6">
        <div class="blog__item">
            <div class="blog__item__pic">
                <img src="img/imagens_pt/' . $nomeImagem . '" alt="">
                <div class="tag">' . $categoriaNome . '</div>
            </div>
            <div class="blog__item__text">
                <p><i class="fa fa-clock-o"></i>' .  $cidadeNome . '</p>
                <h5><a href="' . $ponto->cod . '">' . $ponto->nome . '</a></h5>
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
                        <h4>Search</h4>
                        <form action="#">
                            <input type="text" placeholder="Search...">
                            <button type="submit">Search</button>
                        </form>
                    </div>
                    <div class="blog__sidebar__categories">
                        <h4>Categorias</h4>
                        <ul>
                            <?= $categorias_resultados ?>
                        </ul>
                        <h4>Cidades</h4>
                        <ul>
                            <?= $cidades_resultados ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Section End -->

<?php
include __DIR__ . '/includes/footer.php';
?>