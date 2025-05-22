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

    public function update(array $data, int $id)
    {
        $conn = $this->conn->get();

        $nome = $data['nome'];
        $preco = $data['preco'];
        $variacao = $data['variacao'];
        $quantidade = $data['quantidade'];

        $strp = ''
        . "UPDATE tb_produtos SET `nome` = '%s', `preco` = %s "
        . "WHERE id = %d"
        . '';

        $stre = ''
        . "UPDATE tb_estoque SET `variacao` = '%s', `quantidade` = '%d' "
        . "WHERE id_produto = %d"
        . '';

        $sqlp = sprintf($strp, $nome, $preco, $id);
        $sqle = sprintf($stre, $variacao, $quantidade, $id);

        $conn->beginTransaction();

        try {

            $conn->query($sqlp);
            $conn->query($sqle);

            $conn->commit();

            return true;

        } catch (\Exception $e) {

            $conn->rollback();

            return [
                'status' => 'error',
                'title'=> 'Ops!',
                'message' => $e->getMessage(),
                'sql' => [
                    'produto' => $sqlp,
                    'estoque' => $sqle
                ],
                'data'=> []
            ];
        }
    }

    public function getById(int $id)
    {
        $str = "
            SELECT 
            p.id,
            p.nome,
            p.preco,
            e.variacao,
            e.quantidade 
            FROM tb_produtos AS p 
            INNER JOIN tb_estoque e ON (e.id_produto = p.id)
            WHERE p.id = %d
        ";

        $sql = sprintf($str, $id);
        $conn = $this->conn->get();
        $stmt = $conn->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
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

