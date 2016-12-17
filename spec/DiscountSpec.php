<?php

namespace spec\App;

use App\Discount;
use Money\Currency;
use Money\Money;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DiscountSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('forPercent', [10]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Discount::class);
    }

    function it_can_have_an_amount()
    {
        $amount = new Money(10, new Currency('EUR'));
        $this->beConstructedThrough('forAmount', [$amount]);

        $this->getAmount()->shouldBe($amount);
    }

    function it_can_have_a_discount_percent()
    {
        $this->beConstructedThrough('forPercent', [10]);

        $this->getPercent()->shouldBe((float) 10);
    }

    function it_applies_percent_discount_to_money()
    {
        $expected = new Money(9, new Currency('EUR'));

        $this->beConstructedThrough('forPercent', [10]);
        $this->apply(new Money(10, new Currency('EUR')))->shouldBeSameMoneyAs($expected);
    }

    function it_applies_amount_discount_to_money()
    {
        $expected = new Money(8, new Currency('EUR'));

        $this->beConstructedThrough('forAmount', [new Money(2, new Currency('EUR'))]);
        $this->apply(new Money(10, new Currency('EUR')))->shouldBeSameMoneyAs($expected);
    }

    /**
     * @TODO Extract to an extension
     * @return array
     */
    public function getMatchers()
    {
        return [
            'beSameMoneyAs' => function(Money $subject, Money $target) {
                return $subject->compare($target) === 0;
            }
        ];
    }
}
