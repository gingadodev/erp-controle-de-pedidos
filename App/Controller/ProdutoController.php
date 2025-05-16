<?php

namespace App\Controller;

use App\Helper\RedirectHelper;
use App\Helper\ViewHelper;
use Core\Http\RequestHttp;
use App\Model\ConnModel;
use App\Model\ProdutoModel;
use App\Model\EstoqueModel;

class ProdutoController
{
    private RequestHttp $request;
    private ConnModel $conn;
    private ProdutoModel $produto;

    public function __construct()
    {
        $this->conn = new ConnModel();
        $this->request = new RequestHttp();
        $this->produto = new ProdutoModel($this->conn);
        $this->estoque = new EstoqueModel($this->conn);
    }

    public function indexAction()
    {
        $view = new ViewHelper();

        $data['title'] = 'Produto';
        $data['data'] = $data;

        $view->template('produto', $data);
    }

    public function insertAction()
    {

        $nome = $this->request->post('nome');
        $preco = $this->request->post('preco');
        $variacao = $this->request->post('variacao');
        $quantidade = $this->request->post('estoque');

        $data['nome'] = $nome;
        $data['preco'] = (!isset($preco))? 0: str_replace(['.', ','], ['', '.'], $preco);

        try {

            $idProduto = $this->produto->insert($data);

            $status = 'error';
            $message = 'Erro ao processar dados.';
            $result = [];

            if(isset($idProduto)){

                $status = 'success';
                $message = 'Produto adicionado';
                $result = $data;

                $data['id_produto'] = $idProduto;
                $data['variacao'] = $variacao;
                $data['quantidade'] = $quantidade;

                $this->estoque->insert($data);
            }

            echo json_encode([
                'status' => $status,
                'message' => $message,
                'data' => $result
            ]);


        } catch (\Exception $e) {
            throw new Exception($e->getMessage());
        }

        return;
    }

}    

