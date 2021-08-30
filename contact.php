<?php
require_once('src/PHPMailer.php');
require_once('src/SMTP.php');
require_once('src/Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

if (isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['mensagem'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $mensagem = $_POST['mensagem'];
    $assunto = "Mensagem de " . $nome;

    $mail = new PHPMailer(true);

    try {
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'localizaaialtojacui@gmail.com';
        $mail->Password = '#localizaai';
        $mail->Port = 587;

        $mail->setFrom($email, $nome);
        $mail->addAddress('localizaaialtojacui@gmail.com');

        $mail->isHTML(true);
        $mail->Subject = $assunto;
        $mail->Body = '<h3>' . $nome . "<br>" . $email . ': </h3> <br>' . $mensagem;
        $mail->AltBody = $nome . " " . $email . ': ' . $mensagem;

        $url = '';
        if ($mail->send()) {
            $url = $_SERVER['REQUEST_URI'] . '?sucesso=true';
        } else {
            $url = $_SERVER['REQUEST_URI'] . '?sucesso=false';
        }
        header('Location: ' . $url);
    } catch (Exception $e) {
        echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
    }
}

$mensagem = "";
if (isset($_GET["sucesso"]) && $_GET["sucesso"] == true) {
    $mensagem = '
    <div class="alert alert-success" role="alert">
                Seu email foi enviado com sucesso, aguarde que retornaremos o seu contato &#128521;
            </div>
    ';
}

if (isset($_GET["sucesso"]) && $_GET["sucesso"] == false) {
    $mensagem = '
    <div class="alert alert-danger" role="alert">
                Seu email não foi enviado. Por favor tente novamente;
            </div>
    ';
}


include __DIR__ . '/includes/header.php';
?>

<!-- Map Begin -->
<!-- <div class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2942.5524090066037!2d-71.10245469994108!3d42.47980730490846!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89e3748250c43a43%3A0xe1b9879a5e9b6657!2sWinter%20Street%20Public%20Parking%20Lot!5e0!3m2!1sen!2sbd!4v1577299251173!5m2!1sen!2sbd" height="600" style="border:0;" allowfullscreen=""></iframe>
</div> -->
<!-- Map End -->

<!-- Contact Section Begin -->
<section class="contact spad">
    <div class="container">



        <h2 class="text-center">Não achou seu ponto no site? Fale conosco para adicioná-lo o quanto antes &#128516;
        </h2>
        <div class="row mt-5">
            <div class="col-lg-5 col-md-6 col-sm-5">
                <div class="contact__widget">
                    <div class="contact__widget__item">
                        <h4>Fale Conosco</h4>
                        <ul>
                            <li>(54) 99250-5667</li>
                            <li>localizaaialtojacui@gmail.com</li>
                        </ul>
                    </div>
                    <div class="contact__widget__time">
                        <h4>Funcionamento</h4>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="contact__widget__time__item">
                                    <ul>
                                        <li>Segunda - Sexta</li>
                                        <li><span>Das 8 às 19 horas</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="contact__widget__time__item">
                                    <ul>
                                        <li>Sábado - Domingo</li>
                                        <li><span>Das 8 às 12 horas</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 offset-lg-1 col-md-6 col-sm-7">
                <div class="contact__form">
                    <form method="POST" action="#">
                        <input name="nome" type="text" placeholder="Seu nome" required>
                        <input name="email" type="email" placeholder="Email" required>
                        <textarea name="mensagem" placeholder="Sua mensagem" required></textarea>
                        <button type="submit">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->

<?php
include __DIR__ . '/includes/footer.php';
?>