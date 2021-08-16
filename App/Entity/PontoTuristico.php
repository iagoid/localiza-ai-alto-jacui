<?php

namespace App\Entity;

// Instanciando conexão com o banco
require_once 'app/Db/Database.php';

use \App\Db\Database;
use PDO;

class PontoTuristico
{
  public $cod;
  public $cod_end;
  public $obs;
  public $periodo;
  public $valor;
  public $nome;
  public $descr;
  public $hist;
  public $cap;
  public $longi;
  public $latit;

  public function cadastrar()
  {
    // criando o endereço no DB
    $objDatabase = new Database('ponto_turistico');

    $this->cod = $objDatabase->insert([
      'cod_end' => $this->cod_end,
      'obs' => $this->obs,
      'periodo' => $this->periodo,
      'valor' => $this->valor,
      'nome' => $this->nome,
      'descr' => $this->descr,
      'hist' => $this->hist,
      'cap' => $this->cap,
      'longi' => $this->longi,
      'latit' => $this->latit,
    ]);
    return true;
  }

  public function atualizar()
  {
    return (new Database('ponto_turistico'))->update('cod = ' . $this->cod, [
      'cod_end' => $this->cod_end,
      'obs' => $this->obs,
      'periodo' => $this->periodo,
      'valor' => $this->valor,
      'nome' => $this->nome,
      'descr' => $this->descr,
      'hist' => $this->hist,
      'cap' => $this->cap,
      'longi' => $this->longi,
      'latit' => $this->latit,
    ]);
  }

  public function excluir()
  {
    return (new Database('ponto_turistico'))->delete('cod = ' . $this->cod);
  }

  public static function getPontoTuristicos($where = null, $order = null, $limit = null)
  {
    return (new Database('ponto_turistico'))->select($where, $order, $limit, "cod, cod_end, obs, 
    periodo, valor, nome, descr, hist, cap, longi, latit")->fetchAll(PDO::FETCH_CLASS);
  }

  public static function getPontoTuristico($cod)
  {
    return (new Database('ponto_turistico'))->select('cod = ' . $cod)->fetchObject(self::class);
  }
}
