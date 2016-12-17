<?php

namespace App;

class DiscountProcessor
{
    /**
     * @var DiscountRule[]
     */
    private $rules;

    /**
     * DiscountProcessor constructor.
     *
     * @param DiscountRule[] $rules
     */
    public function __construct(array $rules)
    {
        array_map(function(DiscountRule $rule) {
            $this->rules[] = $rule;
        }, $rules);
    }

    /**
     * @return DiscountRule[]
     */
    public function getRules(): array
    {
        return $this->rules;
    }

    public function process(Cart $cart)
    {
        foreach ($this->rules as $rule) {
            if ($rule->matches($cart)) {
                $cart->addDiscount($rule->getDiscount());
            }
        }
    }
}
