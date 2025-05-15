<?php

namespace App\Controller;

use App\Helper\RedirectHelper;
use App\Helper\ViewHelper;

class IndexController
{
    public function __construct()
    {
        
    }

    public function indexAction()
    {
        RedirectHelper::to(URL_BASE . '?c=produto');
    }

}    

