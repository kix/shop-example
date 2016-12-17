<?php

namespace App;

use Money\Money;

class Discount
{
    private $amount;

    private $percent;

    private function __construct(?Money $amount, ?float $percent)
    {
        $this->amount = $amount;
        $this->percent = $percent;
    }

    public static function forPercent(int $percent)
    {
        return new self(null, $percent);
    }

    public static function forAmount(Money $amount)
    {
        return new self($amount, null);
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getPercent()
    {
        return $this->percent;
    }

    public function apply(Money $money)
    {
        if ($this->amount) {
            return $money->subtract($this->amount);
        }

        return $money->multiply((100 - $this->percent) / 100);
    }
}
