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
require_once 'App/Session/Login.php';

use \App\Entity\PontoTuristico;
use \App\Entity\Endereco;
use \App\Entity\Cidade;
use \App\Entity\Imagem;
use \App\Entity\Categoria;
use \App\Entity\CategoriaPontoTuristico;
use \App\Entity\Funcionamento;
use \App\Entity\Contato;
use \App\Entity\CategoriasDoPonto;
use \App\Session\Login;

Login::requireLogin();

$title = "ADMIN EDITAR";

if (!isset($_GET['cod']) or !is_numeric($_GET['cod'])) {
    header('location: listagemADMIN?status=error');
    exit;
}

$objPontoTuristico = PontoTuristico::getPontoTuristico($_GET['cod']);

if (!$objPontoTuristico instanceof PontoTuristico) {
    header('location: listagemADMIN?status=error');
    exit;
}

//PEGAR OS DADOS DO PONTO TURISTICO E COLOCAR NOS CAMPOS

$objEndereco = Endereco::getEndereco($objPontoTuristico->cod_end);

$objCidade = Cidade::getcidade($objEndereco->cod_cidade);

$objImagem = Imagem::getImagemFromPt($objPontoTuristico->cod);

$whereContato = "cod_pt = " . $objPontoTuristico->cod;
$objContato = Contato::getContatos($whereContato);

$whereCategoria = "cod_pt = " . $objPontoTuristico->cod;
$objCategoriaPontoTuristico = CategoriasDoPonto::categoriasDoPonto($whereCategoria);

$i = 0;

$resultadosCategoriasNome = '';
$resultadosCategoriasCod = '';

foreach ($objCategoriaPontoTuristico as $categoria) {
    $resultadosCategoriasNome .= utf8_encode($categoria->nome);
    $resultadosCategoriasCod .= $categoria->cod;
}

$objFuncionamento = Funcionamento::getFuncionamentoFromPt($objPontoTuristico->cod);
$resultadosFuncionamento = '';

$primeiro = true;

if (sizeof($objFuncionamento) > 0) {
    do {
        $resultadosFuncionamento .= '
            <div class="col-lg-3 col-md-3 col-sm-3">
                <select name="dia0[]" multiple id="dia0" class="dia form-select col-lg-12 col-md-12 col-sm-12">';


        if (sizeof($objFuncionamento) - 1 >= 1) {
            for ($j = 0 + 1; $j <= sizeof($objFuncionamento) - 1; $j++) {
                if (
                    ($objFuncionamento[0]->inicio == $objFuncionamento[$j]->inicio)
                    && ($objFuncionamento[0]->fim == $objFuncionamento[$j]->fim)
                ) {

                    $resultadosFuncionamento .= '<option value="' . utf8_encode($objFuncionamento[$j]->dia) . '" selected="selected">' . utf8_encode($objFuncionamento[$j]->dia) . '</option>';
                    array_splice($objFuncionamento, $j, $j);
                    $j--;
                }
            }
        }

        $resultadosFuncionamento .= '</select>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <label for="inicio0">Inicio</label>
                <input name="inicio0" type="time" value="' . $objFuncionamento[0]->inicio . '">
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4">
                <label for="fim0">Fim</label>
                <input name="fim0" type="time" value="' . $objFuncionamento[0]->fim . '">
            </div>';

        if ($primeiro) {
            $resultadosFuncionamento .= '<div class="col-lg-1 col-md-1 col-sm-1">
                <button type="button" id="novo-funcionamento">+</button>
            </div>';
            $primeiro = false;
        } else {
            $resultadosFuncionamento .= '<div class="col-lg-1 col-md-1 col-sm-1"></div>';
        }


        array_splice($objFuncionamento, 0, 0);
    } while (sizeof($objFuncionamento) - 1 > 0);
}

$primeiroContato = true;
$resultadoContato = '';
if (sizeof($objContato) > 0) {
    foreach ($objContato as $contato) {
        $resultadoContato .= '
            <div class="row div-contato">
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
                <div class="col-lg-7 col-md-7 col-sm-7">
                    <input name="descricao[]" type="descricao" value="' . $contato->descricao . '">
                </div>';
        if ($primeiroContato) {
            $resultadoContato .= '
                <div class="col-lg-1 col-md-1 col-sm-1">
                        <button type="button" id="novo-contato">+</button>
                </div>
            </div>';
            $primeiroContato = false;
        } else {
            $resultadoContato .= '</div>';
        }
    }
}

//ATUALIZAÇÃO

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

$objCategoriaPontoTuristico = new CategoriaPontoTuristico;
$objCategoriaPontoTuristico->cod_pt = $objPontoTuristico->cod;

$objContato2 = new Contato;
$objContato2->cod_pt = $objPontoTuristico->cod;

Funcionamento::excluirFuncionamentoDoPontoTuristico($objPontoTuristico->cod);
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
                    $objFuncionamento->cod_pt = $objPontoTuristico->cod;
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
        $objCategoriaPontoTuristico->excluirTodasCategoriasDoPonto($objPontoTuristico->cod);
        foreach ($_POST['categoria'] as $categoria) {
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
                $objContato2->tipo = utf8_decode($_POST['tipo'][$i]);
                $objContato2->descricao = $descricao;
                // Se existe atualiza, senão cria
                if ($objContato[$i]->cod) {
                    $objContato2->cod = $objContato[$i]->cod;
                    $objContato2->atualizar();
                } else {
                    $objContato2->cadastrar();
                }
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
        $_POST['latit']
    )) {
        $objEndereco2 = new Endereco;
        $objEndereco2->cod = $objEndereco->cod;
        $objEndereco2->cod_cidade = $_POST['cod_cidade'];
        $objEndereco2->rua = utf8_decode($_POST['rua']);
        $objEndereco2->numero = $_POST['numero'];
        $objEndereco2->bairro = utf8_decode($_POST['bairro']);
        $objEndereco2->cep = $_POST['cep'];
        $objEndereco2->atualizar();

        $objPontoTuristico2 = new PontoTuristico;
        $objPontoTuristico2->cod = $objPontoTuristico->cod;
        $objPontoTuristico2->nome = utf8_decode($_POST['nome']);
        $objPontoTuristico2->cap = $_POST['cap'];
        $objPontoTuristico2->obs = utf8_decode($_POST['obs']);
        $objPontoTuristico2->periodo = utf8_decode($_POST['periodo']);
        $objPontoTuristico2->valor = $_POST['valor'];
        $objPontoTuristico2->descr = utf8_decode($_POST['descr']);
        $objPontoTuristico2->hist = utf8_decode($_POST['hist']);
        $objPontoTuristico2->longi = $_POST['longi'];
        $objPontoTuristico2->latit = $_POST['latit'];
        $objPontoTuristico2->cod_end = $objEndereco2->cod;
        $objPontoTuristico2->atualizar();
    }

    //IMAGEM
    if (
        isset(
            $_FILES['imagem']
        ) && $_FILES['imagem']["error"] == null
    ) {
        $file = $_FILES['imagem'];
        print_r($file["error"]);
        exit;

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
    }

    $url =  str_replace("editar", "ponto-turistico", $_SERVER['REQUEST_URI']);
    header('Location: ' . $url);
}

include __DIR__ . '/includes/header.php';
?>

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

<?php
include __DIR__ . '/includes/footer.php';
?>