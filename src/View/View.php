<?php

namespace Automat\View;

class View
{
    public function render(string $template, array $params=[]):void
    {
        require_once dirname(__FILE__).'/../../templates/base.php';
    }
}