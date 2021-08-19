<?php
require_once 'App/Entity/Categoria.php';
require_once 'App/Entity/CategoriaPontoTuristico.php';
require_once 'App/Entity/Funcionamento.php';
require_once 'App/Entity/Contato.php';
require_once 'App/Entity/ContatoPontoTuristico.php';

use \App\Entity\Categoria;
use \App\Entity\CategoriaPontoTuristico;
use \App\Entity\Funcionamento;
use \App\Entity\Contato;
use \App\Entity\ContatoPontoTuristico;

if (!isset($_GET['cod']) or !is_numeric(($_GET['cod']))) {
    header('location: index.php?status=error');
    exit;
}

$categorias = Categoria::getcategorias();

$categorias_resultados = '';
foreach ($categorias as $categoria) {
    $categorias_resultados .= '<option value="' . $categoria->cod . '">' . utf8_encode($categoria->nome) . '</option>';
}

$objFuncionamento = new Funcionamento;
$objFuncionamento->cod_pt = $_GET['cod'];

$objCategoriaPontoTuristico = new CategoriaPontoTuristico;
$objCategoriaPontoTuristico->cod_pt = $_GET['cod'];

$objContato = new Contato;
$objContato->cod_pt = $_GET['cod'];

$objContatoPontoTuristico = new ContatoPontoTuristico;
$objContatoPontoTuristico->cod_pt = $_GET['cod'];

if (isset(
    $_POST['Submit'],
)) {
    for ($i = 0; $i < 7; $i++) {
        $diaString = 'dia' . $i;
        $inicioString = 'inicio' . $i;
        $fimString = 'fim' . $i;

        if (isset(
            $_POST[$diaString],
            $_POST[$inicioString],
            $_POST[$fimString],
        )) {
            if ($_POST[$fimString] != "" && $_POST[$inicioString] != "") {
                foreach ($_POST[$diaString] as $dia) {
                    $objFuncionamento->dia = $dia;
                    $objFuncionamento->inicio = $_POST[$inicioString];
                    $objFuncionamento->fim = $_POST[$fimString];
                    $objFuncionamento->cadastrar();
                }
            }
        }
    }
}

if (isset(
    $_POST['categoria'],
)) {
    foreach ($_POST['categoria'] as $categoria) {
        $objCategoriaPontoTuristico->cod_cat = $categoria;
        $objCategoriaPontoTuristico->cadastrar();
    }
}

if (isset(
    $_POST['tipo'],
    $_POST['url'],
)) {
    $i = 0;
    foreach ($_POST['url'] as $url) {
        if ($url != "") {
            $objContato->tipo = $_POST['tipo'][$i];
            $objContato->url = $url;
            $objContato->cadastrar();
            $objContatoPontoTuristico->cod_cont = $objContato->cod;
            $objContatoPontoTuristico->cadastrar();
        }
        $i++;
    }
}

include __DIR__ . '/includes/header.php';
?>

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option set-bg" data-setbg="img/breadcrumb-bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h1>Cadastro</h1>
                    <div class="breadcrumb__links">
                        <a href="./index.php">Home</a>
                        <span>Cadastro</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->
<section class="history spad">
    <div class="container">
        <div class="col-lg-12 offset-lg-12 col-md-12 col-sm-12">
            <div class="contact__form">
                <?php
                include __DIR__ . '/includes/formularioContato.php';
                ?>
            </div>
        </div>
    </div>
</section>

<?php



include __DIR__ . '/includes/footer.php';
?>