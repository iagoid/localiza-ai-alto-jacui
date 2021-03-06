<?php

namespace App\Entity;

// Instanciando conexão com o banco
require_once 'App/Db/Database.php';

use \App\Db\Database;
use PDO;

class Contato
{
  public $cod;
  public $cod_pt;
  public $tipo;
  public $descricao;

  public function cadastrar()
  {
    // criando o endereço no DB
    $objDatabase = new Database('contato');

    $this->cod = $objDatabase->insert([
      'cod_pt' => $this->cod_pt,
      'tipo' => $this->tipo,
      'descricao' => $this->descricao,
    ]);
    return true;
  }

  public function atualizar()
  {
    return (new Database('contato'))->update('cod = ' . $this->cod, [
      'cod_pt' => $this->cod_pt,
      'tipo' => $this->tipo,
      'descricao' => $this->descricao,
    ]);
  }

  public function excluir()
  {
    return (new Database('contato'))->delete('cod = ' . $this->cod);
  }

  public static function getContatos($where = null, $order = null, $limit = null)
  {
    return (new Database('contato'))->select($where, $order, $limit, "cod, cod_pt, tipo, descricao")->fetchAll(PDO::FETCH_CLASS);
  }

  public static function excluirContatoDoPontoTuristico($cod_pt)
  {
    return (new Database('contato'))->delete('cod_pt = ' . $cod_pt);
  }
}
