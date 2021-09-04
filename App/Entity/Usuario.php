<?php

namespace App\Entity;

require_once 'App/Db/Database.php';

use \App\Db\Database;
use \PDO;

class Usuario{

	public $cod;
	public $nome;
	public $login;
	public $senha;

	public function cadastrar()
	{
		$objDatabase = new Database('usuarios');

		$this->id = $objDatabase->insert([

		'nome' => $this->nome,
		'login' => $this->login,
		'senha' => $this->senha
	]);

		return true;
	}

	public static function getUsuarioPorLogin($login)
	{
		return (new Database('usuarios'))->select('login = "'.$login.'"')->fetchObject(self::class);
	}

	public static function getUsuarioPorSenha($senha)
	{
		return (new Database('usuarios'))->select('senha = "'.$senha.'"')->fetchObject(self::class);
	}

}

