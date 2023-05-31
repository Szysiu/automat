<?php

namespace Automat\Utils;

use Automat\View\View;
use JetBrains\PhpStorm\NoReturn;

class AbstractController
{
    protected const DEF_ACTION = 'main';
    protected View $view;
    protected RequestInterface $request;


    public function __construct(RequestInterface $request)
    {
        $this->view = new View();
        $this->request = $request;
    }

    public function run(): void
    {
        $action = $this->action().'Action';

        if (!method_exists($this, $action)) {
            $action = self::DEF_ACTION . 'Action';
        }

        $this->$action();
    }

    #[NoReturn] protected function redirect(string $to, array $params):void
    {
        $location=$to;

        if(count($params)){
            $queryParams=[];
            foreach($params as $key=>$value){
                $queryParams[]=urlencode($key).'='.urlencode($value);
            }
            $queryParams=implode('&',$queryParams);
            $location.='?'. $queryParams;
        }
        header("Location: $location");
        exit();
    }

    protected function isUserLogged():bool
    {
        return (isset($_SESSION['logged_in']) && $_SESSION['logged_in']===true);
    }

    protected function checkParam(string $param):bool
    {
        return $this->request->isPostSet($param);
    }


    private function action(): string
    {
        return $this->request->getParam('action', self::DEF_ACTION);
    }
}