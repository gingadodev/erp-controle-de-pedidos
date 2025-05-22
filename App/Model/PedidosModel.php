<?php

namespace App\Model;

use App\Model\IConnModel;
use PDO;

class PedidosModel
{
    private IConnModel $conn;

    public function __construct(IConnModel $c)
    {
        $this->conn = $c;
    }

    public function insert($data)
    {
        $conn = $this->conn->get();

        $subtotal = $data['subtotal'];
        $frete = $data['frete'];
        $total = $data['total'];
        $endereco = $data['endereco'];

        $sql = "INSERT INTO tb_pedidos "
            . "(`subtotal`, `frete`, `total`, `endereco`)"
            . " VALUES (:subtotal, :frete, :total, :endereco)"
            . '';

        try {

            $stmt = $conn->prepare($sql);
            $stmt->execute([

                'subtotal' => $subtotal,
                'frete' => $frete,
                'total' => $total,
                'endereco' => $endereco
            ]);

            $lastId = $conn->lastInsertId();

            return $lastId;

        } catch (\Exception $e) {

            return [
                'status' => 'error',
                'title'=> 'Ops!',
                'message' => $e->getMessage(),
                'sql' => [$sql],
                'data'=> []
            ];
        }

    }

}    

