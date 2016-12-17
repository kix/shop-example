<?php

namespace App\DiscountRule;

use App\Cart;
use App\Discount;
use App\DiscountRule;

/**
 * Class BooksBySameIssuerRule
 */
class BooksBySameIssuerRule extends DiscountRule
{
    public function matches(Cart $cart): bool
    {

    }

    public function getDiscount(): Discount
    {
        // TODO: Implement getDiscount() method.
    }
}
