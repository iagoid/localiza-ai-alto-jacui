<?php

namespace App\Entity;

// Instanciando conexão com o banco
require_once 'app/Db/Database.php';

use \App\Db\Database;
use PDO;

class Funcionamento
{
  public $cod;
  public $cod_pt;
  public $inicio;
  public $fim;

  public function cadastrar()
  {
    // criando o endereço no DB
    $objDatabase = new Database('funcionamento');

    $this->cod = $objDatabase->insert([
      'cod_pt' => $this->cod_pt,
      'inicio' => $this->inicio,
      'fim' => $this->fim,
    ]);
    return true;
  }

  public function atualizar()
  {
    return (new Database('funcionamento'))->update('cod = ' . $this->cod, [
      'cod_pt' => $this->cod_pt,
      'inicio' => $this->inicio,
      'fim' => $this->fim,
    ]);
  }

  public function excluir()
  {
    return (new Database('funcionamento'))->delete('cod = ' . $this->cod);
  }

  public static function getFuncionamentos($where = null, $order = null, $limit = null)
  {
    return (new Database('funcionamento'))->select($where, $order, $limit, "cod, cod_pt, inicio, fim")->fetchAll(PDO::FETCH_CLASS);
  }

  public static function getFuncionamento($cod)
  {
    return (new Database('funcionamento'))->select('cod = ' . $cod)->fetchObject(self::class);
  }
}
