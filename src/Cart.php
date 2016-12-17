<?php

namespace App;

use Money\Currency;
use Money\Money;

class Cart
{
    const STRATEGY_PERCENT_FIRST = 0;

    private $items;

    private $discounts;

    public function __construct(int $strategy = self::STRATEGY_PERCENT_FIRST)
    {
        if ($strategy !== self::STRATEGY_PERCENT_FIRST) {
            throw new \InvalidArgumentException('Not supported yet, man');
        }

        $this->discountStrategy = $strategy;
        $this->items = [];
        $this->discounts = [];
    }

    public function addItem(ItemInterface $item)
    {
        $this->items[] = $item;
    }

    public function getItems()
    {
        return $this->items;
    }

    public function addDiscount(Discount $discount)
    {
        $this->discounts[] = $discount;
    }

    public function getDiscounts()
    {
        return $this->discounts;
    }

    public function getTotal()
    {
        // @TODO Should be more FP-ish
        // @TODO Should sort discounts
        $total = new Money(0, new Currency('EUR'));

        array_map(function(ItemInterface $item) use (&$total) {
            $total = $total->add($item->getPrice());
        }, $this->items);

        array_map(function(Discount $discount) use (&$total) {
            $total = $discount->apply($total);
        }, $this->discounts);

        return $total;
    }
}
