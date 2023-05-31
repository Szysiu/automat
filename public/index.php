<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use Automat\Controller\ItemController;
use Automat\Controller\LoginController;
use Automat\Database\Database;
use Automat\Request\Request;
use Automat\Service\ItemService;
use Automat\Service\UserService;


try {
    $request=new Request($_GET,$_POST,$_SERVER);
    $database=new Database();
    $itemService = new ItemService($database);

    $userService=new UserService($database);
    $userService->addUser();
    $loginController=new LoginController($request,$userService);

    $controller = new ItemController($itemService,$request,$userService);
    $controller->run();

}catch (Exception $exception) {
    echo $exception->getMessage();
    exit();
}

