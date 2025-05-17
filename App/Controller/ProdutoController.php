<?php

namespace App\Controller;

use App\Helper\RedirectHelper;
use App\Helper\ViewHelper;
use Core\Http\RequestHttp;
use App\Model\ConnModel;
use App\Model\ProdutoModel;
use App\Model\EstoqueModel;
use Exception;

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

        header('Content-Type: application/json');

        $nome = $this->request->post('nome');
        $preco = $this->request->post('preco');
        $variacao = $this->request->post('variacao');
        $quantidade = $this->request->post('quantidade');

        $data['nome'] = $nome;
        $data['preco'] = (!isset($preco))? 0: str_replace(['.', ','], ['', '.'], $preco);

        try {

            $idProduto = $this->produto->insert($data);

            $status = 'error';
            $title = 'Ops!';
            $message = 'Erro ao processar dados.';
            $result = [];

            if(isset($idProduto)){

                $status = 'success';
                $title = 'Sucesso!';
                $message = 'Produto ADICIONADO';
                $result = $data;

                $data['id_produto'] = $idProduto;
                $data['variacao'] = $variacao;
                $data['quantidade'] = $quantidade;

                $this->estoque->insert($data);
            }

            echo json_encode([
                'status' => $status,
                'title' => $title,
                'message' => $message,
                'data' => $result
            ]);


        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return;
    }

    public function editAction()
    {
        header('Content-Type: application/json');

        try {

            $id = $this->request->post('id');
            $result = $this->produto->getById($id);

            $status = 'error' ;
            $title = 'Ops!';
            $message = 'Erro ao editar dados';
            $data = [];

            if(isset($id)){

                $status = 'success' ;
                $title = 'Sucesso!';
                $message = 'Pronto para editar';
                $data = $result;
            }

            echo json_encode([
                'status' => $status,
                'title' => $title,
                'message' => $message,
                'data' => $result
            ]);

            return;

        } catch (Exception $e) {
            throw new Exception($e);
        }
    }

    public function saveAction()
    {
        $id = $this->request->post('id');

        if($id > 0){
            self::updateAction();
            exit();
        }
            self::insertAction();
    }

    public function updateAction()
    {
        header('Content-Type: application/json');

        $id = $this->request->post('id');
        $nome = $this->request->post('nome');
        $preco = $this->request->post('preco');
        $variacao = $this->request->post('variacao');
        $quantidade = $this->request->post('quantidade');

        $data['nome'] = $nome;
        $data['preco'] = (!isset($preco))? 0: str_replace(['.', ','], ['', '.'], $preco);
        $data['variacao'] = $variacao;
        $data['quantidade'] = $quantidade;

        $result = $this->produto->update($data, $id);

        if($result !== true){
               return json_encode($result);
        }

            echo json_encode([
                'status' => 'success',
                'title' => 'Sucesso',
                'message' => 'Produto ATUALIZADO',
                'data' => $result
            ]);

        return;
    }

    public function listAction()
    {
        header('Content-Type: application/json');

        $response = $this->produto->getAll();

        echo json_encode($response);
    }

}    

