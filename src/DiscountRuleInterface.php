<?php
namespace App;


/**
 * Class DiscountRule
 */
interface DiscountRuleInterface
{
    public function matches(Cart $cart) : bool;

    public function getDiscount() : Discount;
}
