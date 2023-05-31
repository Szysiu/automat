<?php

namespace Automat\Entity;

class Item
{
    private int $id;
    private string $name;
    private string $code;
    private int $amount;
    private float $price;
    private string $image;

    /**
     * @param int $id
     * @param string $name
     * @param string $code
     * @param int $amount
     * @param float $price
     * @param string $image
     */
    public function __construct(int $id, string $name, string $code, int $amount, float $price, string $image)
    {
        $this->id = $id;
        $this->name = $name;
        $this->code = $code;
        $this->amount = $amount;
        $this->price = $price;
        $this->image = $image;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Item
     */
    public function setId(int $id): Item
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Item
     */
    public function setName(string $name): Item
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return Item
     */
    public function setCode(string $code): Item
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     * @return Item
     */
    public function setAmount(int $amount): Item
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return Item
     */
    public function setPrice(float $price): Item
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return $this->image;
    }

    /**
     * @param string $image
     * @return Item
     */
    public function setImage(string $image): Item
    {
        $this->image = $image;
        return $this;
    }
}