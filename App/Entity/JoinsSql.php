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

class PontosCadPT
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
    public $cod_cat;

    public static function pontosCadPT($where = null, $order = null, $limit = null)
    {
        $script = "SELECT cat_pt.cod_pt as cod, cod_end,  obs, periodo, valor, nome, descr, hist, cap, longi, latit, cod_cat FROM ponto_turistico INNER JOIN cat_pt ON cat_pt.cod_pt=ponto_turistico.cod INNER JOIN endereco ON endereco.cod=ponto_turistico.cod_end";
        $group = "GROUP BY ponto_turistico.cod";
        return (new Database('ponto_turistico'))->join($script,  $where, $order, $limit, null, $group)->fetchAll(PDO::FETCH_CLASS);
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
