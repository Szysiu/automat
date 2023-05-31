<?php

namespace Automat\Utils;

use Automat\Entity\Item;
use Automat\Entity\User;

interface DatabaseManagerInterface
{
    public function findAll(string $tableName):array;
    public function findByCode(string $code):Item;
    public function decreaseAmount(string $code):void;

    public function createUser(string $username, string $password):void;
    public function getUser():User;
    public function findById(int $id);

    public function updateItem(int $id,int $amount):void;

}