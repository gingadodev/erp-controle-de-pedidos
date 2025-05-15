<?php

namespace Core\Controller; 

use Core\Http\RequestHttp;

class AppController implements IAppController
{
    private $request; 
    private $controller, $action;
    private $start = 'index';
    private $error404 = 'page not found';

    public function __construct()
    {
        $this->request    = new RequestHttp();
        $c = $this->request->get('c', $this->start);
        $a = $this->request->get('a', $this->start);

        $this->controller = ucfirst($c) . 'Controller';
        $this->action = $a . 'Action';
    }

    public function run()
    {
        $controller = 'App\\Controller\\' . $this->controller;

        if(!class_exists($controller)){
                exit(sprintf('c: %s.', $this->error404));
        }

        if(!method_exists($controller, $this->action)){
                exit(sprintf('a: %s.', $this->error404));
        }

        try {
            
        $i = new $controller();
        $i->{$this->action}();
            
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());

        }
    }
}

