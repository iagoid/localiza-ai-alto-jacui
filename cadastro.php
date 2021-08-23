<?php
require_once 'App/Entity/PontoTuristico.php';
require_once 'App/Entity/Endereco.php';
require_once 'App/Entity/Cidade.php';
require_once 'App/Entity/Imagem.php';

use \App\Entity\PontoTuristico;
use \App\Entity\Endereco;
use \App\Entity\Cidade;
use \App\Entity\Imagem;

session_start();

$cidades = Cidade::getcidades();

$cidades_resultados = '';
foreach ($cidades as $cidade) {
    $cidades_resultados .= '<option value="' . $cidade->cod . '">' . utf8_encode($cidade->nome) . '</option>';
}

$idEndereco;
$idPontoTuristico;

if (isset($_POST['Submit'])) {
    if (isset(
        $_POST['cod_cidade'],
        $_POST['rua'],
        $_POST['numero'],
        $_POST['bairro'],
        $_POST['cep'],
        $_POST['nome'],
        $_POST['cap'],
        $_POST['periodo'],
        $_POST['valor'],
        $_POST['descr'],
        $_POST['hist'],
        $_POST['longi'],
        $_POST['latit'],
        $_FILES['imagem']
    )) {
        $objEndereco = new Endereco;
        $objEndereco->cod_cidade = $_POST['cod_cidade'];
        $objEndereco->rua = $_POST['rua'];
        $objEndereco->numero = $_POST['numero'];
        $objEndereco->bairro = $_POST['bairro'];
        $objEndereco->cep = $_POST['cep'];
        $objEndereco->cadastrar();

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

        //IMAGEM
        $file = $_FILES['imagem'];

        $fileName = ($_FILES['imagem']['name']);
        $fileTmpName = $_FILES['imagem']['tmp_name'];
        $fileSize = $_FILES['imagem']['size'];
        $fileError = $_FILES['imagem']['error'];
        $fileType = $_FILES['imagem']['type'];

        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 500000) {
                    $fileNameNew = uniqid('', true) . "." . $fileActualExt;
                    $fileDestination = 'img/imagens_pt/' . $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                } else {
                    echo "O arquivo é muito grande!";
                }
            } else {
                echo "Ocorreu um erro ao enviar o arquivo!";
            }
        } else {
            echo "Essa extenção de arquivo não é suportada!";
        }

        $objImagem = new Imagem;
        $objImagem->nome = $fileDestination;
        $objImagem->cod_pt = $idPontoTuristico;
        $objImagem->cadastrar();
        $url =  str_replace("cadastro.php", "cadastro2.php", $_SERVER['REQUEST_URI']);
        header('Location: ' . $url);
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