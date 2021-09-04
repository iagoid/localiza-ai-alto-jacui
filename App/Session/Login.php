<?php

namespace App\Session;

class Login{

	private static function init(){
		if(session_status() !== PHP_SESSION_ACTIVE){
			session_start();
		}
	}

	public static function login($objUsuario)
	{
		self::init();

		$_SESSION['usuario'] = [
			'cod' => $objUsuario->cod,
			'nome' => $objUsuario->nome,
			'login' => $objUsuario->login
		];
		
		header('location: listagemADMIN.php');
		exit;
	}

	public static function logout()
	{
		self::init();

		unset($_SESSION['usuario']);

		header('location: login.php');exit;
	}

	public static function isLogged()
	{
		self::init();
		return isset($_SESSION['usuario']['cod']);
	}

	public static function requireLogin()
	{
		if(!self::isLogged()){
			header('location: login.php');
			exit;
		}
	}

	public static function requireLogout()
	{
		if(self::isLogged()){
			header('location: index.php');
			exit;
		}
	}

	public static function getUsuarioLogado(){
		self::init();

		return self::isLogged() ? $_SESSION['usuario'] : null;
	}
}

?>