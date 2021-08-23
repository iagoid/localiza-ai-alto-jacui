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
use \App\Entity\Contato;

if (!isset($_GET['cod']) or !is_numeric(($_GET['cod']))) {
    header('location: index.php?status=error');
    exit;
}


$pontoTuristico = PontoTuristico::getPontoTuristico($_GET['cod']);
$funcionamentos = Funcionamento::getFuncionamentoFromPt($_GET['cod']);
$imagens = Imagem::getImagemFromPt($_GET['cod']);
$categorias = Categoria::getcategorias($_GET['cod']);
$contatos = Contato::getContatos($_GET['cod']);

$resultadosCategorias = '';
foreach ($categorias as $categoria){
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
    $resultadosFuncionamento .= '<div class="room__details__desc">
        <h5>' . $funcionamento->dia . ': De ' . $funcionamento->inicio . ' até ' . $funcionamento->fim . '</h5>
        <h5>Temporada: ' . $pontoTuristico->periodo . '</h5>
                        <h5>Valor por visitante: R$ ' . $pontoTuristico->valor . '</h5>
                        <h5>Capacidade: ' . $pontoTuristico->cap . ' visitantes</h5>
        </div>';
}

$resultadosImagem = '';
$j = 0;
foreach ($imagens as $imagem) {
    $imagemPontoTuristico = ImagensDoPonto::imagensDoPonto("cod_pt = " . $pontoTuristico->cod, null, null, 1);
    $resultadosImagem .= '<div>
        <div>
            <div class="md-5 ml-3">
                <img src="' . $imagemPontoTuristico[0]->nome . '">
            </div>
        </div>
    </div>';
}

$resultadosContato = '';

foreach ($contatos as $contato){
    $ContatoDoPonto = ContatoDoPonto::contatoDoPonto("cod_pt = " . $pontoTuristico->cod, null, null, 1);
    $resultadosContato .= '<div class="room_details__desc"><a href="' . $ContatoDoPonto[0]->url . '">' . $ContatoDoPonto[0]->tipo . '</a></div>';
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
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="room__details__more__facilities">
                                <h2>Funcionamento:</h2>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <?= $resultadosFuncionamento ?>
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