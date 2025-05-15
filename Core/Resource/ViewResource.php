<?php

namespace Core\Resource;

class ViewResource implements IViewResource
{
    private $pathFormat = 'view/%s.php';
    private $error404   = 'View Not Found.';

    public function render($view, $data = [])
    {
        $file = PATH_APP . sprintf($this->pathFormat, $view) ; 

        if(!file_exists($file)){
            exit($this->error404);
        }

        if(is_array($data) && count($data)) {
            extract($data);
        }

        require $file; 
    } 
}    

