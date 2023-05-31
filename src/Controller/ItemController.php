<?php

namespace Automat\Controller;
session_start();

use Automat\Exceptions\DatabaseException;
use Automat\Exceptions\InvalidCretentialsExcption;
use Automat\Exceptions\ItemException;
use Automat\Exceptions\MissingItemException;
use Automat\Service\ItemService;
use Automat\Service\UserService;
use Automat\Utils\AbstractController;
use Automat\Utils\RequestInterface;
use JetBrains\PhpStorm\NoReturn;


class ItemController extends AbstractController
{
    private ItemService $itemService;
    private UserService $userService;

    public function __construct(ItemService $itemService, RequestInterface $request, UserService $userService)
    {
        parent::__construct($request);
        $this->itemService = $itemService;
        $this->userService = $userService;
    }

    public function mainAction(): void
    {
        $items = $this->itemService->getAllItems();

        $this->view->render('main', [
            'items' => $items,
            'error' => $this->request->getParam('error'),
            'message' => $this->request->getParam('message')
        ]);
    }


    public function fillAction(): void
    {
        $this->view->render('login');
    }

    public function loginAction(): void
    {
        try {
            if ($this->checkParam('username') && $this->checkParam('password')) {
                $login = $this->request->postParam('username');
                $password = $this->request->postParam('password');
                $this->userService->login($login, $password);
                $this->redirect('/', ['message' => 'logged']);
            }else {
                $this->redirect('/',[]);
            }
        } catch (InvalidCretentialsExcption $e) {
            $this->redirect('/', ['error' => $e->getMessage()]);
        }
    }

    #[NoReturn] public function logoutAction(): void
    {
        if($this->isUserLogged()) {
            $_SESSION = array();
            session_destroy();
            $this->redirect('/', ['message' => 'logout']);
        } else {
            $this->redirect('/', ['error' => '7']);
        }
    }

    public function updateAction(): void
    {
        if ($this->checkParam('amount')) {
            try {
                $id = $this->request->postParam('id');
                $amount = $this->request->postParam('amount');
                $this->itemService->updateItem($id, $amount);
                $this->redirect('/', ['message' => 'updated']);
            } catch (DatabaseException) {
                $this->redirect('/', ['error' => '5']);
            }
         } else if(!$this->isUserLogged()) {
            $this->redirect('/', ['error' => '6']);
        }

    }

    /**
     * @throws MissingItemException
     */
    public function showAction(): void
    {
        if ($this->isUserLogged()) {
            $id = $this->request->getParam('id');
            $item = $this->itemService->findItemById($id);
            $this->view->render('show', [
                'item' => $item
            ]);
        } else {
            $this->redirect('/?action=fill',[]);
        }
    }

    public function buyAction(): void
    {
        if($this->checkParam('code') && $this->checkParam('money')) {
            try {
                $code = $this->request->postParam('code');
                $money = (float)$this->request->postParam('money');
                $this->itemService->buyItem($code, $money);
                $this->redirect('/', ['message' => 'bought']);
            } catch (MissingItemException $exception) {
                $this->redirect('/', ['error' => $exception->getMessage()]);
            } catch (ItemException $e) {
                $this->redirect('/', ['error' => $e->getMessage()]);
            }
        }
    }

}