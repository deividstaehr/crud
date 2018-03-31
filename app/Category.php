<?php

namespace app;

use core\Model;

final class Category extends Model
{
    protected $tableName = 'categorias';
    protected $pkey = 'id';

    public function __construct()
    {
        parent::__construct();
    }
}