<?php

namespace App\Controller;

use App\Helper\RedirectHelper;
use App\Helper\ViewHelper;

class ProdutoController
{
    public function __construct()
    {
        
    }

    public function indexAction()
    {
        $view = new ViewHelper();

        $data['title'] = 'Produto';
        $data['data'] = $data;

        $view->template('produto', $data);
    }

}    

