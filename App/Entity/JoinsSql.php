<?php

namespace App\Entity;

require_once 'App/Db/Database.php';

use \App\Db\Database;
use PDO;

class CategoriasDoPonto
{
    public $cod;
    public $nome;

    public static function categoriasDoPonto($where = null, $order = null, $limit = null)
    {
        $script = "SELECT categoria.cod, categoria.nome FROM ponto_turistico INNER JOIN cat_pt ON cat_pt.cod_pt = ponto_turistico.cod INNER JOIN categoria ON cat_pt.cod_cat = categoria.cod";
        return (new Database('categoria'))->join($script, $where, $order, $limit, "cod, nome")->fetchAll(PDO::FETCH_CLASS);
    }
}


class CidadeDoPonto
{
    public $numero;
    public $bairro;
    public $cep;
    public $rua;
    public $nome;
    public $uf;

    public static function cidadeDoPonto($where = null, $order = null, $limit = null)
    {
        $script = "SELECT numero, bairro, cep, rua, cidade.nome, cidade.uf FROM `ponto_turistico` INNER JOIN endereco ON ponto_turistico.cod_end=endereco.cod INNER JOIN cidade ON endereco.cod_cidade=cidade.cod";
        return (new Database('endereco'))->join($script, $where, $order, $limit)->fetchAll(PDO::FETCH_CLASS);
    }
}


class ContatoDoPonto
{
    public $url;
    public $tipo;

    public static function contatoDoPonto($where = null, $order = null, $limit = null)
    {
        $script = "SELECT url, tipo FROM ponto_turistico INNER JOIN cont_pt ON ponto_turistico.cod = cont_pt.cod_pt INNER JOIN contato ON cont_pt.cod_cont = contato.cod";
        return (new Database('funcionamento'))->join($script, $where, $order, $limit)->fetchAll(PDO::FETCH_CLASS);
    }
}
