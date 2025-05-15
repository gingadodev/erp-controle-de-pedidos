<?php

namespace Core\Resource;

interface IViewResource
{
    public function render($view, $data = []);
}

