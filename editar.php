<?php
require_once 'App/Entity/PontoTuristico.php';
require_once 'App/Entity/Endereco.php';
require_once 'App/Entity/Cidade.php';
require_once 'App/Entity/Imagem.php';
require_once 'App/Entity/JoinsSql.php';
require_once 'App/Entity/Categoria.php';
require_once 'App/Entity/CategoriaPontoTuristico.php';
require_once 'App/Entity/Funcionamento.php';
require_once 'App/Entity/Contato.php';
require_once 'App/Entity/ContatoPontoTuristico.php';

use \App\Entity\PontoTuristico;
use \App\Entity\Endereco;
use \App\Entity\Cidade;
use \App\Entity\Imagem;
use \App\Entity\EnderecoDoPonto;
use \App\Entity\Categoria;
use \App\Entity\CategoriaPontoTuristico;
use \App\Entity\Funcionamento;
use \App\Entity\Contato;
use \App\Entity\ContatoPontoTuristico;
use \App\Entity\ContatoDoPonto;
use \App\Entity\CategoriasDoPonto;

if(!isset($_GET['cod']) or !is_numeric($_GET['cod'])){
	header('location: listagem.php?status=error');
	exit;
}

$objPontoTuristico = PontoTuristico::getPontoTuristico($_GET['cod']);

if(!$objPontoTuristico instanceof PontoTuristico){
	header('location: listagem.php?status=error');
	exit;
}

//PEGAR OS DADOS DO PONTO TURISTICO E COLOCAR NOS CAMPOS

$objEndereco = Endereco::getEndereco($objPontoTuristico->cod_end);

$objCidade = Cidade::getcidade($objEndereco->cod_cidade);

$objImagem = Imagem::getImagemFromPt($objPontoTuristico->cod);

$whereContato = "cod_pt = ". $objPontoTuristico->cod;
$objContato = ContatoDoPonto::contatoDoPonto($whereContato);

$whereCategoria = "cod_pt = ". $objPontoTuristico->cod;
$objCategoriaPontoTuristico = CategoriasDoPonto::categoriasDoPonto($whereCategoria);

$i = 0;

$resultadosCategoriasNome = '';
$resultadosCategoriasCod = '';

//var_dump($objCategoriaPontoTuristico);exit;

foreach($objCategoriaPontoTuristico as $categoria){
    $resultadosCategoriasNome .= $categoria->nome;
    $resultadosCategoriasCod .= $categoria->cod;
}

$objFuncionamento = Funcionamento::getFuncionamentoFromPt($objPontoTuristico->cod);
$resultadosFuncionamento = '';


foreach ($objFuncionamento as $funcionamento) {
    $resultadosFuncionamento .='
    <div class="row div-funcionamento">
        <div class="col-lg-3 col-md-3 col-sm-3">
            <select name="dia0[]" multiple id="dia0" class="dia form-select col-lg-12 col-md-12 col-sm-12">
                <option value="' . $funcionamento->dia . '" selected="selected">' . $funcionamento->dia . '</option>
                <option value="Domingo">Domingo</option>
                <option value="Segunda">Segunda</option>
                <option value="Terça">Terça</option>
                <option value="Quarta">Quarta</option>
                <option value="Quinta">Quinta</option>
                <option value="Sexta">Sexta</option>
                <option value="Sábado">Sábado</option>
            </select>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
            <label for="inicio0">Inicio</label>
            <input name="inicio0" type="time" value="' . $funcionamento->inicio . '">
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
            <label for="fim0">Fim</label>
            <input name="fim0" type="time" value="' . $funcionamento->fim . '">
        </div>
        <div class="col-lg-1 col-md-1 col-sm-1"></div>
    </div>';
}

/*$resultadoContatoTipo = '';
$resultadoContatoUrl = '';*/
$resultadoContato = '';

foreach ($objContato as $contato){
    $resultadoContato .= '<div class="row div-contato">
            <div class="col-lg-4 col-md-4 col-sm-4 div_flex">
                <select name="tipo[]" id="" class="tipo form-select col-lg-12 col-md-12 col-sm-12">
                    <option selected="selected" value="' . $contato->tipo . '">' . $contato->tipo . '</option>
                    <option value="Instagram">Instagram</option>
                    <option value="Facebook">Facebook</option>
                    <option value="Twitter">Twitter</option>
                    <option value="Telefone">Telefone</option>
                    <option value="Email">Email</option>
                </select>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8">
                <input name="url[]" type="url" value="' . $contato->url . '">
            </div>
        </div>';
}


//ATUALIZAÇÃO

session_start();

$cidades = Cidade::getcidades();

$cidades_resultados = '';
foreach ($cidades as $cidade) {
    $cidades_resultados .= '<option value="' . $cidade->cod . '">' . utf8_encode($cidade->nome) . '</option>';
}

$categorias = Categoria::getcategorias();

$categorias_resultados = '';
foreach ($categorias as $categoria) {
    $categorias_resultados .= '<option value="' . $categoria->cod . '">' . utf8_encode($categoria->nome) . '</option>';
}

$objFuncionamento = new Funcionamento;
$objFuncionamento->cod_pt = $objPontoTuristico->cod;

$objCategoriaPontoTuristico = new CategoriaPontoTuristico;
$objCategoriaPontoTuristico->cod_pt = $objPontoTuristico->cod;

$objContato = new Contato;
$objContato->cod_pt = $objPontoTuristico->cod;

$objContatoPontoTuristico = new ContatoPontoTuristico;
$objContatoPontoTuristico->cod_pt = $objPontoTuristico->cod;

if (isset($_POST['Submit'])) {
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
                    $objFuncionamento->atualizar();
                }
            }
        }
    }


    if (isset(
        $_POST['categoria'],
    )) {
        foreach ($_POST['categoria'] as $categoria) {
            $objCategoriaPontoTuristico->cod_cat = $categoria;
            $objCategoriaPontoTuristico->atualizar();
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
                $objContato->atualizar();
                $objContatoPontoTuristico->cod_cont = $objContato->cod;
                $objContatoPontoTuristico->atualizar();
            }
            $i++;
        }
    }
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
        $objEndereco->atualizar();

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
        $objPontoTuristico->atualizar();

        /*echo "<pre>";
        print_r($objPontoTuristico);
        echo "</pre>";*/

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
        $objImagem->cod_pt = $objPontoTuristico->codTuristico;
        $objImagem->atualizar();
        /*$url =  str_replace("cadastro", "cadastro2", $_SERVER['REQUEST_URI']);
        header('Location: ' . $url);*/
    }
}

include __DIR__ . '/includes/header.php';
?>

<!-- Breadcrumb Begin -->
<!--<div class="breadcrumb-option set-bg" data-setbg="img/breadcrumb-bg.jpg">
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
</div>-->
<!-- Breadcrumb End -->


<section class="history spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title history-title">
                    <h2>Edite seu ponto turístico</h2>
                </div>
            </div>
        </div>
        <div class="col-lg-12 offset-lg-12 col-md-12 col-sm-12">
            <div class="contact__form">
                <?php
                include __DIR__ . '/includes/EditarPontoTuristico.php';
                ?>
            </div>
        </div>
    </div>
</section>
<section class="history spad">
    <div class="container">
        <div class="col-lg-12 offset-lg-12 col-md-12 col-sm-12">
            <div class="contact__form">
                <!--<?php
                //include __DIR__ . '/includes/EditarContato.php';
                ?>-->
            </div>
        </div>
    </div>
</section>



<?php
include __DIR__ . '/includes/footer.php';
?>