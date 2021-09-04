<?php

require_once 'App/Session/Login.php';
require_once 'App/Entity/Usuario.php';

use \App\Session\Login;
use \App\Entity\Usuario;

Login::requireLogout();

$alertaLogin = '';

if(isset($_POST['acao'])){

	$objUsuario = Usuario::getUsuarioPorLogin($_POST['login']);
	$objSenha = Usuario::getUsuarioPorSenha($_POST['senha']);
	if(!$objUsuario instanceof Usuario || !$objSenha instanceof Usuario){
		$alertaLogin = 'Email ou senha inválidos';
	}

	Login::login($objUsuario);

}

$title = 'Login';

include __DIR__.'/includes/header.php';
include __DIR__.'/includes/formulario-login.php';
include __DIR__.'/includes/footer.php';



?>