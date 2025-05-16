<?php

namespace App\Model;

use App\Model\IConnModel;

class EstoqueModel
{
    private IConnModel $conn;

    public function __construct(IConnModel $c)
    {
        $this->conn = $c;
    }

    public function insert($data)
    {
        $conn = $this->conn->get();

        $str = ''
            . "INSERT INTO tb_estoque "
            . "(`id_produto`, `variacao`, `quantidade`) VALUES "
            ."('%d', '%d', '%d')"
            . '';

        $sql = sprintf($str, 
            $data['id_produto'], 
            $data['variacao'], 
            $data['quantidade']
        );

        $conn->query($sql);
        $lastId = $conn->lastInsertId();

        return $lastId;
    }
}    

