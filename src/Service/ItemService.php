<?php

namespace Automat\Service;

use Automat\Entity\Item;
use Automat\Exceptions\DatabaseException;
use Automat\Exceptions\ItemException;
use Automat\Exceptions\MissingItemException;
use Automat\Exceptions\StorageException;
use Automat\Utils\DatabaseManagerInterface;

class ItemService
{
    private DatabaseManagerInterface $databaseManager;

    public function __construct(DatabaseManagerInterface $databaseManager)
    {
        $this->databaseManager=$databaseManager;
    }

    public function getAllItems():array
    {
        return $this->databaseManager->findAll('item');
    }

    /**
     * @throws MissingItemException
     * @throws ItemException
     */
    public function buyItem(string $code,float $money):void
    {
        try {
            $item=$this->databaseManager->findByCode($code);
            if(!$this->checkPrice($item->getPrice(),$money)) {
                throw new ItemException('2');
            }

            if(!$this->checkAmount($item)) {
                throw new ItemException('3');
            }
            $this->databaseManager->decreaseAmount($item->getCode());
        }catch (StorageException ) {
            throw new MissingItemException('1');
        }
    }

    /**
     * @throws MissingItemException
     */
    public function findItemById(int $id):Item
    {
        try {
            return $this->databaseManager->findById($id);
        }catch (DatabaseException) {
            throw new MissingItemException('1');
        }
    }

    /**
     * @throws DatabaseException
     */
    public function updateItem(int $id,int $amount):void
    {
        try {
            $this->databaseManager->updateItem($id,$amount);
        }catch (DatabaseException) {
            throw new DatabaseException();
        }
    }

    private function checkPrice(float $price,float $money):bool
    {
        return $money>=$price;
    }

    private function checkAmount(Item $item):bool
    {
        return $item->getAmount()>0;
    }



}