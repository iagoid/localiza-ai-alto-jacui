<?php

namespace App\Entity;

// Instanciando conexão com o banco
require_once 'app/Db/Database.php';

use \App\Db\Database;
use PDO;

class Usuario
{
  public $cod;
  public $cod_cidade;
  public $rua;
  public $numero;
  public $bairro;
  public $cep;

  public function cadastrar()
  {
    // criando o endereço no DB
    $objDatabase = new Database('endereco');

    $this->cod = $objDatabase->insert([
      'cod_cidade' => $this->cod_cidade,
      'rua' => $this->rua,
      'numero' => $this->numero,
      'bairro' => $this->bairro,
      'cep' => $this->cep,
    ]);
    return true;
  }

  public function atualizar()
  {
    return (new Database('endereco'))->update('cod = ' . $this->cod, [
      'cod_cidade' => $this->cod_cidade,
      'rua' => $this->rua,
      'numero' => $this->numero,
      'bairro' => $this->bairro,
      'cep' => $this->cep,
    ]);
  }

  public function excluir()
  {
    return (new Database('endereco'))->delete('cod = ' . $this->cod);
  }

  public static function getEnderecos($where = null, $order = null, $limit = null)
  {
    return (new Database('endereco'))->select($where, $order, $limit, "cod, cod_cidade, rua, 
    numero, bairro, cep")->fetchAll(PDO::FETCH_CLASS);
  }

  public static function getEndereco($cod)
  {
    return (new Database('endereco'))->select('cod = ' . $cod)->fetchObject(self::class);
  }
}
