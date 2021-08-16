<?php

namespace App\Entity;

// Instanciando conexão com o banco
require_once 'app/Db/Database.php';

use \App\Db\Database;
use PDO;

class Imagem
{
  public $cod;
  public $cod_pt;
  public $nome;

  public function cadastrar()
  {
    // criando o endereço no DB
    $objDatabase = new Database('imagem');

    $this->cod = $objDatabase->insert([
      'cod_pt' => $this->cod_pt,
      'nome' => $this->nome,
    ]);
    return true;
  }

  public function atualizar()
  {
    return (new Database('imagem'))->update('cod = ' . $this->cod, [
      'cod_pt' => $this->cod_pt,
      'nome' => $this->nome,
    ]);
  }

  public function excluir()
  {
    return (new Database('imagem'))->delete('cod = ' . $this->cod);
  }

  public static function getImagens($where = null, $order = null, $limit = null)
  {
    return (new Database('imagem'))->select($where, $order, $limit, "cod, cod_pt, nome")->fetchAll(PDO::FETCH_CLASS);
  }

  public static function getImagem($cod)
  {
    return (new Database('imagem'))->select('cod = ' . $cod)->fetchObject(self::class);
  }
}
