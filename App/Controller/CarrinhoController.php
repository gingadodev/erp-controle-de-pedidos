<?php

namespace App\Controller;

use Exception;
use App\Helper\RedirectHelper;
use App\Helper\ViewHelper;
use Core\Http\RequestHttp;
use App\Model\ConnModel;
use App\Helper\CarrinhoHelper;
use App\Model\ProdutoModel;

class CarrinhoController
{
    private RequestHttp $request;
    private ConnModel $conn;
    private ProdutoModel $produto;

    public function __construct()
    {
        $this->conn = new ConnModel();
        $this->request = new RequestHttp();
        $this->carrinho = new CarrinhoHelper();
        $this->produto = new ProdutoModel($this->conn);
    }

    public function indexAction()
    {
        $view = new ViewHelper();

        $data['title'] = 'Carrinho';
        $data['jsList'] = ['carrinho.js'];
        $data['data'] = $data;

        $view->template('carrinho', $data);
    }

    public function insertAction()
    {
        header('Content-Type: application/json');

        $id = $this->request->post('id');
        $this->carrinho->insert($id);			

        echo json_encode([
            'status' => 'success',
            'title' => 'Sucesso',
            'message' => 'Produto inserido ao Carrinho',
            'data' => ['id' => $id]
        ]);

        return;
    }

    public function updateAction()
    {
        header('Content-Type: application/json');

        $id = $this->request->post('id');
        $qtd = $this->request->post('quantidade');
        $this->carrinho->update($id, $qtd);			

        $listProduct = $this->produto->getAll();

        echo json_encode([
            'status' => 'success',
            'title' => 'Sucesso',
            'message' => 'Carrinho ATUALIZADO'
        ]);

        return;
    }

    public function listAction()
    {
        header('Content-Type: application/json');

        $listProduct = $this->produto->getAll();

        $list      = $this->carrinho->getContent($listProduct);
        $total     = $this->carrinho->getSubtotal($listProduct);
        $total_item = $this->carrinho->getTotalItem();

        $frete = '20,00';

        if($total >= 52.00 && $total >= 166.59){
            $frete = 15.00;
        }

        if ($total > 200.00) {
           $frete = '0,00 Gratis!';
        }

        if ($total < 1) {
           $frete = '0,00';
        }

        $frete = 'R$ ' . $frete;

        $response = [
            'status' => 'success',
            'data' => $list,
            'total' => number_format($total, 2, ',', '.'),
            'total_item' => $total_item,
            'frete' => $frete
        ];

        echo json_encode($response);
    }

    public function deleteAction()
    {
        header('Content-Type: application/json');

        $id = $this->request->post('id');
        $this->carrinho->delete($id);			

        echo json_encode([
            'status' => 'success',
            'title' => 'Sucesso',
            'message' => 'Item do Carrinho DELETADO'
        ]);

        return;

    }

}    

