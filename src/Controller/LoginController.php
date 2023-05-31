<?php

namespace Automat\Controller;

use Automat\Exceptions\InvalidCretentialsExcption;
use Automat\Service\ItemService;
use Automat\Service\UserService;
use Automat\Utils\AbstractController;
use Automat\Utils\RequestInterface;

class LoginController extends AbstractController
{
    private UserService $userService;

    public function __construct(RequestInterface $request,UserService $userService)
    {
        parent::__construct($request);
        $this->userService=$userService;
    }

    public function loginAction():void
    {
        try {
            $login=$this->request->postParam('username');
            $password=$this->request->postParam('password');
            $this->userService->login($login,$password);
            $this->view->render('logged');
        }catch (InvalidCretentialsExcption $e) {
            $this->redirect('/',['error'=>$e->getMessage()]);
        }
    }
}