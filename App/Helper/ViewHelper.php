<?php

namespace App\Helper;

use Core\Resource\ViewResource;
use Core\Resource\IViewResource;

class ViewHelper implements IViewResource
{
    private $view;

    public function __construct()
    {
        $this->view = new ViewResource();
    }

    public function render($view, $data = [])
    {
        $this->view->render($view, $data);    
    } 

    public function template($content, $data = [])
    {
        // $data['view'] = $this->view;
        $data['content'] = $content;
        $data['view'] = $this->view;
        $data['data'] = $data;

        $this->view->render('_template', $data);
    } 
}    

