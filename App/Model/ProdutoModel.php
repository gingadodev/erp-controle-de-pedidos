<?php

namespace App\Model;

use App\Model\IConnModel;
use PDO;

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

    public function getAll()
    {
        $sql = "
            SELECT 
            p.id,
            p.nome,
            p.preco,
            e.variacao,
            e.quantidade 
            FROM tb_produtos AS p 
            INNER JOIN tb_estoque e ON (e.id_produto = p.id)
            ORDER BY p.id DESC
        ";

        $conn = $this->conn->get();
        $stmt = $conn->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
}    

