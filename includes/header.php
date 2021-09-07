<?php

require_once 'App/Session/Login.php';

use \App\Session\Login;

$usuarioLogado = Login::getUsuarioLogado();

$usuario = $usuarioLogado ? '<span id="user-loged"> Olá, ' . $usuarioLogado['nome'] . '</span> <a href="logout.php">Sair</a>' :
    '<a href="login.php"><span class="mr-2 fa fa-user-o"></span>Entrar</a>';

$link = $usuarioLogado ? '<li><a href="./listagemADMIN">Pontos Turísticos</a></li>
    <li><a href="./cadastro">Cadastro</a></li>' : '<li><a href="./listagem">Pontos Turísticos</a></li>';

$linkContato = $usuarioLogado ? "" : '<div class="header__nav__widget">
    <a href="./contact">Fale Conosco <span class="fa arrow_right"></span></a>
    </div>';


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="Hiroto Template">
    <meta name="keywords" content="Hiroto, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Localiza Aí Alto Jacuí | <?= $title ?></title>

    <!-- Css Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link rel="stylesheet" href="css/new-style.css" type="text/css">
    <link rel="icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
    <link rel="manifest" href="img/favicon/site.webmanifest">
</head>

<body>
    <!-- Page Preloder -->
    <!--<div id="preloder">
        <div class="loader"></div>
    </div>-->

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__logo">
            <a href="./index"><img src="img/logo3.png"></a>
        </div>
        <nav class="offcanvas__menu mobile-menu">
            <ul>
                <li class="active"><a href="./index">Home</a></li>
                <?= $link ?>
                <li><a href="./about">Sobre Nós</a></li>
                <li><a href="./contact">Contact</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__btn__widget">
            <a href="#">Fale Conosco<span class="arrow_right"></span></a>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__nav__option">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="header__logo">
                            <a href="./index.php"><img src="img/logo3.png"></a>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="header__nav">
                            <nav class="header__menu">
                                <ul class="menu__class">
                                    <li><a href="./index">Home</a></li>
                                    <?= $link ?>
                                    <li><a href="./about">Sobre Nós</a></li>
                                </ul>
                            </nav>
                            <?= $linkContato ?>

                            <div class="ml-3 header__nav__widget">
                                <?= $usuario ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="canvas__open">
                    <span class="fa fa-bars"></span>
                </div>
            </div>
        </div>
    </header>
    <!-- Header Section End -->