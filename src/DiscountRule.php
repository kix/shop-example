<?php

namespace App;

/**
 * Class DiscountRule
 */
abstract class DiscountRule
{
    abstract public function matches(Cart $cart): bool;

    abstract public function getDiscount(): Discount;
}
