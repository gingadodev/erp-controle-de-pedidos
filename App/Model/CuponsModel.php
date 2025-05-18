<?php

namespace App\Model;

use App\Model\IConnModel;
use PDO;

class CuponsModel
{
    private IConnModel $conn;

    public function __construct(IConnModel $c)
    {
        $this->conn = $c;
    }

    public function insert($data)
    {
        $conn = $this->conn->get();

        $codigo = $data['codigo'];
        $desconto = $data['desconto'];
        $valor_minimo = $data['valor_minimo'];
        $validade = $data['validade'];

        $str = "INSERT INTO tb_cupons "
            . "(`codigo`, `desconto`, `valor_minimo`, `validade`)"
            . " VALUES ('%s', '%s', '%s', '%s')"
            . '';

        $sql = sprintf($str, 
            $codigo, $desconto, 
            $valor_minimo, $validade
        );

        try {

            $conn->query($sql);
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

    public function update(array $data, int $id)
    {
        $conn = $this->conn->get();

        $codigo = $data['codigo'];
        $desconto = $data['desconto'];
        $valor_minimo = $data['valor_minimo'];
        $validade = $data['validade'];

        $str = ''
            . "UPDATE tb_cupons SET "
            . "`codigo` = '%s', "
            . "`desconto` = %s, "
            . "`valor_minimo` = %s, "
            . "`validade` = '%s' "
            . " WHERE id = %d"
            . '';

        $sql = sprintf($str, 
            $codigo, $desconto, 
            $valor_minimo, $validade, 
            $id
        );

        try {

            $conn->query($sql);

            return true;

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

    public function getById(int $id)
    {
        $str = "
            SELECT 
                id, codigo, desconto, 
                valor_minimo, validade,
                DATE_FORMAT(validade, '%%d/%%m/%%Y') AS validade_br 
            FROM tb_cupons 
            WHERE id = %d
        ";

        $sql = sprintf($str, $id);
        $conn = $this->conn->get();

        try {

        $stmt = $conn->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
            
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

    public function getAll()
    {
        $sql = "
            SELECT 
                id, codigo, desconto, 
                valor_minimo, validade,
                DATE_FORMAT(validade, '%d/%m/%Y') AS validade_br 
            FROM tb_cupons 
            ORDER BY id DESC
        ";

        $conn = $this->conn->get();


        try {

        $stmt = $conn->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;

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

