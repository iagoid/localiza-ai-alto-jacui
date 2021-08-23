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

class PontosDaCategoria
{
    public $cod;
    public $nome;

    public static function pontosDaCategoria($where = null, $order = null, $limit = null)
    {
        $script = "SELECT ponto_turistico.nome, ponto_turistico.cod FROM categoria INNER JOIN cat_pt ON cat_pt.cod_cat =
            categoria.cod INNER JOIN ponto_turistico ON cat_pt.cod_cat = ponto_turistico.cod";
        return (new Database('ponto_turistico'))->join($script, $where, $order, $limit, "cod, nome")->fetchAll(PDO::FETCH_CLASS);
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


class ImagensDoPonto
{
    public $nome;
    public $cod_pt;
    public $codigo;

    public static function imagensDoPonto($where = null, $order = null, $limit = null)
    {
        $script = "SELECT imagem.nome FROM imagem INNER JOIN ponto_turistico ON imagem.cod_pt = ponto_turistico.cod";
        return (new Database('imagem'))->join($script, $where, $order, $limit)->fetchAll(PDO::FETCH_CLASS); 

    }
}
