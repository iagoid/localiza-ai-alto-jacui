<?php
require_once 'App/Entity/PontoTuristico.php';
require_once 'App/Entity/Funcionamento.php';

use \App\Entity\PontoTuristico;
use \App\Entity\Funcionamento;

if (!isset($_GET['cod']) or !is_numeric(($_GET['cod']))) {
    header('location: index.php?status=error');
    exit;
}


$pontoTuristico = PontoTuristico::getPontoTuristico($_GET['cod']);
$funcionamentos = Funcionamento::getFuncionamentoFromPt($_GET['cod']);


$resultadosPontoTuristico = '<div class="room__details__title">
                        <h2>' . $pontoTuristico->nome . '</h2>
                    </div>
                    <div class="room__details__desc">
                        <p>' . $pontoTuristico->descr . '</p>
                        <h2>História:</h2>
                        <p>' . $pontoTuristico->hist . '</p>
                        <h5>Temporada: ' . $pontoTuristico->periodo . '</h5>
                        <h5>Valor: R$: ' . $pontoTuristico->valor . '</h5>
                        <h5>Capacidade: ' . $pontoTuristico->cap . ' visitantes</h5>
                        <p>' . $pontoTuristico->obs . '</p>
                    </div>';

$resultadosFuncionamento = '';
$i = 0;
foreach ($funcionamentos as $funcionamento) {
    $resultadosFuncionamento .= '<div class="room__details__more__facilities__item">
        <h6>' . $funcionamento->dia . ': Das ' . $funcionamento->inicio . ' as ' . $funcionamento->fim . '</h6>
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
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="room__details__more__facilities">
                                <h2>Categorias:</h2>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="room__details__more__facilities__item">
                                            <div class="icon"><img src="img/rooms/details/facilities/fac-1.png" alt=""></div>
                                            <h6>Air Conditioning</h6>
                                        </div>
                                        <div class="room__details__more__facilities__item">
                                            <div class="icon"><img src="img/rooms/details/facilities/fac-2.png" alt=""></div>
                                            <h6>Cable TV</h6>
                                        </div>
                                        <div class="room__details__more__facilities__item">
                                            <div class="icon"><img src="img/rooms/details/facilities/fac-3.png" alt=""></div>
                                            <h6>Free drinks</h6>
                                        </div>
                                        <div class="room__details__more__facilities__item">
                                            <div class="icon"><img src="img/rooms/details/facilities/fac-4.png" alt=""></div>
                                            <h6>Unlimited Wifi</h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="room__details__more__facilities__item">
                                            <div class="icon"><img src="img/rooms/details/facilities/fac-5.png" alt=""></div>
                                            <h6>Restaurant quality</h6>
                                        </div>
                                        <div class="room__details__more__facilities__item">
                                            <div class="icon"><img src="img/rooms/details/facilities/fac-6.png" alt=""></div>
                                            <h6>Service 24/24</h6>
                                        </div>
                                        <div class="room__details__more__facilities__item">
                                            <div class="icon"><img src="img/rooms/details/facilities/fac-7.png" alt=""></div>
                                            <h6>Gym Centre</h6>
                                        </div>
                                        <div class="room__details__more__facilities__item">
                                            <div class="icon"><img src="img/rooms/details/facilities/fac-8.png" alt=""></div>
                                            <h6>Spa & Wellness</h6>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="room__details__more__facilities__item">
                                            <div class="icon"><img src="img/rooms/details/facilities/fac-5.png" alt=""></div>
                                            <h6>Restaurant quality</h6>
                                        </div>
                                        <div class="room__details__more__facilities__item">
                                            <div class="icon"><img src="img/rooms/details/facilities/fac-6.png" alt=""></div>
                                            <h6>Service 24/24</h6>
                                        </div>
                                        <div class="room__details__more__facilities__item">
                                            <div class="icon"><img src="img/rooms/details/facilities/fac-7.png" alt=""></div>
                                            <h6>Gym Centre</h6>
                                        </div>
                                        <div class="room__details__more__facilities__item">
                                            <div class="icon"><img src="img/rooms/details/facilities/fac-8.png" alt=""></div>
                                            <h6>Spa & Wellness</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
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
            </div>
        </div>
    </div>
</section>
<!-- Rooms Details Section End -->

<!-- Room Details Slider Begin -->
<div class="room-details-slider">
    <div class="container">
        <div class="room__details__pic__slider owl-carousel">
            <div class="room__details__pic__slider__item set-bg" data-setbg="img/rooms/details/rd-1.jpg"></div>
            <div class="room__details__pic__slider__item set-bg" data-setbg="img/rooms/details/rd-2.jpg"></div>
            <div class="room__details__pic__slider__item set-bg" data-setbg="img/rooms/details/rd-3.jpg"></div>
            <div class="room__details__pic__slider__item set-bg" data-setbg="img/rooms/details/rd-4.jpg"></div>
        </div>
    </div>
</div>
<!-- Room Details Slider End -->

<?php
include __DIR__ . '/includes/footer.php';
?>