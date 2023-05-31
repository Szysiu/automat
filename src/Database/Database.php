<?php

namespace Automat\Database;

use Automat\Entity\Item;
use Automat\Entity\User;
use Automat\Exceptions\AppException;
use Automat\Exceptions\DatabaseException;
use Automat\Exceptions\MissingItemException;
use Automat\Exceptions\StorageException;
use Automat\Utils\DatabaseManagerInterface;
use Exception;
use PDO;

class Database implements DatabaseManagerInterface
{
    private PDO $connection;

    /**
     * @throws DatabaseException
     */
    public function __construct()
    {
        try {
            $this->createConnection();
        }catch (Exception) {
            throw new DatabaseException('Failed to connect to database');
        }
    }

    /**
     * @throws DatabaseException
     */
    public function findAll(string $tableName): array
    {
        $tableName=htmlentities($tableName,ENT_QUOTES,'UTF-8');

        try {
            $sql='SELECT * FROM '.$tableName;
            $query=$this->connection->prepare($sql);
            $query->execute();
            $results= $query->fetchAll(PDO::FETCH_ASSOC);
        }catch (Exception $exception) {
            throw new DatabaseException('Failed to fetch products: '.$exception->getMessage());
        }

        $items=[];
        foreach ($results as $result) {
            $items[]=new Item(
                $result['id'],
                $result['name'],
                $result['code'],
                $result['amount'],
                $result['price'],
                $result['image'],
            );
        }

        return $items;
    }

    /**
     * @throws StorageException
     */
    public function findByCode(string $code): Item
    {
        $code=htmlentities($code,ENT_QUOTES,'UTF-8');
        try {
            $sql="SELECT * FROM item where code =:code";
            $query=$this->connection->prepare($sql);
            $query->bindParam(':code',$code);
            $query->execute();
            $result=$query->fetch(PDO::FETCH_ASSOC);
        }catch (Exception) {
            throw new StorageException('Failed to get note',400);
        }

        if(!$result) {
            throw new StorageException('Item not found');
        }

        return new Item($result['id'],$result['name'],$result['code'],$result['amount'],$result['price'],$result['image']);
    }

    /**
     * @throws DatabaseException
     */
    public function decreaseAmount(string $code): void
    {
        $code=htmlentities($code,ENT_QUOTES,'UTF-8');
        try {
            $sql='UPDATE item SET amount=amount-1 WHERE code=:code';
            $query=$this->connection->prepare($sql);
            $query->bindParam(':code',$code);
            $query->execute();
        }catch (Exception) {
            throw new DatabaseException('Wystąpił błąd');
        }
    }

    /**
     * @throws AppException
     */
    public function createUser(string $username, string $password): void
    {
        $username=htmlentities($username,ENT_QUOTES,'UTF-8');
        $password=htmlentities($password,ENT_QUOTES,'UTF-8');
        $hashedPassword=password_hash($password,PASSWORD_DEFAULT);
        try {

            if($this->checkUsers()) {
                $sql='INSERT INTO user (username,password) VALUES (:username,:password)';
                $query=$this->connection->prepare($sql);
                $query->bindParam(':username',$username);
                $query->bindParam(':password',$hashedPassword);
                $query->execute();
            }
        }catch (Exception $exception) {
            throw new AppException('Wystąpił bład'.$exception->getMessage());
        }

    }

    /**
     * @throws AppException
     */
    public function getUser():User
    {
        try {
            $sql='SELECT * from user';
            $query=$this->connection->prepare($sql);
            $query->execute();
            $result=$query->fetch(PDO::FETCH_ASSOC);

            $user=new User($result['username'],$result['password']);
        }catch (Exception) {
            throw new AppException('Wystąpił bład');
        }

        return $user;
    }

    /**
     * @throws DatabaseException
     */
    public function findById(int $id):Item
    {
        try {
            $sql='SELECT * FROM item WHERE id=:id';
            $query=$this->connection->prepare($sql);
            $query->bindParam(':id',$id);
            $query->execute();
            $result=$query->fetch(PDO::FETCH_ASSOC);

            return new Item($result['id'],$result['name'],$result['code'],$result['amount'],$result['price'],$result['image']);
        }catch (Exception) {
            throw new DatabaseException();
        }
    }

    /**
     * @throws DatabaseException
     */
    public function updateItem(int $id, int $amount): void
    {
        try {
            $sql='UPDATE item SET amount=:amount WHERE id=:id';
            $query=$this->connection->prepare($sql);
            $query->bindParam(':amount',$amount);
            $query->bindParam(':id',$id);
            $query->execute();
        }catch (Exception){
            throw new DatabaseException();
        }
    }

    private function createConnection(): void
    {
        $this->connection=new PDO("sqlite:".__DIR__."/automat.sqlite");
        $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

    private function checkUsers():bool
    {
        $sql='SELECT * from user';
        $query=$this->connection->prepare($sql);
        $query->execute();


        return $query->rowCount() <1;
    }
}