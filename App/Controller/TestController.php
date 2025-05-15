<?php

namespace App\Controller;

use App\Helper\ViewHelper;
use App\Helper\RedirectHelper;
use App\Model\ConnModel;
use Core\Http\SessionHttp;

class TestController
{
    public function __construct()
    {
        $this->session = new SessionHttp();
    }

    public function indexAction()
    {
        $view = new ViewHelper();
        $view->render('test');
    } 

    public function sessionAction()
    {
        echo '<pre>';
        print_r($this->session->getAll());
        echo '</pre>';
    } 

    public function pageAction()
    {
        $view = new ViewHelper();

        $list =[
            [
                'id' => 1, 
                'name' => 'Aries', 
                'email' => 'aries@example.com', 
            ],
            [
                'id' => 2, 
                'name' => 'Poseidon', 
                'email' => 'poseidon@example.com', 
            ],
            [
                'id' => 3, 
                'name' => 'Afrodite', 
                'email' => 'afrodite@example.com', 
            ]
        ];

        $data['title'] = 'Example';
        $data['list'] = $list;

        $view->template(
            'test-page', 
            $data
        );
    }

}    

