<?php

namespace App\Model;

use App\Model\IConnModel;

class ProdutoModel
{
    private IConnModel $conn;

    public function __construct(IConnModel $c)
    {
        $this->conn = $c;
    }

    public function insert($data)
    {

        $conn = $this->conn->get();

        $str = "INSERT INTO tb_produtos (`nome`, `preco`) VALUES ('%s', '%s')";
        $sql = sprintf($str, $data['nome'], $data['preco']);

        $conn->query($sql);
        $lastId = $conn->lastInsertId();

        return $lastId;
    }
}    

