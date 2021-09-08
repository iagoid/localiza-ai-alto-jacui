<?php

namespace App\Entity;

// Instanciando conexão com o banco
require_once 'App/Db/Database.php';

use \App\Db\Database;
use PDO;

class CategoriaPontoTuristico
{
  public $cod_cat;
  public $cod_pt;

  public function cadastrar()
  {
    $objDatabase = new Database('cat_pt');

    $objDatabase->insert([
      'cod_cat' => $this->cod_cat,
      'cod_pt' => $this->cod_pt,
    ]);
    return true;
  }

  public static function excluirTodasCategoriasDoPonto($cod_pt)
  {
    return (new Database('cat_pt'))->delete('cod_pt = ' . $cod_pt);
  }
}
