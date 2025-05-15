<?php 

namespace App\Filter;

interface IFormFilter
{
    public function isValid();
    public function getAllError();
}

