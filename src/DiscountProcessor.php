<?php

namespace App;

class DiscountProcessor
{
    /**
     * @var DiscountRuleInterface[]
     */
    private $rules;

    /**
     * DiscountProcessor constructor.
     *
     * @param DiscountRuleInterface[] $rules
     */
    public function __construct(array $rules)
    {
        array_map(function(DiscountRuleInterface $rule) {
            $this->rules[] = $rule;
        }, $rules);
    }

    /**
     * @return DiscountRuleInterface[]
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
