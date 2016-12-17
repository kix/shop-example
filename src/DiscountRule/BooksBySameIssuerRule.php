<?php

namespace App\DiscountRule;

use function Functional\pluck;
use App\DiscountRuleInterface;
use App\Cart;
use App\Discount;

/**
 * Class BooksBySameIssuerRule
 */
class BooksBySameIssuerRule implements DiscountRuleInterface
{
    private $minimumAmount = 5;

    public function matches(Cart $cart): bool
    {
        $issuers = pluck($cart->getItems(), 'issuer');

        var_dump($issuers);
    }

    public function getDiscount(): Discount
    {
        // TODO: Implement getDiscount() method.
    }
}
