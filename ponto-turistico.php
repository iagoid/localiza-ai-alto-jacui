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
use \App\Entity\ImagensDoPonto;
use \App\Entity\CategoriasDoPonto;
use \App\Entity\ContatoDoPonto;
use \App\Entity\Categoria;

if (!isset($_GET['cod']) or !is_numeric(($_GET['cod']))) {
    header('location: index.php?status=error');
    exit;
}


$pontoTuristico = PontoTuristico::getPontoTuristico($_GET['cod']);
$funcionamentos = Funcionamento::getFuncionamentoFromPt($_GET['cod']);
$imagens = Imagem::getImagemFromPt($_GET['cod']);
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
$j = 0;
foreach ($imagens as $imagem) {
    $imagemPontoTuristico = ImagensDoPonto::imagensDoPonto("cod_pt = " . $pontoTuristico->cod, null, null, 1);
    $nomeImagem = $imagemPontoTuristico[0]->nome ? $imagemPontoTuristico[0]->nome : "image-not-found.jpg";

    $resultadosImagem .= '<div>
        <div>
            <div class="md-5 ml-3">
                <img src="' . $nomeImagem . '">
            </div>
        </div>
    </div>';
}

$resultadosContato = '';

$whereContato = "cod_pt = " . $pontoTuristico->cod; 
$ContatoDoPonto = ContatoDoPonto::contatoDoPonto($whereContato);

//var_dump($ContatoDoPonto);exit;

if(is_array($ContatoDoPonto)){
    $i=0;
$resultadosContato .= '<div class="room_details__desc"><a href="' . $ContatoDoPonto[$i]->url . '">' . $ContatoDoPonto[$i]->tipo . '</a></div>';
    $i++;
}else{
    $resultadosContato .= '<div class="room_details__desc"><a href="' . $ContatoDoPonto->url . '">' . $ContatoDoPonto->tipo . '</a></div>';
}

$pontos3 = "";
$listagempontos = PontoTuristico::getPontoTuristicos(null, null, 3);
foreach ($listagempontos as $ponto) {
    $imagem = ImagensDoPonto::imagensDoPonto("cod_pt = " . $ponto->cod, null, null, 3);


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
                        <h5><a href="#">' . $ponto->nome . '</a></h5>
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
                                <div class="row">
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
<!-- Rooms Details Section End -->

<!-- Room Details Slider Begin -->
<?= $resultadosImagem ?>
<!-- Room Details Slider End -->

<?php
include __DIR__ . '/includes/footer.php';
?>