<?php

namespace Automat\Utils;

interface RequestInterface
{
    public function getParam(string $name,$default=null);
    public function postParam(string $name,$default=null);
    public function isPostSet(string $name):bool;
}