<?php

namespace App\Entity;

// Instanciando conexão com o banco
require_once 'App/Db/Database.php';

use \App\Db\Database;
use PDO;

class Contato
{
  public $cod;
  public $tipo;
  public $url;

  public function cadastrar()
  {
    // criando o endereço no DB
    $objDatabase = new Database('contato');

    $this->cod = $objDatabase->insert([
      'tipo' => $this->tipo,
      'url' => $this->url,
    ]);
    return true;
  }

  public function atualizar()
  {
    return (new Database('contato'))->update('cod = ' . $this->cod, [
      'tipo' => $this->tipo,
      'url' => $this->url,
    ]);
  }

  public function excluir()
  {
    return (new Database('contato'))->delete('cod = ' . $this->cod);
  }

  public static function getContatos($where = null, $order = null, $limit = null)
  {
    return (new Database('contato'))->select($where, $order, $limit, "cod, tipo, url")->fetchAll(PDO::FETCH_CLASS);
  }

  public static function getContato($cod)
  {
    return (new Database('contato'))->select('cod = ' . $cod)->fetchObject(self::class);
  }
}
