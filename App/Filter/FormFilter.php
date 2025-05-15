<?php 

namespace App\Filter;

class FormFilter implements IFormFilter
{
    private $err;

    public function __construct(array $err)
    {
        $this->err = $err;
    }

    public function isValid()
    {
        return (!count($this->err));
    } 


    public function getAllError()
    {
        return $this->err;
    } 
    
}

