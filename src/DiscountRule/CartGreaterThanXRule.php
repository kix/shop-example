<?php

namespace App\DiscountRule;

use App\Cart;
use App\Discount;
use App\DiscountRuleInterface;
use Money\Money;

/**
 * Class CartGreaterThanXRule
 */
class CartGreaterThanXRule implements DiscountRuleInterface
{
    /**
     * @var Money
     */
    private $amount;

    public function __construct(Money $amount)
    {
        $this->amount = $amount;
    }

    public function matches(Cart $cart) : bool
    {
        return $cart->getTotal()->greaterThan($this->amount);
    }

    public function getDescription() : ?string
    {
        return sprintf(
            'Discount 10 percent if cart total is greater than %s %s',
            $this->amount->getAmount(),
            $this->amount->getCurrency()
        );
    }

    public function getDiscount() : Discount
    {
        return Discount::forPercent(10);
    }
}
