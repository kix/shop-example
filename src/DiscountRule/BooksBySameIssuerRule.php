<?php

namespace App\DiscountRule;

use function Functional\{invoke,each,select};
use App\DiscountRuleInterface;
use App\Cart;
use App\Discount;

/**
 * Class BooksBySameIssuerRule
 */
class BooksBySameIssuerRule implements DiscountRuleInterface
{
    private $minimumAmount = 3;

    public function matches(Cart $cart): bool
    {
        $issuers = [];

        each(
            invoke(
                invoke($cart->getItems(), 'getIssuer'),
                'getId'
            ),
            function(int $id) use (&$issuers) {
                if (!array_key_exists($id, $issuers)) {
                    $issuers[$id] = 1;
                    return;
                }

                $issuers[$id]++;
            }
        );

        return count(select($issuers, function($el, $index) {
            return $el >= $this->minimumAmount;
        })) > 0;
    }

    public function getDiscount(): Discount
    {
        return Discount::forPercent(10);
    }

    public function getDescription() : ?string
    {
        return 'Buying 3+ books by same issuer gives 10% discount';
    }
}
