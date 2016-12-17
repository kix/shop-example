<?php

namespace App;

class DiscountProcessor
{
    /**
     * @var DiscountRuleInterface[]
     */
    private $rules;

    private $verbose;

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

    public function setVerbose(bool $verbose)
    {
        $this->verbose = $verbose;
    }

    public function process(Cart $cart)
    {
        foreach ($this->rules as $rule) {
            if ($this->verbose) {
                echo "Checking rule ".get_class($rule)."\n";

            }

            if ($rule->matches($cart)) {
                echo "  + matched: ";
                $cart->addDiscount($rule->getDiscount());
            } else {
                echo "  - not matched: ";
            }

            echo " - {$rule->getDescription()}\n";
        }
    }
}
