<?php

namespace App\Entity;

// Instanciando conexão com o banco
require_once 'app/Db/Database.php';

use \App\Db\Database;
use PDO;

class ContatoPontoTuristico
{
  public $cod_cont;
  public $cod_pt;

  public function cadastrar()
  {
    // criando o endereço no DB
    $objDatabase = new Database('cont_pt');

    $this->cod = $objDatabase->insert([
      'cod_cont' => $this->cod_cont,
      'cod_pt' => $this->cod_pt,
    ]);
    return true;
  }

  public function atualizar()
  {
    return (new Database('cont_pt'))->update('cod_cont = ' . $this->cod_cont . 'AND cod_pt = ' . $this->cod_pt,  [
      'cod_cont' => $this->cod_cont,
      'cod_pt' => $this->cod_pt,
    ]);
  }

  public function excluir()
  {
    return (new Database('cont_pt'))->delete('cod_cont = ' . $this->cod_cont . 'AND cod_pt = ' . $this->cod_pt);
  }

  public static function getContatoPontoTuristico($cod_cont, $cod_pt)
  {
    return (new Database('cont_pt'))->select('cod_cont = ' . $cod_cont . 'AND cod_pt = ' . $cod_pt)->fetchObject(self::class);
  }
}
