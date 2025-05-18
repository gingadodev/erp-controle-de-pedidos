<?php

namespace App\Controller;

use App\Helper\RedirectHelper;
use App\Helper\ViewHelper;
use Core\Http\RequestHttp;
use App\Model\ConnModel;
use App\Model\CuponsModel;
use Exception;

class CuponsController
{
    private RequestHttp $request;
    private ConnModel $conn;
    private CuponsModel $cupons;

    public function __construct()
    {
        $this->conn = new ConnModel();
        $this->request = new RequestHttp();
        $this->cupons = new CuponsModel($this->conn);
    }

    public function indexAction()
    {
        $view = new ViewHelper();

        $data['title'] = 'Cupons';
        $data['jsList'] = ['cupom.js'];
        $data['data'] = $data;

        $view->template('cupons', $data);
    }

    public function insertAction()
    {

        header('Content-Type: application/json');

        $codigo = $this->request->post('codigo');
        $desconto = $this->request->post('desconto');
        $valor_minimo = $this->request->post('valor_minimo');
        $validade = $this->request->post('validade');
        $validade = implode('-', array_reverse(explode('/', $validade)));

        $isD = (isset($desconto));
        $isM = (isset($valor_minimo));

        $data['codigo'] = $codigo;
        $data['desconto'] = (!$isD)? 0: str_replace(['.', ','], ['', '.'], $desconto);
        $data['valor_minimo'] = (!$isM)? 0: str_replace(['.', ','], ['', '.'], $valor_minimo);
        $data['validade'] = $validade;

        try {

            $idCupom = $this->cupons->insert($data);

            $status = 'error';
            $title = 'Ops!';
            $message = 'Erro ao processar dados.';
            $result = [];

            if(isset($idCupom)){

                $status = 'success';
                $title = 'Sucesso!';
                $message = 'Cupom ADICIONADO';
                $result = $data;
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
            $result = $this->cupons->getById($id);

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
        $codigo = $this->request->post('codigo');
        $desconto = $this->request->post('desconto');
        $valor_minimo = $this->request->post('valor_minimo');
        $validade = $this->request->post('validade');
        $validade = implode('-', array_reverse(explode('/', $validade)));

        $isD = (isset($desconto));
        $isM = (isset($valor_minimo));

        $data['codigo'] = $codigo;
        $data['desconto'] = (!$isD)? 0: str_replace(['.', ','], ['', '.'], $desconto);
        $data['valor_minimo'] = (!$isM)? 0: str_replace(['.', ','], ['', '.'], $valor_minimo);
        $data['validade'] = $validade;

        $result = $this->cupons->update($data, $id);

        if($result !== true){
               return json_encode($result);
        }

            echo json_encode([
                'status' => 'success',
                'title' => 'Sucesso',
                'message' => 'Cupom ATUALIZADO',
                'data' => $result
            ]);

        return;
    }

    public function listAction()
    {
        header('Content-Type: application/json');

        $response = $this->cupons->getAll();

        echo json_encode($response);
    }

}    

