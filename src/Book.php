<?php

namespace App;

use Money\Money;

class Book implements ItemInterface
{
    private $issuer;

    private $price;

    public function __construct(Issuer $issuer, Money $price)
    {
        $this->issuer = $issuer;
        $this->price = $price;
    }

    public function getIssuer(): Issuer
    {
        return $this->issuer;
    }

    public function getPrice(): Money
    {
        return $this->price;
    }
}
