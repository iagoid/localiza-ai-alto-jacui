<?php
require_once 'App/Entity/Categoria.php';
require_once 'App/Entity/Funcionamento.php';

use \App\Entity\Categoria;
use \App\Entity\Funcionamento;


$categorias = Categoria::getcategorias();

$categorias_resultados = '';
foreach ($categorias as $categoria) {
    $categorias_resultados .= '<option value="' . $categoria->cod . '">' . utf8_encode($categoria->nome) . '</option>';
}

$objFuncionamento = new Funcionamento;
$objFuncionamento->cod_pt = $_GET['cod'];
print_r($objFuncionamento);
exit;
if (isset(
    $_POST['inicio-domingo'],
    $_POST['fim-domingo'],
)) {
    $objFuncionamento->inicio = $_POST['inicio-domingo'];
    $objFuncionamento->fim = $_POST['fim-domingo'];
    $objFuncionamento->dia = "Domingo";
    $objFuncionamento->cadastrar();
}
if (isset(
    $_POST['inicio-segunda'],
    $_POST['fim-segunda'],
)) {
    $objFuncionamento->inicio = $_POST['inicio-segunda'];
    $objFuncionamento->fim = $_POST['fim-segunda'];
    $objFuncionamento->dia = "Segunda";
    $objFuncionamento->cadastrar();
}
if (isset(
    $_POST['inicio-terca'],
    $_POST['fim-terca'],
)) {
    $objFuncionamento->inicio = $_POST['inicio-terca'];
    $objFuncionamento->fim = $_POST['fim-terca'];
    $objFuncionamento->dia = "Terça";
    $objFuncionamento->cadastrar();
}
if (isset(
    $_POST['inicio-quarta'],
    $_POST['fim-quarta'],
)) {
    $objFuncionamento->inicio = $_POST['inicio-quarta'];
    $objFuncionamento->fim = $_POST['fim-quarta'];
    $objFuncionamento->dia = "Quarta";
    $objFuncionamento->cadastrar();
}
if (isset(
    $_POST['inicio-quinta'],
    $_POST['fim-quinta'],
)) {
    $objFuncionamento->inicio = $_POST['inicio-quinta'];
    $objFuncionamento->fim = $_POST['fim-quinta'];
    $objFuncionamento->dia = "Quinta";
    $objFuncionamento->cadastrar();
}
if (isset(
    $_POST['inicio-sexta'],
    $_POST['fim-sexta'],
)) {
    $objFuncionamento->inicio = $_POST['inicio-sexta'];
    $objFuncionamento->fim = $_POST['fim-sexta'];
    $objFuncionamento->dia = "Sexta";
    $objFuncionamento->cadastrar();
}
if (isset(
    $_POST['inicio-sabado'],
    $_POST['fim-sabado'],
)) {
    $objFuncionamento->inicio = $_POST['inicio-sabado'];
    $objFuncionamento->fim = $_POST['fim-sabado'];
    $objFuncionamento->dia = "Sábado";
    $objFuncionamento->cadastrar();
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