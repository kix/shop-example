<?php

namespace spec\App;

use App\DiscountProcessor;
use App\DiscountRule;
use App\DiscountRuleInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DiscountProcessorSpec extends ObjectBehavior
{
    function let(DiscountRuleInterface $rule1, DiscountRuleInterface $rule2)
    {
        $this->beConstructedWith([$rule1, $rule2]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(DiscountProcessor::class);
    }

    function it_has_rules(DiscountRuleInterface $rule1, DiscountRuleInterface $rule2)
    {
        $rules = [$rule1, $rule2];
        $this->beConstructedWith($rules);
        $this->getRules()->shouldBeEqualTo($rules);
    }
}
