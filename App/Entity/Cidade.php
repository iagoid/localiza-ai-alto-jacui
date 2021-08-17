<?php

namespace App\Entity;

require_once 'App/Db/Database.php';

use \App\Db\Database;
use PDO;

class Cidade
{
  public $cod;
  public $nome;
  public $uf;

  public static function getcidades($where = null, $order = null, $limit = null)
  {
    return (new Database('cidade'))->select($where, $order, $limit, "cod, nome, uf")->fetchAll(PDO::FETCH_CLASS);
  }

  public static function getcidade($cod)
  {
    return (new Database('cidade'))->select('cod = ' . $cod)->fetchObject(self::class);
  }
}
