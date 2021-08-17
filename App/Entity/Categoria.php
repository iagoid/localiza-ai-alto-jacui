<?php

namespace App\Entity;

require_once 'App/Db/Database.php';

use \App\Db\Database;
use PDO;

class Categoria
{
  public $cod;
  public $nome;

  public static function getcategorias($where = null, $order = null, $limit = null)
  {
    return (new Database('categoria'))->select($where, $order, $limit, "cod, nome")->fetchAll(PDO::FETCH_CLASS);
  }

  public static function getcategoria($cod)
  {
    return (new Database('categoria'))->select('cod = ' . $cod)->fetchObject(self::class);
  }
}
