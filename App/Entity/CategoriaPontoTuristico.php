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
    // criando o endereço no DB
    $objDatabase = new Database('cont_pt');

    $this->cod = $objDatabase->insert([
      'cod_cat' => $this->cod_cat,
      'cod_pt' => $this->cod_pt,
    ]);
    return true;
  }

  public function atualizar()
  {
    return (new Database('cont_pt'))->update('cod_cat = ' . $this->cod_cat . 'AND cod_pt = ' . $this->cod_pt,  [
      'cod_cat' => $this->cod_cat,
      'cod_pt' => $this->cod_pt,
    ]);
  }

  public function excluir()
  {
    return (new Database('cont_pt'))->delete('cod_cat = ' . $this->cod_cat . 'AND cod_pt = ' . $this->cod_pt);
  }

  public static function getCategoriaPontoTuristico($cod_cat, $cod_pt)
  {
    return (new Database('cont_pt'))->select('cod_cat = ' . $cod_cat . 'AND cod_pt = ' . $cod_pt)->fetchObject(self::class);
  }
}
