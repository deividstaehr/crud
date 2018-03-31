<?php

namespace app;

use core\Model;

final class Product extends Model
{
    protected $tableName = 'produtos';
    protected $pkey = 'id';
    protected $columns = [
        "id" => null,
        "nome" => null,
        "preco" => null,
        "descricao" => null,
        "categoria_id" => null
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function tableList()
    {
        $sql = "
            SELECT pro.id, pro.nome, pro.preco, pro.descricao, cat.nome AS cat_nome
              FROM produtos AS pro
              JOIN categorias AS cat
                ON cat.id = pro.categoria_id
       ORDER BY pro.id
        ";

        return $this->all($sql);
    }
}