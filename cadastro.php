<?php
require_once 'App/Entity/PontoTuristico.php';
require_once 'App/Entity/Endereco.php';
require_once 'App/Entity/Cidade.php';
require_once 'App/Entity/Imagem.php';
require_once 'App/Session/Login.php';

use \App\Entity\PontoTuristico;
use \App\Entity\Endereco;
use \App\Entity\Cidade;
use \App\Entity\Imagem;
use \App\Session\Login;

Login::requireLogin();


$title = "ADMIN CADASTRO";

$cidades = Cidade::getcidades();

$cidades_resultados = '';
foreach ($cidades as $cidade) {
    $cidades_resultados .= '<option value="' . $cidade->cod . '">' . utf8_encode($cidade->nome) . '</option>';
}

$objPT = null;
$objEnd = null;
$objCid = null;
$objImg = null;

$idEndereco;
$idPontoTuristico;

if (isset($_POST['Submit'])) {
    if (isset(
        $_POST['cod_cidade'],
        $_POST['rua'],
        $_POST['numero'],
        $_POST['bairro'],
        $_POST['cep'],
        $_POST['complemento']
    )) {
        $objEndereco = new Endereco;
        $objEndereco->cod_cidade = $_POST['cod_cidade'];
        $objEndereco->rua = $_POST['rua'];
        $objEndereco->numero = $_POST['numero'];
        $objEndereco->bairro = $_POST['bairro'];
        $objEndereco->cep = $_POST['cep'];
        $objEndereco->complemento = $_POST['complemento'];
        $objEndereco->cadastrar();
    }

    if (isset(
        $_POST['nome'],
        $_POST['cap'],
        $_POST['periodo'],
        $_POST['valor'],
        $_POST['descr'],
        $_POST['hist'],
        $_POST['longi'],
        $_POST['latit']
    )) {
        $objPontoTuristico = new PontoTuristico;
        $objPontoTuristico->nome = $_POST['nome'];
        $objPontoTuristico->cap = $_POST['cap'];
        $objPontoTuristico->obs = $_POST['obs'];
        $objPontoTuristico->periodo = $_POST['periodo'];
        $objPontoTuristico->valor = $_POST['valor'];
        $objPontoTuristico->descr = $_POST['descr'];
        $objPontoTuristico->hist = $_POST['hist'];
        $objPontoTuristico->longi = $_POST['longi'];
        $objPontoTuristico->latit = $_POST['latit'];
        $objPontoTuristico->cod_end = $idEndereco;
        $objPontoTuristico->cadastrar();

        $_SESSION['idPontoTuristico'] = $idPontoTuristico;
    }

    $fileNames = array_filter($_FILES['imagem']['name']);
    if (!empty($fileNames)) {
        $i = 0;
        foreach ($_FILES['imagem']['name'] as $file) {
            $fileName = $_FILES['imagem']['name'][$i];
            $fileSize = $_FILES['imagem']['size'][$i];
            $fileError = $_FILES['imagem']['error'][$i];
            $fileType = $_FILES['imagem']['type'][$i];

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png');

            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                    $fileDestination = 'img/imagens_pt/' . $fileNameNew;
                    move_uploaded_file($_FILES['imagem']['tmp_name'][$i], $fileDestination);


                    $descricao_imagem = $_POST['descricao_imagem'][$i] ? $_POST['descricao_imagem'][$i] : "";
                    $objImagem = new Imagem;
                    $objImagem->nome = $fileNameNew;
                    $objImagem->descricao_imagem = $descricao_imagem;
                    $objImagem->cod_pt = $idPontoTuristico;
                    $objImagem->cadastrar();
                } else {
                    print_r("Ocorreu um erro ao enviar o arquivo!");
                }
            } else {
                print_r("Essa extenção de arquivo não é suportada!");
            }
            $i++;
        }
    }


    $url =  str_replace("cadastro", "cadastro2", $_SERVER['REQUEST_URI']);
    header('Location: ' . $url);
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
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->


<section class="history spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title history-title">
                    <h2>Cadastre seu ponto turístico</h2>
                </div>
            </div>
        </div>
        <div class="col-lg-12 offset-lg-12 col-md-12 col-sm-12">
            <div class="contact__form">
                <?php
                include __DIR__ . '/includes/formularioPontoTuristico.php';
                ?>
            </div>
        </div>
    </div>
</section>



<?php
include __DIR__ . '/includes/footer.php';
?>