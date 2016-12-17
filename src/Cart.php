<?php

namespace App;

use Doctrine\Common\Collections\ArrayCollection;
use Money\Currency;
use Money\Money;

class Cart
{
    const STRATEGY_PERCENT_FIRST = 0;

    private $items;

    private $discounts;

    public function __construct(array $books = [], int $strategy = self::STRATEGY_PERCENT_FIRST)
    {
        if ($strategy !== self::STRATEGY_PERCENT_FIRST) {
            throw new \InvalidArgumentException('Not supported yet, man');
        }

        $this->discountStrategy = $strategy;
        $this->items = new ArrayCollection();
        $this->discounts = new ArrayCollection();

        array_map(function(Book $book) {
            $this->addItem($book);
        }, $books);
    }

    public function addItem(ItemInterface $item)
    {
        $this->items->add($item);
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

        $this->items->map(function(ItemInterface $item) use (&$total) {
            $total = $total->add($item->getPrice());
        });

        $this->discounts->map(function(Discount $discount) use (&$total) {
            $total = $discount->apply($total);
        });

        return $total;
    }
}
