<?php

namespace Project\Controllers;

use Project\View\View;

abstract class AbstractController
{
    protected $view;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../../templates');
    }

}