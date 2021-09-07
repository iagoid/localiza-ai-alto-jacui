<?php
require_once 'App/Entity/Categoria.php';
require_once 'App/Entity/CategoriaPontoTuristico.php';
require_once 'App/Entity/Funcionamento.php';
require_once 'App/Entity/Contato.php';
require_once 'App/Session/Login.php';

use \App\Entity\Categoria;
use \App\Entity\CategoriaPontoTuristico;
use \App\Entity\Funcionamento;
use \App\Entity\Contato;
use \App\Session\Login;

Login::requireLogin();

$title = "ADMIN CADASTRO";

if (!$_SESSION['idPontoTuristico']) {
    header('location: index?status=error');
    exit;
}

$categorias = Categoria::getcategorias();

$categorias_resultados = '';
foreach ($categorias as $categoria) {
    $categorias_resultados .= '<option value="' . $categoria->cod . '">' . $categoria->nome . '</option>';
}

$idPonto = $_SESSION['idPontoTuristico'];
$objFuncionamento = new Funcionamento;
$objFuncionamento->cod_pt = $idPonto;

$objCategoriaPontoTuristico = new CategoriaPontoTuristico;

$objContato = new Contato;
$objContato->cod_pt = $idPonto;


if (isset(
    $_POST['Submit']
)) {
    for ($i = 0; $i < 7; $i++) {
        $diaString = 'dia' . $i;
        $inicioString = 'inicio' . $i;
        $fimString = 'fim' . $i;

        if (isset(
            $_POST[$diaString],
            $_POST[$inicioString],
            $_POST[$fimString]
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


    if (isset(
        $_POST['categoria']
    )) {
        foreach ($_POST['categoria'] as $categoria) {
            $objCategoriaPontoTuristico->cod_pt = $idPonto;
            $objCategoriaPontoTuristico->cod_cat = $categoria;
            $objCategoriaPontoTuristico->cadastrar();
        }
    }

    if (isset(
        $_POST['tipo'],
        $_POST['descricao']
    )) {
        $i = 0;
        foreach ($_POST['descricao'] as $descricao) {
            if ($descricao != "") {
                $objContato->cod_pt = $idPonto;
                $objContato->tipo = $_POST['tipo'][$i];
                $objContato->descricao = $descricao;
                print_r($objContato);
                $objContato->cadastrar();
                // exit;
            }
            $i++;
        }
    }
    $_SESSION['idPontoTuristico'] = null;
    $url =  str_replace("cadastro2", "ponto-turistico?cod=" . $idPonto, $_SERVER['REQUEST_URI']);
    header('Location: ' . $url);
}

include __DIR__ . '/includes/header.php';
?>

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option set-bg" data-setbg="img/breadcrumb-bg.png">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h1>Cadastro</h1>
                    <div class="breadcrumb__links">
                        <a href="./index">Home</a>
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