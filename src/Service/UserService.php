<?php

namespace Automat\Service;

use Automat\Entity\User;
use Automat\Exceptions\InvalidCretentialsExcption;
use Automat\Utils\DatabaseManagerInterface;

class UserService
{
    private DatabaseManagerInterface $databaseManager;

    public function __construct(DatabaseManagerInterface $databaseManager)
    {
        $this->databaseManager = $databaseManager;
    }

    public function addUser(): void
    {

        $this->databaseManager->createUser('admin','admin');

    }

    /**
     * @throws InvalidCretentialsExcption
     */
    public function login( string $login, string $password): void
    {
        $user=$this->databaseManager->getUser();

        if($login!==$user->getUsername()) {
            throw new InvalidCretentialsExcption('4');
        } elseif (!password_verify($password,$user->getPassword())) {
            throw new InvalidCretentialsExcption('5');
        }else {
            $_SESSION['logged_in']=true;
        }
    }

}