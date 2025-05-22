<?php

namespace App\Controller;

use Exception;
use App\Helper\RedirectHelper;
use App\Helper\ViewHelper;
use Core\Http\RequestHttp;
use App\Model\ConnModel;
use App\Helper\CarrinhoHelper;
use App\Model\ProdutoModel;
use App\Model\CuponsModel;
use App\Model\PedidosModel;

class PedidosController
{
    private RequestHttp $request;
    private ConnModel $conn;
    private ProdutoModel $produto;
    private CuponsModel $cupons;

    public function __construct()
    {
        $this->conn = new ConnModel();
        $this->request = new RequestHttp();
        $this->carrinho = new CarrinhoHelper();
        $this->produto = new ProdutoModel($this->conn);
        $this->cupons = new CuponsModel($this->conn);
        $this->pedidos = new PedidosModel($this->conn);
    }

    public function indexAction()
    {
        $view = new ViewHelper();

        $total_item = $this->carrinho->getTotalItem();

        $data['title'] = 'Pedidos';
        $data['jsList'] = ['pedidos.js'];
        $data['total_item'] = $total_item;
        $data['data'] = $data;

        $view->template('pedidos/finalizar', $data);
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

    public function comprarAction()
    {
        header('Content-Type: application/json');

        $codigo = $_SESSION['cupom'];

        $listProduct = $this->produto->getAll();

        $list      = $this->carrinho->getContent($listProduct);
        $total     = $this->carrinho->getSubtotal($listProduct);
        $total_item = $this->carrinho->getTotalItem();
        $row = $this->cupons->getByCodigo($codigo);

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

        $totalC = str_replace(['.', ','], ['', '.'], $total);
        $cupom = '';
        $desconto = '0,00';

        if ((isset($row['id'])) && $totalC >= $row['valor_minimo']) {
            $cupom = $codigo;
            $desconto = $row['desconto'];
        }

        $response = [
            'status' => 'success',
            'data' => $list,
            'total' => number_format($total, 2, ',', '.'),
            'total_item' => $total_item,
            'frete' => $frete,
            'cupom' => $cupom,
            'desconto' => $desconto,
        ];

        echo json_encode($response);
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

    public function finalizarAction()
    {
        header('Content-Type: application/json');

        $view = new ViewHelper();

        $listProduct = $this->produto->getAll();

        $codigo     = $_SESSION['cupom'];
        $list       = $this->carrinho->getContent($listProduct);
        $total      = $this->carrinho->getSubtotal($listProduct);
        $total_item = $this->carrinho->getTotalItem();
        $row        = $this->cupons->getByCodigo($codigo);

        $rua = $this->request->post('rua');
        $numero = $this->request->post('numero');
        $bairro = $this->request->post('bairro');
        $cidade = $this->request->post('cidade');
        $uf = $this->request->post('uf');
        $cep = $this->request->post('cep');

        $endereco = sprintf('%s, %s - %s, %s - %s, %s',
            $rua, $numero, $bairro, $cidade, $uf, $cep 
        );

        $frete = 20.00;

        if($total >= 52.00 && $total >= 166.59){
            $frete = 15.00;
        }

        if ($total > 200.00 || $total < 1) {
            $frete = 0.00;
        }

        $totalC = str_replace(['.', ','], ['', '.'], $total);
        $cupom = '';
        $desconto = 0.00;
        $isDesc = ((isset($row['id'])) && $totalC >= $row['valor_minimo']);

        if ($isDesc) {
            $cupom = $codigo;
            $desconto = $row['desconto'];
        }

        $data['list'] = $list;

        $data['subtotal'] = $total;
        $data['total'] = ($isDesc)? ($total - $row['desconto']): $total;
        $data['frete'] = $frete;
        $data['endereco'] = $endereco;

        $data['total_item'] = $total_item;
        $data['cupom'] = $codigo;
        $data['desconto'] = $desconto;

        $data['rua'] = $rua;
        $data['numero'] = $numero;
        $data['bairro'] = $bairro;
        $data['cidade'] = $cidade;
        $data['uf'] = $uf;
        $data['cep'] = $cep;

        $lastId = $this->pedidos->insert($data);

        if (false) { // desativado para NAO enviar email LOCAL

            ob_start();
            $view->render('pedidos/email', $data);
            $resource = ob_get_contents();
            ob_end_clean();

            $to = 'destinatario@estefanionsantos.github.io';
            $subject = 'mini ERP';
            $message = $resource ?? '';
            $headers  = "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
            $headers .= "From: remetente@estefanionsantos.github.io\r\n";
            $headers .= "Reply-To: remetente@estefanionsantos.github.io\r\n";

            $response['send'] = 'erro ao enviar email.';

            if (mail($to, $subject, $message, $headers)) {
                $response['send'] = "E-mail enviado com sucesso!";
            }

        }

        if (!is_array($lastId) && $lastId > 0) {
            $status = 'success'; 
            $title = "Sucesso";
            $message = 'Compra efetuada com sucesso.';

            $_SESSION['cart'] = [];

        }else{
            $status = 'error'; 
            $title = "Error";
            $message = 'Erro ao efetuar a compra' ;
        }



    if (false) { // desativado para nao executar localmente

    $webhookData = [
        'id' => (int) $lastId,
        'status' => 'pendente',
        'total' => $total,
        'criado_em' => date('Y-m-d H:i:s')
    ];

    $webhookUrl = 'https://estefanionsantos.github.io/webhook/pedido';

    $ch = curl_init($webhookUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($webhookData));
    $webhookResponse = curl_exec($ch);
    curl_close($ch);

    $response['webhook'] = 'Webhook enviado com os dados do pedido.';

        
    }




            $response['status'] = $status;
            $response['title'] = $title;
            $response['message'] = $message;

        echo json_encode($response);

    }


}    

