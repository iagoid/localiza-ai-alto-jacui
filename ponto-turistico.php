<?php
require_once 'App/Entity/PontoTuristico.php';
require_once 'App/Entity/Funcionamento.php';
require_once 'App/Entity/Imagem.php';
require_once 'App/Entity/JoinsSql.php';
require_once 'App/Entity/Categoria.php';
require_once 'App/Entity/Contato.php';

use \App\Entity\PontoTuristico;
use \App\Entity\Funcionamento;
use \App\Entity\Imagem;
use \App\Entity\CategoriasDoPonto;
use \App\Entity\Categoria;
use \App\Entity\Contato;

if (!isset($_GET['cod']) or !is_numeric(($_GET['cod']))) {
    header('location: index.php?status=error');
    exit;
}


$pontoTuristico = PontoTuristico::getPontoTuristico($_GET['cod']);
$funcionamentos = Funcionamento::getFuncionamentoFromPt($_GET['cod']);
$imagens = Imagem::getImagens("cod_pt = " . $_GET['cod']);
$categorias = Categoria::getcategorias($_GET['cod']);

$title = $pontoTuristico->nome;

$resultadosCategorias = '';
foreach ($categorias as $categoria) {
    $categoriaPontoTuristico = CategoriasDoPonto::categoriasDoPonto("cod_pt = " . $pontoTuristico->cod, null, null, 1);
    $resultadosCategorias = $categoriaPontoTuristico ? '<div class="tag">' . $categoriaPontoTuristico[0]->nome . '</div>' : " ";
}

$resultadosPontoTuristico = '<div class="room__details__title">
                        <h2>' . $pontoTuristico->nome . '</h2>
                    </div>
                    <div class="room__details__desc">
                        <p><a' . $resultadosCategorias . '</p>
                    </div>
                    <div class="room__details__desc">
                        <p>' . $pontoTuristico->descr . '</p>
                        <h2>História:</h2>
                        <p>' . $pontoTuristico->hist . '</p>
                        <p>' . $pontoTuristico->obs . '</p>
                    </div>';

$resultadosFuncionamento = '';
$i = 0;

foreach ($funcionamentos as $funcionamento) {
    $resultadosFuncionamento .= '<div class="room__details__more__facilities__item">
        <h6>' . $funcionamento->dia . ': Das ' . $funcionamento->inicio . ' as ' . $funcionamento->fim . '</h6>
        </div>';
}

$resultadoTemporada = '<h5>Temporada: ' . $pontoTuristico->periodo . '</h5>
                    <h5>Valor por visitante: R$ ' . $pontoTuristico->valor . '</h5>
                    <h5>Capacidade: ' . $pontoTuristico->cap . ' visitantes</h5>';


$resultadosImagem = '';


if (!empty($imagens)) {
    foreach ($imagens as $imagem) {
        $nomeImagem = file_exists('./img/imagens_pt/' . $imagem->nome) ? $imagem->nome : "image-not-found.jpg";
        $imagemDescricao = isset($imagem->descricao_imagem) ? $imagem->descricao_imagem : $pontoTuristico->nome;

        $resultadosImagem .= '
    <div class="col-lg-3 col-md-4 col-12">
        <img class="img-fluid img-thumbnail imagem-ponto-galeria" src="img/imagens_pt/' . $nomeImagem . '" alt="' . $imagemDescricao . '">
    </div>';
    }
}

$resultadosContato = '';

$whereContato = "cod_pt = " . $pontoTuristico->cod;
$ContatoDoPonto = Contato::getContatos($whereContato);

if (is_array($ContatoDoPonto)) {
    foreach ($ContatoDoPonto as $contato) {
        if (strtoupper($contato->tipo) == "SITE") {
            $resultadosContato .= '<div class=" contato_link"><a href="' . $contato->descricao . '"><i class="fa fa-site"><h9> ' . strtoupper($contato->tipo) . '</h9></a></i></div>';
        } else if (strtoupper($contato->tipo) == "INSTAGRAM") {
            $resultadosContato .= '<div class=" contato_link"><a href="' . $contato->descricao . '"><i class="fa fa-instagram"><h9> ' . strtoupper($contato->tipo) . '</h9></a></i></div>';
        } else if (strtoupper($contato->tipo) == "FACEBOOK") {
            $resultadosContato .= '<div class=" contato_link"><a href="' . $contato->descricao . '"><i class="fa fa-facebook"><h9> ' . strtoupper($contato->tipo) . '</h9></a></i></div>';
        } else if (strtoupper($contato->tipo) == "TWITTER") {
            $resultadosContato .= '<div class=" contato_link"><a href="' . $contato->descricao . '"><i class="fa fa-twitter"><h9> ' . strtoupper($contato->tipo) . '</h9></a></i></div>';
        } else if (strtoupper($contato->tipo) == "TELEFONE") {
            $resultadosContato .= '<div class=" contato_link"><a href="' . $contato->descricao . '"><i class="fa fa-phone"><h9> ' . strtoupper($contato->tipo) . '</h9></a></i></div>';
        } else if (strtoupper($contato->tipo) == "EMAIL") {
            $resultadosContato .= '<div class=" contato_link"><a href="' . $contato->descricao . '"><i class="fa fa-envelope-o"><h9> ' . strtoupper($contato->tipo) . '</h9></a></i></div>';
        }
    }
} else {
    $resultadosContato .= '<div class="room_details__desc">Nenhum contato encontrado</a></div>';
}

$pontos3 = "";
$listagempontos = PontoTuristico::getPontoTuristicos(null, null, 3);
foreach ($listagempontos as $ponto) {
    $imagem = Imagem::getImagens("cod_pt = " . $ponto->cod, null, null, 3);

    $nomeImagem = "";
    if (sizeof($imagem) > 0) {
        $nomeImagem = $imagem[0]->nome;
    } else {
        $nomeImagem = "image-not-found.jpg";
    }


    $pontos3 .= '<div class="col-lg-4 col-md-4 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="img/imagens_pt/' . $nomeImagem . '" alt="">
                    </div>
                    <div class="blog__item__text">
                        <h5><a href="./ponto-turistico?cod=' . $ponto->cod . '">' . $ponto->nome . '</a></h5>
                    </div>
                </div>
            </div>';
}

include __DIR__ . '/includes/header.php';
?>

<!-- Rooms Details Section Begin -->
<section class="room-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="room__details__content">
                    <?= $resultadosPontoTuristico ?>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="room__details__more__facilities">
                                <h2>Funcionamento:</h2>
                                <div class="row mb-5">
                                    <div class="col-lg-6">
                                        <?= $resultadoTemporada ?>
                                    </div>
                                </div>
                                <h2>Contato:</h2>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <?= $resultadosContato ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <div class="room__details__more__facilities">
                                <h2>Funcionamento:</h2>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <?= $resultadosFuncionamento ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-5">
                <?= $resultadosImagem ?>
            </div>
            <?php
            include __DIR__ . '/includes/Mapa.php';
            ?>

        </div>
    </div>


</section>

<section class="feature-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title bd-title">
                    <h2>Conheça novos lugares</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?= $pontos3 ?>
        </div>
    </div>
</section>


<?php
include __DIR__ . '/includes/footer.php';
?>