<?php

namespace App\Entity;

// Instanciando conexão com o banco
require_once 'App/Db/Database.php';

use \App\Db\Database;
use PDO;

class Funcionamento
{
  public $cod;
  public $cod_pt;
  public $inicio;
  public $fim;
  public $dia;

  public function cadastrar()
  {
    // criando o endereço no DB
    $objDatabase = new Database('funcionamento');

    $this->cod = $objDatabase->insert([
      'cod_pt' => $this->cod_pt,
      'inicio' => $this->inicio,
      'fim' => $this->fim,
      'dia' => $this->dia,
    ]);
    return true;
  }

  public function atualizar()
  {
    return (new Database('funcionamento'))->update('cod = ' . $this->cod, [
      'cod_pt' => $this->cod_pt,
      'inicio' => $this->inicio,
      'fim' => $this->fim,
      'dia' => $this->dia,
    ]);
  }

  public static function excluirFuncionamentoDoPontoTuristico($cod_pt)
  {
    return (new Database('funcionamento'))->delete('cod_pt = ' . $cod_pt);
  }

  public static function getFuncionamentoFromPt($cod_pt)
  {
    return (new Database('funcionamento'))->select('cod_pt = ' . $cod_pt)->fetchAll(PDO::FETCH_CLASS);
  }
}
