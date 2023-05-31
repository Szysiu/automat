<?php

namespace Automat\Request;

use Automat\Utils\RequestInterface;

class Request implements RequestInterface
{
    private array $get = [];
    private array $post = [];
    private array $server = [];

    public function __construct(array $get,array $post,array $server)
    {
        $this->get=$get;
        $this->post=$post;
        $this->server=$server;
    }

    public function getParam(string $name,$default=null)
    {
        return $this->get[$name] ?? $default;
    }

    public function postParam(string $name,$default=null)
    {
        return $this->post[$name] ?? $default;
    }

    public function isPostSet(string $name): bool
    {
        return isset($this->post[$name]);
    }
}